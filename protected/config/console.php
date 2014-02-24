<?php

return array_replace_recursive(
    array(
        'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'name'=>'Консоль',
        // preloading 'log' component
        'preload'=>array('log'),
        // application components
        'components'=>array(
            'log'=>array(
                'class'=>'CLogRouter',
                'routes'=>array(
                    array(
                        'class'=>'CFileLogRoute',
                        'levels'=>'error, warning',
                    ),
                ),
            ),
        ),
        'commandMap' => array(
            'migrate' => array(
                'class' => 'application.cli.commands.EMigrateCommand',
                'migrationPath' => 'application.cli.migrations',
                'migrationTable' => '{{migration}}',
                // имя псевдомодуля для общих миграций. По умолчанию равно "core".
                'applicationModuleName' => 'core',
                // определяем все модули, для которых нужны миграции
                'modulePaths' => array(
                    'email'   => 'application.modules.email.migrations',
                    'user'    => 'application.modules.user.migrations',
                    'auth'    => 'application.modules.auth.migrations'
                ),
                // отключаем некоторые модули
                'disabledModules' => array(
                    //'admin', 'anOtherModule', // ...
                ),
                // название компонента для подключения к базе данных
                'connectionID'=>'db',
                // алиас шаблона для новых миграций
                'templateFile'=>'application.cli.migrations.MigrationTemplate',
            ),
            'env' => array(
                'class' => 'application.cli.commands.EnvironmentCommand',
            ),
        ),
    ),
//    (file_exists(__DIR__ . '/overrides/environment.php') ? require(__DIR__ . '/overrides/environment.php') : array()),
    (file_exists(__DIR__ . '/overrides/local.php') ? require(__DIR__ . '/overrides/local.php') : array())
);