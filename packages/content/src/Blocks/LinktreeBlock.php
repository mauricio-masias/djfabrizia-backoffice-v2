<?php

namespace Djfabrizia\Content\Blocks;

/**
 * Linktree page header and colours (links come from links / link_sections).
 */
final class LinktreeBlock extends Block
{
    public function rules(): array
    {
        return [
            'hero_media_id' => self::ID,
            'title' => self::LINE,
            'teaser' => self::LINE,
            'page_bg' => ['nullable', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'font_color' => ['nullable', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'font_position' => ['nullable', 'string', 'in:left,center,right'],
        ];
    }

    public function defaults(): array
    {
        return ['hero_media_id' => null, 'title' => null, 'teaser' => null, 'page_bg' => '#000000', 'font_color' => '#FFFFFF', 'font_position' => 'center'];
    }

    public function references(): array
    {
        return ['media' => ['hero_media_id']];
    }
}
