<?php

namespace App\Filament\Resources\Mixes\Tables;

use App\Filament\Tables\PublishingColumns;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MixesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_small_url')->label('')->square()->imageSize(40),
                TextColumn::make('title')->searchable()->wrap()->description(fn ($record): ?string => $record->duration),
                TextColumn::make('genres.name')->badge()->limitList(3)->toggleable(),
                TextColumn::make('released_at')->label('Released')->date()->sortable(),
                ...PublishingColumns::columns(synced: true),
            ])
            ->defaultSort('released_at', 'desc')
            ->filters([
                ...PublishingColumns::filters(synced: true),
                SelectFilter::make('genres')->relationship('genres', 'name')->multiple()->preload(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    ...PublishingColumns::bulkActions(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
