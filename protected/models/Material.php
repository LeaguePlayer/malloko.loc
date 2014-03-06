<?php

/**
 * This is the model class for table "{{materials}}".
 *
 * The followings are the available columns in table '{{materials}}':
 * @property integer $id
 * @property string $name
 * @property string $model
 * @property integer $sort
 */
class Material extends CActiveRecord
{
    public function tableName()
    {
        return '{{materials}}';
    }

    public function rules()
    {
        return array(
            array('class_name, name', 'required'),
            array('class_name', 'unique'),
            array('name, class_name', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, name, class_name', 'safe', 'on'=>'search'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Название материала',
            'class_name' => 'Класс',
        );
    }

    public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('id',$this->id);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('class_name',$this->name,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function listMaterials()
    {
        $exists = CHtml::listData(Yii::app()->db->createCommand()
            ->select('class_name')
            ->from($this->tableName())
            ->queryAll(), 'class_name', 'class_name');

        $path = Yii::getPathOfAlias('application.models').DIRECTORY_SEPARATOR;
        $out = array();
        foreach ( glob($path.'*.php') as $file ) {
            $fileinfo = pathinfo($file);
            $classname = $fileinfo['filename'];
            if ( in_array($classname, array('Material', 'Seo', 'Config', 'GalleryPhoto', 'Structure')) )
                continue;
            if ( in_array($classname, $exists) )
                continue;
            $out[$classname] = $classname;
        }
        return $out;
    }
}
