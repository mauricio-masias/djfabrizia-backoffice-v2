<?php

namespace Djfabrizia\Content\Enums;

use Djfabrizia\Content\Concerns\HasLabel;

enum SyncProvider: string
{
    use HasLabel;

    case Mixcloud = 'mixcloud';
    case Spotify = 'spotify';
    case Youtube = 'youtube';
}
