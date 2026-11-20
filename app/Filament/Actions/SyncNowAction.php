<?php

namespace App\Filament\Actions;

use App\Jobs\SyncProviderJob;
use App\Sync\SyncProgress;
use Djfabrizia\Content\Enums\SyncProvider;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;

/**
 * Queues a provider sync. It runs within a minute (the scheduler drains the
 * queue) and shows up under System → Sync runs.
 */
final class SyncNowAction
{
    public static function make(SyncProvider $provider): Action
    {
        return Action::make('syncNow')
            ->icon(Heroicon::OutlinedArrowPath)
            ->color('gray')
            // While queued or running: spinning icon (see theme.css), "Syncing…", no double queue.
            ->label(fn (): string => SyncProgress::isSyncing($provider) ? 'Syncing…' : 'Sync from '.$provider->label())
            ->disabled(fn (): bool => SyncProgress::isSyncing($provider))
            ->extraAttributes(fn (): array => SyncProgress::isSyncing($provider) ? ['class' => 'sync-in-progress'] : [])
            ->requiresConfirmation()
            ->modalDescription("New items are added and published, changed ones updated, and items removed from {$provider->label()} are deleted here (unless a page uses them). Status and order you set are kept.")
            ->after(function (object $livewire): void {
                if (property_exists($livewire, 'syncingProviders')) {
                    $livewire->syncingProviders = SyncProgress::currentlySyncing();
                }
            })
            ->action(function () use ($provider): void {
                SyncProviderJob::dispatch($provider);
                SyncProviderJob::markQueued($provider);

                Notification::make()
                    ->title('Sync queued')
                    ->body('It starts within a minute; results appear under System → Sync runs.')
                    ->success()
                    ->send();
            });
    }
}
