<?php

class AdminModule extends CWebModule
{

	public $defaultController = 'user';

	protected $forceCopyAssets = true;
	protected $assetsUrl;

	public function preinit()
    {
        //Yii::setPathOfAlias('bootstrap', 'protected/modules/admin/extensions/yiistrap');

        // Reset the front-end's client script because we don't want
        // both front-end styles being applied in this module.
        Yii::app()->clientScript->reset();
    }

	public function init()
	{
		Yii::setPathOfAlias('admin_ext', dirname(__FILE__).'/extensions');
		Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/extensions/yiistrap');
		Yii::setPathOfAlias('yiiwheels', dirname(__FILE__).'/extensions/yiiwheels');
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
            'admin.helpers.*',
			'admin.behaviors.*',
			'bootstrap.helpers.*',
			'admin_ext.EPhpThumb.EPhpThumb',
		));
		
		$this->setComponents(array(
            'errorHandler' => array(
                'errorAction' => 'admin/user/error'),
            'user' => array(
                'class' => 'CWebUser',
                'loginUrl' => Yii::app()->createUrl('admin/user/login'),
                'returnUrl' => Yii::app()->createUrl('admin/start/index'),
            ),
            'bootstrap' => array(
                'class' => 'bootstrap.components.TbApi',
                'forceCopyAssets' => $this->forceCopyAssets
            ),
			'yiiwheels' => array(
				'class' => 'yiiwheels.YiiWheels',
			),
        ));
 
		Yii::app()->user->setStateKeyPrefix('_admin');

        $this->registerBootstrap();
        $this->registerCoreCss();
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
            // you may place customized code here
            $route = $controller->id . '/' . $action->id;
           // echo $route;
            $publicPages = array(
                'user/login',
                'user/error',
            );
            if (Yii::app()->user->isGuest && !in_array($route, $publicPages)){            
                Yii::app()->getModule('admin')->user->loginRequired();                
            }
            else
                return true;
		}
		else
			return false;
	}

	protected function registerBootstrap()
    {
        $this->getComponent('bootstrap')->register();
    }

    protected function registerCoreCss()
    {
        Yii::app()->clientScript->registerCssFile($this->getAssetsUrl() . '/css/admin.css');
        Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl() . '/js/knockout.js', CClientScript::POS_END);
    }

    public function getAssetsUrl()
    {
        if (!isset($this->assetsUrl))
        {
            $assetsPath = Yii::getPathOfAlias('admin.assets');
            $this->assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, $this->forceCopyAssets);
        }

        return $this->assetsUrl;
    }
}
