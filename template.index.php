<?php

$yii=dirname(__FILE__).'/../../framework/yii.php';
$params = (file_exists(__DIR__ . '/protected/config/params.php') ? require(__DIR__ . '/protected/config/params.php') : array());
$config = dirname(__FILE__).'/protected/config/main.php';

defined('YII_DEBUG') or define('YII_DEBUG',$params['yii.debug']);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',$params['yii.trace_level']);

require_once($yii);
Yii::createWebApplication($config)->run();
