<?php

namespace App\Filament\Resources\SyncRuns;

use App\Filament\NavigationGroup;
use App\Filament\Resources\SyncRuns\Pages\ListSyncRuns;
use App\Filament\Support\EnumColumn;
use BackedEnum;
use Djfabrizia\Content\Enums\SyncProvider;
use Djfabrizia\Content\Enums\SyncStatus;
use Djfabrizia\Content\Models\SyncRun;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use UnitEnum;

/**
 * Read-only log of the Mixcloud, Spotify and YouTube syncs.
 */
class SyncRunResource extends Resource
{
    protected static ?string $model = SyncRun::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowPath;

    protected static string|UnitEnum|null $navigationGroup = NavigationGroup::System;

    protected static ?int $navigationSort = 3;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                EnumColumn::make('provider'),
                EnumColumn::make('status'),
                TextColumn::make('started_at')->label('Started')->dateTime()->sortable(),
                TextColumn::make('duration')
                    ->state(fn (SyncRun $record): ?string => $record->finished_at === null ? null : $record->started_at->diffInSeconds($record->finished_at).' s'),
                TextColumn::make('created')->label('New'),
                TextColumn::make('updated')->label('Updated'),
                TextColumn::make('missing')->label('Removed upstream'),
                TextColumn::make('error')->label('Notes')->wrap()->limit(160)->color(fn (SyncRun $record): string => $record->status === SyncStatus::Failed ? 'danger' : 'warning'),
            ])
            ->defaultSort('started_at', 'desc')
            ->filters([
                SelectFilter::make('provider')->options(SyncProvider::options()),
                SelectFilter::make('status')->options(SyncStatus::options()),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSyncRuns::route('/'),
        ];
    }
}
