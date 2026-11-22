<?php

namespace App\Filament\Widgets\FabriziaCorsi;

use App\Filament\Widgets\TopCountriesChart as MainTopCountriesChart;
use App\Services\Analytics\AnalyticsSite;

/**
 * A subclass only so the site has its own Livewire key; see ReadsSiteAnalytics.
 */
class TopCountriesChart extends MainTopCountriesChart
{
    protected function site(): AnalyticsSite
    {
        return AnalyticsSite::FabriziaCorsi;
    }
}
