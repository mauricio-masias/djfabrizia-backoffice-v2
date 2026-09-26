<?php declare(strict_types = 1);

// odsl-/var/www/packages/content/src/Legacy/WordpressPages.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Djfabrizia\Content\Legacy\WordpressPages
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.73.0.5-8.4.26-9e00f416904c810fed57eddcfede5d0ee29eb765401a85f6cab33906c13acd06',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Djfabrizia\\Content\\Legacy\\WordpressPages',
        'filename' => '/var/www/packages/content/src/Legacy/WordpressPages.php',
      ),
    ),
    'namespace' => 'Djfabrizia\\Content\\Legacy',
    'name' => 'Djfabrizia\\Content\\Legacy\\WordpressPages',
    'shortName' => 'WordpressPages',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * The WordPress pages the old back office used, and the page each one became.
 *
 * Used by the reference seeder (to create the pages), the importer (to map WP
 * meta onto them) and the endpoint (v1 URLs still carry WordPress page IDs).
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 14,
    'endLine' => 75,
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
      'PAGES' => 
      array (
        'declaringClassName' => 'Djfabrizia\\Content\\Legacy\\WordpressPages',
        'implementingClassName' => 'Djfabrizia\\Content\\Legacy\\WordpressPages',
        'name' => 'PAGES',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[952 => [\'slug\' => \'home\', \'title\' => \'Homepage\', \'template\' => \\Djfabrizia\\Content\\Enums\\PageTemplate::Home, \'locale\' => \\Djfabrizia\\Content\\Enums\\PageLocale::English], 7 => [\'slug\' => \'bio\', \'title\' => \'Bio\', \'template\' => \\Djfabrizia\\Content\\Enums\\PageTemplate::Bio, \'locale\' => \\Djfabrizia\\Content\\Enums\\PageLocale::English], 967 => [\'slug\' => \'social\', \'title\' => \'Social\', \'template\' => \\Djfabrizia\\Content\\Enums\\PageTemplate::Social, \'locale\' => \\Djfabrizia\\Content\\Enums\\PageLocale::English], 39 => [\'slug\' => \'videos\', \'title\' => \'Videos\', \'template\' => \\Djfabrizia\\Content\\Enums\\PageTemplate::Videos, \'locale\' => \\Djfabrizia\\Content\\Enums\\PageLocale::English], 1347 => [\'slug\' => \'linktree\', \'title\' => \'Linktree\', \'template\' => \\Djfabrizia\\Content\\Enums\\PageTemplate::Linktree, \'locale\' => \\Djfabrizia\\Content\\Enums\\PageLocale::English], 3 => [\'slug\' => \'privacy-policy\', \'title\' => \'Privacy Policy\', \'template\' => \\Djfabrizia\\Content\\Enums\\PageTemplate::Legal, \'locale\' => \\Djfabrizia\\Content\\Enums\\PageLocale::English], 1452 => [\'slug\' => \'epk-en\', \'title\' => \'EPK EN\', \'template\' => \\Djfabrizia\\Content\\Enums\\PageTemplate::EpkDefault, \'locale\' => \\Djfabrizia\\Content\\Enums\\PageLocale::English], 1565 => [\'slug\' => \'epk-it\', \'title\' => \'EPK IT\', \'template\' => \\Djfabrizia\\Content\\Enums\\PageTemplate::EpkDefault, \'locale\' => \\Djfabrizia\\Content\\Enums\\PageLocale::Italian], 1606 => [\'slug\' => \'epk-en-special\', \'title\' => \'EPK EN Special\', \'template\' => \\Djfabrizia\\Content\\Enums\\PageTemplate::EpkSpecial, \'locale\' => \\Djfabrizia\\Content\\Enums\\PageLocale::English], 1608 => [\'slug\' => \'epk-it-special\', \'title\' => \'EPK IT Special\', \'template\' => \\Djfabrizia\\Content\\Enums\\PageTemplate::EpkSpecial, \'locale\' => \\Djfabrizia\\Content\\Enums\\PageLocale::Italian], 1707 => [\'slug\' => \'epk-en-underground\', \'title\' => \'EPK EN Underground\', \'template\' => \\Djfabrizia\\Content\\Enums\\PageTemplate::EpkUnderground, \'locale\' => \\Djfabrizia\\Content\\Enums\\PageLocale::English], 1709 => [\'slug\' => \'epk-it-underground\', \'title\' => \'EPK IT Underground\', \'template\' => \\Djfabrizia\\Content\\Enums\\PageTemplate::EpkUnderground, \'locale\' => \\Djfabrizia\\Content\\Enums\\PageLocale::Italian]]',
          'attributes' => 
          array (
            'startLine' => 19,
            'endLine' => 32,
            'startTokenPos' => 37,
            'startFilePos' => 551,
            'endTokenPos' => 495,
            'endFilePos' => 2205,
          ),
        ),
        'docComment' => '/**
 * @var array<int, array{slug: string, title: string, template: PageTemplate, locale: PageLocale}>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 19,
        'endLine' => 32,
        'startColumn' => 5,
        'endColumn' => 6,
      ),
      'MENUS' => 
      array (
        'declaringClassName' => 'Djfabrizia\\Content\\Legacy\\WordpressPages',
        'implementingClassName' => 'Djfabrizia\\Content\\Legacy\\WordpressPages',
        'name' => 'MENUS',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[2 => \'main\', 3 => \'footer\', 4 => \'mobile\']',
          'attributes' => 
          array (
            'startLine' => 39,
            'endLine' => 43,
            'startTokenPos' => 508,
            'startFilePos' => 2345,
            'endTokenPos' => 531,
            'endFilePos' => 2418,
          ),
        ),
        'docComment' => '/**
 * WordPress nav_menu term_taxonomy_id => menu slug.
 *
 * @var array<int, string>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 39,
        'endLine' => 43,
        'startColumn' => 5,
        'endColumn' => 6,
      ),
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'all' => 
      array (
        'name' => 'all',
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
 * @return array<int, array{slug: string, title: string, template: PageTemplate, locale: PageLocale}>
 */',
        'startLine' => 48,
        'endLine' => 51,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Djfabrizia\\Content\\Legacy',
        'declaringClassName' => 'Djfabrizia\\Content\\Legacy\\WordpressPages',
        'implementingClassName' => 'Djfabrizia\\Content\\Legacy\\WordpressPages',
        'currentClassName' => 'Djfabrizia\\Content\\Legacy\\WordpressPages',
        'aliasName' => NULL,
      ),
      'slugFor' => 
      array (
        'name' => 'slugFor',
        'parameters' => 
        array (
          'wordpressId' => 
          array (
            'name' => 'wordpressId',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'int',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 53,
            'endLine' => 53,
            'startColumn' => 36,
            'endColumn' => 51,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
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
                  'name' => 'string',
                  'isIdentifier' => true,
                ),
              ),
              1 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'null',
                  'isIdentifier' => true,
                ),
              ),
            ),
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 53,
        'endLine' => 56,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Djfabrizia\\Content\\Legacy',
        'declaringClassName' => 'Djfabrizia\\Content\\Legacy\\WordpressPages',
        'implementingClassName' => 'Djfabrizia\\Content\\Legacy\\WordpressPages',
        'currentClassName' => 'Djfabrizia\\Content\\Legacy\\WordpressPages',
        'aliasName' => NULL,
      ),
      'epkIds' => 
      array (
        'name' => 'epkIds',
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
 * WordPress page IDs of the EPK pages, in the order v1 serves them.
 *
 * @return list<int>
 */',
        'startLine' => 63,
        'endLine' => 74,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Djfabrizia\\Content\\Legacy',
        'declaringClassName' => 'Djfabrizia\\Content\\Legacy\\WordpressPages',
        'implementingClassName' => 'Djfabrizia\\Content\\Legacy\\WordpressPages',
        'currentClassName' => 'Djfabrizia\\Content\\Legacy\\WordpressPages',
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