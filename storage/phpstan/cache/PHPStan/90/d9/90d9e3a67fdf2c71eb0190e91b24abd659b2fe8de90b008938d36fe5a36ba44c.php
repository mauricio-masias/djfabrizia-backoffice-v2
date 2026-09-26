<?php declare(strict_types = 1);

// odsl-/var/www/packages/content/src/Blocks/Block.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Djfabrizia\Content\Blocks\Block
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.73.0.5-8.4.26-bfc971a9ccddce75544b9b58750012cc825c30d51457775785f5b0062f51f754',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Djfabrizia\\Content\\Blocks\\Block',
        'filename' => '/var/www/packages/content/src/Blocks/Block.php',
      ),
    ),
    'namespace' => 'Djfabrizia\\Content\\Blocks',
    'name' => 'Djfabrizia\\Content\\Blocks\\Block',
    'shortName' => 'Block',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 64,
    'docComment' => '/**
 * Definition of one page block type: how its data is validated, what an empty
 * block looks like, and which fields reference other content.
 *
 * A stored block has the Filament Builder shape: [\'type\' => string, \'data\' => array].
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 11,
    'endLine' => 48,
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
      'TEXT' => 
      array (
        'declaringClassName' => 'Djfabrizia\\Content\\Blocks\\Block',
        'implementingClassName' => 'Djfabrizia\\Content\\Blocks\\Block',
        'name' => 'TEXT',
        'modifiers' => 2,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'nullable\', \'string\']',
          'attributes' => 
          array (
            'startLine' => 13,
            'endLine' => 13,
            'startTokenPos' => 25,
            'startFilePos' => 335,
            'endTokenPos' => 30,
            'endFilePos' => 356,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 13,
        'endLine' => 13,
        'startColumn' => 5,
        'endColumn' => 50,
      ),
      'LINE' => 
      array (
        'declaringClassName' => 'Djfabrizia\\Content\\Blocks\\Block',
        'implementingClassName' => 'Djfabrizia\\Content\\Blocks\\Block',
        'name' => 'LINE',
        'modifiers' => 2,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'nullable\', \'string\', \'max:255\']',
          'attributes' => 
          array (
            'startLine' => 15,
            'endLine' => 15,
            'startTokenPos' => 41,
            'startFilePos' => 387,
            'endTokenPos' => 49,
            'endFilePos' => 419,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 15,
        'endLine' => 15,
        'startColumn' => 5,
        'endColumn' => 61,
      ),
      'URL' => 
      array (
        'declaringClassName' => 'Djfabrizia\\Content\\Blocks\\Block',
        'implementingClassName' => 'Djfabrizia\\Content\\Blocks\\Block',
        'name' => 'URL',
        'modifiers' => 2,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'nullable\', \'string\', \'max:512\']',
          'attributes' => 
          array (
            'startLine' => 17,
            'endLine' => 17,
            'startTokenPos' => 60,
            'startFilePos' => 449,
            'endTokenPos' => 68,
            'endFilePos' => 481,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 17,
        'endLine' => 17,
        'startColumn' => 5,
        'endColumn' => 60,
      ),
      'ID' => 
      array (
        'declaringClassName' => 'Djfabrizia\\Content\\Blocks\\Block',
        'implementingClassName' => 'Djfabrizia\\Content\\Blocks\\Block',
        'name' => 'ID',
        'modifiers' => 2,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'nullable\', \'integer\', \'min:1\']',
          'attributes' => 
          array (
            'startLine' => 19,
            'endLine' => 19,
            'startTokenPos' => 79,
            'startFilePos' => 510,
            'endTokenPos' => 87,
            'endFilePos' => 541,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 19,
        'endLine' => 19,
        'startColumn' => 5,
        'endColumn' => 58,
      ),
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'rules' => 
      array (
        'name' => 'rules',
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
 * Validation rules for the block\'s data, keyed by dot path.
 *
 * @return array<string, list<mixed>>
 */',
        'startLine' => 26,
        'endLine' => 26,
        'startColumn' => 5,
        'endColumn' => 44,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 65,
        'namespace' => 'Djfabrizia\\Content\\Blocks',
        'declaringClassName' => 'Djfabrizia\\Content\\Blocks\\Block',
        'implementingClassName' => 'Djfabrizia\\Content\\Blocks\\Block',
        'currentClassName' => 'Djfabrizia\\Content\\Blocks\\Block',
        'aliasName' => NULL,
      ),
      'defaults' => 
      array (
        'name' => 'defaults',
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
 * Data for a new, empty block of this type.
 *
 * @return array<string, mixed>
 */',
        'startLine' => 33,
        'endLine' => 36,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Djfabrizia\\Content\\Blocks',
        'declaringClassName' => 'Djfabrizia\\Content\\Blocks\\Block',
        'implementingClassName' => 'Djfabrizia\\Content\\Blocks\\Block',
        'currentClassName' => 'Djfabrizia\\Content\\Blocks\\Block',
        'aliasName' => NULL,
      ),
      'references' => 
      array (
        'name' => 'references',
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
 * Fields that reference other content, as kind => dot paths (with `*`
 * wildcards). Kinds are the keys of {@see ReferenceKind}.
 *
 * @return array<value-of<ReferenceKind>, list<string>>
 */',
        'startLine' => 44,
        'endLine' => 47,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Djfabrizia\\Content\\Blocks',
        'declaringClassName' => 'Djfabrizia\\Content\\Blocks\\Block',
        'implementingClassName' => 'Djfabrizia\\Content\\Blocks\\Block',
        'currentClassName' => 'Djfabrizia\\Content\\Blocks\\Block',
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