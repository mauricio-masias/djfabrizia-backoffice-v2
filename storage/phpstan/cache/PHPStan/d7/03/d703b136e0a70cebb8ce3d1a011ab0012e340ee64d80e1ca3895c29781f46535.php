<?php declare(strict_types = 1);

// osfsl-/var/www/vendor/composer/../djfabrizia/content/database/factories/PageFactory.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Djfabrizia\Content\Database\Factories\PageFactory
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-71c46eb80729594f3863c17aa3421df1298b67d1cca9d6668670e22e210cd1ae-8.4.26-6.73.0.5',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Djfabrizia\\Content\\Database\\Factories\\PageFactory',
        'filename' => '/var/www/vendor/composer/../djfabrizia/content/database/factories/PageFactory.php',
      ),
    ),
    'namespace' => 'Djfabrizia\\Content\\Database\\Factories',
    'name' => 'Djfabrizia\\Content\\Database\\Factories\\PageFactory',
    'shortName' => 'PageFactory',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * @extends Factory<Page>
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 14,
    'endLine' => 54,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Illuminate\\Database\\Eloquent\\Factories\\Factory',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
      0 => 'Djfabrizia\\Content\\Database\\Factories\\Concerns\\HasPublishStates',
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'model' => 
      array (
        'declaringClassName' => 'Djfabrizia\\Content\\Database\\Factories\\PageFactory',
        'implementingClassName' => 'Djfabrizia\\Content\\Database\\Factories\\PageFactory',
        'name' => 'model',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\Djfabrizia\\Content\\Models\\Page::class',
          'attributes' => 
          array (
            'startLine' => 18,
            'endLine' => 18,
            'startTokenPos' => 55,
            'startFilePos' => 419,
            'endTokenPos' => 57,
            'endFilePos' => 429,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 18,
        'endLine' => 18,
        'startColumn' => 5,
        'endColumn' => 35,
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
      'definition' => 
      array (
        'name' => 'definition',
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
        'startLine' => 20,
        'endLine' => 33,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Djfabrizia\\Content\\Database\\Factories',
        'declaringClassName' => 'Djfabrizia\\Content\\Database\\Factories\\PageFactory',
        'implementingClassName' => 'Djfabrizia\\Content\\Database\\Factories\\PageFactory',
        'currentClassName' => 'Djfabrizia\\Content\\Database\\Factories\\PageFactory',
        'aliasName' => NULL,
      ),
      'template' => 
      array (
        'name' => 'template',
        'parameters' => 
        array (
          'template' => 
          array (
            'name' => 'template',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Djfabrizia\\Content\\Enums\\PageTemplate',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 38,
            'endLine' => 38,
            'startColumn' => 30,
            'endColumn' => 51,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'locale' => 
          array (
            'name' => 'locale',
            'default' => 
            array (
              'code' => '\\Djfabrizia\\Content\\Enums\\PageLocale::English',
              'attributes' => 
              array (
                'startLine' => 38,
                'endLine' => 38,
                'startTokenPos' => 192,
                'startFilePos' => 1048,
                'endTokenPos' => 194,
                'endFilePos' => 1066,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Djfabrizia\\Content\\Enums\\PageLocale',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 38,
            'endLine' => 38,
            'startColumn' => 54,
            'endColumn' => 93,
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
            'name' => 'static',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * A page of the given template, starting from its skeleton blocks.
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
        'namespace' => 'Djfabrizia\\Content\\Database\\Factories',
        'declaringClassName' => 'Djfabrizia\\Content\\Database\\Factories\\PageFactory',
        'implementingClassName' => 'Djfabrizia\\Content\\Database\\Factories\\PageFactory',
        'currentClassName' => 'Djfabrizia\\Content\\Database\\Factories\\PageFactory',
        'aliasName' => NULL,
      ),
      'withBlocks' => 
      array (
        'name' => 'withBlocks',
        'parameters' => 
        array (
          'blocks' => 
          array (
            'name' => 'blocks',
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
            'startLine' => 50,
            'endLine' => 50,
            'startColumn' => 32,
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
            'name' => 'static',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @param  list<array{type: string, data: array<string, mixed>}>  $blocks
 */',
        'startLine' => 50,
        'endLine' => 53,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Djfabrizia\\Content\\Database\\Factories',
        'declaringClassName' => 'Djfabrizia\\Content\\Database\\Factories\\PageFactory',
        'implementingClassName' => 'Djfabrizia\\Content\\Database\\Factories\\PageFactory',
        'currentClassName' => 'Djfabrizia\\Content\\Database\\Factories\\PageFactory',
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