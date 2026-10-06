<?php

namespace App\Actions;

use App\Events\ContentChanged;
use Djfabrizia\Content\Models\Genre;
use Djfabrizia\Content\Models\Release;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

/**
 * Folds duplicate genres into one: every mix, release and primary-style link
 * moves to the target, and the merged names become aliases of the target so
 * future syncs and imports resolve to it. Reversible by hand: the old names
 * stay in the aliases list.
 */
class MergeGenres
{
    /**
     * @param  Collection<int, Genre>  $sources
     */
    public function handle(Genre $target, Collection $sources): Genre
    {
        $sources = $sources->reject(fn (Genre $genre): bool => $genre->is($target))->values();

        if ($sources->isEmpty()) {
            throw new InvalidArgumentException('Select at least one other genre to merge.');
        }

        $merged = DB::transaction(function () use ($target, $sources): Genre {
            $sourceIds = $sources->modelKeys();
            $sources->load(['mixes:id', 'releases:id']);

            $target->mixes()->syncWithoutDetaching($sources->flatMap->mixes->pluck('id')->all());
            $target->releases()->syncWithoutDetaching($sources->flatMap->releases->pluck('id')->all());

            Release::query()
                ->whereIn('primary_genre_id', $sourceIds)
                ->update(['primary_genre_id' => $target->id]);

            $aliases = collect($target->aliases ?? [])
                ->merge($sources->flatMap(fn (Genre $genre): array => [$genre->name, $genre->slug, ...($genre->aliases ?? [])]))
                ->map(fn (string $alias): string => trim($alias))
                ->filter()
                ->unique(fn (string $alias): string => mb_strtolower($alias))
                ->values()
                ->all();

            $target->update(['aliases' => $aliases, 'sort' => $target->sort ?? 0]);

            // Pivot rows of the merged genres go with them (cascade on delete).
            Genre::query()->whereKey($sourceIds)->delete();

            return $target->refresh();
        });

        // Query-builder writes fire no model events, so the publish observer never sees a merge.
        ContentChanged::dispatch(['genres', 'mixes', 'releases']);

        return $merged;
    }
}
