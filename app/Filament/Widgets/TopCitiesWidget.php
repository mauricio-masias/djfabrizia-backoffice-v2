<?php

namespace App\Filament\Widgets;

use App\Filament\Widgets\Concerns\ReadsSiteAnalytics;
use App\Services\Analytics\Data\Period;
use App\Services\Analytics\Exceptions\AnalyticsUnavailable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

/**
 * Cities are shown as a table rather than a chart.
 *
 * City names are long and their counts on a small site are close together, so
 * a bar chart would be mostly labels. A table also lets the withheld rows GA4
 * reports as unknown sit honestly alongside the rest.
 */
class TopCitiesWidget extends TableWidget
{
    use ReadsSiteAnalytics;

    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'full';

    /**
     * Set while fetching rows, so the empty state can say why there are none.
     */
    protected bool $isAnalyticsUnavailable = false;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Top cities')
            ->description('Last 30 days. GA4 withholds locations for very small groups; those appear as unknown.')
            ->records(fn (): array => $this->rows())
            ->columns([
                TextColumn::make('city')
                    ->label('City')
                    ->weight('medium'),
                TextColumn::make('country')
                    ->label('Country'),
                TextColumn::make('visitors')
                    ->label('Visitors')
                    ->numeric()
                    ->alignEnd(),
                TextColumn::make('sessions')
                    ->label('Visits')
                    ->numeric()
                    ->alignEnd(),
            ])
            ->paginated(false)
            ->emptyStateHeading(fn (): string => $this->isAnalyticsUnavailable ? 'Analytics unavailable' : 'No location data yet')
            ->emptyStateDescription(fn (): ?string => $this->isAnalyticsUnavailable ? AnalyticsUnavailable::USER_MESSAGE : null);
    }

    /**
     * @return array<int, array<string, string|int>>
     */
    private function rows(): array
    {
        try {
            $rows = $this->analytics()->topCities(Period::lastDays(30), 10);
        } catch (AnalyticsUnavailable $e) {
            report($e);

            $this->isAnalyticsUnavailable = true;

            return [];
        }

        $records = [];

        foreach ($rows as $index => $row) {
            $records[$index + 1] = [
                'city' => $row->cityLabel() ?? 'Unknown',
                'country' => $row->countryLabel(),
                'visitors' => $row->visitors,
                'sessions' => $row->sessions,
            ];
        }

        return $records;
    }
}
