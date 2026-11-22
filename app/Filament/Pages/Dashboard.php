<?php

namespace App\Filament\Pages;

use App\Filament\Actions\RebuildApiCacheAction;
use App\Filament\Widgets\AnalyticsOverviewWidget;
use App\Filament\Widgets\ContentStats;
use App\Filament\Widgets\FabriziaCorsi;
use App\Filament\Widgets\LatestBookings;
use App\Filament\Widgets\SyncStatus;
use App\Filament\Widgets\TopCitiesWidget;
use App\Filament\Widgets\TopCountriesChart;
use App\Filament\Widgets\TopPagesWidget;
use App\Filament\Widgets\VisitorsTrendChart;
use Filament\Actions\Action;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\Widget;
use Livewire\Attributes\Url;

/**
 * Three views of the dashboard: the back-office overview, Google Analytics for
 * the main site, and Google Analytics for the sister site FabriziaCorsi.
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

    public const string FABRIZIA_CORSI = 'fabrizia-corsi';

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
            TopPagesWidget::class,
        ],
        // No pages table: the sister site is a single page.
        self::FABRIZIA_CORSI => [
            FabriziaCorsi\AnalyticsOverviewWidget::class,
            FabriziaCorsi\VisitorsTrendChart::class,
            FabriziaCorsi\TopCountriesChart::class,
            FabriziaCorsi\TopCitiesWidget::class,
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

    protected function getHeaderActions(): array
    {
        return [
            $this->toggleAction('toggleAnalytics', self::ANALYTICS, 'Analytics', Heroicon::OutlinedChartBar),
            $this->toggleAction('toggleFabriziaCorsi', self::FABRIZIA_CORSI, 'FabriziaCorsi Analytics', Heroicon::OutlinedPresentationChartLine),
            RebuildApiCacheAction::make(),
        ];
    }

    /**
     * A button that opens a view, and leads back to the overview while that
     * view is open.
     */
    private function toggleAction(string $name, string $tab, string $label, Heroicon $icon): Action
    {
        return Action::make($name)
            ->label(fn (): string => $this->currentTab() === $tab ? 'Overview' : $label)
            ->icon(fn (): Heroicon => $this->currentTab() === $tab ? Heroicon::OutlinedSquares2x2 : $icon)
            ->color('gray')
            ->action(function () use ($tab): void {
                $this->tab = $this->currentTab() === $tab ? self::OVERVIEW : $tab;
            });
    }
}
