<?php

namespace Tests\Feature\Filament;

use App\Filament\Pages\Dashboard;
use App\Filament\Widgets\AnalyticsOverviewWidget;
use App\Filament\Widgets\ContentStats;
use App\Filament\Widgets\LatestBookings;
use App\Filament\Widgets\SyncStatus;
use App\Filament\Widgets\TopCitiesWidget;
use App\Filament\Widgets\TopCountriesChart;
use App\Filament\Widgets\TopPagesWidget;
use App\Filament\Widgets\VisitorsTrendChart;
use App\Services\Analytics\Contracts\AnalyticsProvider;
use App\Services\Analytics\FakeAnalyticsProvider;
use Livewire\Livewire;

class DashboardTabsTest extends AdminTestCase
{
    private const array OVERVIEW_WIDGETS = [ContentStats::class, LatestBookings::class, SyncStatus::class];

    private const array ANALYTICS_WIDGETS = [
        AnalyticsOverviewWidget::class,
        VisitorsTrendChart::class,
        TopCountriesChart::class,
        TopCitiesWidget::class,
        TopPagesWidget::class,
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->instance(AnalyticsProvider::class, new FakeAnalyticsProvider);
    }

    public function test_the_dashboard_opens_on_the_overview(): void
    {
        $page = Livewire::test(Dashboard::class)
            ->assertOk()
            ->assertActionHasLabel('toggleAnalytics', 'Analytics')
            ->assertActionVisible('rebuildApiCache');

        $this->assertSame(self::OVERVIEW_WIDGETS, $page->instance()->getWidgets());

        foreach (self::OVERVIEW_WIDGETS as $widget) {
            $page->assertSeeLivewire($widget);
        }

        foreach (self::ANALYTICS_WIDGETS as $widget) {
            $page->assertDontSeeLivewire($widget);
        }
    }

    public function test_the_toggle_switches_to_analytics_and_back(): void
    {
        $page = Livewire::test(Dashboard::class)
            ->callAction('toggleAnalytics')
            ->assertSet('tab', Dashboard::ANALYTICS)
            ->assertActionHasLabel('toggleAnalytics', 'Overview');

        $this->assertSame(self::ANALYTICS_WIDGETS, $page->instance()->getWidgets());
        $this->assertRendersOnly(self::ANALYTICS_WIDGETS, self::OVERVIEW_WIDGETS, $page->html());

        $page->callAction('toggleAnalytics')
            ->assertSet('tab', Dashboard::OVERVIEW)
            ->assertActionHasLabel('toggleAnalytics', 'Analytics');

        $this->assertRendersOnly(self::OVERVIEW_WIDGETS, self::ANALYTICS_WIDGETS, $page->html());
    }

    public function test_the_analytics_view_can_be_opened_from_the_url(): void
    {
        $this->get('/admin?tab=analytics')
            ->assertOk()
            ->assertSeeLivewire(AnalyticsOverviewWidget::class)
            ->assertDontSeeLivewire(ContentStats::class);
    }

    public function test_an_unknown_tab_falls_back_to_the_overview(): void
    {
        $this->get('/admin?tab=nope')
            ->assertOk()
            ->assertSeeLivewire(ContentStats::class)
            ->assertDontSeeLivewire(AnalyticsOverviewWidget::class);
    }

    public function test_the_analytics_view_still_loads_when_analytics_is_down(): void
    {
        // The dashboard is the panel's landing page; an outage or missing key
        // must never lock the operator out of the rest of the panel.
        $this->app->instance(AnalyticsProvider::class, (new FakeAnalyticsProvider)->fail());

        $this->get('/admin?tab=analytics')->assertOk();
    }

    public function test_the_analytics_view_loads_when_analytics_is_not_configured(): void
    {
        $this->app->forgetInstance(AnalyticsProvider::class);
        config()->set('analytics.driver', 'google');
        config()->set('analytics.property_id', null);

        $this->get('/admin?tab=analytics')->assertOk();
    }

    /**
     * Checked against the re-rendered HTML, because assertSeeLivewire only
     * understands the first render, not a Livewire update response.
     *
     * @param  list<class-string>  $shown
     * @param  list<class-string>  $hidden
     */
    private function assertRendersOnly(array $shown, array $hidden, string $html): void
    {
        foreach ($shown as $widget) {
            $this->assertStringContainsString('wire:name="'.$widget.'"', $html, $widget.' should be on the dashboard');
        }

        foreach ($hidden as $widget) {
            $this->assertStringNotContainsString('wire:name="'.$widget.'"', $html, $widget.' should not be on the dashboard');
        }
    }
}
