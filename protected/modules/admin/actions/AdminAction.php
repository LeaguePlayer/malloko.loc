<?php

abstract class AdminAction extends CAction
{
    private $_modelName;
    private $_view;
    
    public function getModelName()
    {
        if($this->_modelName === null)
            $this->_modelName = ucfirst($this->controller->id);
        
        return $this->_modelName;
    }
    
    public function setModelName($value)
    {
        $this->_modelName = $value;
    }
    
    public function getModel($scenario = 'insert')
    {
        if(($id = Yii::app()->request->getParam('id')) === null)
            $model = new $this->modelName($scenario);
        else if(($model = CActiveRecord::model($this->modelName)->resetScope()->findByPk($id)) === null)
			throw new CHttpException(404, Yii::t('base', "Записи с идентификатором {$id} не существует."));
        
        return $model;
    }
    
    public function setView($value)
    {
        $this->_view = $value;
    }
    
    public function redirect($actionId = null)
    {
        if($actionId === null)
            $actionId = $this->controller->defaultAction;
        
        $this->controller->redirect(array($actionId));
    }
    
    public function render($data, $return = false)
    {
        if($this->_view === null)
            $this->_view = $this->id;
        
        return $this->controller->render($this->_view, $data, $return);
    }
}