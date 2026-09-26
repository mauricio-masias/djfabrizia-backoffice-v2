<?php declare(strict_types = 1);

// ftm-/var/www/vendor/filament/filament/src/Resources/Pages/CreateRecord.php
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v6-2.3.5',
   'data' => 
  array (
    0 => 
    array (
      'aeff02747966cca72fd29e1c62a72753' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => NULL,
         'templatePhpDocNodes' => 
        array (
          'TModel' => 
          array (
            0 => '@template',
            1 => 
            \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
               'name' => 'TModel',
               'bound' => 
              \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                 'name' => 'Model',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
               'default' => 
              \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                 'name' => 'Model',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
               'lowerBound' => NULL,
               'description' => '',
               'attributes' => 
              array (
                'startLine' => 2,
                'endLine' => 2,
              ),
            )),
          ),
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '8f07e1d05460cf20787f6baab7454ab8' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Pages\\Concerns',
         'uses' => 
        array (
          'closure' => 'Closure',
          'filament' => 'Filament\\Facades\\Filament',
          'db' => 'Illuminate\\Support\\Facades\\DB',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => NULL,
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
         'traitData' => 
        array (
          0 => '/var/www/vendor/filament/filament/src/Resources/Pages/CreateRecord.php',
          1 => 'Filament\\Resources\\Pages\\CreateRecord',
          2 => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '26b1d1a0bbb1eafd1efb870b7f341f86' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Pages\\Concerns',
         'uses' => 
        array (
          'closure' => 'Closure',
          'filament' => 'Filament\\Facades\\Filament',
          'db' => 'Illuminate\\Support\\Facades\\DB',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'hasDatabaseTransactions',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
         'traitData' => 
        array (
          0 => '/var/www/vendor/filament/filament/src/Resources/Pages/CreateRecord.php',
          1 => 'Filament\\Resources\\Pages\\CreateRecord',
          2 => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      'f4a99717c37a6422b907d1dd14fa11ad' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Pages\\Concerns',
         'uses' => 
        array (
          'closure' => 'Closure',
          'filament' => 'Filament\\Facades\\Filament',
          'db' => 'Illuminate\\Support\\Facades\\DB',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'beginDatabaseTransaction',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
         'traitData' => 
        array (
          0 => '/var/www/vendor/filament/filament/src/Resources/Pages/CreateRecord.php',
          1 => 'Filament\\Resources\\Pages\\CreateRecord',
          2 => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '8ecea9fb6581fb27e682d320499c8c94' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Pages\\Concerns',
         'uses' => 
        array (
          'closure' => 'Closure',
          'filament' => 'Filament\\Facades\\Filament',
          'db' => 'Illuminate\\Support\\Facades\\DB',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'commitDatabaseTransaction',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
         'traitData' => 
        array (
          0 => '/var/www/vendor/filament/filament/src/Resources/Pages/CreateRecord.php',
          1 => 'Filament\\Resources\\Pages\\CreateRecord',
          2 => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '9d05471698bba1cd1d415b1459a55f2d' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Pages\\Concerns',
         'uses' => 
        array (
          'closure' => 'Closure',
          'filament' => 'Filament\\Facades\\Filament',
          'db' => 'Illuminate\\Support\\Facades\\DB',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'rollBackDatabaseTransaction',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
         'traitData' => 
        array (
          0 => '/var/www/vendor/filament/filament/src/Resources/Pages/CreateRecord.php',
          1 => 'Filament\\Resources\\Pages\\CreateRecord',
          2 => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      'ce2681241d581df8ca6bd9f5a5564165' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Pages\\Concerns',
         'uses' => 
        array (
          'closure' => 'Closure',
          'filament' => 'Filament\\Facades\\Filament',
          'db' => 'Illuminate\\Support\\Facades\\DB',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'wrapInDatabaseTransaction',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
         'traitData' => 
        array (
          0 => '/var/www/vendor/filament/filament/src/Resources/Pages/CreateRecord.php',
          1 => 'Filament\\Resources\\Pages\\CreateRecord',
          2 => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      'a8d6e8477bd56ce0cb2680d9529be2c0' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Pages\\Concerns',
         'uses' => 
        array (
          'filament' => 'Filament\\Facades\\Filament',
          'locked' => 'Livewire\\Attributes\\Locked',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => NULL,
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
         'traitData' => 
        array (
          0 => '/var/www/vendor/filament/filament/src/Resources/Pages/CreateRecord.php',
          1 => 'Filament\\Resources\\Pages\\CreateRecord',
          2 => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '344ea5ca37a881df126b674b676e3836' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Pages\\Concerns',
         'uses' => 
        array (
          'filament' => 'Filament\\Facades\\Filament',
          'locked' => 'Livewire\\Attributes\\Locked',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'mountHasUnsavedDataChangesAlert',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
         'traitData' => 
        array (
          0 => '/var/www/vendor/filament/filament/src/Resources/Pages/CreateRecord.php',
          1 => 'Filament\\Resources\\Pages\\CreateRecord',
          2 => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '650f5179c76056e294234d6790db7c46' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Pages\\Concerns',
         'uses' => 
        array (
          'filament' => 'Filament\\Facades\\Filament',
          'locked' => 'Livewire\\Attributes\\Locked',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'rememberData',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
         'traitData' => 
        array (
          0 => '/var/www/vendor/filament/filament/src/Resources/Pages/CreateRecord.php',
          1 => 'Filament\\Resources\\Pages\\CreateRecord',
          2 => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          3 => NULL,
          4 => NULL,
        ),
      )),
      'd0385533e908d2020321986211ff7595' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Pages\\Concerns',
         'uses' => 
        array (
          'filament' => 'Filament\\Facades\\Filament',
          'locked' => 'Livewire\\Attributes\\Locked',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'hasUnsavedDataChangesAlert',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
         'traitData' => 
        array (
          0 => '/var/www/vendor/filament/filament/src/Resources/Pages/CreateRecord.php',
          1 => 'Filament\\Resources\\Pages\\CreateRecord',
          2 => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '62135955fa3663468cd4ed6e8d1166d7' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'getBreadcrumb',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'caba47040d95f4b3e01c00c80c808d19' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'mount',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'c16cb215c7cc87ddbc3688e05d9ae959' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'authorizeAccess',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '20707ffc6442378cc39344f9a0ce446e' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'hydrate',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'f84f045ee1250d66f2e19f6285a5d144' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'fillForm',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'c6d1572375148c148741190dad482d20' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'create',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'cb5ea0a5cdf447fb57699abc558cafba' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'preserveFormDataWhenCreatingAnother',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '35a3c2cede0c5c8faae6b0a4540e9776' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'getCreatedNotification',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '62190424efd68e4f4d4f186ff1842829' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'getCreatedNotificationTitle',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'a29496fff1d2370c7dc6f2df4874cee0' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'getCreatedNotificationMessage',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '67f9255ea887bafbfc8f78f5ee812d60' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'createAnother',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '93d870ad2eb7ce3e5fe168093d22e68a' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'handleRecordCreation',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '3fd9ea46160be5c90f6b22ffbf2120c9' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'associateRecordWithParent',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'fe6aea46d6322fb84c1da3aa3c59707c' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'mutateFormDataBeforeCreate',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'ffc0e54d553e5067643c0b36b32f4c8e' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'getFormActions',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '906ef47b5b7ffe97d2dd32d8d07c9182' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'getCreateFormAction',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'd3f8b2c241b06e4e251c1928eb0b44c2' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'getSubmitFormAction',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '55d017364a7e04cb9a375114306a9c9f' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'getSubmitFormLivewireMethodName',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '292f8127cccda83f80b0543e0e3a0129' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'getCreateAnotherFormAction',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'fa4db0591ae1568345ad7e69740d9685' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'getCancelFormAction',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'beb0acf59fcf39b6c9bb9c25d34353c6' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'getTitle',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '6cd37e1e5698bd9dee62b4adeabcf729' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'defaultForm',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '0eaf2c9da957f2c88207600846669b43' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'form',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '0c6be4de955c686d02ccc9c69d5632aa' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'getRedirectUrl',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '8d7f26abe6b28060994da260fbaf8b66' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'getRedirectUrlParameters',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'd7509a79eaad66b8fef999833b5ce607' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'getMountedActionSchemaModel',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'b6b0db53e04d2c09e2e1cab36d5a490a' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'canCreateAnother',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'b58a6aca29b7c80ef08080863bacaa9f' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'disableCreateAnother',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'e1b677eb32e0803395347e4766e6b730' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'getRecord',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'e11c3b61856a7e88943ffb3cf9b844a2' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'content',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '9b3417d98a445210200d6f6c37abb809' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'getFormContentComponent',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '279a3cacc3e1bba955c3355b9b2476ee' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'getFormActionsContentComponent',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '0275c3b2445d7080ecf8cce8d18042fd' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'hasFormWrapper',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '8fe4f6756a29b3112615f8b8b1efec5b' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'getPageClasses',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '618b95a9ca7e59fc19c62f7195e62842' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Filament\\Resources\\Pages',
         'uses' => 
        array (
          'action' => 'Filament\\Actions\\Action',
          'actiongroup' => 'Filament\\Actions\\ActionGroup',
          'filament' => 'Filament\\Facades\\Filament',
          'notification' => 'Filament\\Notifications\\Notification',
          'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
          'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
          'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
          'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
          'actions' => 'Filament\\Schemas\\Components\\Actions',
          'component' => 'Filament\\Schemas\\Components\\Component',
          'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
          'form' => 'Filament\\Schemas\\Components\\Form',
          'group' => 'Filament\\Schemas\\Components\\Group',
          'schema' => 'Filament\\Schemas\\Schema',
          'halt' => 'Filament\\Support\\Exceptions\\Halt',
          'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
          'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'event' => 'Illuminate\\Support\\Facades\\Event',
          'js' => 'Illuminate\\Support\\Js',
          'throwable' => 'Throwable',
        ),
         'className' => 'Filament\\Resources\\Pages\\CreateRecord',
         'functionName' => 'hasFullWidthFormActions',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Filament\\Resources\\Pages',
           'uses' => 
          array (
            'action' => 'Filament\\Actions\\Action',
            'actiongroup' => 'Filament\\Actions\\ActionGroup',
            'filament' => 'Filament\\Facades\\Filament',
            'notification' => 'Filament\\Notifications\\Notification',
            'canusedatabasetransactions' => 'Filament\\Pages\\Concerns\\CanUseDatabaseTransactions',
            'hasunsaveddatachangesalert' => 'Filament\\Pages\\Concerns\\HasUnsavedDataChangesAlert',
            'recordcreated' => 'Filament\\Resources\\Events\\RecordCreated',
            'recordsaved' => 'Filament\\Resources\\Events\\RecordSaved',
            'actions' => 'Filament\\Schemas\\Components\\Actions',
            'component' => 'Filament\\Schemas\\Components\\Component',
            'embeddedschema' => 'Filament\\Schemas\\Components\\EmbeddedSchema',
            'form' => 'Filament\\Schemas\\Components\\Form',
            'group' => 'Filament\\Schemas\\Components\\Group',
            'schema' => 'Filament\\Schemas\\Schema',
            'halt' => 'Filament\\Support\\Exceptions\\Halt',
            'filamentview' => 'Filament\\Support\\Facades\\FilamentView',
            'htmlable' => 'Illuminate\\Contracts\\Support\\Htmlable',
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'event' => 'Illuminate\\Support\\Facades\\Event',
            'js' => 'Illuminate\\Support\\Js',
            'throwable' => 'Throwable',
          ),
           'className' => 'Filament\\Resources\\Pages\\CreateRecord',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
            'TModel' => 
            array (
              0 => '@template',
              1 => 
              \PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode::__set_state(array(
                 'name' => 'TModel',
                 'bound' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'default' => 
                \PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode::__set_state(array(
                   'name' => 'Model',
                   'attributes' => 
                  array (
                    'startLine' => 2,
                    'endLine' => 2,
                  ),
                )),
                 'lowerBound' => NULL,
                 'description' => '',
                 'attributes' => 
                array (
                  'startLine' => 2,
                  'endLine' => 2,
                ),
              )),
            ),
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
    ),
    1 => 
    array (
      '/var/www/vendor/filament/filament/src/Resources/Pages/CreateRecord.php' => 'a2b10956d7973d0beeb73e3bfa396dcfb3d486a1d89e417574675cee360a11ae',
      '/var/www/vendor/composer/../filament/filament/src/Pages/Concerns/CanUseDatabaseTransactions.php' => '5c27fb508b106a7faaee445dc3a2abeddbd328e9931c5dff43b5ed2643c53b8c',
      '/var/www/vendor/composer/../filament/filament/src/Pages/Concerns/HasUnsavedDataChangesAlert.php' => 'fdf9d481452753e6abf271d5ef7d0a07fbb2ea35b3e8383bed3b7712d0b5f78e',
    ),
  ),
));