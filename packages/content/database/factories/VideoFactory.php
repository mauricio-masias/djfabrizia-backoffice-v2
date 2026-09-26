<?php

namespace Djfabrizia\Content\Database\Factories;

use Djfabrizia\Content\Database\Factories\Concerns\HasPublishStates;
use Djfabrizia\Content\Enums\ContentSource;
use Djfabrizia\Content\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Video>
 */
class VideoFactory extends Factory
{
    use HasPublishStates;

    protected $model = Video::class;

    public function definition(): array
    {
        return [
            'youtube_id' => fake()->unique()->regexify('[A-Za-z0-9_-]{11}'),
            'title' => Str::title(fake()->words(5, true)),
            'duration' => fake()->numberBetween(1, 59).':'.str_pad((string) fake()->numberBetween(0, 59), 2, '0', STR_PAD_LEFT),
            'source' => ContentSource::Youtube,
            'status' => 'draft',
            'published_at' => null,
            'sort' => 0,
            'source_missing_at' => null,
            'legacy_wp_id' => null,
        ];
    }
}
