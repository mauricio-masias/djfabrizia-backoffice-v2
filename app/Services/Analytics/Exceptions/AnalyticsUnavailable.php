<?php

namespace App\Services\Analytics\Exceptions;

use RuntimeException;
use Throwable;

/**
 * Thrown when analytics data cannot be retrieved.
 *
 * Widgets catch this and render an unavailable state. An outage at Google, a
 * revoked service account, or an exhausted quota must never take the whole
 * admin dashboard down with it.
 */
final class AnalyticsUnavailable extends RuntimeException
{
    /**
     * Shown by the widgets in place of data. Deliberately free of detail: the
     * cause (missing key, quota, outage) is reported to the log instead.
     */
    public const string USER_MESSAGE = 'Google Analytics is not available right now. Check the GA4 settings, or try again later.';

    public static function requestFailed(string $report, Throwable $previous): self
    {
        return new self("Failed to fetch the \"{$report}\" analytics report: {$previous->getMessage()}", 0, $previous);
    }

    public static function unexpectedResponse(string $detail): self
    {
        return new self("Google Analytics returned an unexpected response: {$detail}");
    }

    public static function notConfigured(string $detail): self
    {
        return new self("Analytics is not configured correctly: {$detail}");
    }
}
