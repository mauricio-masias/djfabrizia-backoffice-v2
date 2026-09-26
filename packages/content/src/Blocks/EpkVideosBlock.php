<?php

namespace Djfabrizia\Content\Blocks;

/**
 * EPK corporate and underground video lists.
 */
final class EpkVideosBlock extends Block
{
    public function rules(): array
    {
        return [
            'corporate' => ['array'],
            'corporate.title' => self::LINE,
            'corporate.items' => ['array'],
            'corporate.items.*.label' => self::LINE,
            'corporate.items.*.alt' => self::LINE,
            'corporate.items.*.url' => self::URL,
            'corporate.items.*.image_media_id' => self::ID,
            'underground' => ['array'],
            'underground.title' => self::LINE,
            'underground.items' => ['array'],
            'underground.items.*.label' => self::LINE,
            'underground.items.*.alt' => self::LINE,
            'underground.items.*.url' => self::URL,
            'underground.items.*.image_media_id' => self::ID,
        ];
    }

    public function defaults(): array
    {
        return ['corporate' => ['title' => null, 'items' => []], 'underground' => ['title' => null, 'items' => []]];
    }

    public function references(): array
    {
        return ['media' => ['corporate.items.*.image_media_id', 'underground.items.*.image_media_id']];
    }
}
