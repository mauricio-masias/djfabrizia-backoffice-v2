<?php

namespace Djfabrizia\Content\Blocks;

/**
 * EPK photo carousel with the collaboration text.
 */
final class EpkGalleryBlock extends Block
{
    public function rules(): array
    {
        return [
            'title' => self::LINE,
            'text' => self::TEXT,
            'text_b' => self::TEXT,
            'image_media_ids' => ['array'],
            'image_media_ids.*' => ['integer', 'min:1'],
        ];
    }

    public function defaults(): array
    {
        return ['title' => null, 'text' => null, 'text_b' => null, 'image_media_ids' => []];
    }

    public function references(): array
    {
        return ['media' => ['image_media_ids.*']];
    }
}
