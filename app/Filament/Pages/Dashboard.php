<?php

namespace App\Filament\Pages;

use App\Filament\Actions\RebuildApiCacheAction;
use App\Filament\Widgets\AnalyticsOverviewWidget;
use App\Filament\Widgets\ContentStats;
use App\Filament\Widgets\LatestBookings;
use App\Filament\Widgets\SyncStatus;
use App\Filament\Widgets\TopCitiesWidget;
use App\Filament\Widgets\TopCountriesChart;
use App\Filament\Widgets\VisitorsTrendChart;
use Filament\Actions\Action;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\Widget;
use Livewire\Attributes\Url;

/**
 * Two views of the dashboard: the back-office overview and Google Analytics.
 *
 * The panel discovers every widget in app/Filament/Widgets, so the widgets
 * are listed here per view instead of taken from the panel. Switching is a
 * Livewire round trip; the choice is kept in the URL so a reload or a shared
 * link opens the same view.
 */
class Dashboard extends BaseDashboard
{
    public const string OVERVIEW = 'overview';

    public const string ANALYTICS = 'analytics';

    /**
     * @var array<string, list<class-string<Widget>>>
     */
    private const array WIDGETS = [
        self::OVERVIEW => [
            ContentStats::class,
            LatestBookings::class,
            SyncStatus::class,
        ],
        self::ANALYTICS => [
            AnalyticsOverviewWidget::class,
            VisitorsTrendChart::class,
            TopCountriesChart::class,
            TopCitiesWidget::class,
        ],
    ];

    #[Url(except: self::OVERVIEW)]
    public string $tab = self::OVERVIEW;

    /**
     * @return list<class-string<Widget>>
     */
    public function getWidgets(): array
    {
        return self::WIDGETS[$this->currentTab()];
    }

    public function currentTab(): string
    {
        // The value arrives from the query string, so anything unknown falls
        // back to the overview instead of erroring.
        return array_key_exists($this->tab, self::WIDGETS) ? $this->tab : self::OVERVIEW;
    }

    public function isShowingAnalytics(): bool
    {
        return $this->currentTab() === self::ANALYTICS;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('toggleAnalytics')
                ->label(fn (): string => $this->isShowingAnalytics() ? 'Overview' : 'Analytics')
                ->icon(fn (): Heroicon => $this->isShowingAnalytics() ? Heroicon::OutlinedSquares2x2 : Heroicon::OutlinedChartBar)
                ->color('gray')
                ->action(function (): void {
                    $this->tab = $this->isShowingAnalytics() ? self::OVERVIEW : self::ANALYTICS;
                }),
            RebuildApiCacheAction::make(),
        ];
    }
}
