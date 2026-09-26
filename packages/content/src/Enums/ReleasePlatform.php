<?php

namespace Djfabrizia\Content\Enums;

use Djfabrizia\Content\Concerns\HasLabel;

enum ReleasePlatform: string
{
    use HasLabel;

    case Spotify = 'spotify';
    case Itunes = 'itunes';
    case AmazonMusic = 'amazon_music';
    case Traxsource = 'traxsource';
}
