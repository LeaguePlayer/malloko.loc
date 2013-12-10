<?php

/**
* This is the model class for table "{{settings}}".
*
* The followings are the available columns in table '{{settings}}':
    * @property integer $id
    * @property string $label
    * @property string $name
    * @property string $type
    * @property integer $type_id
*/
class Settings extends EActiveRecord
{
    public function tableName()
    {
        return '{{settings}}';
    }


    public function rules()
    {
        return array(
            array('label, name', 'required'),
            array('type_id', 'numerical', 'integerOnly'=>true),
            array('label, name, type', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, label, name, type, type_id', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'string' => array(self::BELONGS_TO, 'SettingsString', 'type_id'),
            'text' => array(self::BELONGS_TO, 'SettingsText', 'type_id'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'label' => 'Название',
            'name' => 'Уникальное имя',
            'type' => 'Тип поля',
            'type_id' => 'Значение Типа',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('label',$this->label,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('type_id',$this->type_id);
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
        return 'Настройки';
    }

    //model name
    public function getSettingName(){

        switch ($this->type) {
            case 'string':
                return 'SettingsString';
            case 'text':
                return 'SettingsText';
        }

        return 'SettingsString';
    }

    public static function getValue($settingName){
        $setting = self::model()->find('name=:name', array(':name' => $settingName));

        if($setting){
            $type = $setting->{$setting->type};
            if($type) return $type->value;
        }

        return '';
    }
}
