<?php

namespace App\Filament\Resources\Mixes\Pages;

use App\Filament\Actions\SyncNowAction;
use App\Filament\Resources\Mixes\MixResource;
use Djfabrizia\Content\Enums\SyncProvider;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMixes extends ListRecords
{
    protected static string $resource = MixResource::class;

    protected function getHeaderActions(): array
    {
        return [
            SyncNowAction::make(SyncProvider::Mixcloud),
            CreateAction::make(),
        ];
    }
}
