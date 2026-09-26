<?php

namespace Djfabrizia\Content\Tests\Legacy;

use Djfabrizia\Content\Enums\PageLocale;
use Djfabrizia\Content\Enums\PageTemplate;
use Djfabrizia\Content\Legacy\WordpressPages;
use PHPUnit\Framework\TestCase;

class WordpressPagesTest extends TestCase
{
    public function test_the_six_epk_pages_are_independent_template_and_locale_pairs(): void
    {
        $pairs = [];

        foreach (WordpressPages::epkIds() as $id) {
            $page = WordpressPages::all()[$id];
            $pairs[] = $page['template']->value.':'.$page['locale']->value;
        }

        $this->assertSame([1452, 1565, 1606, 1608, 1707, 1709], WordpressPages::epkIds());
        $this->assertCount(6, array_unique($pairs));
    }

    public function test_it_maps_legacy_ids_to_slugs(): void
    {
        $this->assertSame('home', WordpressPages::slugFor(952));
        $this->assertSame('epk-it-underground', WordpressPages::slugFor(1709));
        $this->assertNull(WordpressPages::slugFor(26));
    }

    public function test_slugs_are_unique(): void
    {
        $slugs = array_column(WordpressPages::all(), 'slug');

        $this->assertSame($slugs, array_unique($slugs));
        $this->assertSame(PageTemplate::EpkSpecial, WordpressPages::all()[1608]['template']);
        $this->assertSame(PageLocale::Italian, WordpressPages::all()[1608]['locale']);
    }
}
