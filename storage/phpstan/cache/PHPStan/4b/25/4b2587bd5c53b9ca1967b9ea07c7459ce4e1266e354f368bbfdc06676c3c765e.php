<?php declare(strict_types = 1);

// odsl-/var/www/app/Import/Wordpress/WordpressSource.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Import\Wordpress\WordpressSource
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.73.0.5-8.4.26-b742d039bb5e1dfde9fae954550844e3bd0cf3d56c5488ff6bde31565edd6183',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Import\\Wordpress\\WordpressSource',
        'filename' => '/var/www/app/Import/Wordpress/WordpressSource.php',
      ),
    ),
    'namespace' => 'App\\Import\\Wordpress',
    'name' => 'App\\Import\\Wordpress\\WordpressSource',
    'shortName' => 'WordpressSource',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Read-only access to the WordPress v1 database (the `wordpress` connection,
 * table prefix `dj_`). All postmeta is loaded once: the site is small.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 13,
    'endLine' => 101,
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
      'meta' => 
      array (
        'declaringClassName' => 'App\\Import\\Wordpress\\WordpressSource',
        'implementingClassName' => 'App\\Import\\Wordpress\\WordpressSource',
        'name' => 'meta',
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
            'startLine' => 16,
            'endLine' => 16,
            'startTokenPos' => 41,
            'startFilePos' => 438,
            'endTokenPos' => 41,
            'endFilePos' => 441,
          ),
        ),
        'docComment' => '/** @var array<int, list<array{key: string, value: string}>>|null */',
        'attributes' => 
        array (
        ),
        'startLine' => 16,
        'endLine' => 16,
        'startColumn' => 5,
        'endColumn' => 32,
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
      'connection' => 
      array (
        'name' => 'connection',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Illuminate\\Database\\ConnectionInterface',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 18,
        'endLine' => 21,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Import\\Wordpress',
        'declaringClassName' => 'App\\Import\\Wordpress\\WordpressSource',
        'implementingClassName' => 'App\\Import\\Wordpress\\WordpressSource',
        'currentClassName' => 'App\\Import\\Wordpress\\WordpressSource',
        'aliasName' => NULL,
      ),
      'posts' => 
      array (
        'name' => 'posts',
        'parameters' => 
        array (
          'type' => 
          array (
            'name' => 'type',
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
            'startLine' => 26,
            'endLine' => 26,
            'startColumn' => 27,
            'endColumn' => 38,
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
 * @return Collection<int, object{ID: int, post_title: string, post_status: string, post_date: string, post_content: string, post_mime_type: string, menu_order: int}>
 */',
        'startLine' => 26,
        'endLine' => 37,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Import\\Wordpress',
        'declaringClassName' => 'App\\Import\\Wordpress\\WordpressSource',
        'implementingClassName' => 'App\\Import\\Wordpress\\WordpressSource',
        'currentClassName' => 'App\\Import\\Wordpress\\WordpressSource',
        'aliasName' => NULL,
      ),
      'post' => 
      array (
        'name' => 'post',
        'parameters' => 
        array (
          'id' => 
          array (
            'name' => 'id',
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
            'startLine' => 42,
            'endLine' => 42,
            'startColumn' => 26,
            'endColumn' => 32,
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
                  'name' => 'object',
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
 * @return object{ID: int, post_title: string, post_status: string, post_date: string, post_content: string, post_mime_type: string, menu_order: int}|null
 */',
        'startLine' => 42,
        'endLine' => 51,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Import\\Wordpress',
        'declaringClassName' => 'App\\Import\\Wordpress\\WordpressSource',
        'implementingClassName' => 'App\\Import\\Wordpress\\WordpressSource',
        'currentClassName' => 'App\\Import\\Wordpress\\WordpressSource',
        'aliasName' => NULL,
      ),
      'meta' => 
      array (
        'name' => 'meta',
        'parameters' => 
        array (
          'postId' => 
          array (
            'name' => 'postId',
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
            'startColumn' => 26,
            'endColumn' => 36,
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
            'name' => 'App\\Import\\Wordpress\\Meta',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 53,
        'endLine' => 64,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Import\\Wordpress',
        'declaringClassName' => 'App\\Import\\Wordpress\\WordpressSource',
        'implementingClassName' => 'App\\Import\\Wordpress\\WordpressSource',
        'currentClassName' => 'App\\Import\\Wordpress\\WordpressSource',
        'aliasName' => NULL,
      ),
      'menuItems' => 
      array (
        'name' => 'menuItems',
        'parameters' => 
        array (
          'termTaxonomyId' => 
          array (
            'name' => 'termTaxonomyId',
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
            'startLine' => 71,
            'endLine' => 71,
            'startColumn' => 31,
            'endColumn' => 49,
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
 * Menu item posts of one nav menu (term_taxonomy_id), in menu order.
 *
 * @return Collection<int, object{ID: int, post_title: string, menu_order: int}>
 */',
        'startLine' => 71,
        'endLine' => 83,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Import\\Wordpress',
        'declaringClassName' => 'App\\Import\\Wordpress\\WordpressSource',
        'implementingClassName' => 'App\\Import\\Wordpress\\WordpressSource',
        'currentClassName' => 'App\\Import\\Wordpress\\WordpressSource',
        'aliasName' => NULL,
      ),
      'formSubmissions' => 
      array (
        'name' => 'formSubmissions',
        'parameters' => 
        array (
          'formPostId' => 
          array (
            'name' => 'formPostId',
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
            'startLine' => 90,
            'endLine' => 90,
            'startColumn' => 37,
            'endColumn' => 51,
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
 * Contact Form 7 submissions (CFDB7) of one form.
 *
 * @return Collection<int, object{form_id: int, form_value: string, form_date: string}>
 */',
        'startLine' => 90,
        'endLine' => 100,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Import\\Wordpress',
        'declaringClassName' => 'App\\Import\\Wordpress\\WordpressSource',
        'implementingClassName' => 'App\\Import\\Wordpress\\WordpressSource',
        'currentClassName' => 'App\\Import\\Wordpress\\WordpressSource',
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