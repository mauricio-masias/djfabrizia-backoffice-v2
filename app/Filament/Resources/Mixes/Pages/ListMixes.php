<?php

namespace App\Filament\Resources\Mixes\Pages;

use App\Filament\Resources\Mixes\MixResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMixes extends ListRecords
{
    protected static string $resource = MixResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
