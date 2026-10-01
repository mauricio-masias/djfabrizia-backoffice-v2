<?php

namespace App\Filament\Resources\Pages\Actions;

use Djfabrizia\Content\Models\Page;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\HtmlString;

/**
 * Shows the JSON the website would receive for this page, drafts included.
 * Fetched server to server, so the preview token never reaches the browser.
 */
final class PreviewJsonAction
{
    public static function make(): Action
    {
        return Action::make('previewJson')
            ->label('Preview JSON')
            ->icon(Heroicon::OutlinedCodeBracket)
            ->color('gray')
            ->modalHeading(fn (Page $record): string => 'API preview: '.$record->slug)
            ->modalSubmitAction(false)
            ->modalCancelActionLabel('Close')
            ->modalWidth('5xl')
            ->modalContent(fn (Page $record): HtmlString => new HtmlString(
                '<pre class="text-xs overflow-auto max-h-[70vh] p-4 rounded-lg bg-gray-950 text-gray-100">'.e(self::fetch($record)).'</pre>',
            ));
    }

    public static function fetch(Page $page): string
    {
        $url = rtrim((string) config('cms.endpoint.url'), '/').'/api/v2/preview/pages/'.rawurlencode($page->slug);

        try {
            $response = Http::acceptJson()->timeout(10)->withToken((string) config('cms.endpoint.preview_token'))->get($url);
        } catch (ConnectionException $exception) {
            return 'The API could not be reached: '.$exception->getMessage();
        }

        if (! $response->successful()) {
            return "The API answered {$response->status()}: ".mb_substr($response->body(), 0, 500);
        }

        return (string) json_encode($response->json(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}
