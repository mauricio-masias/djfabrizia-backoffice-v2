<?php

namespace App\Import\Wordpress\Steps;

use App\Import\Wordpress\ImportContext;
use App\Import\Wordpress\Publishing;
use Djfabrizia\Content\Enums\ContentSource;
use Djfabrizia\Content\Models\Playlist;

class PlaylistsStep implements ImportStep
{
    public function name(): string
    {
        return 'playlists';
    }

    public function run(ImportContext $context): void
    {
        foreach ($context->source->posts('playlists') as $post) {
            $meta = $context->source->meta($post->ID);
            $url = (string) $meta->get('playlist_url');

            if ($url === '') {
                $context->skipped($this->name(), "playlist {$post->ID} has no URL");

                continue;
            }

            $playlist = Playlist::query()->updateOrCreate(['legacy_wp_id' => $post->ID], [
                'title' => $post->post_title,
                'short_name' => $meta->get('playlist_short_name'),
                'url' => $url,
                'uri' => $meta->get('playlist_uri'),
                'image_url' => $meta->get('playlist_image'),
                'owner_url' => $meta->get('owner_url'),
                'owner_id' => $meta->get('owner_id'),
                'tracks_total' => $meta->int('tracks_total'),
                'collaborative' => in_array(strtolower((string) $meta->get('collaborative')), ['1', 'true', 'yes'], true),
                'source' => ContentSource::Spotify,
                'external_id' => $meta->get('playlist_id') ?: null,
                ...Publishing::of($post),
            ]);

            $context->saved($this->name(), $playlist);
        }
    }
}
