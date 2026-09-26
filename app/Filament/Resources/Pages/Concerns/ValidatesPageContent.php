<?php

namespace App\Filament\Resources\Pages\Concerns;

use Djfabrizia\Content\Blocks\BlockValidator;
use Djfabrizia\Content\Enums\PageLocale;
use Djfabrizia\Content\Enums\PageTemplate;
use Djfabrizia\Content\Models\Page;
use Filament\Notifications\Notification;
use Filament\Support\Exceptions\Halt;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

/**
 * Final checks before a page is written: the whole block list must be valid
 * for the template (a second line behind the field rules), and there can be
 * only one EPK per template and language.
 */
trait ValidatesPageContent
{
    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function validatePageContent(array $data, ?Page $current = null): array
    {
        $template = $data['template'] instanceof PageTemplate ? $data['template'] : PageTemplate::from((string) $data['template']);
        $locale = $data['locale'] instanceof PageLocale ? $data['locale'] : PageLocale::from((string) $data['locale']);

        if ($template->isEpk() && Page::query()->epk($locale, $template)->when($current, fn ($query) => $query->whereKeyNot($current?->getKey()))->exists()) {
            $this->failWith('That EPK already exists', "There is already a {$template->label()} page in {$locale->label()}.");
        }

        try {
            $data['blocks'] = app(BlockValidator::class)->validate($template, array_values($data['blocks'] ?? []));
        } catch (ValidationException $exception) {
            $this->failWith('Some components are not valid', implode(' ', Arr::flatten($exception->errors())));
        }

        return $data;
    }

    private function failWith(string $title, string $body): never
    {
        Notification::make()->title($title)->body($body)->danger()->persistent()->send();

        throw new Halt;
    }
}
