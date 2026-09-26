<?php declare(strict_types = 1);

// odsl-/var/www/app/Console/Commands/ImportWordpress.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Console\Commands\ImportWordpress
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.73.0.5-8.4.26-20d45df4d699d117879b24d6e434dcf999c0a7bf3bd5495decbd4b00ef1772e1',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Console\\Commands\\ImportWordpress',
        'filename' => '/var/www/app/Console/Commands/ImportWordpress.php',
      ),
    ),
    'namespace' => 'App\\Console\\Commands',
    'name' => 'App\\Console\\Commands\\ImportWordpress',
    'shortName' => 'ImportWordpress',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 28,
    'endLine' => 110,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Illuminate\\Console\\Command',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
      'FRESH_ORDER' => 
      array (
        'declaringClassName' => 'App\\Console\\Commands\\ImportWordpress',
        'implementingClassName' => 'App\\Console\\Commands\\ImportWordpress',
        'name' => 'FRESH_ORDER',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\\Djfabrizia\\Content\\Models\\Link::class, \\Djfabrizia\\Content\\Models\\LinkSection::class, \\Djfabrizia\\Content\\Models\\SocialLink::class, \\Djfabrizia\\Content\\Models\\MenuItem::class, \\Djfabrizia\\Content\\Models\\UkVenue::class, \\Djfabrizia\\Content\\Models\\Club::class, \\Djfabrizia\\Content\\Models\\City::class, \\Djfabrizia\\Content\\Models\\Country::class, \\Djfabrizia\\Content\\Models\\Video::class, \\Djfabrizia\\Content\\Models\\Playlist::class, \\Djfabrizia\\Content\\Models\\ReleaseLink::class, \\Djfabrizia\\Content\\Models\\Release::class, \\Djfabrizia\\Content\\Models\\Mix::class, \\Djfabrizia\\Content\\Models\\Genre::class, \\Djfabrizia\\Content\\Models\\RecordLabel::class, \\Djfabrizia\\Content\\Models\\Page::class, \\Djfabrizia\\Content\\Models\\Media::class, \\Djfabrizia\\Content\\Models\\Booking::class]',
          'attributes' => 
          array (
            'startLine' => 44,
            'endLine' => 48,
            'startTokenPos' => 155,
            'startFilePos' => 1645,
            'endTokenPos' => 247,
            'endFilePos' => 1958,
          ),
        ),
        'docComment' => '/**
 * Deleted by --fresh, children before parents. Users, settings and the
 * audit tables are kept.
 *
 * @var list<class-string<Model>>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 44,
        'endLine' => 48,
        'startColumn' => 5,
        'endColumn' => 6,
      ),
    ),
    'immediateProperties' => 
    array (
      'signature' => 
      array (
        'declaringClassName' => 'App\\Console\\Commands\\ImportWordpress',
        'implementingClassName' => 'App\\Console\\Commands\\ImportWordpress',
        'name' => 'signature',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'cms:import-wordpress
        {--only= : Comma-separated steps to run (media, mixes, releases, playlists, videos, countries, uk_venues, menus, social_links, linktree, pages, settings, bookings)}
        {--dry-run : Run everything inside a transaction and roll it back}
        {--fresh : Delete imported content first}
        {--force : Allow --fresh in production or after back office edits}\'',
          'attributes' => 
          array (
            'startLine' => 30,
            'endLine' => 34,
            'startTokenPos' => 133,
            'startFilePos' => 956,
            'endTokenPos' => 133,
            'endFilePos' => 1350,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 30,
        'endLine' => 34,
        'startColumn' => 5,
        'endColumn' => 76,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'description' => 
      array (
        'declaringClassName' => 'App\\Console\\Commands\\ImportWordpress',
        'implementingClassName' => 'App\\Console\\Commands\\ImportWordpress',
        'name' => 'description',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'Import content from the WordPress v1 database (idempotent)\'',
          'attributes' => 
          array (
            'startLine' => 36,
            'endLine' => 36,
            'startTokenPos' => 142,
            'startFilePos' => 1383,
            'endTokenPos' => 142,
            'endFilePos' => 1442,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 36,
        'endLine' => 36,
        'startColumn' => 5,
        'endColumn' => 90,
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
      'handle' => 
      array (
        'name' => 'handle',
        'parameters' => 
        array (
          'importer' => 
          array (
            'name' => 'importer',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Import\\Wordpress\\WordpressImporter',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 50,
            'endLine' => 50,
            'startColumn' => 28,
            'endColumn' => 54,
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
            'name' => 'int',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 50,
        'endLine' => 77,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Console\\Commands',
        'declaringClassName' => 'App\\Console\\Commands\\ImportWordpress',
        'implementingClassName' => 'App\\Console\\Commands\\ImportWordpress',
        'currentClassName' => 'App\\Console\\Commands\\ImportWordpress',
        'aliasName' => NULL,
      ),
      'freshAllowed' => 
      array (
        'name' => 'freshAllowed',
        'parameters' => 
        array (
          'importer' => 
          array (
            'name' => 'importer',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Import\\Wordpress\\WordpressImporter',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 79,
            'endLine' => 79,
            'startColumn' => 35,
            'endColumn' => 61,
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
        'startLine' => 79,
        'endLine' => 98,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Console\\Commands',
        'declaringClassName' => 'App\\Console\\Commands\\ImportWordpress',
        'implementingClassName' => 'App\\Console\\Commands\\ImportWordpress',
        'currentClassName' => 'App\\Console\\Commands\\ImportWordpress',
        'aliasName' => NULL,
      ),
      'wipe' => 
      array (
        'name' => 'wipe',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 100,
        'endLine' => 109,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Console\\Commands',
        'declaringClassName' => 'App\\Console\\Commands\\ImportWordpress',
        'implementingClassName' => 'App\\Console\\Commands\\ImportWordpress',
        'currentClassName' => 'App\\Console\\Commands\\ImportWordpress',
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