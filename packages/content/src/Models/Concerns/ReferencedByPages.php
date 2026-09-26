<?php

namespace Djfabrizia\Content\Models\Concerns;

use Djfabrizia\Content\Blocks\BlockReferences;
use Djfabrizia\Content\Blocks\ReferenceKind;
use Djfabrizia\Content\Exceptions\ReferencedContentException;
use Djfabrizia\Content\Models\Page;

/**
 * Refuses to delete a row that a page block still references by ID.
 */
trait ReferencedByPages
{
    abstract public static function referenceKind(): ReferenceKind;

    public static function bootReferencedByPages(): void
    {
        static::deleting(function (self $model): void {
            $slugs = $model->referencingPageSlugs();

            if ($slugs !== []) {
                throw ReferencedContentException::usedBy(class_basename($model).' #'.$model->getKey(), $slugs);
            }
        });
    }

    /**
     * Slugs of the pages whose blocks reference this row.
     *
     * @return list<string>
     */
    public function referencingPageSlugs(): array
    {
        $kind = static::referenceKind()->value;
        $slugs = [];

        foreach (Page::query()->select(['id', 'slug', 'blocks'])->cursor() as $page) {
            if (in_array((int) $this->getKey(), BlockReferences::collect($page->blocks)[$kind], true)) {
                $slugs[] = $page->slug;
            }
        }

        return $slugs;
    }
}
