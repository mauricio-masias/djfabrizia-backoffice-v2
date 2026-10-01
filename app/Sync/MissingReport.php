<?php

namespace App\Sync;

/**
 * Outcome of reconciling items that are no longer upstream.
 */
final readonly class MissingReport
{
    /**
     * @param  list<string>  $kept  items that could not be deleted because pages use them
     */
    public function __construct(
        public int $deleted = 0,
        public array $kept = [],
    ) {}

    public function total(): int
    {
        return $this->deleted + count($this->kept);
    }
}
