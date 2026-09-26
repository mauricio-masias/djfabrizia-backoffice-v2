<?php

namespace Djfabrizia\Content\Database\Factories;

use Djfabrizia\Content\Enums\ReleasePlatform;
use Djfabrizia\Content\Models\Release;
use Djfabrizia\Content\Models\ReleaseLink;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ReleaseLink>
 */
class ReleaseLinkFactory extends Factory
{
    protected $model = ReleaseLink::class;

    public function definition(): array
    {
        $platform = fake()->randomElement(ReleasePlatform::cases());

        return [
            'release_id' => Release::factory(),
            'platform' => $platform,
            'label' => $platform->label(),
            'url' => fake()->url(),
            'sort' => 0,
            'legacy_key' => null,
        ];
    }
}
