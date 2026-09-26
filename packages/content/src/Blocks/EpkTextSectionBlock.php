<?php

namespace Djfabrizia\Content\Blocks;

/**
 * EPK text section; `role` says which legacy section it replaces.
 */
final class EpkTextSectionBlock extends Block
{
    public function rules(): array
    {
        return [
            'role' => ['required', 'string', 'in:tailored,renowned,worldwide'],
            'title' => self::LINE,
            'text' => self::TEXT,
            'text_b' => self::TEXT,
            'link_label' => self::LINE,
            'link_url' => self::URL,
        ];
    }

    public function defaults(): array
    {
        return ['role' => 'tailored', 'title' => null, 'text' => null, 'text_b' => null, 'link_label' => null, 'link_url' => null];
    }
}
