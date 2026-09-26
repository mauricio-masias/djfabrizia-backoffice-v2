<?php

namespace Djfabrizia\Content\Legacy;

use Djfabrizia\Content\Enums\PageLocale;
use Djfabrizia\Content\Enums\PageTemplate;

/**
 * The WordPress pages the old back office used, and the page each one became.
 *
 * Used by the reference seeder (to create the pages), the importer (to map WP
 * meta onto them) and the endpoint (v1 URLs still carry WordPress page IDs).
 */
final class WordpressPages
{
    /**
     * @var array<int, array{slug: string, title: string, template: PageTemplate, locale: PageLocale}>
     */
    private const PAGES = [
        952 => ['slug' => 'home', 'title' => 'Homepage', 'template' => PageTemplate::Home, 'locale' => PageLocale::English],
        7 => ['slug' => 'bio', 'title' => 'Bio', 'template' => PageTemplate::Bio, 'locale' => PageLocale::English],
        967 => ['slug' => 'social', 'title' => 'Social', 'template' => PageTemplate::Social, 'locale' => PageLocale::English],
        39 => ['slug' => 'videos', 'title' => 'Videos', 'template' => PageTemplate::Videos, 'locale' => PageLocale::English],
        1347 => ['slug' => 'linktree', 'title' => 'Linktree', 'template' => PageTemplate::Linktree, 'locale' => PageLocale::English],
        3 => ['slug' => 'privacy-policy', 'title' => 'Privacy Policy', 'template' => PageTemplate::Legal, 'locale' => PageLocale::English],
        1452 => ['slug' => 'epk-en', 'title' => 'EPK EN', 'template' => PageTemplate::EpkDefault, 'locale' => PageLocale::English],
        1565 => ['slug' => 'epk-it', 'title' => 'EPK IT', 'template' => PageTemplate::EpkDefault, 'locale' => PageLocale::Italian],
        1606 => ['slug' => 'epk-en-special', 'title' => 'EPK EN Special', 'template' => PageTemplate::EpkSpecial, 'locale' => PageLocale::English],
        1608 => ['slug' => 'epk-it-special', 'title' => 'EPK IT Special', 'template' => PageTemplate::EpkSpecial, 'locale' => PageLocale::Italian],
        1707 => ['slug' => 'epk-en-underground', 'title' => 'EPK EN Underground', 'template' => PageTemplate::EpkUnderground, 'locale' => PageLocale::English],
        1709 => ['slug' => 'epk-it-underground', 'title' => 'EPK IT Underground', 'template' => PageTemplate::EpkUnderground, 'locale' => PageLocale::Italian],
    ];

    /**
     * WordPress nav_menu term_taxonomy_id => menu slug.
     *
     * @var array<int, string>
     */
    public const MENUS = [
        2 => 'main',
        3 => 'footer',
        4 => 'mobile',
    ];

    /**
     * @return array<int, array{slug: string, title: string, template: PageTemplate, locale: PageLocale}>
     */
    public static function all(): array
    {
        return self::PAGES;
    }

    public static function slugFor(int $wordpressId): ?string
    {
        return self::PAGES[$wordpressId]['slug'] ?? null;
    }

    /**
     * WordPress page IDs of the EPK pages, in the order v1 serves them.
     *
     * @return list<int>
     */
    public static function epkIds(): array
    {
        $ids = [];

        foreach (self::PAGES as $id => $page) {
            if ($page['template']->isEpk()) {
                $ids[] = $id;
            }
        }

        return $ids;
    }
}
