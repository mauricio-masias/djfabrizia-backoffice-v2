<?php

namespace App\Sync;

use App\Events\ContentChanged;
use Djfabrizia\Content\Enums\SyncStatus;
use Djfabrizia\Content\Models\SyncRun;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Runs one provider sync and records it in `sync_runs`.
 *
 * Model events are muted while items are written, so a sync of 80 mixes
 * triggers one cache rebuild (a single ContentChanged event) instead of 80.
 */
class SyncRunner
{
    public function run(SyncSource $source): SyncRun
    {
        $run = SyncRun::query()->create([
            'provider' => $source->provider(),
            'status' => SyncStatus::Running,
            'started_at' => now(),
        ]);

        $counts = ['created' => 0, 'updated' => 0, 'unchanged' => 0];

        try {
            $result = $source->fetch();

            Model::withoutEvents(function () use ($source, $result, &$counts): void {
                foreach ($result->items as $externalId => $item) {
                    $counts[$source->save((string) $externalId, $item)]++;
                }
            });

            // An empty "complete" list while items exist here looks like an
            // upstream problem (wrong account, API change): never delete on it.
            $suspicious = $result->items === [] && $source->existingCount() > 0;
            $complete = $result->complete && ! $suspicious;

            $missing = $complete
                ? Model::withoutEvents(fn (): MissingReport => $source->reconcileMissing(array_map('strval', array_keys($result->items))))
                : new MissingReport;

            $notes = array_filter([
                $result->warning,
                $suspicious ? 'The provider returned no items; nothing was removed.' : null,
                $missing->kept === [] ? null : 'Gone upstream but kept as draft: '.implode('; ', $missing->kept),
            ]);

            $run->update([
                'status' => $complete ? SyncStatus::Success : SyncStatus::Partial,
                'finished_at' => now(),
                'created' => $counts['created'],
                'updated' => $counts['updated'],
                'missing' => $missing->total(),
                'error' => $notes === [] ? null : mb_substr(self::redact(implode(' ', $notes)), 0, 1000),
            ]);
        } catch (Throwable $exception) {
            $message = self::redact($exception->getMessage());
            Log::error('Content sync failed', ['provider' => $source->provider()->value, 'error' => $message]);

            $run->update([
                'status' => SyncStatus::Failed,
                'finished_at' => now(),
                'created' => $counts['created'],
                'updated' => $counts['updated'],
                'error' => mb_substr($message, 0, 1000),
            ]);
        }

        if ($run->created > 0 || $run->updated > 0 || $run->missing > 0) {
            ContentChanged::dispatch([$source->topic()]);
        }

        return $run;
    }

    /**
     * Masks credentials that can appear in request URLs (the YouTube API key
     * travels as a query parameter).
     */
    public static function redact(string $message): string
    {
        return (string) preg_replace('/\b(key|access_token|refresh_token|client_secret)=[^&\s"\']+/i', '$1=***', $message);
    }
}
