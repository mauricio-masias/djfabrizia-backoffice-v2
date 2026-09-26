<?php

namespace App\Filament\Forms;

use Djfabrizia\Content\Enums\ContentSource;
use Filament\Schemas\Components\Callout;
use Illuminate\Database\Eloquent\Model;

/**
 * Explains why upstream fields are read-only on synced rows, and flags rows that
 * disappeared upstream.
 */
final class SyncedNotice
{
    public static function make(): Callout
    {
        return Callout::make(fn (?Model $record): string => self::isMissing($record)
            ? 'This item is no longer available upstream'
            : 'Synced from '.self::source($record)?->label())
            ->description(fn (?Model $record): string => self::isMissing($record)
                ? 'It was set to draft by the last sync. It is kept so nothing breaks; delete it once it is no longer used.'
                : 'Titles, links, images and durations come from the provider and are refreshed on every sync. Status and order stay yours.')
            ->color(fn (?Model $record): string => self::isMissing($record) ? 'warning' : 'info')
            ->visible(fn (?Model $record): bool => self::isSynced($record))
            ->columnSpanFull();
    }

    public static function isSynced(?Model $record): bool
    {
        return self::source($record)?->isSynced() ?? false;
    }

    private static function source(?Model $record): ?ContentSource
    {
        $source = $record?->getAttribute('source');

        return $source instanceof ContentSource ? $source : null;
    }

    private static function isMissing(?Model $record): bool
    {
        return $record?->getAttribute('source_missing_at') !== null;
    }
}
