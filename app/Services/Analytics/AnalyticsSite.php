<?php

namespace App\Services\Analytics;

use App\Services\Analytics\Contracts\AnalyticsProvider;

/**
 * The websites whose Google Analytics the dashboard reports on.
 *
 * Each site has its own GA4 property, service account key and cache
 * namespace, so one site's numbers can never be shown as another's.
 */
enum AnalyticsSite: string
{
    case Main = 'main';

    case FabriziaCorsi = 'fabrizia_corsi';

    /**
     * The container binding that resolves this site's provider.
     */
    public function binding(): string
    {
        return match ($this) {
            self::Main => AnalyticsProvider::class,
            self::FabriziaCorsi => 'analytics.fabrizia_corsi',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Main => 'DJ Fabrizia',
            self::FabriziaCorsi => 'FabriziaCorsi',
        };
    }
}
