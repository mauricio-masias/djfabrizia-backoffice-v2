<?php declare(strict_types = 1);

// odsl-/var/www/packages/content/src/Enums/LinkMedia.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Djfabrizia\Content\Enums\LinkMedia
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.73.0.5-8.4.26-6e0f20cfeda27226e802daffd5406a9e53f2bc78e2a59a8d8e7a1e96fef1481e',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Djfabrizia\\Content\\Enums\\LinkMedia',
        'filename' => '/var/www/packages/content/src/Enums/LinkMedia.php',
      ),
    ),
    'namespace' => 'Djfabrizia\\Content\\Enums',
    'name' => 'Djfabrizia\\Content\\Enums\\LinkMedia',
    'shortName' => 'LinkMedia',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => true,
    'isBackedEnum' => true,
    'modifiers' => 0,
    'docComment' => '/**
 * Linktree link kinds. The values match the WordPress `link_media` select:
 * a platform uses the matching social URL, "<platform>-custom" swaps the user
 * segment of that URL, and "custom" is a free URL.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 12,
    'endLine' => 46,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
      0 => 'Djfabrizia\\Content\\Concerns\\HasLabel',
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'name' => 
      array (
        'declaringClassName' => 'Djfabrizia\\Content\\Enums\\LinkMedia',
        'implementingClassName' => 'Djfabrizia\\Content\\Enums\\LinkMedia',
        'name' => 'name',
        'modifiers' => 2177,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => NULL,
        'endLine' => NULL,
        'startColumn' => -1,
        'endColumn' => -1,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'value' => 
      array (
        'declaringClassName' => 'Djfabrizia\\Content\\Enums\\LinkMedia',
        'implementingClassName' => 'Djfabrizia\\Content\\Enums\\LinkMedia',
        'name' => 'value',
        'modifiers' => 2177,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => NULL,
        'endLine' => NULL,
        'startColumn' => -1,
        'endColumn' => -1,
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
      'isCustomHandle' => 
      array (
        'name' => 'isCustomHandle',
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
        'docComment' => NULL,
        'startLine' => 30,
        'endLine' => 33,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Djfabrizia\\Content\\Enums',
        'declaringClassName' => 'Djfabrizia\\Content\\Enums\\LinkMedia',
        'implementingClassName' => 'Djfabrizia\\Content\\Enums\\LinkMedia',
        'currentClassName' => 'Djfabrizia\\Content\\Enums\\LinkMedia',
        'aliasName' => NULL,
      ),
      'platform' => 
      array (
        'name' => 'platform',
        'parameters' => 
        array (
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
        'docComment' => '/**
 * The platform name without the "-custom" suffix, or null for a free URL.
 */',
        'startLine' => 38,
        'endLine' => 45,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Djfabrizia\\Content\\Enums',
        'declaringClassName' => 'Djfabrizia\\Content\\Enums\\LinkMedia',
        'implementingClassName' => 'Djfabrizia\\Content\\Enums\\LinkMedia',
        'currentClassName' => 'Djfabrizia\\Content\\Enums\\LinkMedia',
        'aliasName' => NULL,
      ),
      'cases' => 
      array (
        'name' => 'cases',
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
        'startLine' => NULL,
        'endLine' => NULL,
        'startColumn' => -1,
        'endColumn' => -1,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Djfabrizia\\Content\\Enums',
        'declaringClassName' => 'Djfabrizia\\Content\\Enums\\LinkMedia',
        'implementingClassName' => 'Djfabrizia\\Content\\Enums\\LinkMedia',
        'currentClassName' => 'Djfabrizia\\Content\\Enums\\LinkMedia',
        'aliasName' => NULL,
      ),
      'from' => 
      array (
        'name' => 'from',
        'parameters' => 
        array (
          'value' => 
          array (
            'name' => 'value',
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
                      'name' => 'string',
                      'isIdentifier' => true,
                    ),
                  ),
                  1 => 
                  array (
                    'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                    'data' => 
                    array (
                      'name' => 'int',
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
            'startLine' => NULL,
            'endLine' => NULL,
            'startColumn' => -1,
            'endColumn' => -1,
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
            'name' => 'static',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => NULL,
        'endLine' => NULL,
        'startColumn' => -1,
        'endColumn' => -1,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Djfabrizia\\Content\\Enums',
        'declaringClassName' => 'Djfabrizia\\Content\\Enums\\LinkMedia',
        'implementingClassName' => 'Djfabrizia\\Content\\Enums\\LinkMedia',
        'currentClassName' => 'Djfabrizia\\Content\\Enums\\LinkMedia',
        'aliasName' => NULL,
      ),
      'tryFrom' => 
      array (
        'name' => 'tryFrom',
        'parameters' => 
        array (
          'value' => 
          array (
            'name' => 'value',
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
                      'name' => 'string',
                      'isIdentifier' => true,
                    ),
                  ),
                  1 => 
                  array (
                    'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                    'data' => 
                    array (
                      'name' => 'int',
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
            'startLine' => NULL,
            'endLine' => NULL,
            'startColumn' => -1,
            'endColumn' => -1,
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
                  'name' => 'static',
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
        'startLine' => NULL,
        'endLine' => NULL,
        'startColumn' => -1,
        'endColumn' => -1,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Djfabrizia\\Content\\Enums',
        'declaringClassName' => 'Djfabrizia\\Content\\Enums\\LinkMedia',
        'implementingClassName' => 'Djfabrizia\\Content\\Enums\\LinkMedia',
        'currentClassName' => 'Djfabrizia\\Content\\Enums\\LinkMedia',
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
    'backingType' => 
    array (
      'name' => 'string',
      'isIdentifier' => true,
    ),
    'cases' => 
    array (
      'Instagram' => 
      array (
        'name' => 'Instagram',
        'value' => 
        array (
          'code' => '\'instagram\'',
          'attributes' => 
          array (
            'startLine' => 16,
            'endLine' => 16,
            'startTokenPos' => 34,
            'startFilePos' => 367,
            'endTokenPos' => 34,
            'endFilePos' => 377,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 16,
        'endLine' => 16,
        'startColumn' => 5,
        'endColumn' => 33,
      ),
      'Facebook' => 
      array (
        'name' => 'Facebook',
        'value' => 
        array (
          'code' => '\'facebook\'',
          'attributes' => 
          array (
            'startLine' => 17,
            'endLine' => 17,
            'startTokenPos' => 43,
            'startFilePos' => 400,
            'endTokenPos' => 43,
            'endFilePos' => 409,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 17,
        'endLine' => 17,
        'startColumn' => 5,
        'endColumn' => 31,
      ),
      'X' => 
      array (
        'name' => 'X',
        'value' => 
        array (
          'code' => '\'x\'',
          'attributes' => 
          array (
            'startLine' => 18,
            'endLine' => 18,
            'startTokenPos' => 52,
            'startFilePos' => 425,
            'endTokenPos' => 52,
            'endFilePos' => 427,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 18,
        'endLine' => 18,
        'startColumn' => 5,
        'endColumn' => 17,
      ),
      'Youtube' => 
      array (
        'name' => 'Youtube',
        'value' => 
        array (
          'code' => '\'youtube\'',
          'attributes' => 
          array (
            'startLine' => 19,
            'endLine' => 19,
            'startTokenPos' => 61,
            'startFilePos' => 449,
            'endTokenPos' => 61,
            'endFilePos' => 457,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 19,
        'endLine' => 19,
        'startColumn' => 5,
        'endColumn' => 29,
      ),
      'Mixcloud' => 
      array (
        'name' => 'Mixcloud',
        'value' => 
        array (
          'code' => '\'mixcloud\'',
          'attributes' => 
          array (
            'startLine' => 20,
            'endLine' => 20,
            'startTokenPos' => 70,
            'startFilePos' => 480,
            'endTokenPos' => 70,
            'endFilePos' => 489,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 20,
        'endLine' => 20,
        'startColumn' => 5,
        'endColumn' => 31,
      ),
      'Spotify' => 
      array (
        'name' => 'Spotify',
        'value' => 
        array (
          'code' => '\'spotify\'',
          'attributes' => 
          array (
            'startLine' => 21,
            'endLine' => 21,
            'startTokenPos' => 79,
            'startFilePos' => 511,
            'endTokenPos' => 79,
            'endFilePos' => 519,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 21,
        'endLine' => 21,
        'startColumn' => 5,
        'endColumn' => 29,
      ),
      'InstagramCustom' => 
      array (
        'name' => 'InstagramCustom',
        'value' => 
        array (
          'code' => '\'instagram-custom\'',
          'attributes' => 
          array (
            'startLine' => 22,
            'endLine' => 22,
            'startTokenPos' => 88,
            'startFilePos' => 549,
            'endTokenPos' => 88,
            'endFilePos' => 566,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 22,
        'endLine' => 22,
        'startColumn' => 5,
        'endColumn' => 46,
      ),
      'FacebookCustom' => 
      array (
        'name' => 'FacebookCustom',
        'value' => 
        array (
          'code' => '\'facebook-custom\'',
          'attributes' => 
          array (
            'startLine' => 23,
            'endLine' => 23,
            'startTokenPos' => 97,
            'startFilePos' => 595,
            'endTokenPos' => 97,
            'endFilePos' => 611,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 23,
        'endLine' => 23,
        'startColumn' => 5,
        'endColumn' => 44,
      ),
      'XCustom' => 
      array (
        'name' => 'XCustom',
        'value' => 
        array (
          'code' => '\'x-custom\'',
          'attributes' => 
          array (
            'startLine' => 24,
            'endLine' => 24,
            'startTokenPos' => 106,
            'startFilePos' => 633,
            'endTokenPos' => 106,
            'endFilePos' => 642,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 24,
        'endLine' => 24,
        'startColumn' => 5,
        'endColumn' => 30,
      ),
      'YoutubeCustom' => 
      array (
        'name' => 'YoutubeCustom',
        'value' => 
        array (
          'code' => '\'youtube-custom\'',
          'attributes' => 
          array (
            'startLine' => 25,
            'endLine' => 25,
            'startTokenPos' => 115,
            'startFilePos' => 670,
            'endTokenPos' => 115,
            'endFilePos' => 685,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 25,
        'endLine' => 25,
        'startColumn' => 5,
        'endColumn' => 42,
      ),
      'MixcloudCustom' => 
      array (
        'name' => 'MixcloudCustom',
        'value' => 
        array (
          'code' => '\'mixcloud-custom\'',
          'attributes' => 
          array (
            'startLine' => 26,
            'endLine' => 26,
            'startTokenPos' => 124,
            'startFilePos' => 714,
            'endTokenPos' => 124,
            'endFilePos' => 730,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 26,
        'endLine' => 26,
        'startColumn' => 5,
        'endColumn' => 44,
      ),
      'SpotifyCustom' => 
      array (
        'name' => 'SpotifyCustom',
        'value' => 
        array (
          'code' => '\'spotify-custom\'',
          'attributes' => 
          array (
            'startLine' => 27,
            'endLine' => 27,
            'startTokenPos' => 133,
            'startFilePos' => 758,
            'endTokenPos' => 133,
            'endFilePos' => 773,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 27,
        'endLine' => 27,
        'startColumn' => 5,
        'endColumn' => 42,
      ),
      'Custom' => 
      array (
        'name' => 'Custom',
        'value' => 
        array (
          'code' => '\'custom\'',
          'attributes' => 
          array (
            'startLine' => 28,
            'endLine' => 28,
            'startTokenPos' => 142,
            'startFilePos' => 794,
            'endTokenPos' => 142,
            'endFilePos' => 801,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 28,
        'endLine' => 28,
        'startColumn' => 5,
        'endColumn' => 27,
      ),
    ),
  ),
));