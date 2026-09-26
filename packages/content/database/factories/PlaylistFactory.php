<?php

namespace Djfabrizia\Content\Database\Factories;

use Djfabrizia\Content\Database\Factories\Concerns\HasPublishStates;
use Djfabrizia\Content\Enums\ContentSource;
use Djfabrizia\Content\Models\Playlist;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Playlist>
 */
class PlaylistFactory extends Factory
{
    use HasPublishStates;

    protected $model = Playlist::class;

    public function definition(): array
    {
        $id = Str::random(22);
        $title = Str::title(fake()->unique()->words(3, true));

        return [
            'title' => $title,
            'short_name' => $title,
            'url' => "https://open.spotify.com/playlist/{$id}",
            'uri' => "spotify:playlist:{$id}",
            'image_url' => 'https://i.scdn.co/image/'.fake()->sha1(),
            'owner_url' => 'https://open.spotify.com/user/11162006882',
            'owner_id' => '11162006882',
            'tracks_total' => fake()->numberBetween(10, 120),
            'collaborative' => false,
            'source' => ContentSource::Spotify,
            'external_id' => $id,
            'status' => 'draft',
            'published_at' => null,
            'sort' => 0,
            'source_missing_at' => null,
            'legacy_wp_id' => null,
        ];
    }
}
