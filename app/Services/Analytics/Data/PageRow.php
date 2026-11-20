<?php

namespace App\Services\Analytics\Data;

use Illuminate\Support\Str;

/**
 * A page of the public site with its traffic for a period.
 *
 * The site is a single-page app that never changes the document title, so
 * GA4's pageTitle is the same for every route. The label is derived from the
 * path instead.
 */
final readonly class PageRow
{
    public const string HOME_LABEL = 'Home';

    public function __construct(
        public string $path,
        public int $views,
        public int $visitors,
    ) {}

    /**
     * Strips the query string and fragment, and any trailing slash, so
     * "/mixes/", "/mixes?utm_source=x" and "/mixes#top" are one page. An
     * empty path is the homepage.
     */
    public static function normalisePath(string $path): string
    {
        $path = (string) preg_replace('/[?#].*$/', '', trim($path));
        $path = rtrim($path, '/');

        if ($path === '') {
            return '/';
        }

        return str_starts_with($path, '/') ? $path : '/'.$path;
    }

    /**
     * Normalises paths, merges rows that land on the same path, drops pages
     * without views and sorts by views, most viewed first.
     *
     * Visitors are summed when rows merge. GA4 counts a visitor once per row,
     * so a merged figure can overcount someone who reached the same page by
     * two spellings; views are exact.
     *
     * @param  iterable<PageRow>  $rows
     * @return list<PageRow>
     */
    public static function consolidate(iterable $rows, int $limit): array
    {
        /** @var array<string, array{views: int, visitors: int}> $byPath */
        $byPath = [];

        foreach ($rows as $row) {
            $path = self::normalisePath($row->path);
            $totals = $byPath[$path] ?? ['views' => 0, 'visitors' => 0];

            $byPath[$path] = [
                'views' => $totals['views'] + $row->views,
                'visitors' => $totals['visitors'] + $row->visitors,
            ];
        }

        $pages = [];

        foreach ($byPath as $path => $totals) {
            if ($totals['views'] > 0) {
                $pages[] = new self((string) $path, $totals['views'], $totals['visitors']);
            }
        }

        usort($pages, fn (self $a, self $b): int => [$b->views, $a->path] <=> [$a->views, $b->path]);

        return array_slice($pages, 0, max($limit, 0));
    }

    /**
     * @return array<string, string|int>
     */
    public function toArray(): array
    {
        return [
            'path' => $this->path,
            'views' => $this->views,
            'visitors' => $this->visitors,
        ];
    }

    /**
     * @param  array<string, string|int>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            path: (string) ($data['path'] ?? '/'),
            views: (int) ($data['views'] ?? 0),
            visitors: (int) ($data['visitors'] ?? 0),
        );
    }

    public function isHome(): bool
    {
        return self::normalisePath($this->path) === '/';
    }

    /**
     * "Home" for the root, otherwise the last path segment made readable:
     * "/uk-gigs" reads "Uk gigs", "/mixes/summer-set" reads "Summer set".
     */
    public function label(): string
    {
        if ($this->isHome()) {
            return self::HOME_LABEL;
        }

        $segment = Str::afterLast(self::normalisePath($this->path), '/');

        return Str::ucfirst(str_replace(['-', '_'], ' ', urldecode($segment)));
    }
}
