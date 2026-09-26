<?php

namespace Djfabrizia\Content\Enums;

use Djfabrizia\Content\Concerns\HasLabel;

/**
 * Where a release cover comes from. The values match the WordPress
 * `release_cover_art` radio ("local" or "remote").
 */
enum CoverSource: string
{
    use HasLabel;

    case Local = 'local';
    case Remote = 'remote';
}
