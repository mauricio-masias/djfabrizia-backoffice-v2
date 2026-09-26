<?php

namespace Djfabrizia\Content\Database\Factories;

use Djfabrizia\Content\Enums\MenuTarget;
use Djfabrizia\Content\Models\Menu;
use Djfabrizia\Content\Models\MenuItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<MenuItem>
 */
class MenuItemFactory extends Factory
{
    protected $model = MenuItem::class;

    public function definition(): array
    {
        $title = Str::title(fake()->word());

        return [
            'menu_id' => Menu::factory(),
            'parent_id' => null,
            'title' => $title,
            'url' => '/'.Str::slug($title),
            'target' => MenuTarget::Self,
            'icon' => null,
            'sort' => 0,
            'legacy_wp_id' => null,
        ];
    }

    public function external(): static
    {
        return $this->state(fn (): array => [
            'url' => fake()->url(),
            'target' => MenuTarget::Blank,
        ]);
    }

    public function icon(string $icon = 'instagram'): static
    {
        return $this->state(fn (): array => ['icon' => $icon]);
    }

    /**
     * A child of the given item, in the same menu.
     */
    public function nested(MenuItem $parent): static
    {
        return $this->state(fn (): array => [
            'menu_id' => $parent->menu_id,
            'parent_id' => $parent->id,
        ]);
    }
}
