<?php

namespace App\Filament\Resources\UkVenues\Pages;

use App\Filament\Resources\UkVenues\UkVenueResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUkVenues extends ListRecords
{
    protected static string $resource = UkVenueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
