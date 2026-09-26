<?php

namespace App\Filament\Resources\Videos\Tables;

use App\Filament\Tables\PublishingColumns;
use Djfabrizia\Content\Models\Video;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VideosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('')
                    ->state(fn (Video $record): string => "https://i.ytimg.com/vi/{$record->youtube_id}/mqdefault.jpg")
                    ->imageWidth(72)
                    ->imageHeight(40),
                TextColumn::make('title')->searchable()->wrap()->description(fn (Video $record): ?string => $record->duration),
                TextColumn::make('youtube_id')->label('YouTube ID')->searchable()->copyable()->toggleable(isToggledHiddenByDefault: true),
                ...PublishingColumns::columns(synced: true),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters(PublishingColumns::filters(synced: true))
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
