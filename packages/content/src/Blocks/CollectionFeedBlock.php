<?php

namespace Djfabrizia\Content\Blocks;

/**
 * Paginated feed of one collection. `channel_id` is only used for videos.
 */
final class CollectionFeedBlock extends Block
{
    public function rules(): array
    {
        return [
            'collection' => ['required', 'string', 'in:mixes,releases,playlists,videos'],
            'title' => self::LINE,
            'per_page' => ['required', 'integer', 'min:1', 'max:50'],
            'more_label' => self::LINE,
            'channel_id' => self::LINE,
        ];
    }

    public function defaults(): array
    {
        return ['collection' => 'mixes', 'title' => null, 'per_page' => 6, 'more_label' => null, 'channel_id' => null];
    }
}
