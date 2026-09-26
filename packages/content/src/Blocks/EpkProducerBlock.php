<?php

namespace Djfabrizia\Content\Blocks;

/**
 * Underground EPK producer section: a title, optional text, and groups of
 * tracks (e.g. "Previous releases", "Unreleased edits").
 */
final class EpkProducerBlock extends Block
{
    public function rules(): array
    {
        return [
            'title' => self::LINE,
            'text' => self::TEXT,
            'groups' => ['array'],
            'groups.*.title' => self::LINE,
            'groups.*.items' => ['array'],
            'groups.*.items.*.label' => self::LINE,
            'groups.*.items.*.url' => self::URL,
            'groups.*.items.*.image_url' => self::URL,
        ];
    }

    public function defaults(): array
    {
        return ['title' => null, 'text' => null, 'groups' => []];
    }
}
