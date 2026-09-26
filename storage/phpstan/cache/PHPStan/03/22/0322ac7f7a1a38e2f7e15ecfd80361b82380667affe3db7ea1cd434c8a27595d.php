<?php declare(strict_types = 1);

// odsl-/var/www/packages/content/src/Models/Mix.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Djfabrizia\Content\Models\Mix
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.73.0.5-8.4.26-6ed828fd7673d9eab265b7d2c95f60a191a79f4d2576601c209e2ed75426eae8',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Djfabrizia\\Content\\Models\\Mix',
        'filename' => '/var/www/packages/content/src/Models/Mix.php',
      ),
    ),
    'namespace' => 'Djfabrizia\\Content\\Models',
    'name' => 'Djfabrizia\\Content\\Models\\Mix',
    'shortName' => 'Mix',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * A Mixcloud show (or a manual mix).
 *
 * @property int $id
 * @property string $title
 * @property string|null $short_name
 * @property string $url Mixcloud path, e.g. /djfabrizia/some-show/
 * @property string|null $image_url
 * @property string|null $image_small_url
 * @property Carbon|null $released_at
 * @property string|null $duration display duration, e.g. 64:56
 * @property list<string>|null $source_tags raw upstream tags
 * @property ContentSource $source
 * @property string|null $external_id
 * @property int $sort
 * @property Carbon|null $source_missing_at
 * @property int|null $legacy_wp_id
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 34,
    'endLine' => 92,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Illuminate\\Database\\Eloquent\\Model',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
      0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      1 => 'Djfabrizia\\Content\\Models\\Concerns\\Publishable',
      2 => 'Djfabrizia\\Content\\Models\\Concerns\\ReferencedByPages',
      3 => 'Djfabrizia\\Content\\Models\\Concerns\\UsesContentConnection',
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'fillable' => 
      array (
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\Mix',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\Mix',
        'name' => 'fillable',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'title\', \'short_name\', \'url\', \'image_url\', \'image_small_url\', \'released_at\', \'duration\', \'source_tags\', \'source\', \'external_id\', \'status\', \'published_at\', \'sort\', \'source_missing_at\', \'legacy_wp_id\']',
          'attributes' => 
          array (
            'startLine' => 39,
            'endLine' => 55,
            'startTokenPos' => 91,
            'startFilePos' => 1332,
            'endTokenPos' => 138,
            'endFilePos' => 1658,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 39,
        'endLine' => 55,
        'startColumn' => 5,
        'endColumn' => 6,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'attributes' => 
      array (
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\Mix',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\Mix',
        'name' => 'attributes',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'source\' => \'manual\', \'status\' => \'draft\', \'sort\' => 0]',
          'attributes' => 
          array (
            'startLine' => 57,
            'endLine' => 61,
            'startTokenPos' => 147,
            'startFilePos' => 1690,
            'endTokenPos' => 170,
            'endFilePos' => 1776,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 57,
        'endLine' => 61,
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
        'startLine' => 63,
        'endLine' => 73,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Djfabrizia\\Content\\Models',
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\Mix',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\Mix',
        'currentClassName' => 'Djfabrizia\\Content\\Models\\Mix',
        'aliasName' => NULL,
      ),
      'referenceKind' => 
      array (
        'name' => 'referenceKind',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Djfabrizia\\Content\\Blocks\\ReferenceKind',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 75,
        'endLine' => 78,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Djfabrizia\\Content\\Models',
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\Mix',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\Mix',
        'currentClassName' => 'Djfabrizia\\Content\\Models\\Mix',
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
            'name' => 'Djfabrizia\\Content\\Database\\Factories\\MixFactory',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 80,
        'endLine' => 83,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 18,
        'namespace' => 'Djfabrizia\\Content\\Models',
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\Mix',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\Mix',
        'currentClassName' => 'Djfabrizia\\Content\\Models\\Mix',
        'aliasName' => NULL,
      ),
      'genres' => 
      array (
        'name' => 'genres',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @return BelongsToMany<Genre, $this>
 */',
        'startLine' => 88,
        'endLine' => 91,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Djfabrizia\\Content\\Models',
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\Mix',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\Mix',
        'currentClassName' => 'Djfabrizia\\Content\\Models\\Mix',
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