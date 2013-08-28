<?php

class RestoreAction extends AdminAction
{
    public function run()
    {
        $this->getModel()->restore();
        $this->redirect();
    }
}
