<?php

namespace App\Actions;

use App\Events\ContentChanged;
use Djfabrizia\Content\Models\RecordLabel;
use Djfabrizia\Content\Models\Release;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

/**
 * Moves every release of the source labels to the target label, then deletes
 * the sources (e.g. "On circle" into "On Circle Music").
 */
class MergeRecordLabels
{
    /**
     * @param  Collection<int, RecordLabel>  $sources
     */
    public function handle(RecordLabel $target, Collection $sources): RecordLabel
    {
        $sourceIds = $sources->reject(fn (RecordLabel $label): bool => $label->is($target))->modelKeys();

        if ($sourceIds === []) {
            throw new InvalidArgumentException('Select at least one other label to merge.');
        }

        $merged = DB::transaction(function () use ($target, $sourceIds): RecordLabel {
            Release::query()->whereIn('record_label_id', $sourceIds)->update(['record_label_id' => $target->id]);
            RecordLabel::query()->whereKey($sourceIds)->delete();

            return $target->refresh();
        });

        // Query-builder writes fire no model events, so the publish observer never sees a merge.
        ContentChanged::dispatch(['releases']);

        return $merged;
    }
}
