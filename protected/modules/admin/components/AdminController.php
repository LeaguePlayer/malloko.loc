<?php

Yii::import('admin.actions.*');

class AdminController extends CController
{
    public $layout = '/layouts/admin_columns';

    public $breadcrumbs = array();

    public $menu = array();
	
	public $defaultAction = 'list';
	
	public function actions()
    {
        return array(
            'list' => 'ListAction',
			'create' => 'CreateAction',
            'update' => 'UpdateAction',
            'delete' => 'DeleteAction',
            'restore' => 'RestoreAction',
        );
    }
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