<?php

namespace Djfabrizia\Content\Database\Factories;

use Djfabrizia\Content\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Media>
 */
class MediaFactory extends Factory
{
    protected $model = Media::class;

    public function definition(): array
    {
        $month = fake()->dateTimeBetween('-3 years')->format('Y/m');
        $file = fake()->unique()->slug(3).'.jpg';

        return [
            'disk' => 'public',
            'path' => "media/{$month}/{$file}",
            'legacy_path' => null,
            'mime' => 'image/jpeg',
            'size' => fake()->numberBetween(20_000, 900_000),
            'width' => 1200,
            'height' => 800,
            'alt' => fake()->sentence(4),
            'variants' => null,
            'legacy_wp_id' => null,
        ];
    }

    /**
     * An attachment imported from WordPress, keeping its uploads-relative path.
     */
    public function imported(): static
    {
        return $this->state(function (array $attributes): array {
            $legacyPath = substr((string) $attributes['path'], strlen('media/'));

            return [
                'legacy_path' => $legacyPath,
                'legacy_wp_id' => fake()->unique()->numberBetween(100, 99_999),
            ];
        });
    }

    public function withVariants(): static
    {
        return $this->state(function (array $attributes): array {
            $base = preg_replace('/\.[a-z]+$/', '', (string) $attributes['path']);

            return [
                'variants' => [
                    400 => "{$base}-400.webp",
                    800 => "{$base}-800.webp",
                    1600 => "{$base}-1600.webp",
                ],
            ];
        });
    }

    public function track(): static
    {
        return $this->state(fn (): array => [
            'path' => 'tracks/'.fake()->unique()->slug(3).'.mp3',
            'mime' => 'audio/mpeg',
            'width' => null,
            'height' => null,
            'alt' => null,
        ]);
    }
}
