<?php

namespace Djfabrizia\Content\Database\Factories;

use Djfabrizia\Content\Enums\LinkMedia;
use Djfabrizia\Content\Models\Link;
use Djfabrizia\Content\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Link>
 */
class LinkFactory extends Factory
{
    protected $model = Link::class;

    public function definition(): array
    {
        return [
            'media' => LinkMedia::Custom,
            'description' => fake()->date('d.m').' | '.fake()->company(),
            'image_media_id' => Media::factory(),
            'url' => fake()->url(),
            'sort' => 0,
            'legacy_key' => null,
        ];
    }

    /**
     * A named platform link: the URL comes from the matching social link.
     */
    public function platform(LinkMedia $media = LinkMedia::Instagram): static
    {
        return $this->state(fn (): array => [
            'media' => $media,
            'image_media_id' => null,
            'url' => null,
        ]);
    }

    /**
     * A platform link with a custom user handle swapped into the social URL.
     */
    public function customHandle(LinkMedia $media = LinkMedia::InstagramCustom): static
    {
        return $this->state(fn (): array => [
            'media' => $media,
            'image_media_id' => null,
            'url' => fake()->userName(),
        ]);
    }
}
