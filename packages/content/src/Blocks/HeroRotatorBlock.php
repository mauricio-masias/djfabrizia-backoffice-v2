<?php

namespace Djfabrizia\Content\Blocks;

/**
 * Rotating list of music styles in the homepage hero.
 */
final class HeroRotatorBlock extends Block
{
    public function rules(): array
    {
        return [
            'styles' => ['array'],
            'styles.*' => ['string', 'max:255'],
        ];
    }

    public function defaults(): array
    {
        return ['styles' => []];
    }
}
