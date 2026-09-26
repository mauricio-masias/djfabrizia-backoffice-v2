<?php declare(strict_types = 1);

// odsl-/var/www/app/Filament/Tables/PublishingColumns.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Filament\Tables\PublishingColumns
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.73.0.5-8.4.26-596b9884eebf4b569e8e63296274ff44379b934e45bb357d7f50a642191cedd4',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Filament\\Tables\\PublishingColumns',
        'filename' => '/var/www/app/Filament/Tables/PublishingColumns.php',
      ),
    ),
    'namespace' => 'App\\Filament\\Tables',
    'name' => 'App\\Filament\\Tables\\PublishingColumns',
    'shortName' => 'PublishingColumns',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Columns, filters and bulk actions shared by the publishable collections.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 21,
    'endLine' => 90,
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
      'columns' => 
      array (
        'name' => 'columns',
        'parameters' => 
        array (
          'synced' => 
          array (
            'name' => 'synced',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 26,
                'endLine' => 26,
                'startTokenPos' => 93,
                'startFilePos' => 752,
                'endTokenPos' => 93,
                'endFilePos' => 756,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'bool',
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
            'startColumn' => 36,
            'endColumn' => 55,
            'parameterIndex' => 0,
            'isOptional' => true,
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
 * @return list<TextColumn|IconColumn>
 */',
        'startLine' => 26,
        'endLine' => 47,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'App\\Filament\\Tables',
        'declaringClassName' => 'App\\Filament\\Tables\\PublishingColumns',
        'implementingClassName' => 'App\\Filament\\Tables\\PublishingColumns',
        'currentClassName' => 'App\\Filament\\Tables\\PublishingColumns',
        'aliasName' => NULL,
      ),
      'filters' => 
      array (
        'name' => 'filters',
        'parameters' => 
        array (
          'synced' => 
          array (
            'name' => 'synced',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 52,
                'endLine' => 52,
                'startTokenPos' => 315,
                'startFilePos' => 1791,
                'endTokenPos' => 315,
                'endFilePos' => 1795,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'bool',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 52,
            'endLine' => 52,
            'startColumn' => 36,
            'endColumn' => 55,
            'parameterIndex' => 0,
            'isOptional' => true,
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
 * @return list<SelectFilter|TernaryFilter>
 */',
        'startLine' => 52,
        'endLine' => 69,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'App\\Filament\\Tables',
        'declaringClassName' => 'App\\Filament\\Tables\\PublishingColumns',
        'implementingClassName' => 'App\\Filament\\Tables\\PublishingColumns',
        'currentClassName' => 'App\\Filament\\Tables\\PublishingColumns',
        'aliasName' => NULL,
      ),
      'bulkActions' => 
      array (
        'name' => 'bulkActions',
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
 * @return list<BulkAction>
 */',
        'startLine' => 74,
        'endLine' => 89,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'App\\Filament\\Tables',
        'declaringClassName' => 'App\\Filament\\Tables\\PublishingColumns',
        'implementingClassName' => 'App\\Filament\\Tables\\PublishingColumns',
        'currentClassName' => 'App\\Filament\\Tables\\PublishingColumns',
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