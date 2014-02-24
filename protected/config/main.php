<?php

// Настройки, специфичные для данной машины (например, БД), рекомендуется поместить в overrides/local.php

return array_replace_recursive(
    array(
        'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'name'=>'Каркас приложения',
        'language' => 'ru',
        'theme'=>'default',
        // preloading 'log' component
        'preload'=>array('log'),
        // autoloading model and component classes
        'import'=>array(
            'application.models.*',
            'application.components.*',
            //'application.behaviors.*',
        ),
        'aliases'=>array(
            'appext'=>'application.extensions',
        ),
        'modules'=>array(
            'admin'=>array(),
            'email'=>array(),
            'auth'=>array(),
            'user'=>array(
                'hash' => 'md5',
                'sendActivationMail' => true,
                'loginNotActiv' => false,
                'activeAfterRegister' => false,
                'autoLogin' => true,
                'registrationUrl' => array('/user/registration'),
                'recoveryUrl' => array('/user/recovery'),
                'loginUrl' => array('/user/login'),
                'returnUrl' => array('/user/profile'),
                'returnLogoutUrl' => array('/user/login'),
            ),
        ),
        // application components
        'components'=>array(
//            'db' => array(
//                'connectionString' => 'mysql:host=localhost;dbname=yii_magic_box',
//                'emulatePrepare' => true,
//                'username' => 'root',
//                'password' => 'root',
//                'charset' => 'utf8',
//                'tablePrefix' => 'tbl_',
//            ),
            'authManager' => array(
                'class' => 'CDbAuthManager',// 'auth.components.CachedDbAuthManager',
                //'cachingDuration' => 0,
                'itemTable' => '{{authitem}}',
                'itemChildTable' => '{{authitemchild}}',
                'assignmentTable' => '{{authassignment}}',
                'behaviors' => array(
                    'auth' => array(
                        'class' => 'auth.components.AuthBehavior',
                    ),
                ),
            ),
            'user'=>array(
                'class' => 'user.components.WebUser',
            ),
            'bootstrap'=>array(
                'class'=>'appext.yiistrap.components.TbApi',
            ),
            'yiiwheels' => array(
                'class' => 'appext.yiiwheels.YiiWheels',
            ),
            'phpThumb'=>array(
                'class'=>'appext.EPhpThumb.EPhpThumb',
                'options'=>array()
            ),
            // uncomment the following to enable URLs in path-format
            'urlManager'=>array(
                'showScriptName'=>false,
                'urlFormat'=>'path',
                'rules'=>array(
                    'gii'=>'gii',
                    'admin'=>'admin/start/index',
                    '<controller:\w+>'=>'<controller>/index',
                    '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                ),
            ),
            'clientScript'=>array(
                'class'=>'EClientScript',
                'scriptMap'=>array(
                    //'jquery.min.js'=>'//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js',
                ),
            ),
            'date' => array(
                'class'=>'application.components.Date',
                //And integer that holds the offset of hours from GMT e.g. 4 for GMT +4
                'offset' => 0,
            ),
            'errorHandler'=>array(
                'errorAction'=>'site/error',
            ),
        ),
        'params'=>array(),
    ),
    (file_exists(__DIR__ . '/overrides/environment.php') ? require(__DIR__ . '/overrides/environment.php') : array()),
    (file_exists(__DIR__ . '/overrides/local.php') ? require(__DIR__ . '/overrides/local.php') : array())
);