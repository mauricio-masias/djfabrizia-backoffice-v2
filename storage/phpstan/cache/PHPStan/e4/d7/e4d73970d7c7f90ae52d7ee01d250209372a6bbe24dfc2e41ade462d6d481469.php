<?php declare(strict_types = 1);

// odsl-/var/www/app/Import/Wordpress/WordpressImporter.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Import\Wordpress\WordpressImporter
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.73.0.5-8.4.26-1ff2926f35e2b8a52db77374414834200a07d072fac6e4cf4b4b60c567896e39',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Import\\Wordpress\\WordpressImporter',
        'filename' => '/var/www/app/Import/Wordpress/WordpressImporter.php',
      ),
    ),
    'namespace' => 'App\\Import\\Wordpress',
    'name' => 'App\\Import\\Wordpress\\WordpressImporter',
    'shortName' => 'WordpressImporter',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Runs the import steps in dependency order (media and mixes before the
 * pages and releases that reference them). Every step upserts by a legacy
 * key, so a run can be repeated safely.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 44,
    'endLine' => 160,
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
      'STEPS' => 
      array (
        'declaringClassName' => 'App\\Import\\Wordpress\\WordpressImporter',
        'implementingClassName' => 'App\\Import\\Wordpress\\WordpressImporter',
        'name' => 'STEPS',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\\App\\Import\\Wordpress\\Steps\\MediaStep::class, \\App\\Import\\Wordpress\\Steps\\MixesStep::class, \\App\\Import\\Wordpress\\Steps\\ReleasesStep::class, \\App\\Import\\Wordpress\\Steps\\PlaylistsStep::class, \\App\\Import\\Wordpress\\Steps\\VideosStep::class, \\App\\Import\\Wordpress\\Steps\\CountriesStep::class, \\App\\Import\\Wordpress\\Steps\\UkVenuesStep::class, \\App\\Import\\Wordpress\\Steps\\MenusStep::class, \\App\\Import\\Wordpress\\Steps\\SocialLinksStep::class, \\App\\Import\\Wordpress\\Steps\\LinktreeStep::class, \\App\\Import\\Wordpress\\Steps\\PagesStep::class, \\App\\Import\\Wordpress\\Steps\\SettingsStep::class, \\App\\Import\\Wordpress\\Steps\\BookingsStep::class]',
          'attributes' => 
          array (
            'startLine' => 47,
            'endLine' => 61,
            'startTokenPos' => 190,
            'startFilePos' => 1647,
            'endTokenPos' => 257,
            'endFilePos' => 2021,
          ),
        ),
        'docComment' => '/** @var list<class-string<ImportStep>> */',
        'attributes' => 
        array (
        ),
        'startLine' => 47,
        'endLine' => 61,
        'startColumn' => 5,
        'endColumn' => 6,
      ),
      'EDITABLE_MODELS' => 
      array (
        'declaringClassName' => 'App\\Import\\Wordpress\\WordpressImporter',
        'implementingClassName' => 'App\\Import\\Wordpress\\WordpressImporter',
        'name' => 'EDITABLE_MODELS',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\\Djfabrizia\\Content\\Models\\Page::class, \\Djfabrizia\\Content\\Models\\Mix::class, \\Djfabrizia\\Content\\Models\\Release::class, \\Djfabrizia\\Content\\Models\\Playlist::class, \\Djfabrizia\\Content\\Models\\Video::class, \\Djfabrizia\\Content\\Models\\Country::class, \\Djfabrizia\\Content\\Models\\UkVenue::class, \\Djfabrizia\\Content\\Models\\MenuItem::class, \\Djfabrizia\\Content\\Models\\SocialLink::class, \\Djfabrizia\\Content\\Models\\Link::class, \\Djfabrizia\\Content\\Models\\LinkSection::class, \\Djfabrizia\\Content\\Models\\Media::class]',
          'attributes' => 
          array (
            'startLine' => 68,
            'endLine' => 71,
            'startTokenPos' => 270,
            'startFilePos' => 2194,
            'endTokenPos' => 332,
            'endFilePos' => 2403,
          ),
        ),
        'docComment' => '/**
 * Content a fresh import would overwrite if editors had changed it.
 *
 * @var list<class-string<Model>>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 68,
        'endLine' => 71,
        'startColumn' => 5,
        'endColumn' => 6,
      ),
    ),
    'immediateProperties' => 
    array (
      'source' => 
      array (
        'declaringClassName' => 'App\\Import\\Wordpress\\WordpressImporter',
        'implementingClassName' => 'App\\Import\\Wordpress\\WordpressImporter',
        'name' => 'source',
        'modifiers' => 132,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Import\\Wordpress\\WordpressSource',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 73,
        'endLine' => 73,
        'startColumn' => 33,
        'endColumn' => 72,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
    ),
    'immediateMethods' => 
    array (
      '__construct' => 
      array (
        'name' => '__construct',
        'parameters' => 
        array (
          'source' => 
          array (
            'name' => 'source',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Import\\Wordpress\\WordpressSource',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 73,
            'endLine' => 73,
            'startColumn' => 33,
            'endColumn' => 72,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 73,
        'endLine' => 73,
        'startColumn' => 5,
        'endColumn' => 76,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Import\\Wordpress',
        'declaringClassName' => 'App\\Import\\Wordpress\\WordpressImporter',
        'implementingClassName' => 'App\\Import\\Wordpress\\WordpressImporter',
        'currentClassName' => 'App\\Import\\Wordpress\\WordpressImporter',
        'aliasName' => NULL,
      ),
      'stepNames' => 
      array (
        'name' => 'stepNames',
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
 * @return list<string>
 */',
        'startLine' => 78,
        'endLine' => 81,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'App\\Import\\Wordpress',
        'declaringClassName' => 'App\\Import\\Wordpress\\WordpressImporter',
        'implementingClassName' => 'App\\Import\\Wordpress\\WordpressImporter',
        'currentClassName' => 'App\\Import\\Wordpress\\WordpressImporter',
        'aliasName' => NULL,
      ),
      'run' => 
      array (
        'name' => 'run',
        'parameters' => 
        array (
          'only' => 
          array (
            'name' => 'only',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 86,
                'endLine' => 86,
                'startTokenPos' => 419,
                'startFilePos' => 2802,
                'endTokenPos' => 420,
                'endFilePos' => 2803,
              ),
            ),
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
            'startLine' => 86,
            'endLine' => 86,
            'startColumn' => 25,
            'endColumn' => 40,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
          'dryRun' => 
          array (
            'name' => 'dryRun',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 86,
                'endLine' => 86,
                'startTokenPos' => 429,
                'startFilePos' => 2821,
                'endTokenPos' => 429,
                'endFilePos' => 2825,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'bool',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 86,
            'endLine' => 86,
            'startColumn' => 43,
            'endColumn' => 62,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Import\\Wordpress\\ImportContext',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @param  list<string>  $only  step names; empty runs everything
 */',
        'startLine' => 86,
        'endLine' => 119,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => true,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Import\\Wordpress',
        'declaringClassName' => 'App\\Import\\Wordpress\\WordpressImporter',
        'implementingClassName' => 'App\\Import\\Wordpress\\WordpressImporter',
        'currentClassName' => 'App\\Import\\Wordpress\\WordpressImporter',
        'aliasName' => NULL,
      ),
      'hasEditsSinceLastImport' => 
      array (
        'name' => 'hasEditsSinceLastImport',
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
        'docComment' => '/**
 * Content changed in the back office after the last import, which a fresh
 * import would throw away.
 */',
        'startLine' => 125,
        'endLine' => 143,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Import\\Wordpress',
        'declaringClassName' => 'App\\Import\\Wordpress\\WordpressImporter',
        'implementingClassName' => 'App\\Import\\Wordpress\\WordpressImporter',
        'currentClassName' => 'App\\Import\\Wordpress\\WordpressImporter',
        'aliasName' => NULL,
      ),
      'isNeededFor' => 
      array (
        'name' => 'isNeededFor',
        'parameters' => 
        array (
          'step' => 
          array (
            'name' => 'step',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Import\\Wordpress\\Steps\\ImportStep',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 151,
            'endLine' => 151,
            'startColumn' => 34,
            'endColumn' => 49,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'only' => 
          array (
            'name' => 'only',
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
            'startLine' => 151,
            'endLine' => 151,
            'startColumn' => 52,
            'endColumn' => 62,
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
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Steps that later steps read IDs from: running only "pages" still needs
 * the media and mix ID maps.
 *
 * @param  list<string>  $only
 */',
        'startLine' => 151,
        'endLine' => 159,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Import\\Wordpress',
        'declaringClassName' => 'App\\Import\\Wordpress\\WordpressImporter',
        'implementingClassName' => 'App\\Import\\Wordpress\\WordpressImporter',
        'currentClassName' => 'App\\Import\\Wordpress\\WordpressImporter',
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