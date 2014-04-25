<?php

/**
 * This is the model class for table "{{news_list}}".
 *
 * The followings are the available columns in table '{{news_list}}':
 * @property integer $id
 * @property integer $node_id
 * @property integer $page_size
 */
class NewsList extends CActiveRecord
{
	public function tableName()
	{
		return '{{news_lists}}';
	}


	public function rules()
	{
		return array(
			array('node_id, page_size', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			array('id, node_id, page_size', 'safe', 'on'=>'search'),
		);
	}


	public function relations()
	{
		return array(
			'node' => array(self::BELONGS_TO, 'Structure', 'node_id'),
		);
	}


	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'node_id' => 'Node',
			'page_size' => 'Кол-во новостей на странице',
		);
	}


	public function behaviors()
	{
		return array(
			'StructureComponent' => array(
				'class' => 'application.behaviors.StructureComponentBehavior',
			),
		);
	}


	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('node_id',$this->node_id);
		$criteria->compare('page_size',$this->page_size);
		$criteria->order = 'sort';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function newsSearch($count = null)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('list_id', $this->id);
		$criteria->compare('status', News::STATUS_PUBLISH);
		if ( isset($_GET['tag']) )
			$criteria->compare('tags', $_GET['tag'], true);
		$criteria->order = 'create_time DESC';
		$pageSize = $count ? $count : ( is_numeric($this->page_size) ? $this->page_size : 5 );
		return new CActiveDataProvider('News', array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>$pageSize
			)
		));
	}
}
