<?php declare(strict_types = 1);

// odsl-/var/www/app/Filament/Forms/MediaUpload.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Filament\Forms\MediaUpload
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.73.0.5-8.4.26-579c20033ebf0ddd443e8220b32767f1b21052099723423384e5570d97401cc6',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Filament\\Forms\\MediaUpload',
        'filename' => '/var/www/app/Filament/Forms/MediaUpload.php',
      ),
    ),
    'namespace' => 'App\\Filament\\Forms',
    'name' => 'App\\Filament\\Forms\\MediaUpload',
    'shortName' => 'MediaUpload',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * A FileUpload whose state is Media IDs instead of file paths.
 *
 * Uploading creates a Media row (and queues its webp variants); removing a file
 * only detaches it, because the same Media row can be used elsewhere.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 16,
    'endLine' => 84,
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
      'IMAGE_TYPES' => 
      array (
        'declaringClassName' => 'App\\Filament\\Forms\\MediaUpload',
        'implementingClassName' => 'App\\Filament\\Forms\\MediaUpload',
        'name' => 'IMAGE_TYPES',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'image/jpeg\', \'image/png\', \'image/webp\', \'image/gif\', \'image/svg+xml\']',
          'attributes' => 
          array (
            'startLine' => 18,
            'endLine' => 18,
            'startTokenPos' => 45,
            'startFilePos' => 494,
            'endTokenPos' => 59,
            'endFilePos' => 564,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 18,
        'endLine' => 18,
        'startColumn' => 5,
        'endColumn' => 103,
      ),
      'AUDIO_TYPES' => 
      array (
        'declaringClassName' => 'App\\Filament\\Forms\\MediaUpload',
        'implementingClassName' => 'App\\Filament\\Forms\\MediaUpload',
        'name' => 'AUDIO_TYPES',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'audio/mpeg\', \'audio/mp3\', \'audio/wav\', \'audio/x-wav\']',
          'attributes' => 
          array (
            'startLine' => 20,
            'endLine' => 20,
            'startTokenPos' => 70,
            'startFilePos' => 599,
            'endTokenPos' => 81,
            'endFilePos' => 653,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 20,
        'endLine' => 20,
        'startColumn' => 5,
        'endColumn' => 87,
      ),
      'IMAGE_MAX_KB' => 
      array (
        'declaringClassName' => 'App\\Filament\\Forms\\MediaUpload',
        'implementingClassName' => 'App\\Filament\\Forms\\MediaUpload',
        'name' => 'IMAGE_MAX_KB',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '10240',
          'attributes' => 
          array (
            'startLine' => 23,
            'endLine' => 23,
            'startTokenPos' => 94,
            'startFilePos' => 742,
            'endTokenPos' => 94,
            'endFilePos' => 747,
          ),
        ),
        'docComment' => '/** Max upload size for images, in kilobytes. */',
        'attributes' => 
        array (
        ),
        'startLine' => 23,
        'endLine' => 23,
        'startColumn' => 5,
        'endColumn' => 39,
      ),
      'AUDIO_MAX_KB' => 
      array (
        'declaringClassName' => 'App\\Filament\\Forms\\MediaUpload',
        'implementingClassName' => 'App\\Filament\\Forms\\MediaUpload',
        'name' => 'AUDIO_MAX_KB',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '51200',
          'attributes' => 
          array (
            'startLine' => 26,
            'endLine' => 26,
            'startTokenPos' => 107,
            'startFilePos' => 842,
            'endTokenPos' => 107,
            'endFilePos' => 847,
          ),
        ),
        'docComment' => '/** Max upload size for audio tracks, in kilobytes. */',
        'attributes' => 
        array (
        ),
        'startLine' => 26,
        'endLine' => 26,
        'startColumn' => 5,
        'endColumn' => 39,
      ),
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'image' => 
      array (
        'name' => 'image',
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
            'startLine' => 28,
            'endLine' => 28,
            'startColumn' => 34,
            'endColumn' => 45,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'directory' => 
          array (
            'name' => 'directory',
            'default' => 
            array (
              'code' => '\'media\'',
              'attributes' => 
              array (
                'startLine' => 28,
                'endLine' => 28,
                'startTokenPos' => 129,
                'startFilePos' => 918,
                'endTokenPos' => 129,
                'endFilePos' => 924,
              ),
            ),
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
            'startLine' => 28,
            'endLine' => 28,
            'startColumn' => 48,
            'endColumn' => 74,
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
            'name' => 'Filament\\Forms\\Components\\FileUpload',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 28,
        'endLine' => 34,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'App\\Filament\\Forms',
        'declaringClassName' => 'App\\Filament\\Forms\\MediaUpload',
        'implementingClassName' => 'App\\Filament\\Forms\\MediaUpload',
        'currentClassName' => 'App\\Filament\\Forms\\MediaUpload',
        'aliasName' => NULL,
      ),
      'gallery' => 
      array (
        'name' => 'gallery',
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
            'startLine' => 36,
            'endLine' => 36,
            'startColumn' => 36,
            'endColumn' => 47,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'directory' => 
          array (
            'name' => 'directory',
            'default' => 
            array (
              'code' => '\'media\'',
              'attributes' => 
              array (
                'startLine' => 36,
                'endLine' => 36,
                'startTokenPos' => 192,
                'startFilePos' => 1182,
                'endTokenPos' => 192,
                'endFilePos' => 1188,
              ),
            ),
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
            'startLine' => 36,
            'endLine' => 36,
            'startColumn' => 50,
            'endColumn' => 76,
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
            'name' => 'Filament\\Forms\\Components\\FileUpload',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 36,
        'endLine' => 42,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'App\\Filament\\Forms',
        'declaringClassName' => 'App\\Filament\\Forms\\MediaUpload',
        'implementingClassName' => 'App\\Filament\\Forms\\MediaUpload',
        'currentClassName' => 'App\\Filament\\Forms\\MediaUpload',
        'aliasName' => NULL,
      ),
      'audio' => 
      array (
        'name' => 'audio',
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
            'startLine' => 44,
            'endLine' => 44,
            'startColumn' => 34,
            'endColumn' => 45,
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
            'name' => 'Filament\\Forms\\Components\\FileUpload',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 44,
        'endLine' => 49,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'App\\Filament\\Forms',
        'declaringClassName' => 'App\\Filament\\Forms\\MediaUpload',
        'implementingClassName' => 'App\\Filament\\Forms\\MediaUpload',
        'currentClassName' => 'App\\Filament\\Forms\\MediaUpload',
        'aliasName' => NULL,
      ),
      'base' => 
      array (
        'name' => 'base',
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
            'startLine' => 51,
            'endLine' => 51,
            'startColumn' => 34,
            'endColumn' => 45,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'directory' => 
          array (
            'name' => 'directory',
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
            'startLine' => 51,
            'endLine' => 51,
            'startColumn' => 48,
            'endColumn' => 64,
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
            'name' => 'Filament\\Forms\\Components\\FileUpload',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 51,
        'endLine' => 71,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 20,
        'namespace' => 'App\\Filament\\Forms',
        'declaringClassName' => 'App\\Filament\\Forms\\MediaUpload',
        'implementingClassName' => 'App\\Filament\\Forms\\MediaUpload',
        'currentClassName' => 'App\\Filament\\Forms\\MediaUpload',
        'aliasName' => NULL,
      ),
      'toIds' => 
      array (
        'name' => 'toIds',
        'parameters' => 
        array (
          'state' => 
          array (
            'name' => 'state',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'mixed',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 76,
            'endLine' => 76,
            'startColumn' => 35,
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
            'name' => 'mixed',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Livewire keeps file state as strings; store real integers.
 */',
        'startLine' => 76,
        'endLine' => 83,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 20,
        'namespace' => 'App\\Filament\\Forms',
        'declaringClassName' => 'App\\Filament\\Forms\\MediaUpload',
        'implementingClassName' => 'App\\Filament\\Forms\\MediaUpload',
        'currentClassName' => 'App\\Filament\\Forms\\MediaUpload',
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