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
            'view' => 'ViewAction',
        );
    }
	
	
	/**
	 * Loads the requested data model.
	 * @param string the model class name
	 * @param integer the model ID
	 * @param array additional search criteria
	 * @param boolean whether to throw exception if the model is not found. Defaults to true.
	 * @return CActiveRecord the model instance.
	 * @throws CHttpException if the model cannot be found
	 */
	protected function loadModel($class, $id, $criteria = array(), $exceptionOnNull = true)
	{
		if (empty($criteria)) {
			$model = CActiveRecord::model($class)->findByPk($id);
		} else {
			$finder = CActiveRecord::model($class);
			$c = new CDbCriteria($criteria);
			$c->mergeWith(array(
				'condition' => $finder->tableSchema->primaryKey . '=:id',
				'params' => array(':id' => $id),
			));
			$model = $finder->find($c);
		}
		if (isset($model))
			return $model;
		else if ($exceptionOnNull)
			throw new CHttpException(404, 'Unable to find the requested object.');
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