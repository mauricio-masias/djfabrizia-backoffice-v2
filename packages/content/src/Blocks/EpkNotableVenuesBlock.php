<?php

namespace Djfabrizia\Content\Blocks;

/**
 * Underground EPK notable venues section.
 */
final class EpkNotableVenuesBlock extends Block
{
    public function rules(): array
    {
        return [
            'title' => self::LINE,
            'text' => self::TEXT,
            'link_label' => self::LINE,
            'link_url' => self::URL,
        ];
    }

    public function defaults(): array
    {
        return ['title' => null, 'text' => null, 'link_label' => null, 'link_url' => null];
    }
}
