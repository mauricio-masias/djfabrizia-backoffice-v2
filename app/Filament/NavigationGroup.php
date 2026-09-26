<?php

namespace App\Filament;

use Filament\Support\Contracts\HasLabel;

/**
 * Sidebar groups, in display order.
 */
enum NavigationGroup: string implements HasLabel
{
    case Pages = 'pages';
    case Music = 'music';
    case Venues = 'venues';
    case Links = 'links';
    case Inbox = 'inbox';
    case System = 'system';

    public function getLabel(): string
    {
        return match ($this) {
            self::Pages => 'Pages',
            self::Music => 'Music',
            self::Venues => 'Venues',
            self::Links => 'Navigation & links',
            self::Inbox => 'Inbox',
            self::System => 'System',
        };
    }
}
