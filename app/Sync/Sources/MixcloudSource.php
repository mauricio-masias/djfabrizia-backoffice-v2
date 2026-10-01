<?php

namespace App\Sync\Sources;

use App\Settings\SiteSettings;
use App\Sync\Duration;
use App\Sync\FetchResult;
use App\Sync\SyncHttp;
use Djfabrizia\Content\Enums\ContentSource;
use Djfabrizia\Content\Enums\SyncProvider;
use Djfabrizia\Content\Models\Mix;
use Djfabrizia\Content\Taxonomy\GenreResolver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use RuntimeException;
use Throwable;

/**
 * Mixcloud shows (public API, no credentials) → mixes.
 */
class MixcloudSource extends CollectionSource
{
    private const PAGE_SIZE = 100;

    private const MAX_PAGES = 20;

    private const SHORT_NAME_LENGTH = 30;

    public function __construct(private readonly GenreResolver $genres) {}

    public function provider(): SyncProvider
    {
        return SyncProvider::Mixcloud;
    }

    public function topic(): string
    {
        return 'mixes';
    }

    protected function model(): string
    {
        return Mix::class;
    }

    protected function keyColumn(): string
    {
        return 'external_id';
    }

    protected function contentSource(): ContentSource
    {
        return ContentSource::Mixcloud;
    }

    public function fetch(): FetchResult
    {
        $user = trim((string) SiteSettings::get('sync', 'mixcloud_user'), '/ ');

        if ($user === '') {
            throw new RuntimeException('Set the Mixcloud username on the Settings page.');
        }

        $url = config('services.mixcloud.api_url')."/{$user}/cloudcasts/?limit=".self::PAGE_SIZE;
        $items = [];

        for ($page = 0; $page < self::MAX_PAGES && $url !== null; $page++) {
            try {
                $response = SyncHttp::client()->get($url)->throw();
            } catch (Throwable $exception) {
                if ($items === []) {
                    throw $exception;
                }

                // Keep what was read; the run is partial and removes nothing.
                return new FetchResult($items, complete: false, warning: 'Stopped at page '.($page + 1).': '.$exception->getMessage());
            }

            foreach ((array) $response->json('data', []) as $show) {
                if (is_array($show) && is_string($show['key'] ?? null)) {
                    $items[$show['key']] = $this->map($show);
                }
            }

            $next = $response->json('paging.next');
            $url = is_string($next) && $next !== '' ? $next : null;
        }

        return new FetchResult($items, complete: $url === null, warning: $url === null ? null : 'Stopped after '.self::MAX_PAGES.' pages.');
    }

    /**
     * @param  array<string, mixed>  $show
     * @return array<string, mixed>
     */
    private function map(array $show): array
    {
        $created = is_string($show['created_time'] ?? null) ? Carbon::parse($show['created_time']) : null;
        $name = (string) ($show['name'] ?? '');

        return [
            'title' => $name,
            'url' => (string) $show['key'],
            'image_url' => $show['pictures']['320wx320h'] ?? null,
            'image_small_url' => $show['pictures']['thumbnail'] ?? null,
            'released_at' => $created,
            'duration' => Duration::fromSeconds(is_numeric($show['audio_length'] ?? null) ? (int) $show['audio_length'] : null),
            'source_tags' => array_values(array_filter(array_map(
                fn (mixed $tag): ?string => is_array($tag) && is_string($tag['name'] ?? null) ? $tag['name'] : null,
                is_array($show['tags'] ?? null) ? $show['tags'] : [],
            ))),
            'published_at' => $created,
            'create_only' => ['short_name' => Str::limit($name, self::SHORT_NAME_LENGTH, '')],
        ];
    }

    /**
     * Genres follow the tags, but only when the tags change: an editor's own
     * genre choice survives later syncs.
     */
    protected function afterSave(Model $model, array $item, bool $upstreamChanged): void
    {
        if ($model instanceof Mix && ($model->wasRecentlyCreated || $model->wasChanged('source_tags'))) {
            $model->genres()->sync($this->genres->resolveMany($model->source_tags ?? [])->pluck('id')->all());
        }
    }
}
