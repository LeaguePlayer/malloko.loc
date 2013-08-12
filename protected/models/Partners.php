<?php

/**
 * This is the model class for table "{{partners}}".
 *
 * The followings are the available columns in table '{{partners}}':
 * @property integer $id
 * @property string $image
 * @property string $name
 * @property string $description
 * @property string $site
 * @property integer $status
 * @property integer $sort
 * @property integer $create_time
 * @property integer $update_time
 */
class Partners extends EActiveRecord
{
	public function tableName()
	{
		return '{{partners}}';
	}

	
	public function rules()
	{
		return array(
			array('name', 'required'),
			array('status, sort, create_time, update_time', 'numerical', 'integerOnly'=>true),
			array('name, site', 'length', 'max'=>256),
			array('description, image', 'safe'),
			// The following rule is used by search().
			array('id, image, name, description, site, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
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
			'image' => 'Логотип',
			'name' => 'Название компании',
			'description' => 'Описание',
			'site' => 'Ссылка на сайт',
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
						'resize' => array(160, 0),
					)
				),
			),
		));
	}

	
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('site',$this->site,true);
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
		return 'Партнеры';
	}

	public function getLinkWithSite()
	{
		return TbHtml::link($this->site, $this->site, array('target'=>'_blank'));
	}
}
