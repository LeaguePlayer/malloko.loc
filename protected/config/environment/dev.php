<?php

return array(
    'modules'=>array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'qwe123',
            'ipFilters'=>array('127.0.0.1','::1'),
            'generatorPaths'=>array(
                'application.gii',
            ),
        ),
    ),
    'components' => array(
		'clientScript'=>array(
			'scriptMap'=>array(
				'jquery.js'=>'/lib/jquery/jquery.js',
				'jquery.min.js'=>'/lib/jquery/jquery.min.js',
			),
		),
		'db'=>array(
			'enableProfiling'=>true,
			'enableParamLogging' => true,
		),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
				array(
					'class'=>'application.extensions.yii-debug-toolbar.YiiDebugToolbarRoute',
					'ipFilters'=>array('127.0.0.1'),
				),
//                array(
//                    'class'=>'CWebLogRoute',
//                    'levels'=>'error, warning, trace, profile, info',
//                    'enabled'=>true,
//                ),
            ),
        ),
    ),
);
