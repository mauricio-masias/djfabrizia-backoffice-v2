<?php declare(strict_types = 1);

// odsl-/var/www/packages/content/src/Exceptions/ReferencedContentException.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Djfabrizia\Content\Exceptions\ReferencedContentException
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.73.0.5-8.4.26-cd99efaa115bdaf7360f031f0c2321eb81c23261a5e70cba32000e20b3b34f40',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Djfabrizia\\Content\\Exceptions\\ReferencedContentException',
        'filename' => '/var/www/packages/content/src/Exceptions/ReferencedContentException.php',
      ),
    ),
    'namespace' => 'Djfabrizia\\Content\\Exceptions',
    'name' => 'Djfabrizia\\Content\\Exceptions\\ReferencedContentException',
    'shortName' => 'ReferencedContentException',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Thrown when deleting content that a page block still points at. Page blocks
 * are JSON, so the database cannot enforce these references itself.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 11,
    'endLine' => 20,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'RuntimeException',
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
      'usedBy' => 
      array (
        'name' => 'usedBy',
        'parameters' => 
        array (
          'what' => 
          array (
            'name' => 'what',
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
            'startLine' => 16,
            'endLine' => 16,
            'startColumn' => 35,
            'endColumn' => 46,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'pageSlugs' => 
          array (
            'name' => 'pageSlugs',
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
            'startLine' => 16,
            'endLine' => 16,
            'startColumn' => 49,
            'endColumn' => 64,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'self',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @param  list<string>  $pageSlugs
 */',
        'startLine' => 16,
        'endLine' => 19,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Djfabrizia\\Content\\Exceptions',
        'declaringClassName' => 'Djfabrizia\\Content\\Exceptions\\ReferencedContentException',
        'implementingClassName' => 'Djfabrizia\\Content\\Exceptions\\ReferencedContentException',
        'currentClassName' => 'Djfabrizia\\Content\\Exceptions\\ReferencedContentException',
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