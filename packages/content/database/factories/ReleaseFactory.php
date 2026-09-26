<?php

namespace Djfabrizia\Content\Database\Factories;

use Djfabrizia\Content\Database\Factories\Concerns\HasPublishStates;
use Djfabrizia\Content\Enums\CoverSource;
use Djfabrizia\Content\Enums\ReleasePlatform;
use Djfabrizia\Content\Models\Media;
use Djfabrizia\Content\Models\RecordLabel;
use Djfabrizia\Content\Models\Release;
use Djfabrizia\Content\Models\ReleaseLink;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Release>
 */
class ReleaseFactory extends Factory
{
    use HasPublishStates;

    protected $model = Release::class;

    public function definition(): array
    {
        return [
            'title' => Str::title(fake()->unique()->words(3, true)).' (Original Mix)',
            'cover_source' => CoverSource::Remote,
            'cover_media_id' => null,
            'cover_external_url' => 'https://i.scdn.co/image/'.fake()->sha1(),
            'track_media_id' => null,
            'duration' => fake()->numberBetween(5, 8).':'.str_pad((string) fake()->numberBetween(0, 59), 2, '0', STR_PAD_LEFT),
            'bpm' => fake()->numberBetween(118, 128).'bpm',
            'record_label_id' => RecordLabel::factory(),
            'primary_genre_id' => null,
            'year' => (int) fake()->year(),
            'description' => fake()->optional()->paragraph(),
            'legacy_description' => null,
            'status' => 'draft',
            'published_at' => null,
            'sort' => 0,
            'legacy_wp_id' => null,
        ];
    }

    public function withLocalCover(): static
    {
        return $this->state(fn (): array => [
            'cover_source' => CoverSource::Local,
            'cover_media_id' => Media::factory(),
            'cover_external_url' => null,
        ]);
    }

    public function withExternalCover(): static
    {
        return $this->state(fn (): array => [
            'cover_source' => CoverSource::Remote,
            'cover_media_id' => null,
            'cover_external_url' => 'https://i.scdn.co/image/'.fake()->sha1(),
        ]);
    }

    public function withTrack(): static
    {
        return $this->state(fn (): array => [
            'track_media_id' => Media::factory()->track(),
        ]);
    }

    /**
     * One link per store platform, in platform order.
     */
    public function withLinks(): static
    {
        return $this->afterCreating(function (Release $release): void {
            foreach (ReleasePlatform::cases() as $sort => $platform) {
                ReleaseLink::factory()->for($release)->create([
                    'platform' => $platform,
                    'label' => $platform->label(),
                    'sort' => $sort,
                ]);
            }
        });
    }
}
