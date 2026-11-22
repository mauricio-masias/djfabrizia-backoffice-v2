<?php

namespace Tests\Feature\Filament;

use App\Filament\Pages\Dashboard;
use App\Filament\Widgets\AnalyticsOverviewWidget;
use App\Filament\Widgets\ContentStats;
use App\Filament\Widgets\FabriziaCorsi;
use App\Filament\Widgets\LatestBookings;
use App\Filament\Widgets\SyncStatus;
use App\Filament\Widgets\TopCitiesWidget;
use App\Filament\Widgets\TopCountriesChart;
use App\Filament\Widgets\TopPagesWidget;
use App\Filament\Widgets\VisitorsTrendChart;
use App\Services\Analytics\AnalyticsSite;
use App\Services\Analytics\Contracts\AnalyticsProvider;
use App\Services\Analytics\FakeAnalyticsProvider;
use Filament\Support\Icons\Heroicon;
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

    /** The sister site is a single page, so it has no pages table. */
    private const array FABRIZIA_CORSI_WIDGETS = [
        FabriziaCorsi\AnalyticsOverviewWidget::class,
        FabriziaCorsi\VisitorsTrendChart::class,
        FabriziaCorsi\TopCountriesChart::class,
        FabriziaCorsi\TopCitiesWidget::class,
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->instance(AnalyticsProvider::class, new FakeAnalyticsProvider);
        $this->app->instance(AnalyticsSite::FabriziaCorsi->binding(), new FakeAnalyticsProvider);
    }

    public function test_the_dashboard_opens_on_the_overview(): void
    {
        $page = Livewire::test(Dashboard::class)
            ->assertOk()
            ->assertActionHasLabel('toggleAnalytics', 'Analytics')
            ->assertActionHasLabel('toggleFabriziaCorsi', 'FabriziaCorsi Analytics')
            ->assertActionVisible('toggleAnalytics')
            ->assertActionVisible('toggleFabriziaCorsi')
            ->assertActionVisible('rebuildApiCache');

        $this->assertSame(self::OVERVIEW_WIDGETS, $page->instance()->getWidgets());

        foreach (self::OVERVIEW_WIDGETS as $widget) {
            $page->assertSeeLivewire($widget);
        }

        foreach ([...self::ANALYTICS_WIDGETS, ...self::FABRIZIA_CORSI_WIDGETS] as $widget) {
            $page->assertDontSeeLivewire($widget);
        }
    }

    public function test_the_toggle_switches_to_analytics_and_back(): void
    {
        $page = Livewire::test(Dashboard::class)
            ->callAction('toggleAnalytics')
            ->assertSet('tab', Dashboard::ANALYTICS)
            ->assertActionHasLabel('toggleAnalytics', 'Overview')
            ->assertActionHasIcon('toggleAnalytics', Heroicon::OutlinedSquares2x2)
            ->assertActionHasLabel('toggleFabriziaCorsi', 'FabriziaCorsi Analytics')
            ->assertActionVisible('rebuildApiCache');

        $this->assertSame(self::ANALYTICS_WIDGETS, $page->instance()->getWidgets());
        $this->assertRendersOnly(self::ANALYTICS_WIDGETS, $page->html());

        $page->callAction('toggleAnalytics')
            ->assertSet('tab', Dashboard::OVERVIEW)
            ->assertActionHasLabel('toggleAnalytics', 'Analytics');

        $this->assertRendersOnly(self::OVERVIEW_WIDGETS, $page->html());
    }

    public function test_the_toggle_switches_to_fabrizia_corsi_and_back(): void
    {
        $page = Livewire::test(Dashboard::class)
            ->callAction('toggleFabriziaCorsi')
            ->assertSet('tab', Dashboard::FABRIZIA_CORSI)
            ->assertActionHasLabel('toggleAnalytics', 'Analytics')
            ->assertActionHasLabel('toggleFabriziaCorsi', 'Overview')
            ->assertActionHasIcon('toggleFabriziaCorsi', Heroicon::OutlinedSquares2x2)
            ->assertActionVisible('rebuildApiCache');

        $this->assertSame(self::FABRIZIA_CORSI_WIDGETS, $page->instance()->getWidgets());
        $this->assertRendersOnly(self::FABRIZIA_CORSI_WIDGETS, $page->html());

        $page->callAction('toggleFabriziaCorsi')
            ->assertSet('tab', Dashboard::OVERVIEW)
            ->assertActionHasLabel('toggleFabriziaCorsi', 'FabriziaCorsi Analytics');

        $this->assertRendersOnly(self::OVERVIEW_WIDGETS, $page->html());
    }

    public function test_switching_directly_between_the_two_sites_replaces_every_widget(): void
    {
        // A widget keeping its Livewire key across the switch would not be
        // re-rendered, and would go on showing the other site's numbers.
        $page = Livewire::test(Dashboard::class)
            ->callAction('toggleAnalytics');

        $this->assertRendersOnly(self::ANALYTICS_WIDGETS, $page->html());

        $page->callAction('toggleFabriziaCorsi')
            ->assertSet('tab', Dashboard::FABRIZIA_CORSI);

        $this->assertRendersOnly(self::FABRIZIA_CORSI_WIDGETS, $page->html());

        $page->callAction('toggleAnalytics')
            ->assertSet('tab', Dashboard::ANALYTICS);

        $this->assertRendersOnly(self::ANALYTICS_WIDGETS, $page->html());
    }

    public function test_the_header_shows_both_analytics_buttons_before_the_rebuild_button(): void
    {
        $this->get('/admin')
            ->assertSeeInOrder([
                "mountAction('toggleAnalytics')",
                "mountAction('toggleFabriziaCorsi')",
                "mountAction('rebuildApiCache')",
            ], escape: false);
    }

    public function test_the_analytics_view_can_be_opened_from_the_url(): void
    {
        $this->get('/admin?tab=analytics')
            ->assertOk()
            ->assertSeeLivewire(AnalyticsOverviewWidget::class)
            ->assertDontSeeLivewire(ContentStats::class);
    }

    public function test_the_fabrizia_corsi_view_can_be_opened_from_the_url(): void
    {
        $response = $this->get('/admin?tab=fabrizia-corsi')->assertOk();

        foreach (self::FABRIZIA_CORSI_WIDGETS as $widget) {
            $response->assertSeeLivewire($widget);
        }

        foreach ([...self::OVERVIEW_WIDGETS, ...self::ANALYTICS_WIDGETS] as $widget) {
            $response->assertDontSeeLivewire($widget);
        }
    }

    public function test_an_unknown_tab_falls_back_to_the_overview(): void
    {
        $this->get('/admin?tab=nope')
            ->assertOk()
            ->assertSeeLivewire(ContentStats::class)
            ->assertDontSeeLivewire(AnalyticsOverviewWidget::class)
            ->assertDontSeeLivewire(FabriziaCorsi\AnalyticsOverviewWidget::class);
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

    public function test_the_fabrizia_corsi_view_loads_when_only_its_analytics_is_down(): void
    {
        // The widgets load lazily, so without this the page would render only
        // their placeholders and never reach the failing provider.
        Livewire::withoutLazyLoading();
        $this->app->instance(AnalyticsSite::FabriziaCorsi->binding(), (new FakeAnalyticsProvider)->fail());

        $this->get('/admin?tab=fabrizia-corsi')
            ->assertOk()
            ->assertSee('Analytics unavailable');
    }

    public function test_the_main_view_is_unaffected_when_fabrizia_corsi_analytics_is_down(): void
    {
        Livewire::withoutLazyLoading();
        $this->app->instance(AnalyticsSite::FabriziaCorsi->binding(), (new FakeAnalyticsProvider)->fail());

        $this->get('/admin?tab=analytics')
            ->assertOk()
            ->assertSee('Manchester')
            ->assertDontSee('Analytics unavailable');
    }

    public function test_the_fabrizia_corsi_view_is_unaffected_when_main_analytics_is_down(): void
    {
        Livewire::withoutLazyLoading();
        $this->app->instance(AnalyticsProvider::class, (new FakeAnalyticsProvider)->fail());

        $this->get('/admin?tab=fabrizia-corsi')
            ->assertOk()
            ->assertSee('Manchester')
            ->assertDontSee('Analytics unavailable');
    }

    public function test_the_fabrizia_corsi_view_loads_when_its_analytics_is_not_configured(): void
    {
        Livewire::withoutLazyLoading();
        $this->app->forgetInstance(AnalyticsSite::FabriziaCorsi->binding());
        config()->set('analytics.driver', 'google');
        config()->set('analytics.fabrizia_corsi.property_id', null);

        $this->get('/admin?tab=fabrizia-corsi')
            ->assertOk()
            ->assertSee('Analytics unavailable');
    }

    /**
     * Checked against the re-rendered HTML, because assertSeeLivewire only
     * understands the first render, not a Livewire update response. The
     * quoted class name is matched whole, so a widget is never mistaken for
     * the sister site's widget of the same name.
     *
     * @param  list<class-string>  $shown
     */
    private function assertRendersOnly(array $shown, string $html): void
    {
        foreach ([...self::OVERVIEW_WIDGETS, ...self::ANALYTICS_WIDGETS, ...self::FABRIZIA_CORSI_WIDGETS] as $widget) {
            $expected = in_array($widget, $shown, true) ? 1 : 0;

            $this->assertSame(
                $expected,
                substr_count($html, 'wire:name="'.$widget.'"'),
                $widget.($expected === 1 ? ' should be' : ' should not be').' on the dashboard',
            );
        }
    }
}
