<?php

class RestoreAction extends AdminAction
{
    public function run()
    {
        $this->getModel('update')->restore();
        $this->redirect('list');
    }
}
