<?php

namespace App\Sync;

/**
 * What a provider returned: normalized items keyed by their upstream ID, and
 * whether the whole list was read (only then can missing items be flagged).
 */
final readonly class FetchResult
{
    /**
     * @param  array<string, array<string, mixed>>  $items
     */
    public function __construct(
        public array $items,
        public bool $complete,
        public ?string $warning = null,
    ) {}
}
