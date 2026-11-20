<?php

namespace Tests\Unit;

use App\Services\Analytics\Data\PageRow;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class AnalyticsPageRowTest extends TestCase
{
    /**
     * @return array<string, array{string, string}>
     */
    public static function paths(): array
    {
        return [
            'root' => ['/', '/'],
            'empty' => ['', '/'],
            'query string' => ['/mixes?utm_source=instagram', '/mixes'],
            'fragment' => ['/contact-me#form', '/contact-me'],
            'trailing slash' => ['/mixes/', '/mixes'],
            'trailing slash and query' => ['/mixes/?a=1#b', '/mixes'],
            'root with query' => ['/?fbclid=abc', '/'],
            'missing leading slash' => ['bio', '/bio'],
            'nested' => ['/mixes/summer-set/', '/mixes/summer-set'],
        ];
    }

    #[DataProvider('paths')]
    public function test_paths_are_normalised(string $raw, string $expected): void
    {
        $this->assertSame($expected, PageRow::normalisePath($raw));
    }

    public function test_the_homepage_is_labelled_home(): void
    {
        $this->assertSame('Home', (new PageRow('/', 1, 1))->label());
        $this->assertSame('Home', (new PageRow('', 1, 1))->label());
        $this->assertTrue((new PageRow('/?x=1', 1, 1))->isHome());
    }

    public function test_other_pages_are_labelled_from_their_last_segment(): void
    {
        $this->assertSame('Uk gigs', (new PageRow('/uk-gigs', 1, 1))->label());
        $this->assertSame('Summer set', (new PageRow('/mixes/summer-set/', 1, 1))->label());
    }

    public function test_consolidate_merges_spellings_of_the_same_page(): void
    {
        $pages = PageRow::consolidate([
            new PageRow('/mixes', 10, 4),
            new PageRow('/mixes/', 3, 2),
            new PageRow('/mixes?utm_source=x', 2, 1),
            new PageRow('', 1, 1),
            new PageRow('/', 5, 3),
        ], 20);

        $this->assertEquals([
            new PageRow('/mixes', 15, 7),
            new PageRow('/', 6, 4),
        ], $pages);
    }

    public function test_consolidate_drops_pages_without_views(): void
    {
        $pages = PageRow::consolidate([
            new PageRow('/', 3, 2),
            new PageRow('/privacy-policy', 0, 1),
        ], 20);

        $this->assertSame(['/'], array_map(fn (PageRow $page): string => $page->path, $pages));
    }

    public function test_consolidate_sorts_by_views_and_applies_the_limit_after_merging(): void
    {
        $pages = PageRow::consolidate([
            new PageRow('/bio', 4, 1),
            new PageRow('/mixes', 3, 1),
            new PageRow('/mixes/', 3, 1),
            new PageRow('/videos', 5, 1),
        ], 2);

        $this->assertSame(['/mixes', '/videos'], array_map(fn (PageRow $page): string => $page->path, $pages));
    }

    public function test_survives_an_array_round_trip(): void
    {
        $row = new PageRow('/mixes', 12, 7);

        $this->assertEquals($row, PageRow::fromArray($row->toArray()));
    }
}
