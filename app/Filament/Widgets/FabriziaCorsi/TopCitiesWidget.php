<?php

namespace App\Filament\Widgets\FabriziaCorsi;

use App\Filament\Widgets\TopCitiesWidget as MainTopCitiesWidget;
use App\Services\Analytics\AnalyticsSite;

/**
 * A subclass only so the site has its own Livewire key; see ReadsSiteAnalytics.
 */
class TopCitiesWidget extends MainTopCitiesWidget
{
    protected function site(): AnalyticsSite
    {
        return AnalyticsSite::FabriziaCorsi;
    }
}
