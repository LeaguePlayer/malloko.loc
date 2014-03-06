<?php

class StructureBehavior extends CActiveRecordBehavior{

	public function attach($owner){
		parent::attach($owner);
		$owner->metaData->addRelation('node', array($owner::BELONGS_TO, 'Structure', 'node_id'));
	}

	public function beforeSave($event){
        $nodeId = $this->getOwner()->node_id;
        if(!$nodeId && ($nodeId = Yii::app()->request->getParam('node_id')) !== null){
            $this->getOwner()->node_id = $nodeId;
        }
        parent::beforeSave($event);
	}
}