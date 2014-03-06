<?php

/**
* This is the model class for table "{{seo}}".
*
* The followings are the available columns in table '{{seo}}':
    * @property integer $id
    * @property string $meta_title
    * @property string $meta_keys
    * @property string $meta_desc
    * @property string $meta_html
*/
class Seo extends CActiveRecord
{
    public function tableName()
    {
        return '{{seo}}';
    }


    public function rules()
    {
        return array(
            array('meta_title, meta_keys', 'length', 'max'=>255),
            array('meta_desc, meta_html', 'safe'),
            // The following rule is used by search().
            array('id, meta_title, meta_keys, meta_desc, meta_html', 'safe', 'on'=>'search'),
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
            'meta_title' => 'Meta title',
            'meta_keys' => 'Meta keys',
            'meta_desc' => 'Meta description',
            'meta_html' => 'Meta html',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_keys',$this->meta_keys,true);
		$criteria->compare('meta_desc',$this->meta_desc,true);
		$criteria->compare('meta_html',$this->meta_html,true);
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
        return 'Раздел для SEO специалиста';
    }
}
