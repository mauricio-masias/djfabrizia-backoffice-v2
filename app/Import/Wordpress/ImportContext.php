<?php

namespace App\Import\Wordpress;

use Illuminate\Database\Eloquent\Model;

/**
 * State shared by the import steps of one run: WordPress → new ID maps, the
 * per-step counters and warnings.
 */
final class ImportContext
{
    /** @var array<string, array<int|string, int>> */
    private array $ids = [];

    /** @var array<string, array{created: int, updated: int, unchanged: int, skipped: int}> */
    private array $stats = [];

    /** @var list<string> */
    private array $warnings = [];

    public function __construct(
        public readonly WordpressSource $source,
        public readonly bool $dryRun = false,
        public readonly string $uploadsPath = '/mnt/wp-uploads',
    ) {}

    public function remember(string $kind, int|string $wordpressId, int $newId): void
    {
        $this->ids[$kind][$wordpressId] = $newId;
    }

    public function idFor(string $kind, mixed $wordpressId): ?int
    {
        if (! is_numeric($wordpressId) && ! is_string($wordpressId)) {
            return null;
        }

        return $this->ids[$kind][is_numeric($wordpressId) ? (int) $wordpressId : $wordpressId] ?? null;
    }

    /**
     * Counts a saved model as created, updated or unchanged.
     */
    public function saved(string $step, Model $model): void
    {
        $this->bump($step, match (true) {
            $model->wasRecentlyCreated => 'created',
            $model->wasChanged() => 'updated',
            default => 'unchanged',
        });
    }

    public function skipped(string $step, string $reason): void
    {
        $this->bump($step, 'skipped');
        $this->warn("[{$step}] {$reason}");
    }

    public function warn(string $message): void
    {
        $this->warnings[] = $message;
    }

    /**
     * @return array<string, array{created: int, updated: int, unchanged: int, skipped: int}>
     */
    public function stats(): array
    {
        return $this->stats;
    }

    /**
     * @return list<string>
     */
    public function warnings(): array
    {
        return $this->warnings;
    }

    /**
     * @param  'created'|'updated'|'unchanged'|'skipped'  $counter
     */
    private function bump(string $step, string $counter): void
    {
        $this->stats[$step] ??= ['created' => 0, 'updated' => 0, 'unchanged' => 0, 'skipped' => 0];
        $this->stats[$step][$counter]++;
    }
}
