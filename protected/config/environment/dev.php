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
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
                array(
                    'class'=>'CWebLogRoute',
                    'levels'=>'error, warning, trace, profile, info',
                    'enabled'=>true,
                ),
            ),
        ),
    ),
);
