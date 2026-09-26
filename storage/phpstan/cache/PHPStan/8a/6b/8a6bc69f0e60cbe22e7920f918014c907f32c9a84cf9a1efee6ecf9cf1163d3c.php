<?php declare(strict_types = 1);

// odsl-/var/www/packages/content/src/Models/ReleaseLink.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Djfabrizia\Content\Models\ReleaseLink
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.73.0.5-8.4.26-80bacca07da8bd2df6d0d138e7fd00b0af80a669166c899f795ed72769fbe2cc',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Djfabrizia\\Content\\Models\\ReleaseLink',
        'filename' => '/var/www/packages/content/src/Models/ReleaseLink.php',
      ),
    ),
    'namespace' => 'Djfabrizia\\Content\\Models',
    'name' => 'Djfabrizia\\Content\\Models\\ReleaseLink',
    'shortName' => 'ReleaseLink',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * @property int $id
 * @property int $release_id
 * @property ReleasePlatform $platform
 * @property string|null $label
 * @property string $url
 * @property int $sort
 * @property string|null $legacy_key
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 21,
    'endLine' => 59,
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
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\ReleaseLink',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\ReleaseLink',
        'name' => 'fillable',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'release_id\', \'platform\', \'label\', \'url\', \'sort\', \'legacy_key\']',
          'attributes' => 
          array (
            'startLine' => 26,
            'endLine' => 33,
            'startTokenPos' => 65,
            'startFilePos' => 730,
            'endTokenPos' => 85,
            'endFilePos' => 848,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 26,
        'endLine' => 33,
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
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\ReleaseLink',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\ReleaseLink',
        'name' => 'attributes',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'sort\' => 0]',
          'attributes' => 
          array (
            'startLine' => 35,
            'endLine' => 37,
            'startTokenPos' => 94,
            'startFilePos' => 880,
            'endTokenPos' => 103,
            'endFilePos' => 907,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 35,
        'endLine' => 37,
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
        'startLine' => 39,
        'endLine' => 45,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Djfabrizia\\Content\\Models',
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\ReleaseLink',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\ReleaseLink',
        'currentClassName' => 'Djfabrizia\\Content\\Models\\ReleaseLink',
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
            'name' => 'Djfabrizia\\Content\\Database\\Factories\\ReleaseLinkFactory',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 47,
        'endLine' => 50,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 18,
        'namespace' => 'Djfabrizia\\Content\\Models',
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\ReleaseLink',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\ReleaseLink',
        'currentClassName' => 'Djfabrizia\\Content\\Models\\ReleaseLink',
        'aliasName' => NULL,
      ),
      'release' => 
      array (
        'name' => 'release',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @return BelongsTo<Release, $this>
 */',
        'startLine' => 55,
        'endLine' => 58,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Djfabrizia\\Content\\Models',
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\ReleaseLink',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\ReleaseLink',
        'currentClassName' => 'Djfabrizia\\Content\\Models\\ReleaseLink',
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