<?php

namespace Djfabrizia\Content\Database\Factories;

use Djfabrizia\Content\Models\UkVenue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UkVenue>
 */
class UkVenueFactory extends Factory
{
    protected $model = UkVenue::class;

    public function definition(): array
    {
        return [
            'name' => fake()->company().' ('.fake()->randomElement(['Shoreditch', 'Soho', 'Mayfair', 'Camden', 'Brighton']).')',
            'sort' => 0,
            'legacy_key' => null,
        ];
    }
}
