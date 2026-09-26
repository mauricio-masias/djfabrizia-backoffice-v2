<?php declare(strict_types = 1);

// odsl-/var/www/packages/content/src/Legacy/EpkLegacyMap.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Djfabrizia\Content\Legacy\EpkLegacyMap
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.73.0.5-8.4.26-ad529e71c586f35cd8d2c15ad1fc26070beda689a4f49576d9d83c320f0dd229',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'filename' => '/var/www/packages/content/src/Legacy/EpkLegacyMap.php',
      ),
    ),
    'namespace' => 'Djfabrizia\\Content\\Legacy',
    'name' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
    'shortName' => 'EpkLegacyMap',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Where each field of the legacy v1 EPK payload lives in the page blocks.
 *
 * The WordPress EPK pages all shared one generic ACF schema; the special and
 * underground frontends reuse some generic fields for other sections (see
 * CMS_PLAN.md Appendix B). This map is used in both directions: the importer
 * turns WordPress meta into blocks, and the endpoint\'s v1 rebuilds the legacy
 * payload from blocks, so the two can never drift apart.
 *
 * Kinds:
 *  - text:       plain value
 *  - media:      one media ID (legacy payload: the file path)
 *  - media_list: list of media IDs (legacy payload: list of paths)
 *  - list:       list of strings
 *  - videos:     list of {label, alt, url, image_media_id} (legacy: {label, alt, url, img})
 *  - mixes:      list of {label, mix_id} (legacy: {label, url, img})
 *
 * A legacy field with no entry for a template is not imported for that
 * template (its frontend never reads it); v1 returns null for it.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 28,
    'endLine' => 204,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'for' => 
      array (
        'name' => 'for',
        'parameters' => 
        array (
          'template' => 
          array (
            'name' => 'template',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 33,
            'endLine' => 33,
            'startColumn' => 32,
            'endColumn' => 53,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @return list<array{legacy: string, block: BlockType, role: string|null, field: string, kind: string}>
 */',
        'startLine' => 33,
        'endLine' => 69,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Djfabrizia\\Content\\Legacy',
        'declaringClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'implementingClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'currentClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'aliasName' => NULL,
      ),
      'intro' => 
      array (
        'name' => 'intro',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @return list<array{legacy: string, block: BlockType, role: string|null, field: string, kind: string}>
 */',
        'startLine' => 74,
        'endLine' => 87,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 20,
        'namespace' => 'Djfabrizia\\Content\\Legacy',
        'declaringClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'implementingClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'currentClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'aliasName' => NULL,
      ),
      'reel' => 
      array (
        'name' => 'reel',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @return list<array{legacy: string, block: BlockType, role: string|null, field: string, kind: string}>
 */',
        'startLine' => 92,
        'endLine' => 102,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 20,
        'namespace' => 'Djfabrizia\\Content\\Legacy',
        'declaringClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'implementingClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'currentClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'aliasName' => NULL,
      ),
      'gallery' => 
      array (
        'name' => 'gallery',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @return list<array{legacy: string, block: BlockType, role: string|null, field: string, kind: string}>
 */',
        'startLine' => 107,
        'endLine' => 115,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 20,
        'namespace' => 'Djfabrizia\\Content\\Legacy',
        'declaringClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'implementingClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'currentClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'aliasName' => NULL,
      ),
      'idealFor' => 
      array (
        'name' => 'idealFor',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @return list<array{legacy: string, block: BlockType, role: string|null, field: string, kind: string}>
 */',
        'startLine' => 120,
        'endLine' => 126,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 20,
        'namespace' => 'Djfabrizia\\Content\\Legacy',
        'declaringClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'implementingClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'currentClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'aliasName' => NULL,
      ),
      'textSections' => 
      array (
        'name' => 'textSections',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @return list<array{legacy: string, block: BlockType, role: string|null, field: string, kind: string}>
 */',
        'startLine' => 131,
        'endLine' => 144,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 20,
        'namespace' => 'Djfabrizia\\Content\\Legacy',
        'declaringClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'implementingClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'currentClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'aliasName' => NULL,
      ),
      'offers' => 
      array (
        'name' => 'offers',
        'parameters' => 
        array (
          'offers' => 
          array (
            'name' => 'offers',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'array',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 150,
            'endLine' => 150,
            'startColumn' => 36,
            'endColumn' => 48,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @param  list<int>  $offers
 * @return list<array{legacy: string, block: BlockType, role: string|null, field: string, kind: string}>
 */',
        'startLine' => 150,
        'endLine' => 171,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 20,
        'namespace' => 'Djfabrizia\\Content\\Legacy',
        'declaringClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'implementingClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'currentClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'aliasName' => NULL,
      ),
      'videos' => 
      array (
        'name' => 'videos',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @return list<array{legacy: string, block: BlockType, role: string|null, field: string, kind: string}>
 */',
        'startLine' => 176,
        'endLine' => 184,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 20,
        'namespace' => 'Djfabrizia\\Content\\Legacy',
        'declaringClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'implementingClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'currentClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'aliasName' => NULL,
      ),
      'mixes' => 
      array (
        'name' => 'mixes',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @return list<array{legacy: string, block: BlockType, role: string|null, field: string, kind: string}>
 */',
        'startLine' => 189,
        'endLine' => 195,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 20,
        'namespace' => 'Djfabrizia\\Content\\Legacy',
        'declaringClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'implementingClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'currentClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'aliasName' => NULL,
      ),
      'entry' => 
      array (
        'name' => 'entry',
        'parameters' => 
        array (
          'legacy' => 
          array (
            'name' => 'legacy',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'string',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 200,
            'endLine' => 200,
            'startColumn' => 35,
            'endColumn' => 48,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'block' => 
          array (
            'name' => 'block',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Djfabrizia\\Content\\Blocks\\BlockType',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 200,
            'endLine' => 200,
            'startColumn' => 51,
            'endColumn' => 66,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'field' => 
          array (
            'name' => 'field',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'string',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 200,
            'endLine' => 200,
            'startColumn' => 69,
            'endColumn' => 81,
            'parameterIndex' => 2,
            'isOptional' => false,
          ),
          'role' => 
          array (
            'name' => 'role',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 200,
                'endLine' => 200,
                'startTokenPos' => 1591,
                'startFilePos' => 9609,
                'endTokenPos' => 1591,
                'endFilePos' => 9612,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionUnionType',
              'data' => 
              array (
                'types' => 
                array (
                  0 => 
                  array (
                    'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                    'data' => 
                    array (
                      'name' => 'string',
                      'isIdentifier' => true,
                    ),
                  ),
                  1 => 
                  array (
                    'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                    'data' => 
                    array (
                      'name' => 'null',
                      'isIdentifier' => true,
                    ),
                  ),
                ),
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 200,
            'endLine' => 200,
            'startColumn' => 84,
            'endColumn' => 103,
            'parameterIndex' => 3,
            'isOptional' => true,
          ),
          'kind' => 
          array (
            'name' => 'kind',
            'default' => 
            array (
              'code' => '\'text\'',
              'attributes' => 
              array (
                'startLine' => 200,
                'endLine' => 200,
                'startTokenPos' => 1600,
                'startFilePos' => 9630,
                'endTokenPos' => 1600,
                'endFilePos' => 9635,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'string',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 200,
            'endLine' => 200,
            'startColumn' => 106,
            'endColumn' => 126,
            'parameterIndex' => 4,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @return array{legacy: string, block: BlockType, role: string|null, field: string, kind: string}
 */',
        'startLine' => 200,
        'endLine' => 203,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 20,
        'namespace' => 'Djfabrizia\\Content\\Legacy',
        'declaringClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'implementingClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'currentClassName' => 'Djfabrizia\\Content\\Legacy\\EpkLegacyMap',
        'aliasName' => NULL,
      ),
    ),
    'traitsData' => 
    array (
      'aliases' => 
      array (
      ),
      'modifiers' => 
      array (
      ),
      'precedences' => 
      array (
      ),
      'hashes' => 
      array (
      ),
    ),
  ),
));