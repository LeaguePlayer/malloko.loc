<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'My Console Application',

    // preloading 'log' component
    'preload'=>array('log'),

    'import'=>array(
        'application.models.*',
        'application.components.*',
        //'application.behaviors.*',
    ),

    // application components
    'components'=>array(
        /*'db'=>array(
            'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
        ),*/
        // uncomment the following to use a MySQL database

        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=yii_magic_box',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'root',
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
         'clientScript'=>array(
            'class'=>'EClientScript',
            'scriptMap'=>array(
                //'jquery.min.js'=>'//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js',
            ),
        ),
    ),
    'modules'=>array(
        'user'=>array(
            # encrypting method (php hash function)
            'hash' => 'md5',
 
            # send activation email
            'sendActivationMail' => true,
 
            # allow access for non-activated users
            'loginNotActiv' => false,
 
            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => false,
 
            # automatically login from registration
            'autoLogin' => true,
 
            # registration path
            'registrationUrl' => array('/user/registration'),
 
            # recovery password path
            'recoveryUrl' => array('/user/recovery'),
 
            # login form path
            'loginUrl' => array('/user/login'),
 
            # page after login
            'returnUrl' => array('/user/profile'),
 
            # page after logout
            'returnLogoutUrl' => array('/user/login'),
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
                'auth' => 'application.modules.auth.migrations'
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