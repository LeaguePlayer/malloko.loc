<?php

class Menu extends EActiveRecord
{
    public static function getStatusAliases($status = -1)
    {
        $aliases = array(
            self::STATUS_PUBLISH => 'Да',
            self::STATUS_CLOSED => 'Нет',
        );

        if ($status > -1)
            return $aliases[$status];

        return $aliases[self::STATUS_CLOSED];
    }

    public function tableName()
    {
        return '{{menu}}';
    }


    public function rules()
    {
        return array(
            array('parent_id, node_id, status', 'numerical', 'integerOnly'=>true),
            array('name, external_link, item_class', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, parent_id, node_id, name, external_link, status', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'node'=>array(self::BELONGS_TO, 'Structure', 'node_id'),
        );
    }


    public function behaviors()
    {
        return array(
            'nestedSetBehavior'=>array(
                'class'=>'application.behaviors.NestedSetBehavior',
                'leftAttribute'=>'lft',
                'rightAttribute'=>'rgt',
                'levelAttribute'=>'level',
            ),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'parent_id' => 'Родительский пункт',
            'node_id' => 'Раздел',
            'name' => 'Название',
            'external_link' => 'Внешняя ссылка',
            'item_class' => 'Класс для стиля',
            'status' => 'Включено',
        );
    }




    public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('id',$this->id);
        $criteria->compare('parent_id',$this->parent_id);
        $criteria->compare('node_id',$this->node_id);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('external_link',$this->external_link,true);
        $criteria->compare('status',$this->status);
        $criteria->order = 'lft';

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>false
        ));
    }

    public function beforeSave()
    {
        return true;
    }

    public function beforeDelete()
    {
        return true;
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function getOffset()
    {
        return str_repeat('<span class="offset"></span>', $this->level - 1);
    }

    public function getName()
    {
        if ( $this->level == 2 )
            return $this->getOffset().'<b>'.$this->name.'</b>';
        return $this->getOffset().$this->name;
    }

    public function getTbContextMenu()
    {
        return TbHtml::buttonDropdown(TbHtml::icon(TbHtml::ICON_TH_LIST), array(
            array("label" => "<b>Свойства</b>", "url" => array("/admin/menu/update", "id"=>$this->id)),
            array("label" => "Добавить подпункт", "url" => array("/admin/menu/create", "parent_id"=>$this->id), "visible" => $this->level<3),
            array("label" => "Удалить", "url" => array("/admin/menu/delete", "id"=>$this->id), "visible" => !$this->isRoot()),
        ), array("size"=>TbHtml::BUTTON_SIZE_MINI));
    }

    public function renderAdminRow()
    {
        $out = "<div class='row' data-id='".$this->id."'>";
        if ( !$this->isRoot() )
            $out .= "<span class='cell check'>".CHtml::checkBox('')."</span>";
        else
            $out .= "<span class='cell check'></span>";
        $out .= "<span class='cell menu'>".$this->getTbContextMenu()."</span>".
            "<span class='cell name'>".$this->getName()."</span>".
            "<span class='cell link'>".CHtml::link($this->getUrl(), $this->getUrl(), array("target"=>"_blank"))."</span>".
            "<span class='cell type'>".Menu::getStatusAliases($this->status)."</span>".
            "</div>";
        echo $out;
    }

    public function getUrl()
    {
        if ( !empty($this->external_link) )
            return $this->external_link;

        $subMenu = $this->children()->find();
        if ( $subMenu ) {
            $node = $subMenu->node;
            if ( $node )
                return $node->getUrl();
        }

        if ( $this->node )
            return $this->node->getUrl();
        return '';
    }
}
