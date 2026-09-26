<?php

namespace Djfabrizia\Content\Blocks;

/**
 * Latest Instagram posts (served by the endpoint). v2 only.
 */
final class InstagramFeedBlock extends Block
{
    public function rules(): array
    {
        return [
            'title' => self::LINE,
            'limit' => ['required', 'integer', 'min:1', 'max:12'],
        ];
    }

    public function defaults(): array
    {
        return ['title' => null, 'limit' => 3];
    }
}
