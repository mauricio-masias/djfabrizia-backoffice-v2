<?php

namespace App\Filament\Widgets\FabriziaCorsi;

use App\Filament\Widgets\VisitorsTrendChart as MainVisitorsTrendChart;
use App\Services\Analytics\AnalyticsSite;

/**
 * A subclass only so the site has its own Livewire key; see ReadsSiteAnalytics.
 */
class VisitorsTrendChart extends MainVisitorsTrendChart
{
    protected function site(): AnalyticsSite
    {
        return AnalyticsSite::FabriziaCorsi;
    }
}
