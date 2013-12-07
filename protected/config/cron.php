<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.

//add modules and db file config
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'modules.php');  // $modules
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'db.php');       // $db_config

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'cron',
	// preloading 'log' component
	'preload'=>array('log'),
	// application components
	'components'=>array(
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>$db_config,
		
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
		'example' => array(
			// псевдоним директории, в которую распаковано расширение
			'class' => 'application.cli.commands.ExampleCommand',
		)
	),
);
