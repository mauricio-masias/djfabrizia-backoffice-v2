<?php

namespace App\Services\Analytics\Data;

use App\Services\Analytics\Exceptions\AnalyticsUnavailable;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Carbon\Exceptions\InvalidFormatException;

/**
 * The bucket size for a trend series.
 *
 * This exists because visitor counts cannot be re-bucketed after the fact.
 * GA4 de-duplicates users within whatever range it is asked about, so adding
 * up seven daily visitor counts overcounts everyone who came back during the
 * week. A weekly series has to be requested as weeks.
 *
 * Alignment and stepping live here rather than in the provider so that adding
 * a new case cannot leave a caller silently treating it as some other size.
 */
enum Granularity: string
{
    case Daily = 'daily';
    case Weekly = 'weekly';
    case Monthly = 'monthly';

    /**
     * The GA4 dimension that buckets at this size. The ISO week variant is
     * used so weeks start on Monday, matching the reporting calendar.
     */
    public function dimension(): string
    {
        return match ($this) {
            self::Daily => 'date',
            self::Weekly => 'isoYearIsoWeek',
            self::Monthly => 'yearMonth',
        };
    }

    /**
     * Parses the dimension value GA4 returns: "20260905" for a day, "202636"
     * for an ISO week, "202609" for a month.
     */
    public function parse(string $value, string $timezone): CarbonImmutable
    {
        return match ($this) {
            self::Daily => $this->parseDay($value, $timezone),
            self::Weekly => CarbonImmutable::now($timezone)
                ->setISODate((int) substr($value, 0, 4), (int) substr($value, 4, 2))
                ->startOfDay(),
            self::Monthly => CarbonImmutable::now($timezone)
                ->setDate((int) substr($value, 0, 4), (int) substr($value, 4, 2), 1)
                ->startOfDay(),
        };
    }

    /**
     * A malformed date is a broken response, not a programming error, so it
     * surfaces as AnalyticsUnavailable for the widgets to catch.
     */
    private function parseDay(string $value, string $timezone): CarbonImmutable
    {
        try {
            $date = CarbonImmutable::createFromFormat('Ymd', $value, $timezone);
        } catch (InvalidFormatException) {
            $date = null;
        }

        return ($date ?? throw AnalyticsUnavailable::unexpectedResponse("unrecognised date \"{$value}\""))->startOfDay();
    }

    /**
     * The start of the bucket containing this date.
     */
    public function startOf(CarbonImmutable $date): CarbonImmutable
    {
        return match ($this) {
            self::Daily => $date->startOfDay(),
            self::Weekly => $date->startOfWeek(CarbonInterface::MONDAY),
            self::Monthly => $date->startOfMonth(),
        };
    }

    /**
     * The start of the next bucket.
     */
    public function next(CarbonImmutable $date): CarbonImmutable
    {
        return match ($this) {
            self::Daily => $date->addDay(),
            self::Weekly => $date->addWeek(),
            self::Monthly => $date->addMonth()->startOfMonth(),
        };
    }

    /**
     * Picks a sensible bucket size for a range: days stay readable up to about
     * a quarter, beyond which weeks carry the shape better.
     */
    public static function forLength(int $days): self
    {
        return $days > 90 ? self::Weekly : self::Daily;
    }
}
