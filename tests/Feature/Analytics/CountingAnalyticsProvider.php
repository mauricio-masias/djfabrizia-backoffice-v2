<?php

namespace Tests\Feature\Analytics;

use App\Services\Analytics\Contracts\AnalyticsProvider;
use App\Services\Analytics\Data\Granularity;
use App\Services\Analytics\Data\PageRow;
use App\Services\Analytics\Data\Period;
use App\Services\Analytics\Data\PeriodSummary;

/**
 * Counts calls so cache behaviour can be asserted without mocking.
 */
final class CountingAnalyticsProvider implements AnalyticsProvider
{
    public int $summaryCalls = 0;

    public int $trendCalls = 0;

    public int $countryCalls = 0;

    public int $cityCalls = 0;

    public int $pageCalls = 0;

    public function __construct(private readonly AnalyticsProvider $inner) {}

    public function summary(Period $period): PeriodSummary
    {
        $this->summaryCalls++;

        return $this->inner->summary($period);
    }

    public function trend(Period $period, Granularity $granularity = Granularity::Daily): array
    {
        $this->trendCalls++;

        return $this->inner->trend($period, $granularity);
    }

    public function topCountries(Period $period, int $limit = 10): array
    {
        $this->countryCalls++;

        return $this->inner->topCountries($period, $limit);
    }

    public function topCities(Period $period, int $limit = 10): array
    {
        $this->cityCalls++;

        return $this->inner->topCities($period, $limit);
    }

    /**
     * @return list<PageRow>
     */
    public function topPages(Period $period, int $limit = 20): array
    {
        $this->pageCalls++;

        return $this->inner->topPages($period, $limit);
    }
}
