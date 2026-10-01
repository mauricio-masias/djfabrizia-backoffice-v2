<?php

namespace App\Sync;

use Djfabrizia\Content\Enums\SyncProvider;

/**
 * One provider sync: reads the upstream list and writes it into its
 * collection. Writes only touch upstream-owned fields.
 */
interface SyncSource
{
    public function provider(): SyncProvider;

    /**
     * The endpoint cache topic to rebuild after changes (e.g. "mixes").
     */
    public function topic(): string;

    public function fetch(): FetchResult;

    /**
     * @param  array<string, mixed>  $item
     * @return 'created'|'updated'|'unchanged'
     */
    public function save(string $externalId, array $item): string;

    /**
     * Deletes items that are no longer upstream. Items a page still uses are
     * kept, flagged and moved to draft instead.
     *
     * @param  list<string>  $seenExternalIds
     */
    public function reconcileMissing(array $seenExternalIds): MissingReport;

    /**
     * Synced rows of this provider currently stored.
     */
    public function existingCount(): int;
}
