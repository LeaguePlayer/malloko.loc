<?php

class CreateAction extends AdminAction
{
    public function run()
    {
        $model = $this->getModel();
        
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
