<?php

namespace Djfabrizia\Content\Enums;

use Djfabrizia\Content\Concerns\HasLabel;

enum MenuTarget: string
{
    use HasLabel;

    case Self = '_self';
    case Blank = '_blank';

    public function label(): string
    {
        return match ($this) {
            self::Self => 'Same tab',
            self::Blank => 'New tab',
        };
    }
}
