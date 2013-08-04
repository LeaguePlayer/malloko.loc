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
        
        $this->render(array('model' => $model));
    }
}
