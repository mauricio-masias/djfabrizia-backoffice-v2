<?php

namespace App\Filament\Actions;

use App\Jobs\SyncProviderJob;
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
            ->label('Sync from '.$provider->label())
            ->icon(Heroicon::OutlinedArrowPath)
            ->color('gray')
            ->requiresConfirmation()
            ->modalDescription("New items are added and published, changed ones updated, and items removed from {$provider->label()} are deleted here (unless a page uses them). Status and order you set are kept.")
            ->action(function () use ($provider): void {
                SyncProviderJob::dispatch($provider);

                Notification::make()
                    ->title('Sync queued')
                    ->body('It starts within a minute; results appear under System → Sync runs.')
                    ->success()
                    ->send();
            });
    }
}
