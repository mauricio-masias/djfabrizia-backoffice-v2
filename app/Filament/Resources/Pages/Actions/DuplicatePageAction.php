<?php

namespace App\Filament\Resources\Pages\Actions;

use App\Filament\Resources\Pages\PageResource;
use Djfabrizia\Content\Enums\PageLocale;
use Djfabrizia\Content\Enums\PublishStatus;
use Djfabrizia\Content\Models\Page;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Illuminate\Validation\Rule;

/**
 * Copies a page (typically an EPK into the other language) as an independent
 * draft. Nothing links the copy to the original afterwards.
 */
final class DuplicatePageAction
{
    public static function make(): Action
    {
        return Action::make('duplicate')
            ->icon(Heroicon::OutlinedDocumentDuplicate)
            ->modalDescription('The copy starts as a draft and is edited independently from this page.')
            ->fillForm(fn (Page $record): array => [
                'title' => $record->title.' (copy)',
                'slug' => $record->slug.'-copy',
                'locale' => $record->locale === PageLocale::English ? PageLocale::Italian->value : PageLocale::English->value,
            ])
            ->schema([
                TextInput::make('title')->required()->maxLength(255),
                TextInput::make('slug')->required()->maxLength(255)->regex('/^[a-z0-9]+(?:-[a-z0-9]+)*$/')->rules([Rule::unique(Page::class, 'slug')]),
                Select::make('locale')->label('Language')->options(PageLocale::options())->required(),
            ])
            ->action(function (Page $record, array $data, Action $action): void {
                $locale = PageLocale::from($data['locale']);

                if ($record->template->isEpk() && Page::query()->epk($locale, $record->template)->exists()) {
                    Notification::make()
                        ->title('That EPK already exists')
                        ->body("There is already a {$record->template->label()} page in ".$locale->label().'.')
                        ->danger()
                        ->send();

                    $action->halt();
                }

                $copy = $record->replicate(['legacy_wp_id', 'published_at']);
                $copy->fill([
                    'title' => $data['title'],
                    'slug' => $data['slug'],
                    'locale' => $locale,
                    'status' => PublishStatus::Draft,
                ])->save();

                Notification::make()->title('Page duplicated')->success()->send();

                $action->redirect(PageResource::getUrl('edit', ['record' => $copy]));
            });
    }
}
