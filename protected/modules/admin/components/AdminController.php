<?php

class AdminController extends CController{

    public $layout = '/layouts/admin_columns';

    public $breadcrumbs = array();

    public $menu = array();
	/*public function filters()
    {
        return array(
            'accessControl',
        );
    }
 
    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated users to access all actions
                'users'=>array('@'),
            ),
            array('deny',
            	'users'=>array('*'),
            ),
        );
    }*/
}