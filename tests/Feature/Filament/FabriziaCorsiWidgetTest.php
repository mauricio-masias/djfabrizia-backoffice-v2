<?php

namespace Tests\Feature\Filament;

use App\Filament\Widgets\AnalyticsOverviewWidget;
use App\Filament\Widgets\FabriziaCorsi;
use App\Filament\Widgets\TopCitiesWidget;
use App\Filament\Widgets\TopCountriesChart;
use App\Filament\Widgets\VisitorsTrendChart;
use App\Services\Analytics\AnalyticsSite;
use App\Services\Analytics\Contracts\AnalyticsProvider;
use App\Services\Analytics\Exceptions\AnalyticsUnavailable;
use App\Services\Analytics\FakeAnalyticsProvider;
use Filament\Widgets\Widget;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\DataProvider;

class FabriziaCorsiWidgetTest extends AdminTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->instance(AnalyticsSite::Main->binding(), new FakeAnalyticsProvider);
        $this->app->instance(AnalyticsSite::FabriziaCorsi->binding(), new FakeAnalyticsProvider);
    }

    /**
     * @return array<string, array{class-string<Widget>, class-string<Widget>}>
     */
    public static function widgetPairs(): array
    {
        return [
            'overview' => [AnalyticsOverviewWidget::class, FabriziaCorsi\AnalyticsOverviewWidget::class],
            'visitors trend' => [VisitorsTrendChart::class, FabriziaCorsi\VisitorsTrendChart::class],
            'top countries' => [TopCountriesChart::class, FabriziaCorsi\TopCountriesChart::class],
            'top cities' => [TopCitiesWidget::class, FabriziaCorsi\TopCitiesWidget::class],
        ];
    }

    /**
     * @param  class-string<Widget>  $mainWidget
     * @param  class-string<Widget>  $sisterWidget
     */
    #[DataProvider('widgetPairs')]
    public function test_only_the_sister_widget_is_unavailable_when_the_sister_provider_fails(string $mainWidget, string $sisterWidget): void
    {
        $this->failAnalytics(AnalyticsSite::FabriziaCorsi);

        Livewire::test($sisterWidget)->assertOk()->assertSee('Analytics unavailable');
        Livewire::test($mainWidget)->assertOk()->assertDontSee('Analytics unavailable');
    }

    /**
     * @param  class-string<Widget>  $mainWidget
     * @param  class-string<Widget>  $sisterWidget
     */
    #[DataProvider('widgetPairs')]
    public function test_only_the_main_widget_is_unavailable_when_the_main_provider_fails(string $mainWidget, string $sisterWidget): void
    {
        $this->failAnalytics(AnalyticsSite::Main);

        Livewire::test($mainWidget)->assertOk()->assertSee('Analytics unavailable');
        Livewire::test($sisterWidget)->assertOk()->assertDontSee('Analytics unavailable');
    }

    /**
     * @param  class-string<Widget>  $mainWidget
     * @param  class-string<Widget>  $sisterWidget
     */
    #[DataProvider('widgetPairs')]
    public function test_a_widget_degrades_when_its_provider_cannot_even_be_resolved(string $mainWidget, string $sisterWidget): void
    {
        // A missing property id or key fails while the provider is built,
        // before any report is requested.
        foreach (AnalyticsSite::cases() as $site) {
            $this->app->forgetInstance($site->binding());
            $this->app->bind($site->binding(), fn (): AnalyticsProvider => throw AnalyticsUnavailable::notConfigured('no property id'));
        }

        Livewire::test($mainWidget)->assertOk()->assertSee('Analytics unavailable');
        Livewire::test($sisterWidget)->assertOk()->assertSee('Analytics unavailable');
    }

    /**
     * @param  class-string<Widget>  $mainWidget
     * @param  class-string<Widget>  $sisterWidget
     */
    #[DataProvider('widgetPairs')]
    public function test_the_sister_widget_does_not_poll_a_quota_limited_api(string $mainWidget, string $sisterWidget): void
    {
        Livewire::test($sisterWidget)->assertDontSeeHtml('wire:poll');
    }

    public function test_the_overview_heading_names_the_sister_site_only(): void
    {
        Livewire::test(FabriziaCorsi\AnalyticsOverviewWidget::class)->assertSee('FabriziaCorsi visitors');

        Livewire::test(AnalyticsOverviewWidget::class)
            ->assertSee('Visitors')
            ->assertDontSee('FabriziaCorsi visitors');
    }

    private function failAnalytics(AnalyticsSite $site): void
    {
        $this->app->instance($site->binding(), (new FakeAnalyticsProvider)->fail());
    }
}
