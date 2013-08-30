<?php

/**
* This is the model class for table "{{email_templates}}".
*
* The followings are the available columns in table '{{email_templates}}':
    * @property integer $id
    * @property string $name
    * @property string $alias
    * @property string $subject
    * @property string $content
    * @property integer $create_time
    * @property integer $update_time
*/
class EmailTemplates extends CActiveRecord
{
    public function tableName()
    {
        return '{{email_templates}}';
    }


    public function behaviors()
    {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'create_time',
                'updateAttribute' => 'update_time',
            )
        );
    }


    public function scopes()
    {
        return array(
            'with_all_vars'=>array(
                'with' => array('vars' => array(
                    'join' => ' OR (vars.template_id=0)'
                )),
            ),
        );
    }


    public function rules()
    {
        return array(
            array('subject, content', 'required'),
            array('create_time, update_time', 'numerical', 'integerOnly'=>true),
            array('name, alias, subject', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, name, alias, subject, content, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'vars' => array(self::HAS_MANY, 'EmailVars', 'template_id'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Название шаблона',
            'alias' => 'Идентификатор шаблона',
            'subject' => 'Тема письма',
            'content' => 'Шаблон письма',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('content',$this->content,true);
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


}
