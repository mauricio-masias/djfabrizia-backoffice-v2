<?php

namespace App\Sync;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Throwable;

/**
 * HTTP client for provider APIs: short timeouts, and retries on network
 * errors, 429 and 5xx, waiting for Retry-After when the provider sends it.
 */
final class SyncHttp
{
    private const TIMEOUT_SECONDS = 15;

    private const CONNECT_TIMEOUT_SECONDS = 5;

    private const MAX_RETRY_AFTER_SECONDS = 30;

    public static function client(): PendingRequest
    {
        return Http::acceptJson()
            ->timeout(self::TIMEOUT_SECONDS)
            ->connectTimeout(self::CONNECT_TIMEOUT_SECONDS)
            ->retry(
                3,
                fn (int $attempt, Throwable $exception): int => self::delay($attempt, $exception),
                fn (Throwable $exception): bool => ! $exception instanceof RequestException
                    || $exception->response->status() === 429
                    || $exception->response->serverError(),
            );
    }

    private static function delay(int $attempt, Throwable $exception): int
    {
        if ($exception instanceof RequestException) {
            $retryAfter = (int) $exception->response->header('Retry-After');

            if ($retryAfter > 0) {
                return min($retryAfter, self::MAX_RETRY_AFTER_SECONDS) * 1000;
            }
        }

        return 500 * 2 ** ($attempt - 1);
    }
}
