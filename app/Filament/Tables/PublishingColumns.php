<?php

namespace App\Filament\Tables;

use App\Filament\Support\EnumColumn;
use Djfabrizia\Content\Enums\ContentSource;
use Djfabrizia\Content\Enums\PublishStatus;
use Filament\Actions\BulkAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Columns, filters and bulk actions shared by the publishable collections.
 */
final class PublishingColumns
{
    /**
     * @return list<TextColumn|IconColumn>
     */
    public static function columns(bool $synced = false): array
    {
        $columns = [
            EnumColumn::make('status')->sortable(),
            TextColumn::make('published_at')->label('Published')->date()->sortable()->toggleable(),
        ];

        if ($synced) {
            $columns[] = EnumColumn::make('source')->toggleable();
            $columns[] = IconColumn::make('source_missing_at')
                ->label('Upstream')
                ->state(fn (Model $record): bool => $record->getAttribute('source_missing_at') === null)
                ->boolean()
                ->trueIcon(Heroicon::OutlinedCheckCircle)
                ->falseIcon(Heroicon::OutlinedExclamationTriangle)
                ->falseColor('warning')
                ->tooltip(fn (Model $record): ?string => $record->getAttribute('source_missing_at') === null ? null : 'Missing upstream since the last sync')
                ->toggleable();
        }

        return $columns;
    }

    /**
     * @return list<SelectFilter|TernaryFilter>
     */
    public static function filters(bool $synced = false): array
    {
        $filters = [
            SelectFilter::make('status')->options(PublishStatus::options()),
        ];

        if ($synced) {
            $filters[] = SelectFilter::make('source')->options(ContentSource::options());
            $filters[] = TernaryFilter::make('missing')
                ->label('Missing upstream')
                ->queries(
                    true: fn (Builder $query): Builder => $query->whereNotNull('source_missing_at'),
                    false: fn (Builder $query): Builder => $query->whereNull('source_missing_at'),
                );
        }

        return $filters;
    }

    /**
     * @return list<BulkAction>
     */
    public static function bulkActions(): array
    {
        return [
            BulkAction::make('publish')
                ->icon(Heroicon::OutlinedEye)
                ->requiresConfirmation()
                ->action(fn (Collection $records) => $records->each->update(['status' => PublishStatus::Published]))
                ->deselectRecordsAfterCompletion(),
            BulkAction::make('unpublish')
                ->label('Move to draft')
                ->icon(Heroicon::OutlinedEyeSlash)
                ->requiresConfirmation()
                ->action(fn (Collection $records) => $records->each->update(['status' => PublishStatus::Draft]))
                ->deselectRecordsAfterCompletion(),
        ];
    }
}
