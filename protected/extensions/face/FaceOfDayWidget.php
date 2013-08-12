<?php
class FaceOfDayWidget extends CWidget
{
	private $_run = true;
	
	protected $cookieVar = 'FACE_OF_DAY';
	
	public $model;
	public $options = array();

	public function init()
	{
		if ( $this->model === null ) {
			$criteria = new CDbCriteria;
			$criteria->addCondition('status=:status');
			$criteria->params[':status'] = Employees::STATUS_PUBLISH;
			$faceId = Settings::getOption('face');
			if ( $faceId and is_numeric($faceId) ) {
				$this->model = Employees::model()->findByPk($faceId, $criteria);
				$this->updateCookie();
			} else {
				$cookie = Yii::app()->request->cookies[$this->cookieVar];
				$criteria->addCondition('face_of_day=1');
				if ( isset($cookie) ) {
					$this->model = Employees::model()->findByPk($cookie->value, $criteria);
				}
				if ( $this->model === null ) {
					$criteria->order = 'rand()';
					$this->model = Employees::model()->find($criteria);
					$this->updateCookie();
				}
			}
		}
		if ( $this->model === null ) {
			$this->_run = false;
			return true;
		}
	}
	
	protected function updateCookie()
	{
		if ( $this->model === null ) {
			return false;
		}
		$cookie = new CHttpCookie($this->cookieVar, $this->model->id);
		$cookie->expire = time() + (60*60*24); // 24 hours
		Yii::app()->request->cookies[$this->cookieVar] = $cookie;
		return true;
	}

	public function run()
	{
		if ( !$this->_run ) {
			return true;
		}
		$this->render('face', array('model' => $this->model));
    }
}
