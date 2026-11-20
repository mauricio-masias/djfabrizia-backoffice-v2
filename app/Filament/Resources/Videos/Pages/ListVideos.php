<?php

namespace App\Filament\Resources\Videos\Pages;

use App\Filament\Actions\SyncNowAction;
use App\Filament\Concerns\PollsSyncProgress;
use App\Filament\Resources\Videos\VideoResource;
use Djfabrizia\Content\Enums\SyncProvider;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVideos extends ListRecords
{
    use PollsSyncProgress;

    protected static string $resource = VideoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            SyncNowAction::make(SyncProvider::Youtube),
            CreateAction::make(),
        ];
    }
}
