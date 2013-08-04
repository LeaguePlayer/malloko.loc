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
        
        $this->render(array(
            'model' => $model,
            'showRemoved' => $showRemoved,
        ));
    }
}
