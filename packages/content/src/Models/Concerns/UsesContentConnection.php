<?php

namespace Djfabrizia\Content\Models\Concerns;

/**
 * Reads the content tables through the connection configured in
 * `content.connection` (the endpoint's read-only "cms" connection), or the
 * application default when that is not set (the back office).
 */
trait UsesContentConnection
{
    public function getConnectionName(): ?string
    {
        $connection = config('content.connection');

        return is_string($connection) && $connection !== '' ? $connection : parent::getConnectionName();
    }
}
