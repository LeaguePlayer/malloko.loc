<?php

//TODO: Желательно переписать нормально
class SettingsController extends AdminController
{
	public function actionTypeForm($type){
		$model = null;

		switch ($type) {
			case 'string':
				$model = new SettingsString;
				break;
			case 'text':
				$model = new SettingsText;
				break;
		}

		if($model)
			$this->renderPartial("_$type", array('model' => $model));
	}

	public function actionCreate(){
		$model = new Settings;

		$settingName = $model->getSettingName();
		$settingType = new $settingName;

		if(isset($_POST['Settings'])){
			$model->attributes = $_POST['Settings'];

			$valid = $model->validate();

			if(isset($_POST[$settingName])){
				$settingType->attributes = $_POST[$settingName];

				$valid = $valid && $settingType->validate();
			}

			if($valid){
				//save setting value
				$settingType->save(false);
				$model->type_id = $settingType->id;
				//save setting
				$model->save(false);
				$this->redirect($this->createUrl('list'));
			}
				
		}

		$this->render('create', array(
			'model' => $model, 
			'settingType' => $settingType
			)
		);
	}

	public function actionUpdate($id){
		$model = Settings::model()->findByPk($id);
		$old = clone $model;

		$settingType = $model->{$model->type}; //relation

		if(isset($_POST['Settings'])){
			$model->attributes = $_POST['Settings'];

			$valid = $model->validate();

			$settingName = $model->getSettingName();
			$settingType = $model->{$model->type}; //relation

			if(!$settingType) $settingType = new $settingName;

			if(isset($_POST[$settingName])){
				$settingType->attributes = $_POST[$settingName];
				$valid = $valid && $settingType->validate();
			}

			if($valid){
				//if select new type then delete old value				
				if($model->type !== $old->type){
					$oldVal = $old->{$old->type};
					$oldVal->delete();
				}

				//save setting value
				$settingType->save(false);
				$model->type_id = $settingType->id;
				//save setting
				$model->save(false);
				$this->redirect($this->createUrl('list'));
			}
				
		}

		$this->render('update', array(
			'model' => $model, 
			'settingType' => $settingType
			)
		);
	}
}
