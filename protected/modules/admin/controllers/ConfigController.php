<?php

class ConfigController extends AdminController
{
    public $defaultAction = 'update';

    public function actions()
    {
        return array();
    }

    public function actionUpdate()
    {
        $configs = Config::model()->findAll();
        $confArray = array();
        foreach ( $configs as $config ) {
            $confArray[$config->id] = $config;
        }

        if ( isset($_POST['Config']) ) {
            $success = true;
            foreach ( $_POST['Config'] as $id => $post ) {
                if ( isset($confArray[$id]) ) {
                    $config = $confArray[$id];
                    $config->attributes = $post;
                    $success = $config->save() && $success;
                }
            }
            if ( $success ) {
                Yii::app()->user->setFlash('CONFIG_SUCCESS', 'Все настройки сохранены');
            }
        }
        $this->render('form', array(
            'confArray' => $confArray
        ));
    }
}