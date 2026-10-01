<?php

namespace Djfabrizia\Content\Legacy;

/**
 * The WordPress underground EPK kept its "producer" track lists as text in one
 * field: a <p>title</p> followed by a JSON array, repeated, e.g.
 *
 *     <p>Previous releases</p>
 *     [{"url":"…", "img":"…", "label":"…"},
 *     {"url":"…", "img":"…", "label":"…"}
 *     ]
 *
 * The back office stores real groups instead; this class converts between the
 * two (the importer parses, the v1 endpoint formats).
 */
final class ProducerListFormat
{
    private const GROUP_PATTERN = '/<p>(.*?)<\/p>\s*(\[[\s\S]*?\])/';

    /**
     * @return list<array{title: string, items: list<array{label: string|null, url: string|null, image_url: string|null}>}>
     */
    public static function parse(?string $text): array
    {
        if ($text === null || preg_match_all(self::GROUP_PATTERN, $text, $matches, PREG_SET_ORDER) === 0) {
            return [];
        }

        $groups = [];

        foreach ($matches as $match) {
            $items = json_decode($match[2], true);

            if (! is_array($items)) {
                continue;
            }

            $groups[] = [
                'title' => $match[1],
                'items' => array_values(array_map(static fn (array $item): array => [
                    'label' => is_string($item['label'] ?? null) ? $item['label'] : null,
                    'url' => is_string($item['url'] ?? null) ? $item['url'] : null,
                    'image_url' => is_string($item['img'] ?? null) ? $item['img'] : null,
                ], array_filter($items, 'is_array'))),
            ];
        }

        return $groups;
    }

    /**
     * @param  array<array-key, mixed>  $groups
     */
    public static function format(array $groups): string
    {
        $blocks = [];

        foreach ($groups as $group) {
            if (! is_array($group)) {
                continue;
            }

            $items = array_map(static fn (mixed $item): string => sprintf(
                '{"url":%s, "img":%s, "label":%s}',
                self::json(is_array($item) ? ($item['url'] ?? null) : null),
                self::json(is_array($item) ? ($item['image_url'] ?? null) : null),
                self::json(is_array($item) ? ($item['label'] ?? null) : null),
            ), is_array($group['items'] ?? null) ? array_values($group['items']) : []);

            $blocks[] = '<p>'.($group['title'] ?? '')."</p>\r\n[".implode(",\r\n", $items)."\r\n]";
        }

        // WordPress stored the text with Windows line endings.
        return implode("\r\n", $blocks);
    }

    private static function json(mixed $value): string
    {
        return (string) json_encode($value, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}
