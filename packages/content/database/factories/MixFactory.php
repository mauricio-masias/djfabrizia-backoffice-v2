<?php

namespace Djfabrizia\Content\Database\Factories;

use Djfabrizia\Content\Database\Factories\Concerns\HasPublishStates;
use Djfabrizia\Content\Enums\ContentSource;
use Djfabrizia\Content\Models\Mix;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Mix>
 */
class MixFactory extends Factory
{
    use HasPublishStates;

    protected $model = Mix::class;

    public function definition(): array
    {
        $title = Str::title(fake()->unique()->words(4, true)).' Radio Show';
        $slug = Str::slug($title);

        return [
            'title' => $title,
            'short_name' => Str::limit($title, 30, ''),
            'url' => "/djfabrizia/{$slug}/",
            'image_url' => 'https://thumbnailer.mixcloud.com/unsafe/320x320/'.fake()->uuid(),
            'image_small_url' => 'https://thumbnailer.mixcloud.com/unsafe/60x60/'.fake()->uuid(),
            'released_at' => fake()->dateTimeBetween('-5 years'),
            'duration' => fake()->numberBetween(45, 120).':'.str_pad((string) fake()->numberBetween(0, 59), 2, '0', STR_PAD_LEFT),
            'source_tags' => fake()->randomElements(['House', 'Tech house', 'Deep house', 'Techno', 'Classic house'], 3),
            'source' => ContentSource::Mixcloud,
            'external_id' => "/djfabrizia/{$slug}/",
            'status' => 'draft',
            'published_at' => null,
            'sort' => 0,
            'source_missing_at' => null,
            'legacy_wp_id' => null,
        ];
    }

    public function manual(): static
    {
        return $this->state(fn (): array => [
            'source' => ContentSource::Manual,
            'external_id' => null,
        ]);
    }

    public function missingUpstream(): static
    {
        return $this->state(fn (): array => [
            'source_missing_at' => now(),
            'status' => 'draft',
        ]);
    }
}
