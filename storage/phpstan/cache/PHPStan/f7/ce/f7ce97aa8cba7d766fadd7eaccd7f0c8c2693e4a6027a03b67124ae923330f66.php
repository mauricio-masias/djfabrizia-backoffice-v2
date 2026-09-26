<?php declare(strict_types = 1);

// odsl-/var/www/packages/content/src/Blocks/BlockHydrator.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Djfabrizia\Content\Blocks\BlockHydrator
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.73.0.5-8.4.26-f8d07d180f81130028bd76727a2d1016ae4f6f240b9f18c44938c1703e2c2390',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Djfabrizia\\Content\\Blocks\\BlockHydrator',
        'filename' => '/var/www/packages/content/src/Blocks/BlockHydrator.php',
      ),
    ),
    'namespace' => 'Djfabrizia\\Content\\Blocks',
    'name' => 'Djfabrizia\\Content\\Blocks\\BlockHydrator',
    'shortName' => 'BlockHydrator',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Loads everything the blocks of one or more pages point at, with one query
 * per kind of content, so rendering a page never triggers per-block queries.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 14,
    'endLine' => 45,
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
      'hydrate' => 
      array (
        'name' => 'hydrate',
        'parameters' => 
        array (
          'pages' => 
          array (
            'name' => 'pages',
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
                      'name' => 'Djfabrizia\\Content\\Models\\Page',
                      'isIdentifier' => false,
                    ),
                  ),
                  1 => 
                  array (
                    'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                    'data' => 
                    array (
                      'name' => 'iterable',
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
            'startLine' => 19,
            'endLine' => 19,
            'startColumn' => 29,
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
            'name' => 'Djfabrizia\\Content\\Blocks\\HydratedReferences',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @param  Page|iterable<Page>  $pages
 */',
        'startLine' => 19,
        'endLine' => 44,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Djfabrizia\\Content\\Blocks',
        'declaringClassName' => 'Djfabrizia\\Content\\Blocks\\BlockHydrator',
        'implementingClassName' => 'Djfabrizia\\Content\\Blocks\\BlockHydrator',
        'currentClassName' => 'Djfabrizia\\Content\\Blocks\\BlockHydrator',
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