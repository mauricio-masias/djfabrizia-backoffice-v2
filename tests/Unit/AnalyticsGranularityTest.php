<?php

namespace Tests\Unit;

use App\Services\Analytics\Data\Granularity;
use App\Services\Analytics\Exceptions\AnalyticsUnavailable;
use PHPUnit\Framework\TestCase;

class AnalyticsGranularityTest extends TestCase
{
    public function test_parses_the_dimension_values_ga4_returns(): void
    {
        $this->assertSame('2026-09-05', Granularity::Daily->parse('20260905', 'Europe/London')->toDateString());
        $this->assertSame('2026-08-31', Granularity::Weekly->parse('202636', 'Europe/London')->toDateString());
        $this->assertSame('2026-09-01', Granularity::Monthly->parse('202609', 'Europe/London')->toDateString());
    }

    public function test_an_unparseable_date_is_reported_as_unavailable_rather_than_crashing(): void
    {
        $this->expectException(AnalyticsUnavailable::class);

        Granularity::Daily->parse('not-a-date', 'Europe/London');
    }

    public function test_long_ranges_are_bucketed_by_week(): void
    {
        $this->assertSame(Granularity::Daily, Granularity::forLength(90));
        $this->assertSame(Granularity::Weekly, Granularity::forLength(91));
    }
}
