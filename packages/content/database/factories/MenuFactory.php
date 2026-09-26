<?php

namespace Djfabrizia\Content\Database\Factories;

use Djfabrizia\Content\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Menu>
 */
class MenuFactory extends Factory
{
    protected $model = Menu::class;

    public function definition(): array
    {
        $slug = fake()->unique()->slug(1);

        return [
            'slug' => $slug,
            'name' => Str::headline($slug).' menu',
            'legacy_wp_id' => null,
        ];
    }
}
