<?php

namespace Djfabrizia\Content\Blocks;

/**
 * Kinds of content a block field can point at by ID.
 */
enum ReferenceKind: string
{
    case Media = 'media';
    case Mixes = 'mixes';
    case Releases = 'releases';
}
