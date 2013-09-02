<?php

class AdminModule extends EWebModule
{

	public $defaultController = 'user';


	public function init()
	{
        $this->setImport(array(
            'admin.models.*',
            'admin.components.*',
            'admin.helpers.*',
            'appext.EPhpThumb.EPhpThumb',
        ));

        $this->setComponents(array(
            'errorHandler' => array(
                'errorAction' => 'admin/user/error'),
            'user' => array(
                'class' => 'CWebUser',
                'loginUrl' => Yii::app()->createUrl('admin/user/login'),
                'returnUrl' => Yii::app()->createUrl('admin/start/index'),
            ),
        ));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
            $this->registerBootstrap();
            $this->registerCoreScripts();
            return true;
        }
        return false;
	}

    protected function registerCoreScripts()
    {
        parent::registerCoreScripts();
        Yii::app()->clientScript->registerCssFile($this->getAssetsUrl() . '/css/admin.css');
		Yii::app()->clientScript->registerCssFile($this->getAssetsUrl() . '/css/jquery-ui-bootstrap/custom-theme/jquery-ui-1.9.2.custom.css');
        Yii::app()->clientScript->registerCssFile($this->getAssetsUrl() . '/css/jquery-ui-bootstrap/custom-theme/jquery.ui.1.9.2.ie.css');
        Yii::app()->clientScript->registerCoreScript('jquery.ui');
		Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl() . '/js/knockout.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl() . '/js/magic.js', CClientScript::POS_END);
	}


}
