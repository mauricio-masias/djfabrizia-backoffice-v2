<?php

namespace App\Sync\Sources;

use App\Sync\MissingReport;
use App\Sync\SyncSource;
use Djfabrizia\Content\Enums\ContentSource;
use Djfabrizia\Content\Enums\PublishStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Upsert and reconcile rules shared by the synced collections.
 *
 * - An item is matched by its upstream ID column.
 * - New items are created published, dated with their upstream date.
 * - Existing items only get their upstream fields refreshed: status, order
 *   and editor-owned fields are never touched, and a hidden item is never
 *   re-published.
 * - Items no longer upstream are deleted, unless a page still uses them: those
 *   are flagged and moved to draft, and the run log names the pages.
 */
abstract class CollectionSource implements SyncSource
{
    /**
     * @return class-string<Model>
     */
    abstract protected function model(): string;

    /**
     * Column holding the upstream ID.
     */
    abstract protected function keyColumn(): string;

    abstract protected function contentSource(): ContentSource;

    /**
     * Hook for changes that go beyond plain columns (e.g. mix genres).
     *
     * @param  array<string, mixed>  $item
     */
    protected function afterSave(Model $model, array $item, bool $upstreamChanged): void {}

    public function save(string $externalId, array $item): string
    {
        // Set once on creation, then owned by editors.
        $createOnly = is_array($item['create_only'] ?? null) ? $item['create_only'] : [];
        $publishedAt = $item['published_at'] ?? null;
        unset($item['published_at'], $item['create_only']);

        $model = $this->query()->where($this->keyColumn(), $externalId)->first();

        if ($model === null) {
            $model = $this->model()::query()->create([
                ...$createOnly,
                ...$item,
                $this->keyColumn() => $externalId,
                'source' => $this->contentSource(),
                'status' => PublishStatus::Published,
                'published_at' => $publishedAt instanceof Carbon ? $publishedAt : now(),
            ]);
            $this->afterSave($model, $item, true);

            return 'created';
        }

        $model->fill([...$item, 'source_missing_at' => null]);
        $changed = $model->isDirty();
        $model->save();
        $this->afterSave($model, $item, $model->wasChanged(array_keys($item)));

        return $changed ? 'updated' : 'unchanged';
    }

    public function reconcileMissing(array $seenExternalIds): MissingReport
    {
        $deleted = 0;
        $kept = [];

        foreach ($this->query()->whereNotIn($this->keyColumn(), $seenExternalIds)->get() as $model) {
            // Model events are muted during a sync, so the page-reference guard
            // is checked here explicitly.
            $pages = method_exists($model, 'referencingPageSlugs') ? $model->referencingPageSlugs() : [];

            if ($pages === []) {
                $model->delete();
                $deleted++;

                continue;
            }

            if ($model->getAttribute('source_missing_at') === null) {
                $model->forceFill(['source_missing_at' => now(), 'status' => PublishStatus::Draft])->save();
            }

            $kept[] = '"'.$model->getAttribute('title').'" (used on '.implode(', ', $pages).')';
        }

        return new MissingReport($deleted, $kept);
    }

    /**
     * Synced rows of this provider that exist here.
     */
    public function existingCount(): int
    {
        return $this->query()->count();
    }

    /**
     * Rows owned by this provider (manual rows are never touched).
     *
     * @return Builder<Model>
     */
    private function query(): Builder
    {
        return $this->model()::query()->where('source', $this->contentSource()->value);
    }
}
