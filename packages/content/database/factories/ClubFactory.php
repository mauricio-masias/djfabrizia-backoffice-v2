<?php

namespace Djfabrizia\Content\Database\Factories;

use Djfabrizia\Content\Models\City;
use Djfabrizia\Content\Models\Club;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Club>
 */
class ClubFactory extends Factory
{
    protected $model = Club::class;

    public function definition(): array
    {
        return [
            'city_id' => City::factory(),
            'name' => fake()->company().' Club',
            'sort' => 0,
            'legacy_key' => null,
        ];
    }
}
