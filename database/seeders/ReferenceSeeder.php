<?php

namespace Database\Seeders;

use Djfabrizia\Content\Enums\PublishStatus;
use Djfabrizia\Content\Legacy\WordpressPages;
use Djfabrizia\Content\Models\Menu;
use Djfabrizia\Content\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * The skeleton every environment needs: the three menus and one page per
 * former WordPress page, each starting from its template's default blocks.
 *
 * Idempotent and non-destructive: existing rows are left untouched, so it is
 * safe to run after editors have changed content.
 */
class ReferenceSeeder extends Seeder
{
    public function run(): void
    {
        foreach (WordpressPages::MENUS as $wordpressId => $slug) {
            Menu::query()->firstOrCreate(
                ['slug' => $slug],
                ['name' => Str::headline($slug).' menu', 'legacy_wp_id' => $wordpressId],
            );
        }

        foreach (WordpressPages::all() as $wordpressId => $page) {
            Page::query()->firstOrCreate(
                ['slug' => $page['slug']],
                [
                    'title' => $page['title'],
                    'template' => $page['template'],
                    'locale' => $page['locale'],
                    'status' => PublishStatus::Draft,
                    'blocks' => $page['template']->skeleton(),
                    'legacy_wp_id' => $wordpressId,
                ],
            );
        }
    }
}
