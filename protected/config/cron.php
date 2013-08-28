<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
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
		'testevents' => array(
			// псевдоним директории, в которую распаковано расширение
			'class' => 'application.cli.commands.ExampleCommand',
		)
	),
);
