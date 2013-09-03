<?php

Yii::import('admin.actions.*');

class AdminController extends Controller
{
    public $layout = '/layouts/admin_columns';
	public $defaultAction = 'list';

    public function filters()
    {
        return array(
            array('auth.filters.AuthFilter'),
        );
    }
	
	public function actions()
    {
        return array(
            'list' => 'ListAction',
			'create' => 'CreateAction',
            'update' => 'UpdateAction',
            'delete' => 'DeleteAction',
            'restore' => 'RestoreAction',
            'view' => 'ViewAction',
            'sort' => 'SortAction',
        );
    }
}