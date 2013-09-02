<?php

/**
* This is the model class for table "{{brands}}".
*
* The followings are the available columns in table '{{brands}}':
    * @property integer $id
    * @property string $dt_timer
    * @property string $dttm_timer
    * @property string $tm_timer
    * @property string $img_sddd
    * @property string $img_sdfsdf
    * @property string $wswg_3434
    * @property string $wswg_5656
    * @property integer $gllr_timer
    * @property integer $gllr_dfdfdfdf
    * @property integer $status
    * @property integer $sort
    * @property integer $create_time
    * @property integer $update_time
*/
class Brands extends EActiveRecord
{
    public function tableName()
    {
        return '{{brands}}';
    }


    public function rules()
    {
        return array(
            array('gllr_timer, gllr_dfdfdfdf, status, sort, create_time, update_time', 'numerical', 'integerOnly'=>true),
            array('img_sddd, img_sdfsdf', 'length', 'max'=>255),
            array('dt_timer, dttm_timer, tm_timer, wswg_3434, wswg_5656', 'safe'),
            // The following rule is used by search().
            array('id, dt_timer, dttm_timer, tm_timer, img_sddd, img_sdfsdf, wswg_3434, wswg_5656, gllr_timer, gllr_dfdfdfdf, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
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
            'dt_timer' => 'Комментарий',
            'dttm_timer' => 'Комментарий',
            'tm_timer' => 'Комментарий',
            'img_sddd' => 'Комментарий',
            'img_sdfsdf' => 'Комментарий',
            'wswg_3434' => 'Комментарий',
            'wswg_5656' => 'Комментарий',
            'gllr_timer' => 'Комментарий',
            'gllr_dfdfdfdf' => 'Комментарий',
            'status' => 'Статус',
            'sort' => 'Вес для сортировки',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
        );
    }


    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
        	'imgBehaviorSddd' => array(
				'class' => 'application.behaviors.UploadableImageBehavior',
				'attributeName' => 'img_sddd',
				'versions' => array(
					'icon' => array(
						'centeredpreview' => array(90, 90),
					),
					'small' => array(
						'resize' => array(200, 180),
					)
				),
			),
	        'imgBehaviorSdfsdf' => array(
				'class' => 'application.behaviors.UploadableImageBehavior',
				'attributeName' => 'img_sdfsdf',
				'versions' => array(
					'icon' => array(
						'centeredpreview' => array(90, 90),
					),
					'small' => array(
						'resize' => array(200, 180),
					)
				),
			),
			'galleryBehaviorTimer' => array(
				'class' => 'appext.imagesgallery.GalleryBehavior',
				'idAttribute' => 'gllr_timer',
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
			'galleryBehaviorDfdfdfdf' => array(
				'class' => 'appext.imagesgallery.GalleryBehavior',
				'idAttribute' => 'gllr_dfdfdfdf',
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
		$criteria->compare('dt_timer',$this->dt_timer,true);
		$criteria->compare('dttm_timer',$this->dttm_timer,true);
		$criteria->compare('tm_timer',$this->tm_timer,true);
		$criteria->compare('img_sddd',$this->img_sddd,true);
		$criteria->compare('img_sdfsdf',$this->img_sdfsdf,true);
		$criteria->compare('wswg_3434',$this->wswg_3434,true);
		$criteria->compare('wswg_5656',$this->wswg_5656,true);
		$criteria->compare('gllr_timer',$this->gllr_timer);
		$criteria->compare('gllr_dfdfdfdf',$this->gllr_dfdfdfdf);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('update_time',$this->update_time);

        $criteria->order = 'sort';

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
        return 'sdsd';
    }

	public function beforeSave()
	{
		if (!empty($this->dt_timer))
			$this->dt_timer = Yii::app()->date->toMysql($this->dt_timer);
		if (!empty($this->dttm_timer))
			$this->dttm_timer = Yii::app()->date->toMysql($this->dttm_timer);
		if (!empty($this->tm_timer))
			$this->tm_timer = Yii::app()->date->toMysql($this->tm_timer);
		return parent::beforeSave();
	}

	public function afterFind()
	{
		parent::afterFind();
		if ( in_array($this->scenario, array('insert', 'update')) ) { 
			$this->dt_timer = ($this->dt_timer !== '0000-00-00' ) ? date('d-m-Y', strtotime($this->dt_timer)) : '';
			$this->dttm_timer = ($this->dttm_timer !== '0000-00-00 00:00:00' ) ? date('d-m-Y H:i', strtotime($this->dttm_timer)) : '';
			$this->tm_timer = ($this->tm_timer !== '00:00:00' ) ? date('H:i', strtotime($this->tm_timer)) : '';
		}
	}
}
