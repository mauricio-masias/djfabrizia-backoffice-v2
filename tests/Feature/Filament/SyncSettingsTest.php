<?php

namespace Tests\Feature\Filament;

use App\Filament\Pages\Settings;
use App\Filament\Resources\Mixes\Pages\ListMixes;
use App\Jobs\SyncProviderJob;
use App\Settings\SiteSettings;
use Djfabrizia\Content\Enums\SyncProvider;
use Filament\Actions\Testing\TestAction;
use Filament\Widgets\AccountWidget;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
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

    private function scheduledSync(string $name): Event
    {
        return collect(app(Schedule::class)->events())
            ->firstOrFail(fn (Event $event): bool => $event->description === $name);
    }
}
