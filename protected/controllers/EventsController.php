<?php

class EventsController extends Controller
{
	public $layout='//layouts/column2';

	
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	
	public function actionView($id)
	{
		$this->layout = '//layouts/col_2';
		
		$criteria = new CDbCriteria;
		$criteria->addCondition('place_id=:place_id AND status=:status');
		$criteria->params[':place_id'] = $this->place['id'];
		$criteria->params[':status'] = Events::STATUS_PUBLISH;
		$model = $this->loadModel('Events', $id, $criteria);
		
		$criteria->order = 'public_date';
		$criteria->addCondition('id<>:id AND type=:type');
		$criteria->params[':id'] = $id;
		$criteria->params[':type'] = $model->type;
		$roundData = new CActiveDataProvider('Events', array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => 1000,
			)
		));
		
		$this->render('view',array(
			'model' => $model,
			'roundData' => $roundData,
		));
	}

	
	public function actionIndex($type = Events::TYPE_NEWS)
	{
		$this->layout = '//layouts/col_2';
		
		$criteria = new CDbCriteria;
		$criteria->addCondition('place_id=:place_id AND status=:status AND type=:type');
		$criteria->params[':place_id'] = $this->place['id'];
		$criteria->params[':status'] = Events::STATUS_PUBLISH;
		$criteria->params[':type'] = $type;
		$criteria->order = 'public_date DESC';
		
		$dataProvider=new CActiveDataProvider('Events', array(
			'criteria' => $criteria,
			'pagination'=>array(
				'pageSize'=>10
			),
		));
		$this->render('index', array(
			'type'=>$type,
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionLoadRoundItem()
	{
		$this->renderPartial('_roundItem', array('model' => $model));
	}
}
