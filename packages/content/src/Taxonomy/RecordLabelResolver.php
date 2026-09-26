<?php

namespace Djfabrizia\Content\Taxonomy;

use Djfabrizia\Content\Models\RecordLabel;
use Illuminate\Support\Str;

/**
 * Maps a free-text record label name to a RecordLabel row, matching by slug
 * (case and spacing insensitive) and creating the label when it is new.
 * Near-duplicates such as "On circle" and "On Circle Music" stay separate;
 * editors merge them in the back office.
 */
class RecordLabelResolver
{
    /** @var array<string, RecordLabel>|null */
    private ?array $index = null;

    public function resolve(string $name): ?RecordLabel
    {
        $name = trim(preg_replace('/\s+/u', ' ', $name) ?? '');
        $slug = Str::slug($name);

        if ($slug === '') {
            return null;
        }

        if ($this->index === null) {
            $this->index = RecordLabel::query()->get()->keyBy('slug')->all();
        }

        return $this->index[$slug] ??= RecordLabel::query()->create([
            'name' => $name,
            'slug' => $slug,
        ]);
    }
}
