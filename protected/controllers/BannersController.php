<?php

class BannersController extends Controller
{
	public $layout='//layouts/col_2';

	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'ajaxOnly + getNext'
		);
	}

	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','getNext'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	
	public function actionIndex()
	{
		$criteria = new CDbCriteria;
		$criteria->addCondition('status=:status and (ISNULL(place_id) OR place_id=0 OR place_id=:place_id)');
		$criteria->params[':status'] = Banners::STATUS_PUBLISH;
		$criteria->params[':place_id'] = $this->place['id'];
		$dataProvider=new CActiveDataProvider('Banners', array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => 10
			)
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionGetNext($current = 0)
	{
		$criteria = new CDbCriteria;
		$criteria->order = 'rand()';
		$criteria->addCondition('(ISNULL(place_id) OR place_id=0 OR place_id=:place_id)');
		$criteria->params[':place_id'] = $this->place['id'];
		if ( $current != 0 ) {
			$criteria->addCondition('id<>:id');
			$criteria->params[':id'] = $current;
		}
		$model = Banners::model()->findByAttributes(array(
			'status' => Banners::STATUS_PUBLISH
		), $criteria);
		
		if ( $model !== null ) {
			echo CJSON::encode(array(
				'current' => $model->id,
				'html' => $this->renderPartial('_banner', array('model'=>$model), true)
			));
		}
	}
}
