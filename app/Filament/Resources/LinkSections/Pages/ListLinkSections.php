<?php

namespace App\Filament\Resources\LinkSections\Pages;

use App\Filament\Resources\LinkSections\LinkSectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLinkSections extends ListRecords
{
    protected static string $resource = LinkSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
