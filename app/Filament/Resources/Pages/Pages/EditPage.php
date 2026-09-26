<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Filament\Resources\Pages\Actions\DuplicatePageAction;
use App\Filament\Resources\Pages\Concerns\ValidatesPageContent;
use App\Filament\Resources\Pages\PageResource;
use Djfabrizia\Content\Legacy\WordpressPages;
use Djfabrizia\Content\Models\Page;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPage extends EditRecord
{
    use ValidatesPageContent;

    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DuplicatePageAction::make(),
            DeleteAction::make()
                ->hidden(fn (Page $record): bool => self::isSitePage($record)),
        ];
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $page = $this->getRecord();

        return $this->validatePageContent(
            [...$data, 'template' => $data['template'] ?? $page->getAttribute('template')],
            $page instanceof Page ? $page : null,
        );
    }

    /**
     * Pages the public site requests by name cannot be deleted.
     */
    public static function isSitePage(Page $page): bool
    {
        return in_array($page->slug, array_column(WordpressPages::all(), 'slug'), true);
    }
}
