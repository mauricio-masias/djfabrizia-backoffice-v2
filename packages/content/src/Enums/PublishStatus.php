<?php

namespace Djfabrizia\Content\Enums;

use Djfabrizia\Content\Concerns\HasLabel;

enum PublishStatus: string
{
    use HasLabel;

    case Draft = 'draft';
    case Published = 'published';

    public function color(): string
    {
        return match ($this) {
            self::Draft => 'gray',
            self::Published => 'success',
        };
    }
}
