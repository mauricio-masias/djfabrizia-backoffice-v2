<?php

namespace App\Filament\Resources\UkVenues\Pages;

use App\Filament\Resources\UkVenues\UkVenueResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUkVenue extends EditRecord
{
    protected static string $resource = UkVenueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
