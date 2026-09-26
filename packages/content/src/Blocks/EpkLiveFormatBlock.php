<?php

namespace Djfabrizia\Content\Blocks;

/**
 * Underground EPK live format section.
 */
final class EpkLiveFormatBlock extends Block
{
    public function rules(): array
    {
        return [
            'title' => self::LINE,
            'text' => self::TEXT,
            'text_b' => self::TEXT,
        ];
    }

    public function defaults(): array
    {
        return ['title' => null, 'text' => null, 'text_b' => null];
    }
}
