<?php declare(strict_types = 1);

// odsl-/var/www/app/Import/Wordpress/Publishing.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Import\Wordpress\Publishing
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.73.0.5-8.4.26-e14d6f3a6d7224eaf56fbd1b9f6e8c3a01e4dd53232e4a8a217559320bab11c8',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Import\\Wordpress\\Publishing',
        'filename' => '/var/www/app/Import/Wordpress/Publishing.php',
      ),
    ),
    'namespace' => 'App\\Import\\Wordpress',
    'name' => 'App\\Import\\Wordpress\\Publishing',
    'shortName' => 'Publishing',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * WordPress post status/date → status + published_at.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 11,
    'endLine' => 26,
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
    ),
    'immediateMethods' => 
    array (
      'of' => 
      array (
        'name' => 'of',
        'parameters' => 
        array (
          'post' => 
          array (
            'name' => 'post',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'object',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 17,
            'endLine' => 17,
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
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @param  object{post_status: string, post_date: string}  $post
 * @return array{status: PublishStatus, published_at: Carbon|null}
 */',
        'startLine' => 17,
        'endLine' => 25,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'App\\Import\\Wordpress',
        'declaringClassName' => 'App\\Import\\Wordpress\\Publishing',
        'implementingClassName' => 'App\\Import\\Wordpress\\Publishing',
        'currentClassName' => 'App\\Import\\Wordpress\\Publishing',
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