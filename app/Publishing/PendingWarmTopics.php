<?php

namespace App\Publishing;

use Illuminate\Support\Facades\Cache;

/**
 * Topics waiting to be sent to the endpoint. Stored in the cache (database
 * store, shared by web requests and cron runs) and changed under a lock, so a
 * topic added while a flush is running is never lost.
 */
final class PendingWarmTopics
{
    private const KEY = 'endpoint-warm:pending';

    private const LOCK = 'endpoint-warm:pending-lock';

    private const LOCK_SECONDS = 10;

    /**
     * @param  list<string>  $topics
     */
    public function add(array $topics): void
    {
        if ($topics === []) {
            return;
        }

        Cache::lock(self::LOCK, self::LOCK_SECONDS)->block(self::LOCK_SECONDS, function () use ($topics): void {
            Cache::forever(self::KEY, array_values(array_unique([...$this->all(), ...$topics])));
        });
    }

    /**
     * Takes every pending topic (the set is emptied).
     *
     * @return list<string>
     */
    public function pull(): array
    {
        return Cache::lock(self::LOCK, self::LOCK_SECONDS)->block(self::LOCK_SECONDS, function (): array {
            $topics = $this->all();
            Cache::forget(self::KEY);

            return $topics;
        });
    }

    /**
     * @return list<string>
     */
    public function all(): array
    {
        $topics = Cache::get(self::KEY, []);

        return is_array($topics) ? array_values(array_filter($topics, 'is_string')) : [];
    }
}
