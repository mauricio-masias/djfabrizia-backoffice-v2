<?php declare(strict_types = 1);

// odsl-/var/www/packages/content/src/Taxonomy/GenreResolver.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Djfabrizia\Content\Taxonomy\GenreResolver
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.73.0.5-8.4.26-3ae5fd6fd5fd163338d8c36af29c258d75ba07086bbe45bc8972acc5604c3af7',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Djfabrizia\\Content\\Taxonomy\\GenreResolver',
        'filename' => '/var/www/packages/content/src/Taxonomy/GenreResolver.php',
      ),
    ),
    'namespace' => 'Djfabrizia\\Content\\Taxonomy',
    'name' => 'Djfabrizia\\Content\\Taxonomy\\GenreResolver',
    'shortName' => 'GenreResolver',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Maps free-text genre tags (Mixcloud tags, the style part of a WordPress
 * release description) to shared Genre rows.
 *
 * A tag matches a genre by slug, by slug without hyphens ("tech-house" and
 * "techhouse"), or by one of the genre\'s aliases. A tag that matches nothing
 * creates a genre with a null sort position, which marks it as unreviewed.
 *
 * The genre table is small, so it is indexed in memory once per instance;
 * reuse one instance for a whole import or sync run.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 20,
    'endLine' => 114,
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
      'index' => 
      array (
        'declaringClassName' => 'Djfabrizia\\Content\\Taxonomy\\GenreResolver',
        'implementingClassName' => 'Djfabrizia\\Content\\Taxonomy\\GenreResolver',
        'name' => 'index',
        'modifiers' => 4,
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
                  'name' => 'array',
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
        'default' => 
        array (
          'code' => 'null',
          'attributes' => 
          array (
            'startLine' => 23,
            'endLine' => 23,
            'startTokenPos' => 41,
            'startFilePos' => 734,
            'endTokenPos' => 41,
            'endFilePos' => 737,
          ),
        ),
        'docComment' => '/** @var array<string, Genre>|null */',
        'attributes' => 
        array (
        ),
        'startLine' => 23,
        'endLine' => 23,
        'startColumn' => 5,
        'endColumn' => 33,
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
      'resolve' => 
      array (
        'name' => 'resolve',
        'parameters' => 
        array (
          'tag' => 
          array (
            'name' => 'tag',
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
            'startLine' => 25,
            'endLine' => 25,
            'startColumn' => 29,
            'endColumn' => 39,
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
                  'name' => 'Djfabrizia\\Content\\Models\\Genre',
                  'isIdentifier' => false,
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
        'startLine' => 25,
        'endLine' => 51,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Djfabrizia\\Content\\Taxonomy',
        'declaringClassName' => 'Djfabrizia\\Content\\Taxonomy\\GenreResolver',
        'implementingClassName' => 'Djfabrizia\\Content\\Taxonomy\\GenreResolver',
        'currentClassName' => 'Djfabrizia\\Content\\Taxonomy\\GenreResolver',
        'aliasName' => NULL,
      ),
      'resolveMany' => 
      array (
        'name' => 'resolveMany',
        'parameters' => 
        array (
          'tags' => 
          array (
            'name' => 'tags',
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
            'startLine' => 57,
            'endLine' => 57,
            'startColumn' => 33,
            'endColumn' => 46,
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
            'name' => 'Illuminate\\Support\\Collection',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @param  iterable<mixed>  $tags
 * @return Collection<int, Genre> unique genres, in first-seen order
 */',
        'startLine' => 57,
        'endLine' => 70,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Djfabrizia\\Content\\Taxonomy',
        'declaringClassName' => 'Djfabrizia\\Content\\Taxonomy\\GenreResolver',
        'implementingClassName' => 'Djfabrizia\\Content\\Taxonomy\\GenreResolver',
        'currentClassName' => 'Djfabrizia\\Content\\Taxonomy\\GenreResolver',
        'aliasName' => NULL,
      ),
      'keys' => 
      array (
        'name' => 'keys',
        'parameters' => 
        array (
          'name' => 
          array (
            'name' => 'name',
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
            'startLine' => 77,
            'endLine' => 77,
            'startColumn' => 33,
            'endColumn' => 44,
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
 * Normalized lookup keys for a name: its slug and its slug without hyphens.
 *
 * @return list<string>
 */',
        'startLine' => 77,
        'endLine' => 86,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Djfabrizia\\Content\\Taxonomy',
        'declaringClassName' => 'Djfabrizia\\Content\\Taxonomy\\GenreResolver',
        'implementingClassName' => 'Djfabrizia\\Content\\Taxonomy\\GenreResolver',
        'currentClassName' => 'Djfabrizia\\Content\\Taxonomy\\GenreResolver',
        'aliasName' => NULL,
      ),
      'index' => 
      array (
        'name' => 'index',
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
 * @return array<string, Genre>
 */',
        'startLine' => 91,
        'endLine' => 102,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Djfabrizia\\Content\\Taxonomy',
        'declaringClassName' => 'Djfabrizia\\Content\\Taxonomy\\GenreResolver',
        'implementingClassName' => 'Djfabrizia\\Content\\Taxonomy\\GenreResolver',
        'currentClassName' => 'Djfabrizia\\Content\\Taxonomy\\GenreResolver',
        'aliasName' => NULL,
      ),
      'remember' => 
      array (
        'name' => 'remember',
        'parameters' => 
        array (
          'genre' => 
          array (
            'name' => 'genre',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Djfabrizia\\Content\\Models\\Genre',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 104,
            'endLine' => 104,
            'startColumn' => 31,
            'endColumn' => 42,
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
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 104,
        'endLine' => 113,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Djfabrizia\\Content\\Taxonomy',
        'declaringClassName' => 'Djfabrizia\\Content\\Taxonomy\\GenreResolver',
        'implementingClassName' => 'Djfabrizia\\Content\\Taxonomy\\GenreResolver',
        'currentClassName' => 'Djfabrizia\\Content\\Taxonomy\\GenreResolver',
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