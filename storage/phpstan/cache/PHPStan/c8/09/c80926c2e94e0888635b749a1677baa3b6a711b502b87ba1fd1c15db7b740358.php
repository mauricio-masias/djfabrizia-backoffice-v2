<?php declare(strict_types = 1);

// odsl-/var/www/packages/content/src/Models/Playlist.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Djfabrizia\Content\Models\Playlist
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.73.0.5-8.4.26-5d64c972ad17baa1b5f609ecfc1b9094751b007e78c08741b4ccab3c5a26d945',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Djfabrizia\\Content\\Models\\Playlist',
        'filename' => '/var/www/packages/content/src/Models/Playlist.php',
      ),
    ),
    'namespace' => 'Djfabrizia\\Content\\Models',
    'name' => 'Djfabrizia\\Content\\Models\\Playlist',
    'shortName' => 'Playlist',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * A Spotify playlist.
 *
 * @property int $id
 * @property string $title
 * @property string|null $short_name
 * @property string $url
 * @property string|null $uri
 * @property string|null $image_url
 * @property string|null $owner_url
 * @property string|null $owner_id
 * @property int|null $tracks_total
 * @property bool $collaborative
 * @property ContentSource $source
 * @property string|null $external_id
 * @property int $sort
 * @property Carbon|null $source_missing_at
 * @property int|null $legacy_wp_id
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 32,
    'endLine' => 79,
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
      2 => 'Djfabrizia\\Content\\Models\\Concerns\\UsesContentConnection',
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'fillable' => 
      array (
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\Playlist',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\Playlist',
        'name' => 'fillable',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'title\', \'short_name\', \'url\', \'uri\', \'image_url\', \'owner_url\', \'owner_id\', \'tracks_total\', \'collaborative\', \'source\', \'external_id\', \'status\', \'published_at\', \'sort\', \'source_missing_at\', \'legacy_wp_id\']',
          'attributes' => 
          array (
            'startLine' => 37,
            'endLine' => 54,
            'startTokenPos' => 73,
            'startFilePos' => 1073,
            'endTokenPos' => 123,
            'endFilePos' => 1411,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 37,
        'endLine' => 54,
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
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\Playlist',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\Playlist',
        'name' => 'attributes',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'collaborative\' => false, \'source\' => \'manual\', \'status\' => \'draft\', \'sort\' => 0]',
          'attributes' => 
          array (
            'startLine' => 56,
            'endLine' => 61,
            'startTokenPos' => 132,
            'startFilePos' => 1443,
            'endTokenPos' => 162,
            'endFilePos' => 1563,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 56,
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
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\Playlist',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\Playlist',
        'currentClassName' => 'Djfabrizia\\Content\\Models\\Playlist',
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
            'name' => 'Djfabrizia\\Content\\Database\\Factories\\PlaylistFactory',
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
        'modifiers' => 18,
        'namespace' => 'Djfabrizia\\Content\\Models',
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\Playlist',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\Playlist',
        'currentClassName' => 'Djfabrizia\\Content\\Models\\Playlist',
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