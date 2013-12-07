<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

//add modules and db file config
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'modules.php');  // $modules
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'db.php');       // $db_config

return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Новый сайт',
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
    'modules'=>$modules,

    // application components
    'components'=>array(
        'cart' => array(
            'class' => 'appext.shoppingCart.EShoppingCart',
            'onUpdatePosition' => array('CartNotifer', 'updatePosition'),
            'onRemovePosition' => array('CartNotifer', 'removePosition'),
            'discounts' => array(
                array(
                    'class' => 'appext.shoppingCart.discounts.TestDiscount',
                ),
            ),
        ),
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
        'db' => $db_config,
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

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(),
);