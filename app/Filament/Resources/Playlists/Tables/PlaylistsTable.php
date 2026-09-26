<?php

namespace App\Filament\Resources\Playlists\Tables;

use App\Filament\Tables\PublishingColumns;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PlaylistsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url')->label('')->square()->imageSize(40),
                TextColumn::make('title')->searchable()->wrap(),
                TextColumn::make('tracks_total')->label('Tracks')->numeric()->sortable(),
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
