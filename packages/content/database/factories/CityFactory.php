<?php

namespace Djfabrizia\Content\Database\Factories;

use Djfabrizia\Content\Models\City;
use Djfabrizia\Content\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<City>
 */
class CityFactory extends Factory
{
    protected $model = City::class;

    public function definition(): array
    {
        return [
            'country_id' => Country::factory(),
            'name' => fake()->city(),
            'sort' => 0,
            'legacy_key' => null,
        ];
    }
}
