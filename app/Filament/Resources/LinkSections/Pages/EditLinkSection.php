<?php

namespace App\Filament\Resources\LinkSections\Pages;

use App\Filament\Resources\LinkSections\LinkSectionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLinkSection extends EditRecord
{
    protected static string $resource = LinkSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
