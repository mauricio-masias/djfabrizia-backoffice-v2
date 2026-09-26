<?php

namespace Djfabrizia\Content\Blocks;

/**
 * EPK "ideal for / perfect for" list.
 */
final class EpkIdealForBlock extends Block
{
    public function rules(): array
    {
        return [
            'title' => self::LINE,
            'reasons' => ['array'],
            'reasons.*' => ['string', 'max:255'],
        ];
    }

    public function defaults(): array
    {
        return ['title' => null, 'reasons' => []];
    }
}
