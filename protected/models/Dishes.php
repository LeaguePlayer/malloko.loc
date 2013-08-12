<?php

/**
 * This is the model class for table "{{dishes}}".
 *
 * The followings are the available columns in table '{{dishes}}':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $gallery
 * @property integer $place_id
 * @property integer $status
 * @property integer $sort
 * @property integer $create_time
 * @property integer $update_time
 */
class Dishes extends EActiveRecord
{
	public function tableName()
	{
		return '{{dishes}}';
	}

	
	public function rules()
	{
		return array(
			array('place_id, title', 'required'),
			array('gallery, place_id, status, sort, create_time, update_time', 'numerical', 'integerOnly'=>true),
			array('title, description', 'length', 'max'=>256),
			// The following rule is used by search().
			array('id, title, description, gallery, place_id, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
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
			'title' => 'Наименование категории',
			'description' => 'Описание',
			'gallery' => 'Блюда',
			'place_id' => 'Привязка к ресторану',
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
						'centeredpreview' => array(204, 123),
					),
					'view' => array(
						'resize' => array(204, 0),
					),
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('gallery',$this->gallery);
		$criteria->compare('place_id',$this->place_id);
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
		return 'Блюда';
	}
	
	public function getCountPhotos()
	{
		return count($this->galleryManager->getGallery()->galleryPhotos);
	}
	
	public function getViewUrl()
	{
		return Yii::app()->urlManager->createUrl('/dishes/view', array('id'=>$this->id));
	}
}
