<?php

namespace App\Import\Wordpress;

/**
 * The postmeta of one WordPress post, in meta_id order, with helpers for the
 * flattened ACF repeater keys (`{field}` = count, `{field}_{i}_{sub}` = value).
 *
 * Every key is kept, including WordPress's own underscore keys such as
 * `_menu_item_url` and `_wp_attached_file`. ACF's "_{field}" reference rows are
 * kept too (harmless for lookups) but skipped by matching().
 */
final class Meta
{
    /** @var array<string, string> */
    private array $values = [];

    /**
     * @param  list<array{key: string, value: string}>  $rows
     */
    public function __construct(private readonly array $rows)
    {
        foreach ($rows as $row) {
            $this->values[$row['key']] ??= $row['value'];
        }
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->values);
    }

    public function get(string $key): ?string
    {
        return $this->values[$key] ?? null;
    }

    public function int(string $key): ?int
    {
        $value = $this->get($key);

        return is_numeric($value) ? (int) $value : null;
    }

    /**
     * Values of the rows whose key matches the pattern, in meta_id order.
     *
     * @return list<string>
     */
    public function matching(string $pattern): array
    {
        $values = [];

        foreach ($this->rows as $row) {
            if (! str_starts_with($row['key'], '_') && preg_match($pattern, $row['key']) === 1) {
                $values[] = $row['value'];
            }
        }

        return $values;
    }

    /**
     * Rows of an ACF repeater, e.g. repeater('social_icons', ['icon_link']).
     *
     * @param  list<string>  $fields
     * @return list<array<string, string|null>>
     */
    public function repeater(string $name, array $fields): array
    {
        $rows = [];
        $count = $this->int($name) ?? 0;

        for ($index = 0; $index < $count; $index++) {
            $row = [];

            foreach ($fields as $field) {
                $row[$field] = $this->get("{$name}_{$index}_{$field}");
            }

            $rows[] = $row;
        }

        return $rows;
    }

    /**
     * A PHP-serialized array value (ACF gallery, checkbox, taxonomy fields).
     * Objects are never instantiated.
     *
     * @return list<string>
     */
    public function serializedList(string $key): array
    {
        return self::unserializeList($this->get($key));
    }

    /**
     * @return list<string>
     */
    public static function unserializeList(?string $value): array
    {
        if ($value === null || $value === '') {
            return [];
        }

        $data = @unserialize($value, ['allowed_classes' => false]);

        return is_array($data) ? array_values(array_map('strval', array_filter($data, 'is_scalar'))) : [];
    }
}
