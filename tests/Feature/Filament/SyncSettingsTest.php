<?php

namespace Tests\Feature\Filament;

use App\Filament\Pages\Settings;
use App\Filament\Resources\Mixes\Pages\ListMixes;
use App\Jobs\SyncProviderJob;
use App\Settings\SiteSettings;
use App\Sync\SyncRunner;
use Djfabrizia\Content\Enums\SyncProvider;
use Djfabrizia\Content\Enums\SyncStatus;
use Djfabrizia\Content\Models\Setting;
use Djfabrizia\Content\Models\SyncRun;
use Filament\Actions\Testing\TestAction;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\AccountWidget;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Sleep;
use Livewire\Livewire;

class SyncSettingsTest extends AdminTestCase
{
    public function test_settings_render_a_daily_sync_toggle_per_provider(): void
    {
        Livewire::test(Settings::class)
            ->assertFormFieldExists('sync.mixcloud_enabled')
            ->assertFormFieldExists('sync.spotify_enabled')
            ->assertFormFieldExists('sync.youtube_enabled')
            ->assertSet('data.sync.mixcloud_enabled', true)
            ->assertSet('data.sync.youtube_enabled', true);
    }

    public function test_a_missing_value_means_the_sync_is_enabled(): void
    {
        foreach (SyncProvider::cases() as $provider) {
            $this->assertTrue(SiteSettings::syncEnabled($provider));
        }
    }

    public function test_saving_persists_the_toggles(): void
    {
        Livewire::test(Settings::class)
            ->fillForm(['sync' => ['spotify_enabled' => false]])
            ->call('save')
            ->assertNotified();

        $this->assertFalse(SiteSettings::syncEnabled(SyncProvider::Spotify));
        $this->assertTrue(SiteSettings::syncEnabled(SyncProvider::Mixcloud));
        $this->assertTrue(SiteSettings::syncEnabled(SyncProvider::Youtube));
    }

    public function test_the_schedule_skips_only_disabled_providers(): void
    {
        SiteSettings::save(['sync' => ['spotify_enabled' => false], 'bookings' => []]);

        $this->assertTrue($this->scheduledSync('sync-mixcloud')->filtersPass($this->app));
        $this->assertFalse($this->scheduledSync('sync-spotify')->filtersPass($this->app));
        $this->assertTrue($this->scheduledSync('sync-youtube')->filtersPass($this->app));
    }

    public function test_sync_now_still_dispatches_when_the_daily_sync_is_off(): void
    {
        Queue::fake();
        SiteSettings::save(['sync' => ['mixcloud_enabled' => false], 'bookings' => []]);

        Livewire::test(ListMixes::class)->callAction('syncNow')->assertNotified('Sync queued');

        Queue::assertPushed(SyncProviderJob::class);
    }

    public function test_settings_offer_the_api_cache_rebuild(): void
    {
        Http::fake();

        Livewire::test(Settings::class)
            ->assertSee('API cache')
            ->assertSee('Rebuild API cache')
            ->callAction(TestAction::make('rebuildApiCache')->schemaComponent('apiCacheActions', schema: 'content'))
            ->assertNotified();
    }

    public function test_the_dashboard_no_longer_shows_the_account_widget(): void
    {
        $this->get('/admin')->assertOk()->assertDontSeeLivewire(AccountWidget::class);
    }

    public function test_the_status_shows_never_synced_without_a_run(): void
    {
        Livewire::test(Settings::class)->assertSee('Never synced')->assertDontSee('Last sync:');
    }

    public function test_the_status_shows_the_latest_run_in_utc_whatever_the_app_timezone(): void
    {
        config(['app.timezone' => 'Europe/London']);
        SyncRun::factory()->create([
            'provider' => SyncProvider::Mixcloud,
            'status' => SyncStatus::Success,
            'started_at' => Carbon::parse('2026-07-01 13:59:00', 'UTC'),
            'finished_at' => Carbon::parse('2026-07-01 14:05:00', 'UTC'),
        ]);
        SyncRun::factory()->create([
            'provider' => SyncProvider::Mixcloud,
            'status' => SyncStatus::Failed,
            'error' => 'old failure',
            'started_at' => Carbon::parse('2026-06-01 10:00:00', 'UTC'),
            'finished_at' => Carbon::parse('2026-06-01 10:00:05', 'UTC'),
        ]);

        Livewire::test(Settings::class)
            ->assertSee('Success')
            ->assertSee('Last sync: 01/07/26 14:05 (UTC)')
            ->assertDontSee('old failure')
            ->assertSee('Never synced');
    }

    public function test_a_running_run_falls_back_to_its_start_time(): void
    {
        SyncRun::factory()->create([
            'provider' => SyncProvider::Spotify,
            'status' => SyncStatus::Running,
            'started_at' => Carbon::parse('2026-01-02 03:04:00', 'UTC'),
            'finished_at' => null,
        ]);

        Livewire::test(Settings::class)->assertSee('Last sync: 02/01/26 03:04 (UTC)');
    }

    public function test_a_failed_run_shows_a_truncated_error(): void
    {
        SyncRun::factory()->failed(str_repeat('x', 400))->create(['provider' => SyncProvider::Youtube]);
        SyncRun::factory()->failed('Quota exceeded')->create(['provider' => SyncProvider::Spotify]);

        Livewire::test(Settings::class)
            ->assertSee('Failed')
            ->assertSee('Quota exceeded')
            ->assertSee(str_repeat('x', 100))
            ->assertDontSee(str_repeat('x', 200));
    }

    public function test_test_connection_reports_success_without_writing_a_run_or_queueing(): void
    {
        Queue::fake();
        Http::fake(['api.mixcloud.com/djfabrizia/' => Http::response(['username' => 'djfabrizia'])]);
        SiteSettings::save(['sync' => ['mixcloud_user' => 'djfabrizia'], 'bookings' => []]);

        Livewire::test(Settings::class)
            ->callAction(TestAction::make('testConnectionMixcloud')->schemaComponent('mixcloudActions', schema: 'form'))
            ->assertNotified('Mixcloud connection works');

        $this->assertSame(0, SyncRun::query()->count());
        Queue::assertNothingPushed();
    }

    public function test_test_connection_reports_a_redacted_failure(): void
    {
        Queue::fake();
        Sleep::fake();
        config(['services.youtube.api_key' => 'yt-secret-key']);
        SiteSettings::save(['sync' => ['youtube_channel_id' => 'UC123'], 'bookings' => []]);
        Http::fake(['www.googleapis.com/*' => Http::response(['error' => 'bad'], 403)]);

        Livewire::test(Settings::class)
            ->callAction(TestAction::make('testConnectionYoutube')->schemaComponent('youtubeActions', schema: 'form'))
            ->assertNotified('Youtube connection failed');

        $this->assertSame(0, SyncRun::query()->count());
        Queue::assertNothingPushed();
    }

    public function test_a_failed_http_check_shows_the_providers_full_reason(): void
    {
        $reason = 'Active premium subscription required for the owner of the app. When the subscription status changes, it can take a few hours before requests are allowed again.';
        Http::fake(['api.spotify.com/*' => Http::response($reason, 403)]);

        try {
            Http::get('https://api.spotify.com/v1/users/x/playlists')->throw();
            $this->fail('Expected the request to fail.');
        } catch (RequestException $exception) {
            $this->assertSame('HTTP 403: '.$reason, Settings::failureMessage($exception));
        }
    }

    public function test_a_failed_http_check_prefers_the_json_error_message(): void
    {
        Http::fake(['www.googleapis.com/*' => Http::response(['error' => ['message' => 'API key expired. Please renew the API key.']], 400)]);

        try {
            Http::get('https://www.googleapis.com/youtube/v3/channels')->throw();
            $this->fail('Expected the request to fail.');
        } catch (RequestException $exception) {
            $this->assertSame('HTTP 400: API key expired. Please renew the API key.', Settings::failureMessage($exception));
        }
    }

    public function test_the_spotify_row_offers_connect_and_shows_not_connected(): void
    {
        config(['services.spotify.refresh_token' => null]);

        Livewire::test(Settings::class)
            ->assertSee('Spotify login: not connected')
            ->assertSee('Connect Spotify')
            ->assertDontSee('Reconnect Spotify');
    }

    public function test_the_spotify_login_shows_when_it_expires(): void
    {
        $this->travelTo(Carbon::parse('2026-03-01 12:00:00', 'UTC'));
        config(['services.spotify.refresh_token' => 'env']);
        Setting::put('spotify', 'connected_at', '2026-02-01T10:00:00+00:00');

        Livewire::test(Settings::class)
            ->assertSee('Reconnect Spotify')
            ->assertSee('Spotify login: connected 01/02/26 (UTC) · expires in 153 days');

        $this->travelTo(Carbon::parse('2026-07-20 12:00:00', 'UTC'));
        Livewire::test(Settings::class)->assertSee('expires in 12 days');

        $this->travelTo(Carbon::parse('2026-08-02 12:00:00', 'UTC'));
        Livewire::test(Settings::class)->assertSee('Login expired — reconnect');
    }

    private function rowAction(string $action, string $provider): TestAction
    {
        return TestAction::make($action)->schemaComponent("{$provider}Actions", schema: 'form');
    }

    private function connectSpotify(?string $connectedAt = null): void
    {
        config(['services.spotify.refresh_token' => 'env-refresh', 'services.spotify.client_id' => 'c', 'services.spotify.client_secret' => 's']);
        Setting::put('spotify', 'connected_at', $connectedAt ?? now()->toIso8601String());
    }

    private function fakeAllProviders(?PromiseInterface $youtube = null): void
    {
        config(['services.youtube.api_key' => 'k', 'services.spotify.refresh_token' => 'env-refresh', 'services.spotify.client_id' => 'c', 'services.spotify.client_secret' => 's']);
        SiteSettings::save(['sync' => ['mixcloud_user' => 'djfabrizia', 'youtube_channel_id' => 'UC123', 'spotify_user_id' => 'me'], 'bookings' => []]);
        Http::fake([
            'api.mixcloud.com/*' => Http::response(['username' => 'djfabrizia']),
            'www.googleapis.com/*' => $youtube ?? Http::response(['items' => [['contentDetails' => ['relatedPlaylists' => ['uploads' => 'UU1']]]]]),
            'accounts.spotify.com/*' => Http::response(['access_token' => 't', 'expires_in' => 3600]),
            'api.spotify.com/v1/me' => Http::response(['id' => 'me']),
            'api.spotify.com/v1/me/playlists*' => Http::response(['items' => [], 'total' => 2]),
        ]);
    }

    public function test_the_rows_are_ordered_mixcloud_youtube_spotify_and_separated(): void
    {
        Livewire::test(Settings::class)
            ->assertSeeInOrder(['Mixcloud username', 'YouTube channel ID', 'Spotify user ID'])
            ->assertDontSeeHtml('data-sync-row-separator="mixcloud"')
            ->assertSeeHtmlInOrder(['data-sync-row-separator="youtube"', 'data-sync-row-separator="spotify"']);
    }

    public function test_sync_now_shows_for_mixcloud_and_youtube_and_for_spotify_only_when_connected(): void
    {
        config(['services.spotify.refresh_token' => null]);

        Livewire::test(Settings::class)
            ->assertSee('Sync from Mixcloud')
            ->assertSee('Sync from Youtube')
            ->assertDontSee('Sync from Spotify');

        $this->connectSpotify('2020-01-01T00:00:00+00:00');
        Livewire::test(Settings::class)->assertDontSee('Sync from Spotify');

        $this->connectSpotify();
        Livewire::test(Settings::class)->assertSee('Sync from Spotify');
    }

    public function test_sync_now_from_the_settings_page_dispatches_even_when_the_daily_sync_is_off(): void
    {
        Queue::fake();
        SiteSettings::save(['sync' => ['youtube_enabled' => false], 'bookings' => []]);

        Livewire::test(Settings::class)
            ->callAction($this->rowAction('syncNow', 'youtube'))
            ->assertNotified('Sync queued');

        Queue::assertPushed(SyncProviderJob::class, fn (SyncProviderJob $job): bool => $job->provider === SyncProvider::Youtube);
    }

    public function test_the_first_render_calls_no_provider_and_shows_pending_icons(): void
    {
        $this->fakeAllProviders();

        Livewire::test(Settings::class)
            ->assertSet('connectionChecks', [])
            ->assertActionHasColor($this->rowAction('testConnectionMixcloud', 'mixcloud'), 'gray');

        Http::assertNothingSent();
    }

    public function test_the_deferred_check_calls_each_provider_and_stores_the_result(): void
    {
        Queue::fake();
        $this->fakeAllProviders();

        $page = Livewire::test(Settings::class)->call('runConnectionChecks');

        $checks = $page->get('connectionChecks');
        $this->assertSame(['mixcloud', 'youtube', 'spotify'], array_keys($checks));
        $this->assertSame([true, true, true], array_column($checks, 'ok'));
        $this->assertSame('Connected to Spotify as me: 2 playlists.', $checks['spotify']['message']);
        $this->assertMatchesRegularExpression('/^\d{2}:\d{2}$/', $checks['mixcloud']['checked_at']);
        $page->assertActionHasColor($this->rowAction('testConnectionMixcloud', 'mixcloud'), 'gray')
            ->assertSeeHtml('connection-check-ok')
            ->assertActionHasIcon($this->rowAction('testConnectionMixcloud', 'mixcloud'), Heroicon::OutlinedCheckCircle);
        $this->assertSame(0, SyncRun::query()->count());
        Queue::assertNothingPushed();
    }

    public function test_one_failing_provider_does_not_break_the_others(): void
    {
        Sleep::fake();
        $this->fakeAllProviders(Http::response(['error' => 'bad key=secret'], 403));

        $page = Livewire::test(Settings::class)->call('runConnectionChecks');

        $checks = $page->get('connectionChecks');
        $this->assertTrue($checks['mixcloud']['ok']);
        $this->assertFalse($checks['youtube']['ok']);
        $this->assertTrue($checks['spotify']['ok']);
        $this->assertStringNotContainsString('secret', $checks['youtube']['message']);
        $page->assertActionHasColor($this->rowAction('testConnectionYoutube', 'youtube'), 'gray')
            ->assertSeeHtml('connection-check-failed')
            ->assertActionHasIcon($this->rowAction('testConnectionYoutube', 'youtube'), Heroicon::OutlinedXCircle);
    }

    public function test_a_disconnected_spotify_is_not_called_and_shows_not_connected(): void
    {
        $this->fakeAllProviders();
        config(['services.spotify.refresh_token' => null]);

        $page = Livewire::test(Settings::class)->call('runConnectionChecks');

        $this->assertArrayNotHasKey('spotify', $page->get('connectionChecks'));
        Http::assertNotSent(fn (Request $request): bool => str_contains($request->url(), 'spotify.com'));
        $page->assertActionHasColor($this->rowAction('testConnectionSpotify', 'spotify'), 'gray');
    }

    public function test_pressing_test_connection_runs_a_live_check_and_updates_the_state(): void
    {
        $this->fakeAllProviders();

        $page = Livewire::test(Settings::class)
            ->callAction($this->rowAction('testConnectionMixcloud', 'mixcloud'))
            ->assertNotified('Mixcloud connection works');

        $this->assertTrue($page->get('connectionChecks')['mixcloud']['ok']);
        $this->assertArrayNotHasKey('youtube', $page->get('connectionChecks'));
    }

    public function test_an_idle_page_has_no_spinner_and_no_polling(): void
    {
        Livewire::test(Settings::class)
            ->assertDontSeeHtml('sync-in-progress')
            ->assertDontSeeHtml('wire:poll')
            ->assertDontSee('Syncing…')
            ->assertSet('syncingProviders', []);
    }

    public function test_clicking_sync_now_queues_marks_and_shows_the_spinner_at_once(): void
    {
        Queue::fake();

        $page = Livewire::test(Settings::class)
            ->callAction($this->rowAction('syncNow', 'youtube'))
            ->assertSet('syncingProviders', ['youtube'])
            ->assertSee('Syncing…')
            ->assertSeeHtml('sync-in-progress')
            ->assertSeeHtml('wire:poll.5s="refreshSyncProgress"');

        Queue::assertPushed(SyncProviderJob::class);
        $this->assertTrue(SyncProviderJob::isQueued(SyncProvider::Youtube));
        $this->assertFalse(SyncProviderJob::isQueued(SyncProvider::Mixcloud));
        $page->assertActionDisabled($this->rowAction('syncNow', 'youtube'));
    }

    public function test_a_running_run_counts_as_syncing(): void
    {
        SyncRun::factory()->create(['provider' => SyncProvider::Mixcloud, 'status' => SyncStatus::Running, 'finished_at' => null]);

        Livewire::test(Settings::class)
            ->assertSet('syncingProviders', ['mixcloud'])
            ->assertSeeHtml('sync-in-progress')
            ->assertSeeHtml('wire:poll.5s');
    }

    public function test_the_job_clears_the_queued_marker_when_it_starts_and_when_it_fails(): void
    {
        SyncProviderJob::markQueued(SyncProvider::Mixcloud);
        (new SyncProviderJob(SyncProvider::Mixcloud))->handle(app(SyncRunner::class));
        $this->assertFalse(SyncProviderJob::isQueued(SyncProvider::Mixcloud));

        SyncProviderJob::markQueued(SyncProvider::Spotify);
        (new SyncProviderJob(SyncProvider::Spotify))->failed(null);
        $this->assertFalse(SyncProviderJob::isQueued(SyncProvider::Spotify));
    }

    public function test_the_poll_announces_a_finished_sync_and_stops_polling(): void
    {
        SyncProviderJob::markQueued(SyncProvider::Mixcloud);
        $page = Livewire::test(Settings::class)->assertSet('syncingProviders', ['mixcloud']);

        Cache::forget(SyncProviderJob::queuedCacheKey(SyncProvider::Mixcloud));
        SyncRun::factory()->create(['provider' => SyncProvider::Mixcloud, 'status' => SyncStatus::Partial, 'created' => 3, 'updated' => 1]);

        $page->call('refreshSyncProgress')
            ->assertNotified('Mixcloud sync finished')
            ->assertSet('syncingProviders', [])
            ->assertDontSeeHtml('wire:poll');
    }

    public function test_the_poll_stays_quiet_while_the_sync_is_still_running(): void
    {
        SyncProviderJob::markQueued(SyncProvider::Mixcloud);
        $page = Livewire::test(Settings::class)->call('refreshSyncProgress');

        $page->assertNotNotified()->assertSet('syncingProviders', ['mixcloud']);
    }

    private function scheduledSync(string $name): Event
    {
        return collect(app(Schedule::class)->events())
            ->firstOrFail(fn (Event $event): bool => $event->description === $name);
    }
}
