<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/simple';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	//for link in main menu
	public $action = null;

	public $cs;

	protected $forceCopyAssets = false;

	protected $assetsUrl;

	protected function preinit()
	{
		parent::preinit();
	}

	public function init(){
		parent::init();
		
		$this->cs = Yii::app()->clientScript;
		$this->cs->registerCoreScript('jquery');

		//Change theme
		Yii::app()->theme = 'default';

		if(Yii::app()->getRequest()->getParam('update_assets')) $this->forceCopyAssets = true;

		//Css initialize
		/*$cs->registerCssFile($this->getAssetsUrl().'/css/ui-lightness/jquery-ui-1.10.3.custom.min.css');
		$cs->registerCssFile($this->getAssetsUrl().'/css/reset.css');
		$cs->registerCssFile($this->getAssetsUrl().'/css/style.css');
		$cs->registerCssFile($this->getAssetsUrl().'/css/buttons.css');
		$cs->registerCssFile($this->getAssetsUrl().'/css/chosen.css');*/

	}

	//Get Clip
	public function getClip($name){
		if (isset($this->clips[$name])) return $this->clips[$name];
		return '';
	}

	//Check home page
	public function is_home(){
		return $this->route == 'site/index';
	}

/*	protected function beforeAction($action){

		return parent::beforeAction($action);
	}*/

	public function getAssetsUrl()
    {
        if (Yii::app()->getRequest()->getParam('update_assets') || !isset($this->assetsUrl))
        {
            $assetsPath = Yii::getPathOfAlias('webroot.themes.'.Yii::app()->theme->name.'.assets');
            $this->assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, $this->forceCopyAssets);
        }
        return $this->assetsUrl;
    }

	public function beforeRender($view)
    {
        $this->renderPartial('//layouts/clips/_main_menu');

        return parent::beforeRender($view);
    }
}