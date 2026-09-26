<?php

namespace Djfabrizia\Content\Blocks;

use Djfabrizia\Content\Models\Media;
use Djfabrizia\Content\Models\Mix;
use Djfabrizia\Content\Models\Release;
use Illuminate\Support\Collection;

/**
 * Content referenced by page blocks, keyed by ID. A missing ID (deleted or
 * never existed) resolves to null and the caller skips it.
 */
final readonly class HydratedReferences
{
    /**
     * @param  Collection<int, Media>  $media
     * @param  Collection<int, Mix>  $mixes
     * @param  Collection<int, Release>  $releases
     */
    public function __construct(
        private Collection $media,
        private Collection $mixes,
        private Collection $releases,
    ) {}

    public function media(mixed $id): ?Media
    {
        return is_numeric($id) ? $this->media->get((int) $id) : null;
    }

    public function mix(mixed $id): ?Mix
    {
        return is_numeric($id) ? $this->mixes->get((int) $id) : null;
    }

    public function release(mixed $id): ?Release
    {
        return is_numeric($id) ? $this->releases->get((int) $id) : null;
    }
}
