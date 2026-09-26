<?php

namespace App\Filament\Resources\RecordLabels\Pages;

use App\Filament\Resources\RecordLabels\RecordLabelResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRecordLabel extends EditRecord
{
    protected static string $resource = RecordLabelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
