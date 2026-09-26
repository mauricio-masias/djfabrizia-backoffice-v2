<?php

namespace Djfabrizia\Content\Exceptions;

use RuntimeException;

/**
 * Thrown when deleting content that a page block still points at. Page blocks
 * are JSON, so the database cannot enforce these references itself.
 */
class ReferencedContentException extends RuntimeException
{
    /**
     * @param  list<string>  $pageSlugs
     */
    public static function usedBy(string $what, array $pageSlugs): self
    {
        return new self(sprintf('%s is used on page(s): %s. Remove it from those pages first.', $what, implode(', ', $pageSlugs)));
    }
}
