<?php

namespace App\Jobs;

use App\Sync\Sources\MixcloudSource;
use App\Sync\Sources\SpotifySource;
use App\Sync\Sources\YoutubeSource;
use App\Sync\SyncRunner;
use App\Sync\SyncSource;
use Djfabrizia\Content\Enums\SyncProvider;
use Djfabrizia\Content\Enums\SyncStatus;
use Djfabrizia\Content\Models\SyncRun;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Throwable;

/**
 * Syncs one provider. Scheduled daily and started by the "Sync now" buttons;
 * a manual and a scheduled run of the same provider never overlap.
 */
class SyncProviderJob implements ShouldQueue
{
    use Queueable;

    /** Retries happen per request inside the run; a failed run is recorded, not retried. */
    public int $tries = 1;

    /** Below the worker's --timeout and the queue's retry_after. */
    public int $timeout = 110;

    public function __construct(public readonly SyncProvider $provider) {}

    /**
     * @return list<object>
     */
    public function middleware(): array
    {
        return [(new WithoutOverlapping('sync-'.$this->provider->value))->dontRelease()->expireAfter(300)];
    }

    public function handle(SyncRunner $runner): void
    {
        $runner->run(self::source($this->provider));
    }

    /**
     * A run killed from outside the runner (worker timeout, fatal error) would
     * otherwise stay "running" forever in the sync log.
     */
    public function failed(?Throwable $exception): void
    {
        SyncRun::query()
            ->where('provider', $this->provider)
            ->where('status', SyncStatus::Running)
            ->update([
                'status' => SyncStatus::Failed,
                'finished_at' => now(),
                'error' => mb_substr(SyncRunner::redact($exception?->getMessage() ?? 'The sync was stopped before it finished.'), 0, 1000),
            ]);
    }

    public static function source(SyncProvider $provider): SyncSource
    {
        return app(match ($provider) {
            SyncProvider::Mixcloud => MixcloudSource::class,
            SyncProvider::Spotify => SpotifySource::class,
            SyncProvider::Youtube => YoutubeSource::class,
        });
    }
}
