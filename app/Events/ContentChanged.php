<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;

/**
 * Content changed in a way the public API has cached: carries the endpoint
 * cache topics to rebuild (e.g. "mixes", "pages:home").
 */
final class ContentChanged
{
    use Dispatchable;

    /**
     * @param  list<string>  $topics
     */
    public function __construct(public readonly array $topics) {}
}
