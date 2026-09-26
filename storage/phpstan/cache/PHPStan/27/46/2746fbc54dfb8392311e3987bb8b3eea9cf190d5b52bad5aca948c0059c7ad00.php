<?php declare(strict_types = 1);

// odsl-/var/www/packages/content/src/Models/PublishEvent.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Djfabrizia\Content\Models\PublishEvent
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.73.0.5-8.4.26-1498957ebd5feac7b97b1b89202eb5f3864a85e9f5236f73d36a40ff2cdbe01f',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Djfabrizia\\Content\\Models\\PublishEvent',
        'filename' => '/var/www/packages/content/src/Models/PublishEvent.php',
      ),
    ),
    'namespace' => 'Djfabrizia\\Content\\Models',
    'name' => 'Djfabrizia\\Content\\Models\\PublishEvent',
    'shortName' => 'PublishEvent',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Audit row for one cache warm request sent to the endpoint.
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $subject_type
 * @property int|null $subject_id
 * @property list<string> $targets
 * @property PublishEventStatus $status
 * @property array<string, mixed>|null $response
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 21,
    'endLine' => 54,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Illuminate\\Database\\Eloquent\\Model',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
      0 => 'Djfabrizia\\Content\\Models\\Concerns\\UsesContentConnection',
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'fillable' => 
      array (
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\PublishEvent',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\PublishEvent',
        'name' => 'fillable',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'user_id\', \'subject_type\', \'subject_id\', \'targets\', \'status\', \'response\']',
          'attributes' => 
          array (
            'startLine' => 25,
            'endLine' => 32,
            'startTokenPos' => 50,
            'startFilePos' => 664,
            'endTokenPos' => 70,
            'endFilePos' => 792,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 25,
        'endLine' => 32,
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
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\PublishEvent',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\PublishEvent',
        'name' => 'attributes',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'status\' => \'queued\']',
          'attributes' => 
          array (
            'startLine' => 34,
            'endLine' => 36,
            'startTokenPos' => 79,
            'startFilePos' => 824,
            'endTokenPos' => 88,
            'endFilePos' => 860,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 34,
        'endLine' => 36,
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
        'startLine' => 38,
        'endLine' => 45,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Djfabrizia\\Content\\Models',
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\PublishEvent',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\PublishEvent',
        'currentClassName' => 'Djfabrizia\\Content\\Models\\PublishEvent',
        'aliasName' => NULL,
      ),
      'subject' => 
      array (
        'name' => 'subject',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Illuminate\\Database\\Eloquent\\Relations\\MorphTo',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @return MorphTo<Model, $this>
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
        'namespace' => 'Djfabrizia\\Content\\Models',
        'declaringClassName' => 'Djfabrizia\\Content\\Models\\PublishEvent',
        'implementingClassName' => 'Djfabrizia\\Content\\Models\\PublishEvent',
        'currentClassName' => 'Djfabrizia\\Content\\Models\\PublishEvent',
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