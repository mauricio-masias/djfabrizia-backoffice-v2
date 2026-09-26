<?php

namespace Djfabrizia\Content\Enums;

use Djfabrizia\Content\Concerns\HasLabel;

enum PublishEventStatus: string
{
    use HasLabel;

    case Queued = 'queued';
    case Warmed = 'warmed';
    case Failed = 'failed';

    public function color(): string
    {
        return match ($this) {
            self::Queued => 'info',
            self::Warmed => 'success',
            self::Failed => 'danger',
        };
    }
}
