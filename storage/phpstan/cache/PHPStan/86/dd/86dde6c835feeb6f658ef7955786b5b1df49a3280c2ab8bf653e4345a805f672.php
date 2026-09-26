<?php declare(strict_types = 1);

// odsl-/var/www/app/Import/Wordpress/Steps/LinktreeStep.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Import\Wordpress\Steps\LinktreeStep
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.73.0.5-8.4.26-a46f18723bdce39e69cd720ca3b8f291cf17c428d3f62f7f305dce080eb1ac8a',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Import\\Wordpress\\Steps\\LinktreeStep',
        'filename' => '/var/www/app/Import/Wordpress/Steps/LinktreeStep.php',
      ),
    ),
    'namespace' => 'App\\Import\\Wordpress\\Steps',
    'name' => 'App\\Import\\Wordpress\\Steps\\LinktreeStep',
    'shortName' => 'LinktreeStep',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * The Linktree page\'s section and link repeaters. Links point at sections by
 * WordPress taxonomy term ID; those become real link ↔ section rows.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 15,
    'endLine' => 85,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'App\\Import\\Wordpress\\Steps\\ImportStep',
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
      'LINKTREE_PAGE_ID' => 
      array (
        'declaringClassName' => 'App\\Import\\Wordpress\\Steps\\LinktreeStep',
        'implementingClassName' => 'App\\Import\\Wordpress\\Steps\\LinktreeStep',
        'name' => 'LINKTREE_PAGE_ID',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '1347',
          'attributes' => 
          array (
            'startLine' => 17,
            'endLine' => 17,
            'startTokenPos' => 52,
            'startFilePos' => 475,
            'endTokenPos' => 52,
            'endFilePos' => 478,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 17,
        'endLine' => 17,
        'startColumn' => 5,
        'endColumn' => 42,
      ),
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 19,
        'endLine' => 22,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Import\\Wordpress\\Steps',
        'declaringClassName' => 'App\\Import\\Wordpress\\Steps\\LinktreeStep',
        'implementingClassName' => 'App\\Import\\Wordpress\\Steps\\LinktreeStep',
        'currentClassName' => 'App\\Import\\Wordpress\\Steps\\LinktreeStep',
        'aliasName' => NULL,
      ),
      'run' => 
      array (
        'name' => 'run',
        'parameters' => 
        array (
          'context' => 
          array (
            'name' => 'context',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Import\\Wordpress\\ImportContext',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 24,
            'endLine' => 24,
            'startColumn' => 25,
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
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 24,
        'endLine' => 59,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Import\\Wordpress\\Steps',
        'declaringClassName' => 'App\\Import\\Wordpress\\Steps\\LinktreeStep',
        'implementingClassName' => 'App\\Import\\Wordpress\\Steps\\LinktreeStep',
        'currentClassName' => 'App\\Import\\Wordpress\\Steps\\LinktreeStep',
        'aliasName' => NULL,
      ),
      'importSections' => 
      array (
        'name' => 'importSections',
        'parameters' => 
        array (
          'context' => 
          array (
            'name' => 'context',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Import\\Wordpress\\ImportContext',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 64,
            'endLine' => 64,
            'startColumn' => 37,
            'endColumn' => 58,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'meta' => 
          array (
            'name' => 'meta',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Import\\Wordpress\\Meta',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 64,
            'endLine' => 64,
            'startColumn' => 61,
            'endColumn' => 70,
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
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @return array<int, int> WordPress term ID => section ID
 */',
        'startLine' => 64,
        'endLine' => 84,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Import\\Wordpress\\Steps',
        'declaringClassName' => 'App\\Import\\Wordpress\\Steps\\LinktreeStep',
        'implementingClassName' => 'App\\Import\\Wordpress\\Steps\\LinktreeStep',
        'currentClassName' => 'App\\Import\\Wordpress\\Steps\\LinktreeStep',
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