<?php

/**
 * This is the model class for table "{{events}}".
 *
 * The followings are the available columns in table '{{events}}':
 * @property integer $id
 * @property string $title
 * @property string $html_content
 * @property integer $gallery
 * @property integer $place_id
 * @property integer $type
 * @property string $public_date
 * @property integer $status
 * @property integer $sort
 * @property integer $create_time
 * @property integer $update_time
 */
class Events extends EActiveRecord
{
	const TYPE_NEWS = 0;
	const TYPE_CHRONICLE = 1;
	
	public static function getTypes($type = null)
	{
		$types = array(
			self::TYPE_NEWS => 'Новость',
			self::TYPE_CHRONICLE => 'Хроника',
		);
		if ( $type === null )
			return $types;
		
		return $types[$type];
	}
	
	public function tableName()
	{
		return '{{events}}';
	}

	
	public function rules()
	{
		return array(
			array('gallery, place_id, type, status, sort, create_time, update_time', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>256),
			array('html_content, public_date', 'safe'),
			// The following rule is used by search().
			array('id, title, html_content, gallery, place_id, type, public_date, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
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
			'title' => 'Загловок',
			'html_content' => 'Контент',
			'gallery' => 'Галерея',
			'place_id' => 'Ресторан',
			'type' => 'Новость или хроника',
			'public_date' => 'Дата публикации',
			'status' => 'Статус',
			'sort' => 'Вес для сортировки',
			'create_time' => 'Дата создания',
			'update_time' => 'Дата последнего редактирования',
		);
	}
	
	
	public function behaviors()
	{
		return CMap::mergeArray(parent::behaviors(), array(
			'galleryManager' => array(
				'class' => 'admin.extensions.imagesgallery.GalleryBehavior',
				'idAttribute' => 'gallery',
				'versions' => array(
					'small' => array(
						'adaptiveResize' => array(90, 90),
					),
					'medium' => array(
						'resize' => array(600, 500),
					)
				),
				'name' => true,
				'description' => true,
			),
		));
	}

	
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('html_content',$this->html_content,true);
		$criteria->compare('gallery',$this->gallery);
		$criteria->compare('place_id',$this->place_id);
		$criteria->compare('type',$this->type);
		$criteria->compare('public_date',$this->public_date,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('update_time',$this->update_time);

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
		return 'Новости ресторана';
	}
	
	public function beforeSave()
	{
		$this->public_date = Yii::app()->date->toMysql($this->public_date);
		return parent::beforeSave();
	}
}
