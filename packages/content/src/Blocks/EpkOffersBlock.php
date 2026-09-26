<?php

namespace Djfabrizia\Content\Blocks;

/**
 * EPK "what I offer" list plus the DJ setup image.
 */
final class EpkOffersBlock extends Block
{
    public function rules(): array
    {
        return [
            'title' => self::LINE,
            'items' => ['array', 'max:6'],
            'items.*.title' => self::LINE,
            'items.*.text' => self::TEXT,
            'items.*.text_b' => self::TEXT,
            'songs_by' => self::LINE,
            'listen_here_1' => self::LINE,
            'listen_here_2' => self::LINE,
            'setup' => ['array'],
            'setup.image_media_id' => self::ID,
            'setup.alt' => self::LINE,
            'setup.url' => self::URL,
            'setup.cta' => self::LINE,
        ];
    }

    public function defaults(): array
    {
        return ['title' => null, 'items' => [], 'songs_by' => null, 'listen_here_1' => null, 'listen_here_2' => null, 'setup' => ['image_media_id' => null, 'alt' => null, 'url' => null, 'cta' => null]];
    }

    public function references(): array
    {
        return ['media' => ['setup.image_media_id']];
    }
}
