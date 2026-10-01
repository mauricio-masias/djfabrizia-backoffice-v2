<?php

namespace App\Filament\Resources\PublishEvents;

use App\Filament\NavigationGroup;
use App\Filament\Resources\PublishEvents\Pages\ListPublishEvents;
use App\Filament\Support\EnumColumn;
use App\Models\User;
use BackedEnum;
use Djfabrizia\Content\Enums\PublishEventStatus;
use Djfabrizia\Content\Models\PublishEvent;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use UnitEnum;

/**
 * Read-only log of what was sent to the public API cache, and whether it worked.
 */
class PublishEventResource extends Resource
{
    protected static ?string $model = PublishEvent::class;

    protected static ?string $modelLabel = 'publish log entry';

    protected static ?string $navigationLabel = 'Publish log';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSignal;

    protected static string|UnitEnum|null $navigationGroup = NavigationGroup::System;

    protected static ?int $navigationSort = 4;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                EnumColumn::make('status'),
                TextColumn::make('targets')->label('Changed')->badge()->color('gray'),
                TextColumn::make('user_id')
                    ->label('By')
                    ->formatStateUsing(fn (?int $state): string => $state === null ? 'System' : (string) User::query()->whereKey($state)->value('name'))
                    ->placeholder('System'),
                TextColumn::make('response')
                    ->label('Result')
                    ->state(fn (PublishEvent $record): string => isset($record->response['totals'])
                        ? ($record->response['totals']['warmed'] ?? 0).' rebuilt in '.($record->response['duration_ms'] ?? '?').' ms'
                        : (string) ($record->response['error'] ?? ''))
                    ->wrap(),
                TextColumn::make('created_at')->label('When')->since()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')->options(PublishEventStatus::options()),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPublishEvents::route('/'),
        ];
    }
}
