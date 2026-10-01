<?php

namespace App\Sync\Sources;

use App\Settings\SiteSettings;
use App\Sync\Duration;
use App\Sync\FetchResult;
use App\Sync\SyncHttp;
use Djfabrizia\Content\Enums\ContentSource;
use Djfabrizia\Content\Enums\SyncProvider;
use Djfabrizia\Content\Models\Video;
use Illuminate\Support\Carbon;
use RuntimeException;
use Throwable;

/**
 * Uploads of the configured YouTube channel → videos. The channel setting can
 * be a channel ID ("UC…"), a handle ("@name") or a legacy username.
 */
class YoutubeSource extends CollectionSource
{
    private const PAGE_SIZE = 50;

    private const MAX_PAGES = 20;

    public function provider(): SyncProvider
    {
        return SyncProvider::Youtube;
    }

    public function topic(): string
    {
        return 'videos';
    }

    protected function model(): string
    {
        return Video::class;
    }

    protected function keyColumn(): string
    {
        return 'youtube_id';
    }

    protected function contentSource(): ContentSource
    {
        return ContentSource::Youtube;
    }

    public function fetch(): FetchResult
    {
        $key = (string) config('services.youtube.api_key');
        $channel = trim((string) SiteSettings::get('sync', 'youtube_channel_id'));

        if ($key === '') {
            throw new RuntimeException('The YouTube API key is missing: set YOUTUBE_API_KEY in .env.');
        }

        if ($channel === '') {
            throw new RuntimeException('Set the YouTube channel on the Settings page.');
        }

        [$uploads, $complete] = $this->uploads($this->uploadsPlaylist($channel, $key), $key);
        $items = [];

        foreach (array_chunk(array_keys($uploads), self::PAGE_SIZE) as $ids) {
            $details = $this->api('videos', ['part' => 'contentDetails,snippet', 'id' => implode(',', $ids), 'maxResults' => self::PAGE_SIZE], $key);

            foreach ((array) ($details['items'] ?? []) as $video) {
                $id = $video['id'] ?? null;

                if (is_string($id) && isset($uploads[$id])) {
                    $items[$id] = [
                        'title' => (string) ($video['snippet']['title'] ?? $uploads[$id]['title']),
                        'duration' => Duration::fromIso8601($video['contentDetails']['duration'] ?? null),
                        'published_at' => $uploads[$id]['published_at'],
                    ];
                }
            }
        }

        return new FetchResult($items, $complete, $complete ? null : 'Stopped after '.self::MAX_PAGES.' pages.');
    }

    private function uploadsPlaylist(string $channel, string $key): string
    {
        $lookups = str_starts_with($channel, 'UC')
            ? [['id' => $channel]]
            : [['forHandle' => '@'.ltrim($channel, '@')], ['forUsername' => ltrim($channel, '@')]];

        foreach ($lookups as $lookup) {
            $playlist = $this->api('channels', ['part' => 'contentDetails', ...$lookup], $key)['items'][0]['contentDetails']['relatedPlaylists']['uploads'] ?? null;

            if (is_string($playlist) && $playlist !== '') {
                return $playlist;
            }
        }

        throw new RuntimeException("YouTube channel '{$channel}' was not found.");
    }

    /**
     * @return array{0: array<string, array{title: string, published_at: Carbon|null}>, 1: bool}
     */
    private function uploads(string $playlistId, string $key): array
    {
        $uploads = [];
        $pageToken = null;
        $page = 0;

        do {
            try {
                $response = $this->api('playlistItems', array_filter([
                    'part' => 'snippet,contentDetails',
                    'playlistId' => $playlistId,
                    'maxResults' => self::PAGE_SIZE,
                    'pageToken' => $pageToken,
                ]), $key);
            } catch (Throwable $exception) {
                if ($uploads === []) {
                    throw $exception;
                }

                // Keep what was read; the run is partial and removes nothing.
                return [$uploads, false];
            }

            foreach ((array) ($response['items'] ?? []) as $item) {
                $id = $item['contentDetails']['videoId'] ?? null;
                $published = $item['contentDetails']['videoPublishedAt'] ?? null;

                // Private and deleted videos have no publish date.
                if (is_string($id) && is_string($published)) {
                    $uploads[$id] = ['title' => (string) ($item['snippet']['title'] ?? ''), 'published_at' => Carbon::parse($published)];
                }
            }

            $pageToken = is_string($response['nextPageToken'] ?? null) ? $response['nextPageToken'] : null;
            $page++;
        } while ($pageToken !== null && $page < self::MAX_PAGES);

        return [$uploads, $pageToken === null];
    }

    /**
     * @param  array<string, mixed>  $query
     * @return array<string, mixed>
     */
    private function api(string $resource, array $query, string $key): array
    {
        $response = SyncHttp::client()->get(config('services.youtube.api_url').'/'.$resource, [...$query, 'key' => $key])->throw();

        return (array) $response->json();
    }
}
