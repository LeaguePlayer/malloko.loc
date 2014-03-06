<?php

class DeleteAction extends AdminAction
{
    public function run()
    {
        $this->getModel()->delete();
        $this->redirect('list');
    }
}
