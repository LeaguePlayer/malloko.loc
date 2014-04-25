<?php

/**
* This is the model class for table "{{structure}}".
*
* The followings are the available columns in table '{{structure}}':
    * @property integer $id
    * @property string $name
    * @property string $material_type
    * @property integer $material_id
    * @property string $url
    * @property integer $level
    * @property integer $lft
    * @property integer $rgt
    * @property integer $seo_id
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Structure extends EActiveRecord
{
    private $_parent;
    public function setParent(Structure $model = null)
    {
        $this->_parent = $model;
    }

    public function tableName()
    {
        return '{{structure}}';
    }


    public function rules()
    {
        return array(
            array('name, url, material_id', 'required'),
            array('url', 'match', 'pattern' => '/^[\w_-]+$/', 'message' => 'Разрешены только символы латинского алфавита и знак подчеркивания.'),
            array('url', 'unique'),
            array('material_id, level, lft, rgt, seo_id, status, sort', 'numerical', 'integerOnly'=>true),
            array('name, url', 'length', 'max'=>255),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, name, material_type, material_id, url, level, lft, rgt, seo_id, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function url_unique($attribute, $params)
    {
        $url = $this->url;
        if ( $this->_parent ) {
            $this->url = $this->_parent->url.'/'.$this->url;
        }
        $validator = CValidator::createValidator('unique', $this, $attribute, $params);
        $validator->validate($this, $attribute);
        $this->url = $url;
    }


    public function relations()
    {
        return array(
            'material' => array(self::BELONGS_TO, 'Material', 'material_id')
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Название раздела',
            'material_id' => 'Тип материала',
            'url' => 'Идентификатор',
            'level' => 'Level',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'seo_id' => 'Ссылка на СЕО',
            'status' => 'Статус',
            'sort' => 'Вес для сортировки',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
        );
    }


    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
			'timestamp' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'create_time',
                'updateAttribute' => 'update_time',
                'setUpdateOnCreate' => true,
			),
            'NestedSetBehavior'=>array(
                'class'=>'application.behaviors.NestedSetBehavior',
                'leftAttribute'=>'lft',
                'rightAttribute'=>'rgt',
                'levelAttribute'=>'level',
            ),
			'seo' => array(
				'class' => 'application.behaviors.SeoBehavior',
			),
        ));
    }

    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('material_id',$this->material_id);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('lft',$this->lft);
		$criteria->compare('rgt',$this->rgt);
		$criteria->compare('seo_id',$this->seo_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
        $criteria->order = 'sort';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }


    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }


    public function afterDelete()
    {
        $modelName = ucfirst( $this->material->class_name );
        $components = CActiveRecord::model($modelName)->findAllByAttributes(array(
            'node_id'=>$this->id
        ));
        foreach ( $components as $component ) {
            $component->delete();
        }
        $descendants = $this->descendants()->findAll();
        foreach ( $descendants as $descendant ) {
            $descendant->deleteNode();
        }
        parent::afterDelete();
    }


    private $_component;
    public function getComponent()
    {
        if ( $this->_component === null ) {
            $component_name = $this->material->class_name;
            $model = $component_name::model();
			$this->_component = $model->findByAttributes(array('node_id'=>$this->id));
        }
        return $this->_component;
    }

    public function findByUrl($url)
    {
        return $this->findByAttributes(array('url'=>$url));
    }


    private $_url;
    public function getUrl()
    {
//        if ( $this->_url === null ) {
//            $this->_url = Yii::app()->createUrl('structure/show', array('url'=>$this->url));
//        }
//        return $this->_url;

		if ( $this->_url === null ) {
			if ( $this->isRoot() )
				return Yii::app()->createUrl('site/index');
			$component = $this->getComponent();
			if ( !$component )
				return '';
			$component_name = lcfirst(get_class($component));
			$this->_url = Yii::app()->createUrl($component_name.'/view', array('url'=>$this->url));
		}

        return $this->_url;
    }


    public function getBreadcrumbs()
    {
        $ancestors = $this->ancestors()->findAll();
        $breadcrumbs = array();
        foreach ( $ancestors as $node ) {
            if ( $node->isRoot() ) continue;
            $breadcrumbs[$node->name] = $node->getUrl();
        }
        $breadcrumbs[] = $this->name;
        return $breadcrumbs;
    }
}
