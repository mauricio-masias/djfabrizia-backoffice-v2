<?php

namespace Djfabrizia\Content\Blocks;

/**
 * Call-to-action banner. v2 only.
 */
final class CtaBannerBlock extends Block
{
    public function rules(): array
    {
        return [
            'title' => self::LINE,
            'text' => self::TEXT,
            'button_label' => self::LINE,
            'button_url' => self::URL,
            'image_media_id' => self::ID,
        ];
    }

    public function defaults(): array
    {
        return ['title' => null, 'text' => null, 'button_label' => null, 'button_url' => null, 'image_media_id' => null];
    }

    public function references(): array
    {
        return ['media' => ['image_media_id']];
    }
}
