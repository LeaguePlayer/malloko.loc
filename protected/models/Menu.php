<?php

/**
 * This is the model class for table "{{menu}}".
 *
 * The followings are the available columns in table '{{menu}}':
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $html_content
 * @property integer $status
 * @property integer $sort
 * @property integer $create_time
 * @property integer $update_time
 */
class Menu extends EActiveRecord
{
	public function tableName()
	{
		return '{{menu}}';
	}

	
	public function rules()
	{
		return array(
			array('place_id, name', 'required'),
			array('status, sort, create_time, update_time, place_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>256),
			array('html_content', 'safe'),
			// The following rule is used by search().
			array('id, name, image, html_content, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
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
			'name' => 'Название меню',
			'image' => 'Превью',
			'html_content' => 'Состав меню',
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
			'UploadableImageBehavior' => array(
				'class' => 'admin.behaviors.UploadableImageBehavior',
				'versions' => array(
					'small' => array(
						'centeredpreview' => array(90, 90),
					),
					'medium' => array(
						'centeredpreview' => array(130, 130),
					)
				),
			),
		));
	}

	
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('html_content',$this->html_content,true);
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
		return 'Меню';
	}
	
	public function getViewUrl()
	{
		return Yii::app()->urlManager->createUrl('/menu/view', array('id'=>$this->id));
	}
}
