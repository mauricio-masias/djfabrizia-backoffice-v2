<?php

namespace Djfabrizia\Content\Enums;

use Djfabrizia\Content\Concerns\HasLabel;

enum ContentSource: string
{
    use HasLabel;

    case Manual = 'manual';
    case Mixcloud = 'mixcloud';
    case Spotify = 'spotify';
    case Youtube = 'youtube';

    public function isSynced(): bool
    {
        return $this !== self::Manual;
    }
}
