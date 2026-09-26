<?php

namespace Djfabrizia\Content\Database\Factories;

use Djfabrizia\Content\Models\RecordLabel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<RecordLabel>
 */
class RecordLabelFactory extends Factory
{
    protected $model = RecordLabel::class;

    public function definition(): array
    {
        $name = fake()->unique()->company().' Records';

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'url' => fake()->optional()->url(),
        ];
    }
}
