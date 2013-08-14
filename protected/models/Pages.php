<?php

/**
 * This is the model class for table "{{pages}}".
 *
 * The followings are the available columns in table '{{pages}}':
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $html_content
 * @property integer $place_id
 * @property integer $status
 * @property integer $sort
 * @property integer $create_time
 * @property integer $update_time
 */
class Pages extends EActiveRecord
{
	public function tableName()
	{
		return '{{pages}}';
	}

	
	public function rules()
	{
		return array(
			array('title', 'required'),
			array('place_id, status, sort, create_time, update_time', 'numerical', 'integerOnly'=>true),
			array('title, alias', 'length', 'max'=>256),
			array('alias', 'match', 'pattern'=>'/^[\w]+$/', 'message'=>'Идентификатор не должен содержать русских символов, спецсимволов и пробелов'),
			array('html_content', 'safe'),
			// The following rule is used by search().
			array('id, title, alias, html_content, place_id, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		return array(
			'place'=>array(self::BELONGS_TO, 'Places', 'place_id'),
		);
	}

	
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Заголовок',
			'alias' => 'Идентификатор страницы',
			'html_content' => 'Контент',
			'place_id' => 'Привязка к ресторану',
			'status' => 'Статус',
			'sort' => 'Вес для сортировки',
			'create_time' => 'Дата создания',
			'update_time' => 'Дата последнего редактирования',
		);
	}
	
	

	
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('html_content',$this->html_content,true);
		$criteria->compare('place_id',$this->place_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('update_time',$this->update_time);
		$criteria->order = 'status, create_time DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function translition()
	{
		return 'Страницы';
	}
	
	public function beforeSave() {
		if ( empty($this->alias) ) {
			$this->alias = SiteHelper::translit($this->title);
		}
		return parent::beforeSave();
	}
	
	public static function getUrlByAlias($alias)
	{
		return Yii::app()->urlManager->createUrl('/pages/view', array('alias'=>$alias));
	}
	
	public function getViewUrl()
	{
		return Yii::app()->urlManager->createUrl('/pages/view', array('id'=>$this->id));
	}
}
