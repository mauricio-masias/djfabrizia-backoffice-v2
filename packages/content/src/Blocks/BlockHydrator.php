<?php

namespace Djfabrizia\Content\Blocks;

use Djfabrizia\Content\Models\Media;
use Djfabrizia\Content\Models\Mix;
use Djfabrizia\Content\Models\Page;
use Djfabrizia\Content\Models\Release;

/**
 * Loads everything the blocks of one or more pages point at, with one query
 * per kind of content, so rendering a page never triggers per-block queries.
 *
 * Unpublished mixes and releases resolve to null (and are skipped by the
 * renderers) unless drafts are asked for, as in back office previews.
 */
class BlockHydrator
{
    /**
     * @param  Page|iterable<Page>  $pages
     */
    public function hydrate(Page|iterable $pages, bool $includeDrafts = false): HydratedReferences
    {
        $blocks = [];

        foreach ($pages instanceof Page ? [$pages] : $pages as $page) {
            array_push($blocks, ...$page->blocks);
        }

        $ids = BlockReferences::collect($blocks);

        return new HydratedReferences(
            media: $ids[ReferenceKind::Media->value] === []
                ? collect()
                : Media::query()->whereKey($ids[ReferenceKind::Media->value])->get()->keyBy('id'),
            mixes: $ids[ReferenceKind::Mixes->value] === []
                ? collect()
                : Mix::query()->whereKey($ids[ReferenceKind::Mixes->value])->when(! $includeDrafts, fn ($query) => $query->published())->get()->keyBy('id'),
            releases: $ids[ReferenceKind::Releases->value] === []
                ? collect()
                : Release::query()
                    ->when(! $includeDrafts, fn ($query) => $query->published())
                    ->with(['coverMedia', 'trackMedia', 'recordLabel', 'links'])
                    ->whereKey($ids[ReferenceKind::Releases->value])
                    ->get()
                    ->keyBy('id'),
        );
    }
}
