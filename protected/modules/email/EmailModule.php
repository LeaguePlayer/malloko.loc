<?php

class EmailModule extends EWebModule {

	public $delivery = 'php';
	public $from = null;
    public $defaultConroller = 'template';

	public function init() {
		$this->setImport(array(
			'email.models.*',
			'email.components.*',
		));
	}

    public function beforeControllerAction($controller, $action)
    {
        if(parent::beforeControllerAction($controller, $action))
        {
            Yii::app()->user->setStateKeyPrefix('_email');
            $this->registerBootstrap();
            $this->registerCoreScripts();
            return true;
        }
        else
            return false;
    }
}
