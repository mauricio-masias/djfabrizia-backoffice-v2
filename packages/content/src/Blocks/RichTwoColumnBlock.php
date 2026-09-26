<?php

namespace Djfabrizia\Content\Blocks;

/**
 * Title with two text columns (homepage "about me", bio).
 */
final class RichTwoColumnBlock extends Block
{
    public function rules(): array
    {
        return [
            'title' => self::LINE,
            'left' => self::TEXT,
            'right' => self::TEXT,
            'left_link' => self::URL,
            'right_link' => self::URL,
        ];
    }

    public function defaults(): array
    {
        return ['title' => null, 'left' => null, 'right' => null, 'left_link' => null, 'right_link' => null];
    }
}
