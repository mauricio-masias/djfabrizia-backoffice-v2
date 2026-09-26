<?php declare(strict_types = 1);

// osfsl-/var/www/vendor/composer/../filament/forms/src/Components/ToggleButtons.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Filament\Forms\Components\ToggleButtons
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-b5e39093a6408a5200b9fcdd013c3ceb44c357ad39d49dde37fc6233847017bb-8.4.26-6.73.0.5',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Filament\\Forms\\Components\\ToggleButtons',
        'filename' => '/var/www/vendor/composer/../filament/forms/src/Components/ToggleButtons.php',
      ),
    ),
    'namespace' => 'Filament\\Forms\\Components',
    'name' => 'Filament\\Forms\\Components\\ToggleButtons',
    'shortName' => 'ToggleButtons',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 24,
    'endLine' => 364,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Filament\\Forms\\Components\\Field',
    'implementsClassNames' => 
    array (
      0 => 'Filament\\Forms\\Components\\Contracts\\CanDisableOptions',
      1 => 'Filament\\Support\\Components\\Contracts\\HasEmbeddedView',
    ),
    'traitClassNames' => 
    array (
      0 => 'Filament\\Forms\\Components\\Concerns\\CanDisableOptions',
      1 => 'Filament\\Forms\\Components\\Concerns\\CanDisableOptionsWhenSelectedInSiblingRepeaterItems',
      2 => 'Filament\\Forms\\Components\\Concerns\\CanFixIndistinctState',
      3 => 'Filament\\Forms\\Components\\Concerns\\HasColors',
      4 => 'Filament\\Forms\\Components\\Concerns\\HasExtraInputAttributes',
      5 => 'Filament\\Forms\\Components\\Concerns\\HasGridDirection',
      6 => 'Filament\\Forms\\Components\\Concerns\\HasIcons',
      7 => 'Filament\\Forms\\Components\\Concerns\\HasNestedRecursiveValidationRules',
      8 => 'Filament\\Forms\\Components\\Concerns\\HasOptions',
      9 => 'Filament\\Forms\\Components\\Concerns\\HasTooltips',
    ),
    'immediateConstants' => 
    array (
      'GROUPED_VIEW' => 
      array (
        'declaringClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'implementingClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'name' => 'GROUPED_VIEW',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'filament-forms::components.toggle-buttons.grouped\'',
          'attributes' => 
          array (
            'startLine' => 37,
            'endLine' => 37,
            'startTokenPos' => 173,
            'startFilePos' => 1423,
            'endTokenPos' => 173,
            'endFilePos' => 1473,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 37,
        'endLine' => 37,
        'startColumn' => 5,
        'endColumn' => 84,
      ),
    ),
    'immediateProperties' => 
    array (
      'isMultiple' => 
      array (
        'declaringClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'implementingClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'name' => 'isMultiple',
        'modifiers' => 2,
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
                  'name' => 'bool',
                  'isIdentifier' => true,
                ),
              ),
              1 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'Closure',
                  'isIdentifier' => false,
                ),
              ),
            ),
          ),
        ),
        'default' => 
        array (
          'code' => 'false',
          'attributes' => 
          array (
            'startLine' => 39,
            'endLine' => 39,
            'startTokenPos' => 188,
            'startFilePos' => 1520,
            'endTokenPos' => 188,
            'endFilePos' => 1524,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 39,
        'endLine' => 39,
        'startColumn' => 5,
        'endColumn' => 49,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'isInline' => 
      array (
        'declaringClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'implementingClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'name' => 'isInline',
        'modifiers' => 2,
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
                  'name' => 'bool',
                  'isIdentifier' => true,
                ),
              ),
              1 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'Closure',
                  'isIdentifier' => false,
                ),
              ),
            ),
          ),
        ),
        'default' => 
        array (
          'code' => 'false',
          'attributes' => 
          array (
            'startLine' => 41,
            'endLine' => 41,
            'startTokenPos' => 203,
            'startFilePos' => 1569,
            'endTokenPos' => 203,
            'endFilePos' => 1573,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 41,
        'endLine' => 41,
        'startColumn' => 5,
        'endColumn' => 47,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'isGrouped' => 
      array (
        'declaringClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'implementingClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'name' => 'isGrouped',
        'modifiers' => 2,
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
                  'name' => 'bool',
                  'isIdentifier' => true,
                ),
              ),
              1 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'Closure',
                  'isIdentifier' => false,
                ),
              ),
            ),
          ),
        ),
        'default' => 
        array (
          'code' => 'false',
          'attributes' => 
          array (
            'startLine' => 43,
            'endLine' => 43,
            'startTokenPos' => 218,
            'startFilePos' => 1619,
            'endTokenPos' => 218,
            'endFilePos' => 1623,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 43,
        'endLine' => 43,
        'startColumn' => 5,
        'endColumn' => 48,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'areButtonLabelsHidden' => 
      array (
        'declaringClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'implementingClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'name' => 'areButtonLabelsHidden',
        'modifiers' => 2,
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
                  'name' => 'bool',
                  'isIdentifier' => true,
                ),
              ),
              1 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'Closure',
                  'isIdentifier' => false,
                ),
              ),
            ),
          ),
        ),
        'default' => 
        array (
          'code' => 'false',
          'attributes' => 
          array (
            'startLine' => 45,
            'endLine' => 45,
            'startTokenPos' => 233,
            'startFilePos' => 1681,
            'endTokenPos' => 233,
            'endFilePos' => 1685,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 45,
        'endLine' => 45,
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
      'grouped' => 
      array (
        'name' => 'grouped',
        'parameters' => 
        array (
          'condition' => 
          array (
            'name' => 'condition',
            'default' => 
            array (
              'code' => 'true',
              'attributes' => 
              array (
                'startLine' => 47,
                'endLine' => 47,
                'startTokenPos' => 252,
                'startFilePos' => 1745,
                'endTokenPos' => 252,
                'endFilePos' => 1748,
              ),
            ),
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
                      'name' => 'bool',
                      'isIdentifier' => true,
                    ),
                  ),
                  1 => 
                  array (
                    'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                    'data' => 
                    array (
                      'name' => 'Closure',
                      'isIdentifier' => false,
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
            'startLine' => 47,
            'endLine' => 47,
            'startColumn' => 29,
            'endColumn' => 60,
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
            'name' => 'static',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 47,
        'endLine' => 52,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Filament\\Forms\\Components',
        'declaringClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'implementingClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'currentClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'aliasName' => NULL,
      ),
      'isGrouped' => 
      array (
        'name' => 'isGrouped',
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
        'startLine' => 54,
        'endLine' => 57,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Filament\\Forms\\Components',
        'declaringClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'implementingClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'currentClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'aliasName' => NULL,
      ),
      'getPublishedViewOverrideCheckPath' => 
      array (
        'name' => 'getPublishedViewOverrideCheckPath',
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
        'docComment' => NULL,
        'startLine' => 59,
        'endLine' => 66,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Filament\\Forms\\Components',
        'declaringClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'implementingClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'currentClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'aliasName' => NULL,
      ),
      'toEmbeddedHtml' => 
      array (
        'name' => 'toEmbeddedHtml',
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
        'startLine' => 68,
        'endLine' => 163,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Filament\\Forms\\Components',
        'declaringClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'implementingClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'currentClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'aliasName' => NULL,
      ),
      'toGroupedEmbeddedHtml' => 
      array (
        'name' => 'toGroupedEmbeddedHtml',
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
        'startLine' => 165,
        'endLine' => 240,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Filament\\Forms\\Components',
        'declaringClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'implementingClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'currentClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'aliasName' => NULL,
      ),
      'boolean' => 
      array (
        'name' => 'boolean',
        'parameters' => 
        array (
          'trueLabel' => 
          array (
            'name' => 'trueLabel',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 242,
                'endLine' => 242,
                'startTokenPos' => 1824,
                'startFilePos' => 9892,
                'endTokenPos' => 1824,
                'endFilePos' => 9895,
              ),
            ),
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
                      'name' => 'null',
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
            'startLine' => 242,
            'endLine' => 242,
            'startColumn' => 29,
            'endColumn' => 53,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
          'falseLabel' => 
          array (
            'name' => 'falseLabel',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 242,
                'endLine' => 242,
                'startTokenPos' => 1834,
                'startFilePos' => 9920,
                'endTokenPos' => 1834,
                'endFilePos' => 9923,
              ),
            ),
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
                      'name' => 'null',
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
            'startLine' => 242,
            'endLine' => 242,
            'startColumn' => 56,
            'endColumn' => 81,
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
        'docComment' => NULL,
        'startLine' => 242,
        'endLine' => 262,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Filament\\Forms\\Components',
        'declaringClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'implementingClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'currentClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'aliasName' => NULL,
      ),
      'inline' => 
      array (
        'name' => 'inline',
        'parameters' => 
        array (
          'condition' => 
          array (
            'name' => 'condition',
            'default' => 
            array (
              'code' => 'true',
              'attributes' => 
              array (
                'startLine' => 264,
                'endLine' => 264,
                'startTokenPos' => 1999,
                'startFilePos' => 10693,
                'endTokenPos' => 1999,
                'endFilePos' => 10696,
              ),
            ),
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
                      'name' => 'bool',
                      'isIdentifier' => true,
                    ),
                  ),
                  1 => 
                  array (
                    'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                    'data' => 
                    array (
                      'name' => 'Closure',
                      'isIdentifier' => false,
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
            'startLine' => 264,
            'endLine' => 264,
            'startColumn' => 28,
            'endColumn' => 59,
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
            'name' => 'static',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 264,
        'endLine' => 269,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Filament\\Forms\\Components',
        'declaringClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'implementingClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'currentClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'aliasName' => NULL,
      ),
      'isInline' => 
      array (
        'name' => 'isInline',
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
        'startLine' => 271,
        'endLine' => 274,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Filament\\Forms\\Components',
        'declaringClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'implementingClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'currentClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'aliasName' => NULL,
      ),
      'hiddenButtonLabels' => 
      array (
        'name' => 'hiddenButtonLabels',
        'parameters' => 
        array (
          'condition' => 
          array (
            'name' => 'condition',
            'default' => 
            array (
              'code' => 'true',
              'attributes' => 
              array (
                'startLine' => 276,
                'endLine' => 276,
                'startTokenPos' => 2068,
                'startFilePos' => 10954,
                'endTokenPos' => 2068,
                'endFilePos' => 10957,
              ),
            ),
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
                      'name' => 'bool',
                      'isIdentifier' => true,
                    ),
                  ),
                  1 => 
                  array (
                    'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                    'data' => 
                    array (
                      'name' => 'Closure',
                      'isIdentifier' => false,
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
            'startLine' => 276,
            'endLine' => 276,
            'startColumn' => 40,
            'endColumn' => 71,
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
            'name' => 'static',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 276,
        'endLine' => 281,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Filament\\Forms\\Components',
        'declaringClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'implementingClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'currentClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'aliasName' => NULL,
      ),
      'areButtonLabelsHidden' => 
      array (
        'name' => 'areButtonLabelsHidden',
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
        'startLine' => 283,
        'endLine' => 286,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Filament\\Forms\\Components',
        'declaringClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'implementingClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'currentClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'aliasName' => NULL,
      ),
      'multiple' => 
      array (
        'name' => 'multiple',
        'parameters' => 
        array (
          'condition' => 
          array (
            'name' => 'condition',
            'default' => 
            array (
              'code' => 'true',
              'attributes' => 
              array (
                'startLine' => 288,
                'endLine' => 288,
                'startTokenPos' => 2137,
                'startFilePos' => 11244,
                'endTokenPos' => 2137,
                'endFilePos' => 11247,
              ),
            ),
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
                      'name' => 'bool',
                      'isIdentifier' => true,
                    ),
                  ),
                  1 => 
                  array (
                    'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                    'data' => 
                    array (
                      'name' => 'Closure',
                      'isIdentifier' => false,
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
            'startLine' => 288,
            'endLine' => 288,
            'startColumn' => 30,
            'endColumn' => 61,
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
            'name' => 'static',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 288,
        'endLine' => 293,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Filament\\Forms\\Components',
        'declaringClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'implementingClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'currentClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'aliasName' => NULL,
      ),
      'isMultiple' => 
      array (
        'name' => 'isMultiple',
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
        'startLine' => 295,
        'endLine' => 298,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Filament\\Forms\\Components',
        'declaringClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'implementingClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'currentClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'aliasName' => NULL,
      ),
      'getDefaultState' => 
      array (
        'name' => 'getDefaultState',
        'parameters' => 
        array (
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
        'docComment' => NULL,
        'startLine' => 300,
        'endLine' => 309,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Filament\\Forms\\Components',
        'declaringClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'implementingClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'currentClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'aliasName' => NULL,
      ),
      'getEnumDefaultStateCast' => 
      array (
        'name' => 'getEnumDefaultStateCast',
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
                  'name' => 'Filament\\Schemas\\Components\\StateCasts\\Contracts\\StateCast',
                  'isIdentifier' => false,
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
        'startLine' => 311,
        'endLine' => 323,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Filament\\Forms\\Components',
        'declaringClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'implementingClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'currentClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'aliasName' => NULL,
      ),
      'getDefaultStateCasts' => 
      array (
        'name' => 'getDefaultStateCasts',
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
 * @return array<StateCast>
 */',
        'startLine' => 328,
        'endLine' => 339,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Filament\\Forms\\Components',
        'declaringClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'implementingClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'currentClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'aliasName' => NULL,
      ),
      'getInValidationRuleValues' => 
      array (
        'name' => 'getInValidationRuleValues',
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
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @return ?array<string>
 */',
        'startLine' => 344,
        'endLine' => 353,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Filament\\Forms\\Components',
        'declaringClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'implementingClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'currentClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'aliasName' => NULL,
      ),
      'hasInValidationOnMultipleValues' => 
      array (
        'name' => 'hasInValidationOnMultipleValues',
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
        'startLine' => 355,
        'endLine' => 358,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Filament\\Forms\\Components',
        'declaringClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'implementingClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'currentClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'aliasName' => NULL,
      ),
      'hasNullableBooleanState' => 
      array (
        'name' => 'hasNullableBooleanState',
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
        'startLine' => 360,
        'endLine' => 363,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Filament\\Forms\\Components',
        'declaringClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'implementingClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
        'currentClassName' => 'Filament\\Forms\\Components\\ToggleButtons',
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