<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\Mixes\Pages\ListMixes;
use App\Filament\Resources\Playlists\Pages\ListPlaylists;
use App\Filament\Resources\SyncRuns\Pages\ListSyncRuns;
use App\Filament\Resources\Videos\Pages\ListVideos;
use App\Jobs\SyncProviderJob;
use Djfabrizia\Content\Enums\SyncProvider;
use Djfabrizia\Content\Enums\SyncStatus;
use Djfabrizia\Content\Models\SyncRun;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\DataProvider;

class SyncProgressListPagesTest extends AdminTestCase
{
    /**
     * @return array<string, array{0: class-string, 1: SyncProvider, 2: string}>
     */
    public static function listPages(): array
    {
        return [
            'mixes' => [ListMixes::class, SyncProvider::Mixcloud, 'Mixcloud'],
            'videos' => [ListVideos::class, SyncProvider::Youtube, 'Youtube'],
            'playlists' => [ListPlaylists::class, SyncProvider::Spotify, 'Spotify'],
        ];
    }

    /**
     * @param  class-string  $page
     */
    #[DataProvider('listPages')]
    public function test_an_idle_page_has_no_spinner_and_no_polling(string $page, SyncProvider $provider, string $label): void
    {
        Livewire::test($page)
            ->assertSee("Sync from {$label}")
            ->assertDontSee('Syncing…')
            ->assertDontSeeHtml('sync-in-progress')
            ->assertDontSeeHtml('wire:poll')
            ->assertSet('syncingProviders', []);
    }

    /**
     * @param  class-string  $page
     */
    #[DataProvider('listPages')]
    public function test_clicking_sync_queues_marks_and_spins_with_polling_on(string $page, SyncProvider $provider, string $label): void
    {
        Queue::fake();

        Livewire::test($page)
            ->callAction('syncNow')
            ->assertSet('syncingProviders', [$provider->value])
            ->assertSee('Syncing…')
            ->assertSeeHtml('sync-in-progress')
            ->assertSeeHtml('wire:poll.5s')
            ->assertActionDisabled('syncNow');

        Queue::assertPushed(SyncProviderJob::class, fn (SyncProviderJob $job): bool => $job->provider === $provider);
        $this->assertTrue(SyncProviderJob::isQueued($provider));
    }

    /**
     * @param  class-string  $page
     */
    #[DataProvider('listPages')]
    public function test_a_running_run_counts_as_syncing(string $page, SyncProvider $provider, string $label): void
    {
        SyncRun::factory()->create(['provider' => $provider, 'status' => SyncStatus::Running, 'finished_at' => null]);

        Livewire::test($page)
            ->assertSet('syncingProviders', [$provider->value])
            ->assertSeeHtml('sync-in-progress')
            ->assertSeeHtml('wire:poll.5s');
    }

    /**
     * @param  class-string  $page
     */
    #[DataProvider('listPages')]
    public function test_a_finished_sync_is_announced_once_and_polling_stops(string $page, SyncProvider $provider, string $label): void
    {
        SyncProviderJob::markQueued($provider);
        $component = Livewire::test($page)->assertSet('syncingProviders', [$provider->value]);

        Cache::forget(SyncProviderJob::queuedCacheKey($provider));
        SyncRun::factory()->create(['provider' => $provider, 'status' => SyncStatus::Success, 'created' => 2, 'updated' => 0]);

        // Any request (here a plain refresh, like a table poll) notices it.
        $component->call('$refresh')
            ->assertNotified("{$label} sync finished")
            ->assertSet('syncingProviders', [])
            ->assertDontSeeHtml('wire:poll');

        $component->call('$refresh')->assertNotNotified();
    }

    public function test_the_sync_runs_page_shows_the_state_too(): void
    {
        SyncRun::factory()->create(['provider' => SyncProvider::Mixcloud, 'status' => SyncStatus::Running, 'finished_at' => null]);

        Livewire::test(ListSyncRuns::class)->assertSee('Syncing…')->assertSeeHtml('wire:poll.5s');
    }
}
