<?php declare(strict_types = 1);

// odsl-/var/www/packages/content/src/Models/Menu.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Djfabrizia\Content\Models\Menu
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.73.0.5-8.4.26-323819d91bbd4d6033f6faa28780edb211f3bcddd9b0f39a3e4088b40be5a45c',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Djfabrizia\\Content\\Models\\Menu',
        'filename' => '/var/www/packages/content/src/Models/Menu.php',
      ),
    ),
    'namespace' => 'Djfabrizia\\Content\\Models',
    'name' => 'Djfabrizia\\Content\\Models\\Menu',
    'shortName' => 'Menu',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * @property int $id
 * @property string $slug main, footer or mobile
 * @property string $name
 * @property int|null $legacy_wp_id WordPress nav_menu term_taxonomy_id
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 17,
    'endLine' => 49,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Illuminate\\Database\\Eloquent\\Model',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
      0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      1 => 'Djfabrizia\\Content\\Models\\Concerns\\UsesContentConnection',
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'fillable' => 
      array (
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\Menu',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\Menu',
        'name' => 'fillable',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'slug\', \'name\', \'legacy_wp_id\']',
          'attributes' => 
          array (
            'startLine' => 22,
            'endLine' => 26,
            'startTokenPos' => 60,
            'startFilePos' => 623,
            'endTokenPos' => 71,
            'endFilePos' => 685,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 22,
        'endLine' => 26,
        'startColumn' => 5,
        'endColumn' => 6,
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
      'casts' => 
      array (
        'name' => 'casts',
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
        'startLine' => 28,
        'endLine' => 33,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Djfabrizia\\Content\\Models',
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\Menu',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\Menu',
        'currentClassName' => 'Djfabrizia\\Content\\Models\\Menu',
        'aliasName' => NULL,
      ),
      'newFactory' => 
      array (
        'name' => 'newFactory',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Djfabrizia\\Content\\Database\\Factories\\MenuFactory',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 35,
        'endLine' => 38,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 18,
        'namespace' => 'Djfabrizia\\Content\\Models',
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\Menu',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\Menu',
        'currentClassName' => 'Djfabrizia\\Content\\Models\\Menu',
        'aliasName' => NULL,
      ),
      'items' => 
      array (
        'name' => 'items',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Every item of the menu, flat, in display order.
 *
 * @return HasMany<MenuItem, $this>
 */',
        'startLine' => 45,
        'endLine' => 48,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Djfabrizia\\Content\\Models',
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\Menu',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\Menu',
        'currentClassName' => 'Djfabrizia\\Content\\Models\\Menu',
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