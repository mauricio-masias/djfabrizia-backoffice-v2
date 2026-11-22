<?php

namespace App\Filament\Widgets\FabriziaCorsi;

use App\Filament\Widgets\AnalyticsOverviewWidget as MainAnalyticsOverviewWidget;
use App\Services\Analytics\AnalyticsSite;

/**
 * A subclass only so the site has its own Livewire key; see ReadsSiteAnalytics.
 */
class AnalyticsOverviewWidget extends MainAnalyticsOverviewWidget
{
    protected function site(): AnalyticsSite
    {
        return AnalyticsSite::FabriziaCorsi;
    }
}
