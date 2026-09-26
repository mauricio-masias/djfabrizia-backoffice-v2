<?php declare(strict_types = 1);

// odsl-/var/www/packages/content/src/Models/Booking.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Djfabrizia\Content\Models\Booking
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.73.0.5-8.4.26-403f4dc18a713ffb25b3954b76ab6b0ec0d1dd6b356a5ac79dcd4ddb60bbad6a',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Djfabrizia\\Content\\Models\\Booking',
        'filename' => '/var/www/packages/content/src/Models/Booking.php',
      ),
    ),
    'namespace' => 'Djfabrizia\\Content\\Models',
    'name' => 'Djfabrizia\\Content\\Models\\Booking',
    'shortName' => 'Booking',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * A booking request from the public site. Written by the endpoint, managed in
 * the back office inbox.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $message
 * @property BookingStatus $status
 * @property string|null $ip
 * @property string|null $user_agent
 * @property string|null $legacy_key
 * @property Carbon $created_at
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 26,
    'endLine' => 57,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Illuminate\\Database\\Eloquent\\Model',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
      0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      1 => 'Djfabrizia\\Content\\Models\\Concerns\\UsesContentConnection',
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'fillable' => 
      array (
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\Booking',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\Booking',
        'name' => 'fillable',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'name\', \'email\', \'message\', \'status\', \'ip\', \'user_agent\', \'legacy_key\', \'created_at\']',
          'attributes' => 
          array (
            'startLine' => 31,
            'endLine' => 40,
            'startTokenPos' => 65,
            'startFilePos' => 868,
            'endTokenPos' => 91,
            'endFilePos' => 1024,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 31,
        'endLine' => 40,
        'startColumn' => 5,
        'endColumn' => 6,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'attributes' => 
      array (
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\Booking',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\Booking',
        'name' => 'attributes',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'status\' => \'unread\']',
          'attributes' => 
          array (
            'startLine' => 42,
            'endLine' => 44,
            'startTokenPos' => 100,
            'startFilePos' => 1056,
            'endTokenPos' => 109,
            'endFilePos' => 1092,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 42,
        'endLine' => 44,
        'startColumn' => 5,
        'endColumn' => 6,
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
      'casts' => 
      array (
        'name' => 'casts',
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
        'startLine' => 46,
        'endLine' => 51,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Djfabrizia\\Content\\Models',
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\Booking',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\Booking',
        'currentClassName' => 'Djfabrizia\\Content\\Models\\Booking',
        'aliasName' => NULL,
      ),
      'newFactory' => 
      array (
        'name' => 'newFactory',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Djfabrizia\\Content\\Database\\Factories\\BookingFactory',
            'isIdentifier' => false,
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
        'modifiers' => 18,
        'namespace' => 'Djfabrizia\\Content\\Models',
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\Booking',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\Booking',
        'currentClassName' => 'Djfabrizia\\Content\\Models\\Booking',
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