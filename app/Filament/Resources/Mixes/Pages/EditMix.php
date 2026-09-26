<?php

namespace App\Filament\Resources\Mixes\Pages;

use App\Filament\Resources\Mixes\MixResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMix extends EditRecord
{
    protected static string $resource = MixResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
