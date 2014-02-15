<?php

return array(
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
    // application components
    'components'=>array(
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
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
                /*array(
                    'class'=>'CWebLogRoute',
                    'levels'=>'error, warning, trace, profile, info',
                    'enabled'=>true,
                ),*/
            ),
        ),
    ),
    'params'=>array(),
);