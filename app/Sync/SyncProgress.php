<?php

namespace App\Sync;

use App\Jobs\SyncProviderJob;
use Djfabrizia\Content\Enums\SyncProvider;
use Djfabrizia\Content\Enums\SyncStatus;
use Djfabrizia\Content\Models\SyncRun;

/**
 * What the admin UI needs to know about manual syncs in flight.
 *
 * A sync is in progress from the click until its run ends: queued (waiting
 * for the queue drain) or running.
 */
final class SyncProgress
{
    public static function latestRun(SyncProvider $provider): ?SyncRun
    {
        return SyncRun::query()->where('provider', $provider->value)->latest('started_at')->latest('id')->first();
    }

    public static function isSyncing(SyncProvider $provider): bool
    {
        return SyncProviderJob::isQueued($provider) || self::latestRun($provider)?->status === SyncStatus::Running;
    }

    /**
     * @return list<string> provider values
     */
    public static function currentlySyncing(): array
    {
        return array_values(array_map(
            fn (SyncProvider $provider): string => $provider->value,
            array_filter(SyncProvider::cases(), self::isSyncing(...)),
        ));
    }
}
