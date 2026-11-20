<?php

namespace Tests\Feature\Filament;

use App\Filament\Widgets\AnalyticsOverviewWidget;
use App\Filament\Widgets\TopCitiesWidget;
use App\Filament\Widgets\TopCountriesChart;
use App\Filament\Widgets\VisitorsTrendChart;
use App\Services\Analytics\Contracts\AnalyticsProvider;
use App\Services\Analytics\Exceptions\AnalyticsUnavailable;
use App\Services\Analytics\FakeAnalyticsProvider;
use Livewire\Livewire;

class AnalyticsWidgetTest extends AdminTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->instance(AnalyticsProvider::class, new FakeAnalyticsProvider);
    }

    private function failAnalytics(): void
    {
        $this->app->instance(AnalyticsProvider::class, (new FakeAnalyticsProvider)->fail());
    }

    public function test_overview_renders_all_four_periods(): void
    {
        Livewire::test(AnalyticsOverviewWidget::class)
            ->assertOk()
            ->assertSee('Today')
            ->assertSee('This week')
            ->assertSee('This month')
            ->assertSee('All time')
            ->assertSee('visits');
    }

    public function test_overview_degrades_instead_of_failing_when_analytics_is_down(): void
    {
        $this->failAnalytics();

        Livewire::test(AnalyticsOverviewWidget::class)
            ->assertOk()
            ->assertSee('Analytics unavailable')
            ->assertSee('Today');
    }

    public function test_analytics_widgets_do_not_poll(): void
    {
        // Polling a quota-limited API every few seconds would burn the daily
        // budget without ever showing fresher numbers.
        foreach ([AnalyticsOverviewWidget::class, VisitorsTrendChart::class, TopCountriesChart::class] as $widget) {
            $instance = Livewire::test($widget)->instance();

            $this->assertNull(
                (fn () => $this->getPollingInterval())->call($instance),
                $widget.' must not poll a quota-limited API',
            );
        }
    }

    public function test_trend_chart_defaults_to_thirty_daily_points(): void
    {
        $data = $this->chartData(Livewire::test(VisitorsTrendChart::class)->instance());

        $this->assertCount(30, $data['labels']);
        $this->assertCount(2, $data['datasets']);
        $this->assertSame('Visitors', $data['datasets'][0]['label']);
        $this->assertSame('Visits', $data['datasets'][1]['label']);
        $this->assertCount(30, $data['datasets'][0]['data']);
    }

    public function test_trend_chart_switches_to_weekly_buckets_for_long_ranges(): void
    {
        $data = $this->chartData(Livewire::test(VisitorsTrendChart::class)->set('filter', '365')->instance());

        // Summing days into weeks would overcount repeat visitors, so the
        // series is requested as weeks.
        $this->assertGreaterThan(50, count($data['labels']));
        $this->assertLessThan(60, count($data['labels']));
        $this->assertStringStartsWith('w/c ', $data['labels'][0]);
    }

    public function test_weekly_chart_does_not_plot_a_partial_leading_week(): void
    {
        $data = $this->chartData(Livewire::test(VisitorsTrendChart::class)->set('filter', '365')->instance());

        $visitors = $data['datasets'][0]['data'];
        $rest = array_slice($visitors, 1, 8);

        $this->assertGreaterThan(max($rest) / 2, $visitors[0], 'leading week looks truncated rather than whole');
    }

    public function test_trend_chart_stays_daily_at_ninety_days(): void
    {
        $data = $this->chartData(Livewire::test(VisitorsTrendChart::class)->set('filter', '90')->instance());

        $this->assertCount(90, $data['labels']);
        $this->assertStringNotContainsString('w/c', $data['labels'][0]);
    }

    public function test_trend_chart_explains_itself_when_analytics_is_down(): void
    {
        $this->failAnalytics();

        $component = Livewire::test(VisitorsTrendChart::class)
            ->assertOk()
            ->assertSee('Analytics unavailable')
            ->assertSee(AnalyticsUnavailable::USER_MESSAGE);

        $this->assertSame([], $this->chartData($component->instance()));
    }

    public function test_countries_chart_lists_countries_by_visitors(): void
    {
        $data = $this->chartData(Livewire::test(TopCountriesChart::class)->instance());

        $this->assertSame('United Kingdom', $data['labels'][0]);
        $this->assertContains('Unknown', $data['labels']);
        $this->assertSame(412, $data['datasets'][0]['data'][0]);
    }

    public function test_countries_chart_supports_a_today_filter(): void
    {
        $component = Livewire::test(TopCountriesChart::class)->set('filter', '1');
        $data = $this->chartData($component->instance());

        $this->assertArrayHasKey('1', (fn () => $this->getFilters())->call($component->instance()) ?? []);
        $this->assertSame('United Kingdom', $data['labels'][0]);
    }

    public function test_countries_chart_renders_horizontally(): void
    {
        $options = (fn () => $this->getOptions())->call(Livewire::test(TopCountriesChart::class)->instance());

        $this->assertIsArray($options);
        $this->assertSame('y', $options['indexAxis']);
    }

    public function test_countries_chart_explains_itself_when_analytics_is_down(): void
    {
        $this->failAnalytics();

        Livewire::test(TopCountriesChart::class)
            ->assertOk()
            ->assertSee('Analytics unavailable');
    }

    public function test_cities_table_renders_rows_and_labels_withheld_locations(): void
    {
        Livewire::test(TopCitiesWidget::class)
            ->assertOk()
            ->assertSee('Top cities')
            ->assertSee('London')
            ->assertSee('Manchester')
            ->assertSee('Unknown')
            ->assertDontSee('(not set)');
    }

    public function test_cities_table_explains_itself_when_analytics_is_down(): void
    {
        $this->failAnalytics();

        Livewire::test(TopCitiesWidget::class)
            ->assertOk()
            ->assertSee('Analytics unavailable')
            ->assertDontSee('No location data yet');
    }

    /**
     * @return array<string, mixed>
     */
    private function chartData(object $component): array
    {
        return (fn () => $this->getData())->call($component);
    }
}
