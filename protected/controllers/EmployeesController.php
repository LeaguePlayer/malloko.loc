<?php

class EmployeesController extends Controller
{
	public $layout='//layouts/col_2';

	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	
	public function actionIndex()
	{
		$criteria = new CDbCriteria;
		$criteria->order = 'create_time';
		$criteria->addCondition('status=:status');
		$criteria->params[':status'] = Menu::STATUS_PUBLISH;
		$dataProvider=new CActiveDataProvider('Employees', array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => 10
			)
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
}
