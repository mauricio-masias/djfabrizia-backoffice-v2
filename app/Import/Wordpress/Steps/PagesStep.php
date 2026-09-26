<?php

namespace App\Import\Wordpress\Steps;

use App\Import\Wordpress\ImportContext;
use App\Import\Wordpress\Pages\PageBlocksBuilder;
use App\Import\Wordpress\Publishing;
use Djfabrizia\Content\Blocks\BlockValidator;
use Djfabrizia\Content\Legacy\WordpressPages;
use Djfabrizia\Content\Models\Page;
use Illuminate\Validation\ValidationException;

/**
 * The twelve WordPress pages → pages with blocks. Every page is validated
 * against its template before it is written.
 */
class PagesStep implements ImportStep
{
    public function __construct(
        private readonly PageBlocksBuilder $builder,
        private readonly BlockValidator $validator,
    ) {}

    public function name(): string
    {
        return 'pages';
    }

    public function run(ImportContext $context): void
    {
        foreach (WordpressPages::all() as $wordpressId => $definition) {
            $post = $context->source->post($wordpressId);

            if ($post === null) {
                $context->skipped($this->name(), "WordPress page {$wordpressId} ({$definition['slug']}) not found");

                continue;
            }

            $blocks = $this->builder->build($definition['template'], $context->source->meta($wordpressId), $post, $context);

            try {
                $blocks = $this->validator->validate($definition['template'], $blocks);
            } catch (ValidationException $exception) {
                $context->skipped($this->name(), "{$definition['slug']}: ".json_encode($exception->errors()));

                continue;
            }

            $page = Page::query()->updateOrCreate(['slug' => $definition['slug']], [
                'title' => $definition['title'],
                'template' => $definition['template'],
                'locale' => $definition['locale'],
                'blocks' => $blocks,
                'legacy_wp_id' => $wordpressId,
                ...Publishing::of($post),
            ]);

            $context->saved($this->name(), $page);
        }
    }
}
