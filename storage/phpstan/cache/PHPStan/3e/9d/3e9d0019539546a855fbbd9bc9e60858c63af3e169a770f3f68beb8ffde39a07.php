<?php declare(strict_types = 1);

// odsl-/var/www/app/Filament/Resources/Users/Pages/EditUser.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Filament\Resources\Users\Pages\EditUser
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.73.0.5-8.4.26-c719ef9956913b33d3c80daf7f92ca64d0feb124ea3819d03af826ce457d8ffb',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Filament\\Resources\\Users\\Pages\\EditUser',
        'filename' => '/var/www/app/Filament/Resources/Users/Pages/EditUser.php',
      ),
    ),
    'namespace' => 'App\\Filament\\Resources\\Users\\Pages',
    'name' => 'App\\Filament\\Resources\\Users\\Pages\\EditUser',
    'shortName' => 'EditUser',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 12,
    'endLine' => 40,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Filament\\Resources\\Pages\\EditRecord',
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
      'resource' => 
      array (
        'declaringClassName' => 'App\\Filament\\Resources\\Users\\Pages\\EditUser',
        'implementingClassName' => 'App\\Filament\\Resources\\Users\\Pages\\EditUser',
        'name' => 'resource',
        'modifiers' => 18,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'default' => 
        array (
          'code' => '\\App\\Filament\\Resources\\Users\\UserResource::class',
          'attributes' => 
          array (
            'startLine' => 14,
            'endLine' => 14,
            'startTokenPos' => 57,
            'startFilePos' => 352,
            'endTokenPos' => 59,
            'endFilePos' => 370,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 14,
        'endLine' => 14,
        'startColumn' => 5,
        'endColumn' => 60,
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
      'getHeaderActions' => 
      array (
        'name' => 'getHeaderActions',
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
        'startLine' => 16,
        'endLine' => 21,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'App\\Filament\\Resources\\Users\\Pages',
        'declaringClassName' => 'App\\Filament\\Resources\\Users\\Pages\\EditUser',
        'implementingClassName' => 'App\\Filament\\Resources\\Users\\Pages\\EditUser',
        'currentClassName' => 'App\\Filament\\Resources\\Users\\Pages\\EditUser',
        'aliasName' => NULL,
      ),
      'handleRecordUpdate' => 
      array (
        'name' => 'handleRecordUpdate',
        'parameters' => 
        array (
          'record' => 
          array (
            'name' => 'record',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Illuminate\\Database\\Eloquent\\Model',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 28,
            'endLine' => 28,
            'startColumn' => 43,
            'endColumn' => 55,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'data' => 
          array (
            'name' => 'data',
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
            'startLine' => 28,
            'endLine' => 28,
            'startColumn' => 58,
            'endColumn' => 68,
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
            'name' => 'Illuminate\\Database\\Eloquent\\Model',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * `is_admin` is not mass-assignable, and admins cannot remove their own access.
 *
 * @param  array<string, mixed>  $data
 */',
        'startLine' => 28,
        'endLine' => 39,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'App\\Filament\\Resources\\Users\\Pages',
        'declaringClassName' => 'App\\Filament\\Resources\\Users\\Pages\\EditUser',
        'implementingClassName' => 'App\\Filament\\Resources\\Users\\Pages\\EditUser',
        'currentClassName' => 'App\\Filament\\Resources\\Users\\Pages\\EditUser',
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