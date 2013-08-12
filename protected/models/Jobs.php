<?php

/**
 * This is the model class for table "{{jobs}}".
 *
 * The followings are the available columns in table '{{jobs}}':
 * @property integer $id
 * @property string $name
 * @property string $html_description
 * @property integer $status
 * @property integer $sort
 * @property integer $create_time
 * @property integer $update_time
 */
class Jobs extends EActiveRecord
{
	public function tableName()
	{
		return '{{jobs}}';
	}

	
	public function rules()
	{
		return array(
			array('name', 'required'),
			array('status, sort, create_time, update_time', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>256),
			array('html_description', 'safe'),
			// The following rule is used by search().
			array('id, name, html_description, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
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
			'name' => 'Название должности',
			'html_description' => 'Описание',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('html_description',$this->html_description,true);
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
		return 'Вакансии';
	}

}
