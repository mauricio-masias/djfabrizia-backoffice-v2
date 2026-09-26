<?php

namespace Djfabrizia\Content\Blocks;

/**
 * EPK showreel with its intro text.
 */
final class EpkReelBlock extends Block
{
    public function rules(): array
    {
        return [
            'title' => self::LINE,
            'cta' => self::LINE,
            'url' => self::URL,
            'image_media_id' => self::ID,
            'intro_a' => self::TEXT,
            'intro_b' => self::TEXT,
        ];
    }

    public function defaults(): array
    {
        return ['title' => null, 'cta' => null, 'url' => null, 'image_media_id' => null, 'intro_a' => null, 'intro_b' => null];
    }

    public function references(): array
    {
        return ['media' => ['image_media_id']];
    }
}
