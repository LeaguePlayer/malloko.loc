<?php

class ViewAction extends AdminAction
{
    public function run()
    {
        $model = $this->getModel();        
        $this->render(array('model' => $model));
    }
}