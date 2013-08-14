<?php

/**
 * This is the model class for table "{{banners}}".
 *
 * The followings are the available columns in table '{{banners}}':
 * @property integer $id
 * @property string $image
 * @property string $link
 * @property integer $target_method
 * @property string $title
 * @property string $description
 * @property integer $status
 * @property integer $sort
 * @property integer $create_time
 * @property integer $update_time
 */
class Banners extends EActiveRecord
{
	const TARGET_SELF = 0;
	const TARGET_BLANK = 1;
	
	public static function getTargetMethodLabels($target_method = false)
	{
		$labels = array(
			self::TARGET_SELF => 'В текущем окне',
			self::TARGET_BLANK => 'В новом окне',
			);

		if ($target_method > -1)
			return $aliases[$target_method];
		
		return $labels;
	}
	
	public function tableName()
	{
		return '{{banners}}';
	}

	
	public function rules()
	{
		return array(
			array('title', 'required'),
			array('target_method, status, sort, create_time, update_time, place_id', 'numerical', 'integerOnly'=>true),
			array('link, title', 'length', 'max'=>256),
			array('description', 'safe'),
			// The following rule is used by search().
			array('id, image, link, target_method, title, description, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
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
			'image' => 'Баннер',
			'link' => 'Целевая ссылка',
			'target_method' => 'Метод перехода по ссылке',
			'title' => 'Заголовок',
			'place_id' => 'Привязка к ресторану',
			'description' => 'Описание',
			'status' => 'Статус',
			'sort' => 'Вес для сортировки',
			'create_time' => 'Дата создания',
			'update_time' => 'Дата последнего редактирования',
		);
	}
	
	
	public function behaviors()
	{
		return CMap::mergeArray(parent::behaviors(), array(
			'UploadableImageBehavior' => array(
				'class' => 'admin.behaviors.UploadableImageBehavior',
				'versions' => array(
					'small' => array(
						'centeredpreview' => array(90, 90),
					),
					'medium' => array(
						'resize' => array(218, 0),
					),
				)
			),
		));
	}

	
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('target_method',$this->target_method);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
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
		return 'Реклама';
	}

	public static function listUrl()
	{
		return Yii::app()->urlManager->createUrl('/banners/index');
	}
}
