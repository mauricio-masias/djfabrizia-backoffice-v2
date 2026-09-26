<?php

namespace Djfabrizia\Content\Blocks;

/**
 * UK gigs venue list (rows come from uk_venues).
 */
final class VenuesUkBlock extends Block
{
    public function rules(): array
    {
        return [
            'title' => self::LINE,
        ];
    }

    public function defaults(): array
    {
        return ['title' => null];
    }
}
