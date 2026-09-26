<?php

namespace Djfabrizia\Content\Database\Factories;

use Djfabrizia\Content\Models\City;
use Djfabrizia\Content\Models\Club;
use Djfabrizia\Content\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Country>
 */
class CountryFactory extends Factory
{
    protected $model = Country::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->country(),
            'is_default' => false,
            'sort' => 0,
            'legacy_wp_id' => null,
        ];
    }

    public function default(): static
    {
        return $this->state(fn (): array => ['is_default' => true]);
    }

    /**
     * Adds cities, each with clubs.
     */
    public function withCities(int $cities = 2, int $clubsPerCity = 3): static
    {
        return $this->afterCreating(function (Country $country) use ($cities, $clubsPerCity): void {
            for ($sort = 0; $sort < $cities; $sort++) {
                $city = City::factory()->for($country)->create(['sort' => $sort]);

                for ($clubSort = 0; $clubSort < $clubsPerCity; $clubSort++) {
                    Club::factory()->for($city)->create(['sort' => $clubSort]);
                }
            }
        });
    }
}
