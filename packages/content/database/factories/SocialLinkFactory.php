<?php

namespace Djfabrizia\Content\Database\Factories;

use Djfabrizia\Content\Models\SocialLink;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SocialLink>
 */
class SocialLinkFactory extends Factory
{
    protected $model = SocialLink::class;

    public function definition(): array
    {
        $network = fake()->randomElement(['Instagram', 'Facebook', 'Youtube', 'Mixcloud', 'Spotify']);
        $handle = fake()->userName();

        return [
            'network' => $network,
            'icon_class' => 'fa-'.strtolower($network),
            'type' => 'brands',
            'url' => 'https://www.'.strtolower($network).'.com/'.$handle,
            'app_url' => null,
            'sort' => 0,
            'legacy_key' => null,
        ];
    }
}
