<?php

/**
 * This is the model class for table "{{employees}}".
 *
 * The followings are the available columns in table '{{employees}}':
 * @property integer $id
 * @property string $image
 * @property string $fio
 * @property string $position
 * @property string $html_quote
 * @property string $face_of_day
 * @property integer $status
 * @property integer $sort
 * @property integer $create_time
 * @property integer $update_time
 */
class Employees extends EActiveRecord
{
	public function tableName()
	{
		return '{{employees}}';
	}

	
	public function rules()
	{
		return array(
			array('fio, position', 'required'),
			array('status, sort, create_time, update_time, face_of_day', 'numerical', 'integerOnly'=>true),
			array('face_of_day', 'in', 'range'=>array(0, 1)),
			array('fio, position', 'length', 'max'=>256),
			array('html_quote', 'safe'),
			// The following rule is used by search().
			array('id, image, fio, position, html_quote, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		return array(
		);
	}

	
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'image' => 'Фото сотрудника',
			'fio' => 'ФИО',
			'position' => 'Должность',
			'html_quote' => 'Дополнительная информация',
			'face_of_day' => 'Лицо дня',
			'status' => 'Статус',
			'sort' => 'Вес для сортировки',
			'create_time' => 'Дата создания',
			'update_time' => 'Дата редактирования',
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
						'resize' => array(130, 0),
					),
					'big' => array(
						'centeredpreview' => array(204, 204),
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
		$criteria->compare('fio',$this->fio,true);
		$criteria->compare('face_of_day',$this->face_of_day,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('html_quote',$this->html_quote,true);
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
		return 'Работники ресторана';
	}
	
	public function afterSave()
	{
		$ranges = CHtml::listData(Employees::model()->findAll(), 'id', 'fio');
		Settings::updateOptionRanges('face', $ranges);
		parent::afterSave();
	}
	
	public function isFaceOfDay()
	{
		return $this->face_of_day ? 'Да' : 'Нет';
	}
}
