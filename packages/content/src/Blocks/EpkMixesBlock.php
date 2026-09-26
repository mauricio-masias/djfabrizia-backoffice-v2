<?php

namespace Djfabrizia\Content\Blocks;

/**
 * EPK selection of mixes.
 */
final class EpkMixesBlock extends Block
{
    public function rules(): array
    {
        return [
            'title' => self::LINE,
            'items' => ['array'],
            'items.*.label' => self::LINE,
            'items.*.mix_id' => ['required', 'integer', 'min:1'],
        ];
    }

    public function defaults(): array
    {
        return ['title' => null, 'items' => []];
    }

    public function references(): array
    {
        return ['mixes' => ['items.*.mix_id']];
    }
}
