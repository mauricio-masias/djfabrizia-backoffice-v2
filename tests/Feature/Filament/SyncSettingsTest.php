<?php

namespace Tests\Feature\Filament;

use App\Filament\Pages\Settings;
use App\Filament\Resources\Mixes\Pages\ListMixes;
use App\Jobs\SyncProviderJob;
use App\Settings\SiteSettings;
use Djfabrizia\Content\Enums\SyncProvider;
use Djfabrizia\Content\Enums\SyncStatus;
use Djfabrizia\Content\Models\Setting;
use Djfabrizia\Content\Models\SyncRun;
use Filament\Actions\Testing\TestAction;
use Filament\Widgets\AccountWidget;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Carbon;
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

    private function scheduledSync(string $name): Event
    {
        return collect(app(Schedule::class)->events())
            ->firstOrFail(fn (Event $event): bool => $event->description === $name);
    }
}
