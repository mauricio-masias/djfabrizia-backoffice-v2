<?php

namespace Djfabrizia\Content\Blocks;

/**
 * Collects the IDs that blocks point at, grouped by {@see ReferenceKind}.
 */
final class BlockReferences
{
    /**
     * @param  iterable<array{type?: mixed, data?: mixed}>  $blocks
     * @return array<value-of<ReferenceKind>, list<int>>
     */
    public static function collect(iterable $blocks): array
    {
        $ids = [];

        foreach (ReferenceKind::cases() as $kind) {
            $ids[$kind->value] = [];
        }

        foreach ($blocks as $block) {
            $type = is_string($block['type'] ?? null) ? BlockType::tryFrom($block['type']) : null;
            $data = is_array($block['data'] ?? null) ? $block['data'] : [];

            if ($type === null) {
                continue;
            }

            foreach ($type->definition()->references() as $kind => $paths) {
                foreach ($paths as $path) {
                    foreach ((array) data_get($data, $path) as $value) {
                        if (is_numeric($value) && (int) $value > 0) {
                            $ids[$kind][] = (int) $value;
                        }
                    }
                }
            }
        }

        return array_map(static fn (array $list): array => array_values(array_unique($list)), $ids);
    }
}
