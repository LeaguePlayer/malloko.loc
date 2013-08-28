<?php

class StartController extends AdminController{

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionSettings()
    {
        if (isset($_POST['Settings'])) {
            foreach ( $_POST['Settings'] as $option => $value ) {
                Settings::setOption($option, $value);
            }
        }
        $this->render('settings', array('settings' => Settings::model()->findAll()));
    }
}