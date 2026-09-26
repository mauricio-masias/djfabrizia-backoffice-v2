<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Filament\Resources\Pages\Concerns\ValidatesPageContent;
use App\Filament\Resources\Pages\PageResource;
use Djfabrizia\Content\Enums\PageTemplate;
use Filament\Resources\Pages\CreateRecord;

class CreatePage extends CreateRecord
{
    use ValidatesPageContent;

    protected static string $resource = PageResource::class;

    /**
     * A new page with no components starts from its template's skeleton.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['blocks'])) {
            $data['blocks'] = PageTemplate::from((string) $data['template'])->skeleton();
        }

        return $this->validatePageContent($data);
    }
}
