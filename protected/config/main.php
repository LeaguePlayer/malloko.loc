<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

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
		'application.modules.admin.behaviors.*',
	),
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'qwe123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths'=>array(
                //'bootstrap.gii',
				'application.gii',
            ),
			'import' => array(
				'admin.extensions.imagesgallery.GalleryBehavior',
			),
		),
		'admin'=>array(
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'bootstrap'=>array(
            'class'=>'admin_ext.yiistrap.components.TbApi',
        ),
		'yiiwheels' => array(
			'class' => 'yiiwheels.YiiWheels',
		),
        'phpThumb'=>array(
		    'class'=>'admin_ext.EPhpThumb.EPhpThumb',
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
		'date' => array(
			'class'=>'application.components.Date',
			//And integer that holds the offset of hours from GMT e.g. 4 for GMT +4
			'offset' => 0,
		),
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
		'errorHandler'=>array(
			// use 'site/error' action to display errors
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