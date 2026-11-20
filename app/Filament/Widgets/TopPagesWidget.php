<?php

namespace App\Filament\Widgets;

use App\Services\Analytics\Contracts\AnalyticsProvider;
use App\Services\Analytics\Data\Period;
use App\Services\Analytics\Exceptions\AnalyticsUnavailable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

/**
 * Which pages of the public site were viewed, most viewed first.
 */
class TopPagesWidget extends TableWidget
{
    /**
     * Day counts, matching the period filters on the analytics charts.
     */
    public const array PERIODS = [
        '1' => 'Today',
        '7' => 'Last 7 days',
        '30' => 'Last 30 days',
        '90' => 'Last 90 days',
    ];

    public const string DEFAULT_PERIOD = '7';

    private const int LIMIT = 20;

    protected static ?int $sort = 5;

    protected int|string|array $columnSpan = 'full';

    /**
     * Set while fetching rows, so the empty state can say why there are none.
     */
    protected bool $isAnalyticsUnavailable = false;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Pages visited')
            ->description('Views and visitors per page. Query strings and trailing slashes are merged into one page.')
            ->records(fn (array $filters): array => $this->rows($filters['period']['value'] ?? null))
            ->columns([
                TextColumn::make('label')
                    ->label('Page')
                    ->weight('medium')
                    ->description(fn (array $record): string => $record['path']),
                TextColumn::make('views')
                    ->label('Views')
                    ->numeric()
                    ->alignEnd(),
                TextColumn::make('visitors')
                    ->label('Visitors')
                    ->numeric()
                    ->alignEnd(),
            ])
            ->filters([
                SelectFilter::make('period')
                    ->label('Period')
                    ->options(self::PERIODS)
                    ->default(self::DEFAULT_PERIOD)
                    ->selectablePlaceholder(false),
            ], layout: FiltersLayout::AboveContent)
            ->deferFilters(false)
            ->paginated(false)
            ->emptyStateHeading(fn (): string => $this->isAnalyticsUnavailable ? 'Analytics unavailable' : 'No visits')
            ->emptyStateDescription(fn (): string => $this->isAnalyticsUnavailable
                ? AnalyticsUnavailable::USER_MESSAGE
                : 'Nobody has viewed a page in this period.');
    }

    /**
     * @return array<int, array{label: string, path: string, views: int, visitors: int}>
     */
    private function rows(mixed $period): array
    {
        // The filter value round-trips through the browser, so only known
        // day counts are accepted.
        $days = array_key_exists((string) $period, self::PERIODS) ? (int) $period : (int) self::DEFAULT_PERIOD;

        try {
            $pages = app(AnalyticsProvider::class)->topPages(Period::lastDays($days), self::LIMIT);
        } catch (AnalyticsUnavailable $e) {
            report($e);

            $this->isAnalyticsUnavailable = true;

            return [];
        }

        $records = [];

        foreach ($pages as $index => $page) {
            if ($page->views <= 0) {
                continue;
            }

            $records[$index + 1] = [
                'label' => $page->label(),
                'path' => $page->path,
                'views' => $page->views,
                'visitors' => $page->visitors,
            ];
        }

        return $records;
    }
}
