<?php

namespace App\Filament\Concerns;

use App\Sync\SyncProgress;
use Djfabrizia\Content\Enums\SyncProvider;
use Filament\Notifications\Notification;

/**
 * For Livewire pages with "Sync now" buttons: remembers which syncs were in
 * progress and announces each one that finishes. The check runs on every
 * request (so any poll or refresh notices a finished sync) and can also be
 * called directly.
 */
trait TracksSyncProgress
{
    /**
     * Providers whose sync was in progress at the last look.
     *
     * @var list<string>
     */
    public array $syncingProviders = [];

    public function mountTracksSyncProgress(): void
    {
        $this->syncingProviders = SyncProgress::currentlySyncing();
    }

    public function hydrateTracksSyncProgress(): void
    {
        $this->refreshSyncProgress();
    }

    public function refreshSyncProgress(): void
    {
        $now = SyncProgress::currentlySyncing();

        foreach (array_diff($this->syncingProviders, $now) as $value) {
            $provider = SyncProvider::tryFrom($value);
            $run = $provider === null ? null : SyncProgress::latestRun($provider);

            if ($provider === null || $run === null) {
                continue;
            }

            $counts = ($run->created + $run->updated) > 0 ? " — {$run->created} added, {$run->updated} updated" : '';

            Notification::make()
                ->title("{$provider->label()} sync finished")
                ->body($run->status->label().$counts)
                ->color($run->status->color())
                ->send();
        }

        $this->syncingProviders = $now;
    }
}
