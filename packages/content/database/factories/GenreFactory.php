<?php

namespace Djfabrizia\Content\Database\Factories;

use Djfabrizia\Content\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Genre>
 */
class GenreFactory extends Factory
{
    protected $model = Genre::class;

    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'House', 'Deep House', 'Tech House', 'Techno', 'Afro House', 'Progressive House',
            'Melodic House', 'Classic House', 'Funky House', 'Nu Disco', 'Minimal', 'Lounge',
            'Chillout', 'Tribal House', 'Deep Tech', 'Acid Jazz', 'World Music', 'Jackin House',
        ]).' '.fake()->unique()->numberBetween(1, 9999);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'aliases' => [],
            'sort' => fake()->numberBetween(1, 100),
        ];
    }

    public function unreviewed(): static
    {
        return $this->state(fn (): array => ['sort' => null]);
    }
}
