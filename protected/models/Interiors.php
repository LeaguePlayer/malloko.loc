<?php

/**
 * This is the model class for table "{{interiors}}".
 *
 * The followings are the available columns in table '{{interiors}}':
 * @property integer $id
 * @property string $title
 * @property integer $place_id
 * @property integer $gallery
 * @property integer $status
 * @property integer $sort
 * @property integer $create_time
 * @property integer $update_time
 */
class Interiors extends EActiveRecord
{
	public function tableName()
	{
		return '{{interiors}}';
	}

	
	public function rules()
	{
		return array(
			array('place_id, gallery, status, sort, create_time, update_time', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			array('id, title, place_id, gallery, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
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
			'place_id' => 'Привязка к ресторану',
			'gallery' => 'Фотографии',
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
					'side' => array(
						'centeredpreview' => array(204, 98),
					),
					'medium' => array(
						'centeredpreview' => array(315, 177),
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
		$criteria->compare('place_id',$this->place_id);
		$criteria->compare('gallery',$this->gallery);
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
		return 'Интерьер';
	}

	public function getViewUrl()
	{
		return Yii::app()->urlManager->createUrl('/interiors/view', array('id'=>$this->id));
	}
	
	public function getCountPhotos()
	{
		return count($this->galleryManager->getGallery()->galleryPhotos);
	}
}
