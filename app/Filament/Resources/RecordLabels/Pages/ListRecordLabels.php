<?php

namespace App\Filament\Resources\RecordLabels\Pages;

use App\Filament\Resources\RecordLabels\RecordLabelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRecordLabels extends ListRecords
{
    protected static string $resource = RecordLabelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
