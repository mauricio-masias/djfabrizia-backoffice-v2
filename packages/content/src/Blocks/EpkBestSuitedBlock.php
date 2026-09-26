<?php

namespace Djfabrizia\Content\Blocks;

/**
 * Underground EPK "best suited for" section.
 */
final class EpkBestSuitedBlock extends Block
{
    public function rules(): array
    {
        return [
            'title' => self::LINE,
            'text' => self::TEXT,
            'text_b' => self::TEXT,
            'text_c' => self::TEXT,
        ];
    }

    public function defaults(): array
    {
        return ['title' => null, 'text' => null, 'text_b' => null, 'text_c' => null];
    }
}
