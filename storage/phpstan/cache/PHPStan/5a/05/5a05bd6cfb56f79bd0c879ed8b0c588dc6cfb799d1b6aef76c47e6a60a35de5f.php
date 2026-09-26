<?php declare(strict_types = 1);

// odsl-/var/www/packages/content/src/Blocks/BlockReferences.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Djfabrizia\Content\Blocks\BlockReferences
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.73.0.5-8.4.26-ca0bb6b236076f92a07ba82fb1c8e574ba7806fc58969cf8f9757c68c3f11f62',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Djfabrizia\\Content\\Blocks\\BlockReferences',
        'filename' => '/var/www/packages/content/src/Blocks/BlockReferences.php',
      ),
    ),
    'namespace' => 'Djfabrizia\\Content\\Blocks',
    'name' => 'Djfabrizia\\Content\\Blocks\\BlockReferences',
    'shortName' => 'BlockReferences',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Collects the IDs that blocks point at, grouped by {@see ReferenceKind}.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 8,
    'endLine' => 43,
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
      'collect' => 
      array (
        'name' => 'collect',
        'parameters' => 
        array (
          'blocks' => 
          array (
            'name' => 'blocks',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'iterable',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 14,
            'endLine' => 14,
            'startColumn' => 36,
            'endColumn' => 51,
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
 * @param  iterable<array{type?: mixed, data?: mixed}>  $blocks
 * @return array<value-of<ReferenceKind>, list<int>>
 */',
        'startLine' => 14,
        'endLine' => 42,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Djfabrizia\\Content\\Blocks',
        'declaringClassName' => 'Djfabrizia\\Content\\Blocks\\BlockReferences',
        'implementingClassName' => 'Djfabrizia\\Content\\Blocks\\BlockReferences',
        'currentClassName' => 'Djfabrizia\\Content\\Blocks\\BlockReferences',
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