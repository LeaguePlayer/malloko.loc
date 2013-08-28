<?php

class UpdateAction extends AdminAction
{
    public function run()
    {
        $model = $this->getModel();
        
        if(isset($_POST[$this->modelName]))
        {
            $model->attributes = $_POST[$this->modelName];
			//$model->attachBehavior('UploadableImageBehavior', array(
            //    'class' => 'UploadableImageBehavior',
            //));
			$success = $model->save();
			//$model->detachBehavior('UploadableImageBehavior');
            if( $success ) {
				$this->redirect();
			}
        }
        
		$appConreoller = Yii::app()->createController('site');
		$assetsPath = $appConreoller[0]->getAssetsUrl();
		Yii::app()->clientScript->registerCssFile($assetsPath.'/css/fancybox/jquery.fancybox.css');
		Yii::app()->clientScript->registerScriptFile($assetsPath.'/js/lib/jquery.fancybox.js', CClientScript::POS_END);
		Yii::app()->clientScript->registerScriptFile(Yii::app()->getModule('admin')->getAssetsUrl().'/js/listitem_view.js', CClientScript::POS_END);
		
        $this->render(array('model' => $model));
    }
}
