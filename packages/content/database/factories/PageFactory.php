<?php

namespace Djfabrizia\Content\Database\Factories;

use Djfabrizia\Content\Database\Factories\Concerns\HasPublishStates;
use Djfabrizia\Content\Enums\PageLocale;
use Djfabrizia\Content\Enums\PageTemplate;
use Djfabrizia\Content\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Page>
 */
class PageFactory extends Factory
{
    use HasPublishStates;

    protected $model = Page::class;

    public function definition(): array
    {
        return [
            'slug' => fake()->unique()->slug(2),
            'title' => fake()->sentence(3),
            'template' => PageTemplate::Home,
            'locale' => PageLocale::English,
            'status' => 'draft',
            'blocks' => PageTemplate::Home->skeleton(),
            'seo' => null,
            'published_at' => null,
            'legacy_wp_id' => null,
        ];
    }

    /**
     * A page of the given template, starting from its skeleton blocks.
     */
    public function template(PageTemplate $template, PageLocale $locale = PageLocale::English): static
    {
        return $this->state(fn (): array => [
            'template' => $template,
            'locale' => $locale,
            'blocks' => $template->skeleton(),
        ]);
    }

    /**
     * @param  list<array{type: string, data: array<string, mixed>}>  $blocks
     */
    public function withBlocks(array $blocks): static
    {
        return $this->state(fn (): array => ['blocks' => $blocks]);
    }
}
