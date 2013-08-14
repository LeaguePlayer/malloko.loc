<?php

class ListAction extends AdminAction
{
    public function run($showRemoved = false)
    {
        $model = $this->getModel('search');

        if($showRemoved)
            $model->removed();
        
        if(isset($_GET[$this->modelName]))
            $model->attributes = $_GET[$this->modelName];
		
		$appConreoller = Yii::app()->createController('site');
		$assetsPath = $appConreoller[0]->getAssetsUrl();
		Yii::app()->clientScript->registerCssFile($assetsPath.'/css/fancybox/jquery.fancybox.css');
		Yii::app()->clientScript->registerScriptFile($assetsPath.'/js/lib/jquery.fancybox.js', CClientScript::POS_END);
		Yii::app()->clientScript->registerScriptFile(Yii::app()->getModule('admin')->getAssetsUrl().'/js/listitem_view.js', CClientScript::POS_END);
        
        $this->render(array(
            'model' => $model,
            'showRemoved' => $showRemoved,
        ));
    }
}
