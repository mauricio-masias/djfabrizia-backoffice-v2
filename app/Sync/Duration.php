<?php

namespace App\Sync;

/**
 * Display durations in the formats the site has always used.
 */
final class Duration
{
    /**
     * YouTube ISO 8601 ("PT1H7M28S") → "1:07:28", "PT4M5S" → "04:05", "PT38S" → "00:38".
     */
    public static function fromIso8601(?string $value): ?string
    {
        if ($value === null || preg_match('/^P(?:(\d+)D)?T?(?:(\d+)H)?(?:(\d+)M)?(?:(\d+)S)?$/', $value, $parts) !== 1) {
            return null;
        }

        $hours = (int) ($parts[1] ?? 0) * 24 + (int) ($parts[2] ?? 0);
        $minutes = (int) ($parts[3] ?? 0);
        $seconds = (int) ($parts[4] ?? 0);

        return $hours > 0
            ? sprintf('%d:%02d:%02d', $hours, $minutes, $seconds)
            : sprintf('%02d:%02d', $minutes, $seconds);
    }

    /**
     * Mixcloud seconds → "minutes:seconds" without padding ("63:6"), as the
     * WordPress sync stored them.
     */
    public static function fromSeconds(?int $seconds): ?string
    {
        return $seconds === null ? null : intdiv($seconds, 60).':'.($seconds % 60);
    }
}
