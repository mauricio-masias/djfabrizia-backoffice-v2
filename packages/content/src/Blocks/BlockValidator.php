<?php

namespace Djfabrizia\Content\Blocks;

use Djfabrizia\Content\Enums\PageTemplate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Validates a page's blocks against its template: every block must be a type
 * the template allows, and its data must pass that block's rules.
 */
class BlockValidator
{
    /**
     * @param  array<array-key, mixed>  $blocks
     * @return list<array{type: string, data: array<string, mixed>}>
     *
     * @throws ValidationException
     */
    public function validate(PageTemplate $template, array $blocks, string $attribute = 'blocks'): array
    {
        $allowed = array_map(static fn (BlockType $type): string => $type->value, $template->allowedBlocks());

        $shape = Validator::make([$attribute => $blocks], [
            $attribute => ['present', 'array', 'list'],
            "{$attribute}.*" => ['array:type,data'],
            "{$attribute}.*.type" => ['required', 'string', 'in:'.implode(',', $allowed)],
            "{$attribute}.*.data" => ['present', 'array'],
        ]);

        $shape->validate();

        $rules = [];

        foreach (array_values($blocks) as $index => $block) {
            foreach (BlockType::from($block['type'])->definition()->rules() as $path => $pathRules) {
                $rules["{$attribute}.{$index}.data.{$path}"] = $pathRules;
            }
        }

        $validated = Validator::make([$attribute => $blocks], $rules)->validate();

        return array_map(
            static fn (array $block, int $index): array => [
                'type' => $block['type'],
                'data' => $validated[$attribute][$index]['data'] ?? [],
            ],
            array_values($blocks),
            array_keys(array_values($blocks)),
        );
    }
}
