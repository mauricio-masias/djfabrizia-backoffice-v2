<?php

namespace Tests\Feature\Filament;

use App\Filament\Widgets\AnalyticsOverviewWidget;
use App\Filament\Widgets\TopCitiesWidget;
use App\Filament\Widgets\TopCountriesChart;
use App\Filament\Widgets\TopPagesWidget;
use App\Filament\Widgets\VisitorsTrendChart;
use App\Services\Analytics\Contracts\AnalyticsProvider;
use App\Services\Analytics\Data\Granularity;
use App\Services\Analytics\Data\PageRow;
use App\Services\Analytics\Data\Period;
use App\Services\Analytics\Data\PeriodSummary;
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

    public function test_pages_table_lists_pages_by_views_with_home_labelled(): void
    {
        // The fake scales by period length: the default 7 days gives Home
        // 280 views, and the /mixes spellings merge into 105.
        Livewire::test(TopPagesWidget::class)
            ->assertOk()
            ->assertSee('Pages visited')
            ->assertSeeInOrder(['Home', 'Mixes', 'Uk gigs', 'Contact me'])
            ->assertSee('280')
            ->assertSee('105')
            ->assertDontSee('utm_source')
            ->assertDontSee('Privacy policy');
    }

    public function test_pages_table_filter_switches_the_period(): void
    {
        $this->assertSame('7', TopPagesWidget::DEFAULT_PERIOD);
        $this->assertSame(['1', '7', '30', '90'], array_map('strval', array_keys(TopPagesWidget::PERIODS)));

        Livewire::test(TopPagesWidget::class)
            ->assertTableFilterExists('period')
            ->filterTable('period', '90')
            ->assertSee('3,600')
            ->filterTable('period', '1')
            ->assertSee('40')
            ->assertDontSee('3,600');
    }

    public function test_pages_table_shows_only_home_when_only_home_was_visited(): void
    {
        $this->app->instance(AnalyticsProvider::class, $this->pagesProvider([new PageRow('/', 9, 4)]));

        Livewire::test(TopPagesWidget::class)
            ->assertOk()
            ->assertSee('Home')
            ->assertDontSee('No visits');
    }

    public function test_pages_table_says_no_visits_when_nothing_was_viewed(): void
    {
        $this->app->instance(AnalyticsProvider::class, $this->pagesProvider([]));

        Livewire::test(TopPagesWidget::class)
            ->assertOk()
            ->assertSee('No visits')
            ->assertDontSee('Analytics unavailable');
    }

    public function test_pages_table_never_shows_zero_view_pages(): void
    {
        // GA4 already omits these, and consolidate() drops them; the widget
        // filters once more so a provider that slips one through stays honest.
        $this->app->instance(AnalyticsProvider::class, $this->pagesProvider([new PageRow('/bio', 0, 2)]));

        Livewire::test(TopPagesWidget::class)
            ->assertSee('No visits')
            ->assertDontSee('Bio');
    }

    public function test_pages_table_explains_itself_when_analytics_is_down(): void
    {
        $this->failAnalytics();

        Livewire::test(TopPagesWidget::class)
            ->assertOk()
            ->assertSee('Analytics unavailable')
            ->assertDontSee('No visits');
    }

    /**
     * A provider whose topPages() returns exactly the given rows, unfiltered.
     *
     * @param  list<PageRow>  $pages
     */
    private function pagesProvider(array $pages): AnalyticsProvider
    {
        return new class($pages) implements AnalyticsProvider
        {
            private FakeAnalyticsProvider $fake;

            /**
             * @param  list<PageRow>  $pages
             */
            public function __construct(private readonly array $pages)
            {
                $this->fake = new FakeAnalyticsProvider;
            }

            public function summary(Period $period): PeriodSummary
            {
                return $this->fake->summary($period);
            }

            public function trend(Period $period, Granularity $granularity = Granularity::Daily): array
            {
                return $this->fake->trend($period, $granularity);
            }

            public function topCountries(Period $period, int $limit = 10): array
            {
                return $this->fake->topCountries($period, $limit);
            }

            public function topCities(Period $period, int $limit = 10): array
            {
                return $this->fake->topCities($period, $limit);
            }

            public function topPages(Period $period, int $limit = 20): array
            {
                return $this->pages;
            }
        };
    }

    /**
     * @return array<string, mixed>
     */
    private function chartData(object $component): array
    {
        return (fn () => $this->getData())->call($component);
    }
}
