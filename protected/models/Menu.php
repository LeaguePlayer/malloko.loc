<?php

class Menu extends EActiveRecord
{
    public static function getStatusAliases($status = -1)
    {
        $aliases = array(
            self::STATUS_PUBLISH => 'Да',
            self::STATUS_CLOSED => 'Нет',
        );

        if ($status > -1)
            return $aliases[$status];

        return $aliases[self::STATUS_CLOSED];
    }

    public function tableName()
    {
        return '{{menu}}';
    }


    public function rules()
    {
        return array(
            array('parent_id, node_id, status', 'numerical', 'integerOnly'=>true),
            array('name, external_link, item_class', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, parent_id, node_id, name, external_link, status', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'node'=>array(self::BELONGS_TO, 'Structure', 'node_id'),
        );
    }


    public function behaviors()
    {
        return array(
            'NestedSetBehavior'=>array(
                'class'=>'application.behaviors.NestedSetBehavior',
                'leftAttribute'=>'lft',
                'rightAttribute'=>'rgt',
                'levelAttribute'=>'level',
            ),
			'category'=>array(
				'class'=>'ECategoryNSTreeBehavior',
				'titleAttribute'=>'name',
			)
        );
    }


	public function getLinkActive()
	{
		return false;
	}


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'parent_id' => 'Родительский пункт',
            'node_id' => 'Раздел',
            'name' => 'Название',
            'external_link' => 'Внешняя ссылка',
            'item_class' => 'Класс для стиля',
            'status' => 'Включено',
        );
    }




    public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('id',$this->id);
        $criteria->compare('parent_id',$this->parent_id);
        $criteria->compare('node_id',$this->node_id);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('external_link',$this->external_link,true);
        $criteria->compare('status',$this->status);
        $criteria->order = 'lft';

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>false
        ));
    }

    public function beforeSave()
    {
        return true;
    }

    public function beforeDelete()
    {
        return true;
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

	private $_url;
    public function getUrl()
    {
		if ( $this->_url === null ) {
			if ( !empty($this->external_link) ) {
				$this->_url = $this->external_link;
			} else {
				$node = null;
				// Поведение, при котором меню будет возвращать ссылку на первый дочерний элемент ( раскомментируй для включения )
				/*
				$subMenu = $this->children()->find();
				if ( $subMenu ) {
					$node = $subMenu->node;
				}
				*/

				//if ( $node === null ) {
					$node = $this->node;
				//}

				if ( $node !== null ) {
					$this->_url = $node->getUrl();
				} else {
					$this->_url = '';
				}
			}
		}
        return $this->_url;
    }
}
