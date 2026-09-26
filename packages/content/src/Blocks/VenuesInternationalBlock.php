<?php

namespace Djfabrizia\Content\Blocks;

/**
 * International countries, cities and clubs (rows come from countries).
 */
final class VenuesInternationalBlock extends Block
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
