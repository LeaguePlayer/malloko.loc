<?php

class UpdateAction extends AdminAction
{
    public function run()
    {
        $model = $this->getModel();

        if (isset($_POST[$this->modelName]['deletePhoto'])) {
            $behaviorName = 'imgBehavior'.ucfirst( $_POST[$this->modelName]['deletePhoto'] );
            $model->{$behaviorName}->deletePhoto();
            if ( Yii::app()->request->isAjaxRequest ) {
                Yii::app()->end();
            }
        }
        
        if(isset($_POST[$this->modelName]))
        {
            $model->attributes = $_POST[$this->modelName];
			$success = $model->save();
            if( $success ) {
				$this->redirect();
			}
        }
        $this->render(array('model' => $model));
    }
}
