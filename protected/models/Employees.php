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
			array('status, sort, create_time, update_time', 'numerical', 'integerOnly'=>true),
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
			'html_quote' => 'Высказывание',
			'status' => 'Статус',
			'sort' => 'Вес для сортировки',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
		);
	}
	
	
	public function behaviors()
	{
		return CMap::mergeArray(parent::behaviors(), array(
			'UploadableImageBehavior' => array(
				'class' => 'admin.behaviors.UploadableImageBehavior',
			),
		));
	}

	
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('fio',$this->fio,true);
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
}
