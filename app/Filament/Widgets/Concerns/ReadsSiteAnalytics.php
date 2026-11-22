<?php

namespace App\Filament\Widgets\Concerns;

use App\Services\Analytics\AnalyticsSite;
use App\Services\Analytics\Contracts\AnalyticsProvider;
use App\Services\Analytics\Exceptions\AnalyticsUnavailable;

/**
 * For widgets that exist once per website: which site they report on, and
 * that site's analytics provider.
 *
 * A widget reports on the main site unless a subclass overrides site(). The
 * site is a subclass rather than a property passed through Widget::make(),
 * because Filament keys dashboard widgets by class and position only. Both
 * sites' widgets would share a Livewire key, so switching directly from one
 * view to the other would keep the first site's component and its numbers.
 */
trait ReadsSiteAnalytics
{
    protected function site(): AnalyticsSite
    {
        return AnalyticsSite::Main;
    }

    /**
     * Call this inside the try block that guards the report: a site that is
     * not configured already fails here, while its provider is being built.
     *
     * @throws AnalyticsUnavailable
     */
    protected function analytics(): AnalyticsProvider
    {
        return app($this->site()->binding());
    }
}
