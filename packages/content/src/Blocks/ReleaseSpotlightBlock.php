<?php

namespace Djfabrizia\Content\Blocks;

/**
 * Highlights one release. v2 only.
 */
final class ReleaseSpotlightBlock extends Block
{
    public function rules(): array
    {
        return [
            'title' => self::LINE,
            'release_id' => ['required', 'integer', 'min:1'],
            'text' => self::TEXT,
        ];
    }

    public function defaults(): array
    {
        return ['title' => null, 'release_id' => null, 'text' => null];
    }

    public function references(): array
    {
        return ['releases' => ['release_id']];
    }
}
