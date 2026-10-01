<?php

namespace App\Filament\Resources\PublishEvents\Pages;

use App\Filament\Actions\RebuildApiCacheAction;
use App\Filament\Resources\PublishEvents\PublishEventResource;
use Filament\Resources\Pages\ListRecords;

class ListPublishEvents extends ListRecords
{
    protected static string $resource = PublishEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            RebuildApiCacheAction::make(),
        ];
    }
}
