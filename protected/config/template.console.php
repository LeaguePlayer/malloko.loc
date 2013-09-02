<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'My Console Application',

    // preloading 'log' component
    'preload'=>array('log'),

    // application components
    'components'=>array(
        /*'db'=>array(
            'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
        ),*/
        // uncomment the following to use a MySQL database

        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=abaris',
            'emulatePrepare' => true,
            'username' => 'abaris',
            'password' => 'qwe123',
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
        ),

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
            // псевдоним директории, в которую распаковано расширение
            'class' => 'application.cli.commands.EMigrateCommand',
            // путь для хранения общих миграций
            'migrationPath' => 'application.cli.migrations',
            // имя таблицы с версиями
            'migrationTable' => '{{migration}}',
            // имя псевдомодуля для общих миграций. По умолчанию равно "core".
            'applicationModuleName' => 'core',
            // определяем все модули, для которых нужны миграции
            'modulePaths' => array(
                'email'      => 'application.modules.email.migrations',
                'user'      => 'application.modules.user.migrations',
            ),
            // отключаем некоторые модули
            'disabledModules' => array(
                //'admin', 'anOtherModule', // ...
            ),
            // название компонента для подключения к базе данных
            'connectionID'=>'db',
            // алиас шаблона для новых миграций
            'templateFile'=>'application.cli.migrations.MigrationTemplate',
        )
    ),
);