<?php

/**
* This is the model class for table "{{email_vars}}".
*
* The followings are the available columns in table '{{email_vars}}':
    * @property integer $id
    * @property string $name
    * @property string $value
    * @property integer $template_id
*/
class EmailVars extends CActiveRecord
{
    public function tableName()
    {
        return '{{email_vars}}';
    }


    public function rules()
    {
        return array(
            array('name', 'required'),
            array('template_id', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>255),
            array('value', 'safe'),
            // The following rule is used by search().
            array('id, name, value, template_id', 'safe', 'on'=>'search'),
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
            'name' => 'Имя переменной',
            'value' => 'Значение переменной',
            'template_id' => 'Ссылка на шаблон',
            'content' => 'Шаблон письма',
        );
    }




    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('template_id',$this->template_id);
		$criteria->compare('content',$this->content,true);
        $criteria->order = 'sort';

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }


}
