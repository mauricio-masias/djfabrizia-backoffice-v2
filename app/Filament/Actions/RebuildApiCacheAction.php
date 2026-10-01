<?php

namespace App\Filament\Actions;

use App\Publishing\EndpointWarmer;
use Djfabrizia\Content\Enums\PublishEventStatus;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;

/**
 * Rebuilds every public API payload now (replaces the WordPress "On demand"
 * page). Normally not needed: saves publish their own changes.
 */
final class RebuildApiCacheAction
{
    public static function make(): Action
    {
        return Action::make('rebuildApiCache')
            ->label('Rebuild API cache')
            ->icon(Heroicon::OutlinedArrowPath)
            ->color('gray')
            ->requiresConfirmation()
            ->modalDescription('Rebuilds every page and list the website reads. Changes you save are published automatically; use this only if something looks out of date.')
            ->action(function (): void {
                $event = app(EndpointWarmer::class)->flush(['all']);
                $ok = $event?->status === PublishEventStatus::Warmed;

                Notification::make()
                    ->title($ok ? 'API cache rebuilt' : 'Rebuild not done yet')
                    ->body($ok
                        ? ($event->response['totals']['warmed'] ?? 0).' payloads rebuilt.'
                        : (string) ($event->response['error'] ?? 'It will be retried within a minute.'))
                    ->color($ok ? 'success' : 'warning')
                    ->send();
            });
    }
}
