<?php

namespace Djfabrizia\Content\Enums;

use Djfabrizia\Content\Concerns\HasLabel;

enum BookingStatus: string
{
    use HasLabel;

    case Unread = 'unread';
    case Read = 'read';
    case Archived = 'archived';

    public function color(): string
    {
        return match ($this) {
            self::Unread => 'warning',
            self::Read => 'success',
            self::Archived => 'gray',
        };
    }
}
