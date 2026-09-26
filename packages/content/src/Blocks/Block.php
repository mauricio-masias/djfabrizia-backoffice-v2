<?php

namespace Djfabrizia\Content\Blocks;

/**
 * Definition of one page block type: how its data is validated, what an empty
 * block looks like, and which fields reference other content.
 *
 * A stored block has the Filament Builder shape: ['type' => string, 'data' => array].
 */
abstract class Block
{
    protected const TEXT = ['nullable', 'string'];

    protected const LINE = ['nullable', 'string', 'max:255'];

    protected const URL = ['nullable', 'string', 'max:512'];

    protected const ID = ['nullable', 'integer', 'min:1'];

    /**
     * Validation rules for the block's data, keyed by dot path.
     *
     * @return array<string, list<mixed>>
     */
    abstract public function rules(): array;

    /**
     * Data for a new, empty block of this type.
     *
     * @return array<string, mixed>
     */
    public function defaults(): array
    {
        return [];
    }

    /**
     * Fields that reference other content, as kind => dot paths (with `*`
     * wildcards). Kinds are the keys of {@see ReferenceKind}.
     *
     * @return array<value-of<ReferenceKind>, list<string>>
     */
    public function references(): array
    {
        return [];
    }
}
