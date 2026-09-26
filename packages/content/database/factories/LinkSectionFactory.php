<?php

namespace Djfabrizia\Content\Database\Factories;

use Djfabrizia\Content\Models\LinkSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LinkSection>
 */
class LinkSectionFactory extends Factory
{
    protected $model = LinkSection::class;

    public function definition(): array
    {
        return [
            'label' => strtoupper(fake()->words(2, true)),
            'sort' => 0,
            'legacy_key' => null,
        ];
    }
}
