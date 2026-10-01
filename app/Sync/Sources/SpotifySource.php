<?php

namespace App\Sync\Sources;

use App\Settings\SiteSettings;
use App\Sync\FetchResult;
use App\Sync\SyncHttp;
use Djfabrizia\Content\Enums\ContentSource;
use Djfabrizia\Content\Enums\SyncProvider;
use Djfabrizia\Content\Models\Playlist;
use RuntimeException;
use Throwable;

/**
 * Spotify playlists of the configured user → playlists.
 */
class SpotifySource extends CollectionSource
{
    private const PAGE_SIZE = 50;

    private const MAX_PAGES = 20;

    public function __construct(private readonly SpotifyTokens $tokens) {}

    public function provider(): SyncProvider
    {
        return SyncProvider::Spotify;
    }

    public function topic(): string
    {
        return 'playlists';
    }

    protected function model(): string
    {
        return Playlist::class;
    }

    protected function keyColumn(): string
    {
        return 'external_id';
    }

    protected function contentSource(): ContentSource
    {
        return ContentSource::Spotify;
    }

    public function fetch(): FetchResult
    {
        $user = trim((string) SiteSettings::get('sync', 'spotify_user_id'));

        if ($user === '') {
            throw new RuntimeException('Set the Spotify user ID on the Settings page.');
        }

        $token = $this->tokens->accessToken();
        $url = config('services.spotify.api_url').'/users/'.rawurlencode($user).'/playlists?limit='.self::PAGE_SIZE;
        $items = [];

        for ($page = 0; $page < self::MAX_PAGES && $url !== null; $page++) {
            try {
                $response = SyncHttp::client()->withToken($token)->get($url)->throw();
            } catch (Throwable $exception) {
                if ($items === []) {
                    throw $exception;
                }

                // Keep what was read; the run is partial and removes nothing.
                return new FetchResult($items, complete: false, warning: 'Stopped at page '.($page + 1).': '.$exception->getMessage());
            }

            foreach ((array) $response->json('items', []) as $playlist) {
                if (is_array($playlist) && is_string($playlist['id'] ?? null)) {
                    $items[$playlist['id']] = $this->map($playlist);
                }
            }

            $next = $response->json('next');
            $url = is_string($next) && $next !== '' ? $next : null;
        }

        return new FetchResult($items, complete: $url === null, warning: $url === null ? null : 'Stopped after '.self::MAX_PAGES.' pages.');
    }

    /**
     * @param  array<string, mixed>  $playlist
     * @return array<string, mixed>
     */
    private function map(array $playlist): array
    {
        $total = $playlist['tracks']['total'] ?? $playlist['items']['total'] ?? null;

        return [
            'title' => (string) ($playlist['name'] ?? ''),
            'url' => (string) ($playlist['external_urls']['spotify'] ?? ''),
            'uri' => $playlist['uri'] ?? null,
            'image_url' => $playlist['images'][0]['url'] ?? null,
            'owner_url' => $playlist['owner']['external_urls']['spotify'] ?? null,
            'owner_id' => $playlist['owner']['id'] ?? null,
            'tracks_total' => is_numeric($total) ? (int) $total : null,
            'collaborative' => (bool) ($playlist['collaborative'] ?? false),
            'create_only' => ['short_name' => (string) ($playlist['name'] ?? '')],
        ];
    }
}
