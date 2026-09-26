<?php declare(strict_types = 1);

// odsl-/var/www/packages/content/src/Enums/PageTemplate.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Djfabrizia\Content\Enums\PageTemplate
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.73.0.5-8.4.26-4ba90ee78f51997d0fcb7961c29ce1547d527d92460208f5391f3ad8e49cd0a8',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'filename' => '/var/www/packages/content/src/Enums/PageTemplate.php',
      ),
    ),
    'namespace' => 'Djfabrizia\\Content\\Enums',
    'name' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
    'shortName' => 'PageTemplate',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => true,
    'isBackedEnum' => true,
    'modifiers' => 0,
    'docComment' => '/**
 * Page templates. A template decides which blocks the page builder offers and
 * the skeleton a new page starts with. EPK variants are independent pages: the
 * EN and IT pages of one template share the allowed blocks, never the content.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 13,
    'endLine' => 181,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
      0 => 'Djfabrizia\\Content\\Concerns\\HasLabel',
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'name' => 
      array (
        'declaringClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'implementingClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'name' => 'name',
        'modifiers' => 2177,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => NULL,
        'endLine' => NULL,
        'startColumn' => -1,
        'endColumn' => -1,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'value' => 
      array (
        'declaringClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'implementingClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'name' => 'value',
        'modifiers' => 2177,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => NULL,
        'endLine' => NULL,
        'startColumn' => -1,
        'endColumn' => -1,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
    ),
    'immediateMethods' => 
    array (
      'isEpk' => 
      array (
        'name' => 'isEpk',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 27,
        'endLine' => 30,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Djfabrizia\\Content\\Enums',
        'declaringClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'implementingClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'currentClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'aliasName' => NULL,
      ),
      'epkVariant' => 
      array (
        'name' => 'epkVariant',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
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
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * The EPK variant name used in URLs (/epk/{locale}/{variant}), or null.
 */',
        'startLine' => 35,
        'endLine' => 43,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Djfabrizia\\Content\\Enums',
        'declaringClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'implementingClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'currentClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'aliasName' => NULL,
      ),
      'allowedBlocks' => 
      array (
        'name' => 'allowedBlocks',
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
 * @return list<BlockType>
 */',
        'startLine' => 48,
        'endLine' => 103,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Djfabrizia\\Content\\Enums',
        'declaringClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'implementingClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'currentClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'aliasName' => NULL,
      ),
      'allows' => 
      array (
        'name' => 'allows',
        'parameters' => 
        array (
          'type' => 
          array (
            'name' => 'type',
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
            'startLine' => 105,
            'endLine' => 105,
            'startColumn' => 28,
            'endColumn' => 42,
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
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 105,
        'endLine' => 108,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Djfabrizia\\Content\\Enums',
        'declaringClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'implementingClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'currentClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'aliasName' => NULL,
      ),
      'skeleton' => 
      array (
        'name' => 'skeleton',
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
 * Blocks a new page of this template starts with, in display order.
 *
 * @return list<array{type: string, data: array<string, mixed>}>
 */',
        'startLine' => 115,
        'endLine' => 180,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Djfabrizia\\Content\\Enums',
        'declaringClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'implementingClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'currentClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'aliasName' => NULL,
      ),
      'cases' => 
      array (
        'name' => 'cases',
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
        'docComment' => NULL,
        'startLine' => NULL,
        'endLine' => NULL,
        'startColumn' => -1,
        'endColumn' => -1,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Djfabrizia\\Content\\Enums',
        'declaringClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'implementingClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'currentClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'aliasName' => NULL,
      ),
      'from' => 
      array (
        'name' => 'from',
        'parameters' => 
        array (
          'value' => 
          array (
            'name' => 'value',
            'default' => NULL,
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
                      'name' => 'int',
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
            'startLine' => NULL,
            'endLine' => NULL,
            'startColumn' => -1,
            'endColumn' => -1,
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
            'name' => 'static',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => NULL,
        'endLine' => NULL,
        'startColumn' => -1,
        'endColumn' => -1,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Djfabrizia\\Content\\Enums',
        'declaringClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'implementingClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'currentClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'aliasName' => NULL,
      ),
      'tryFrom' => 
      array (
        'name' => 'tryFrom',
        'parameters' => 
        array (
          'value' => 
          array (
            'name' => 'value',
            'default' => NULL,
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
                      'name' => 'int',
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
            'startLine' => NULL,
            'endLine' => NULL,
            'startColumn' => -1,
            'endColumn' => -1,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
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
                  'name' => 'static',
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
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => NULL,
        'endLine' => NULL,
        'startColumn' => -1,
        'endColumn' => -1,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Djfabrizia\\Content\\Enums',
        'declaringClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'implementingClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
        'currentClassName' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
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
    'backingType' => 
    array (
      'name' => 'string',
      'isIdentifier' => true,
    ),
    'cases' => 
    array (
      'Home' => 
      array (
        'name' => 'Home',
        'value' => 
        array (
          'code' => '\'home\'',
          'attributes' => 
          array (
            'startLine' => 17,
            'endLine' => 17,
            'startTokenPos' => 39,
            'startFilePos' => 438,
            'endTokenPos' => 39,
            'endFilePos' => 443,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 17,
        'endLine' => 17,
        'startColumn' => 5,
        'endColumn' => 23,
      ),
      'Bio' => 
      array (
        'name' => 'Bio',
        'value' => 
        array (
          'code' => '\'bio\'',
          'attributes' => 
          array (
            'startLine' => 18,
            'endLine' => 18,
            'startTokenPos' => 48,
            'startFilePos' => 461,
            'endTokenPos' => 48,
            'endFilePos' => 465,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 18,
        'endLine' => 18,
        'startColumn' => 5,
        'endColumn' => 21,
      ),
      'Social' => 
      array (
        'name' => 'Social',
        'value' => 
        array (
          'code' => '\'social\'',
          'attributes' => 
          array (
            'startLine' => 19,
            'endLine' => 19,
            'startTokenPos' => 57,
            'startFilePos' => 486,
            'endTokenPos' => 57,
            'endFilePos' => 493,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 19,
        'endLine' => 19,
        'startColumn' => 5,
        'endColumn' => 27,
      ),
      'Videos' => 
      array (
        'name' => 'Videos',
        'value' => 
        array (
          'code' => '\'videos\'',
          'attributes' => 
          array (
            'startLine' => 20,
            'endLine' => 20,
            'startTokenPos' => 66,
            'startFilePos' => 514,
            'endTokenPos' => 66,
            'endFilePos' => 521,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 20,
        'endLine' => 20,
        'startColumn' => 5,
        'endColumn' => 27,
      ),
      'Linktree' => 
      array (
        'name' => 'Linktree',
        'value' => 
        array (
          'code' => '\'linktree\'',
          'attributes' => 
          array (
            'startLine' => 21,
            'endLine' => 21,
            'startTokenPos' => 75,
            'startFilePos' => 544,
            'endTokenPos' => 75,
            'endFilePos' => 553,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 21,
        'endLine' => 21,
        'startColumn' => 5,
        'endColumn' => 31,
      ),
      'Legal' => 
      array (
        'name' => 'Legal',
        'value' => 
        array (
          'code' => '\'legal\'',
          'attributes' => 
          array (
            'startLine' => 22,
            'endLine' => 22,
            'startTokenPos' => 84,
            'startFilePos' => 573,
            'endTokenPos' => 84,
            'endFilePos' => 579,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 22,
        'endLine' => 22,
        'startColumn' => 5,
        'endColumn' => 25,
      ),
      'EpkDefault' => 
      array (
        'name' => 'EpkDefault',
        'value' => 
        array (
          'code' => '\'epk_default\'',
          'attributes' => 
          array (
            'startLine' => 23,
            'endLine' => 23,
            'startTokenPos' => 93,
            'startFilePos' => 604,
            'endTokenPos' => 93,
            'endFilePos' => 616,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 23,
        'endLine' => 23,
        'startColumn' => 5,
        'endColumn' => 36,
      ),
      'EpkSpecial' => 
      array (
        'name' => 'EpkSpecial',
        'value' => 
        array (
          'code' => '\'epk_special\'',
          'attributes' => 
          array (
            'startLine' => 24,
            'endLine' => 24,
            'startTokenPos' => 102,
            'startFilePos' => 641,
            'endTokenPos' => 102,
            'endFilePos' => 653,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 24,
        'endLine' => 24,
        'startColumn' => 5,
        'endColumn' => 36,
      ),
      'EpkUnderground' => 
      array (
        'name' => 'EpkUnderground',
        'value' => 
        array (
          'code' => '\'epk_underground\'',
          'attributes' => 
          array (
            'startLine' => 25,
            'endLine' => 25,
            'startTokenPos' => 111,
            'startFilePos' => 682,
            'endTokenPos' => 111,
            'endFilePos' => 698,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 25,
        'endLine' => 25,
        'startColumn' => 5,
        'endColumn' => 44,
      ),
    ),
  ),
));