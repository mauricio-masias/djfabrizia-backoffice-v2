<?php

namespace App\Filament\Resources\Playlists\Pages;

use App\Filament\Actions\SyncNowAction;
use App\Filament\Resources\Playlists\PlaylistResource;
use Djfabrizia\Content\Enums\SyncProvider;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPlaylists extends ListRecords
{
    protected static string $resource = PlaylistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            SyncNowAction::make(SyncProvider::Spotify),
            CreateAction::make(),
        ];
    }
}
