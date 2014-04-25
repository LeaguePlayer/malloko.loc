<?php

// Owner должен реализовывать функционал поведения NestedSetBehavior

class ECategoryNSTreeBehavior extends CActiveRecordBehavior
{
    /**
     * @var string model attribute used for showing title
     */
    public $titleAttribute = 'title';
    /**
     * @var string model attribute, which defined alias
     */
    public $aliasAttribute = 'alias';
    /**
     * @var string model property, which contains url.
     * Optionally your model can have 'url' attribute or getUrl() method,
     * which construct correct url for using our getMenuList().
     */
    public $urlAttribute = 'url';
	/**
	 * @var string set this request property if you can use default getLinkActive() method
	 */
	public $requestPathAttribute = 'path';
    /**
     * @var string model property, which contains icon.
     * Optionally for 'image' value your model can have 'image' attribute or getImage() method,
     * which construct correct url for using our getMenuList().
     */
    public $iconAttribute;
    /**
     * @var string model property, which return true for active menu item.
     * Optionally declare own getLinkActive() method in your model.
     */
    public $linkActiveAttribute = 'linkActive';



	/**
	 * Optional redeclare this method in your model for use (@link getMenuList())
	 * or define in (@link requestPathAttribute) your $_GET attribute for url matching
	 * @return bool true if current request url matches with category alias
	 */
	public function getLinkActive()
	{
		return mb_strpos(Yii::app()->request->getParam($this->requestPathAttribute), $this->getOwner()->{$this->aliasAttribute}, null, 'UTF-8') === 0;
	}



    protected $leftAttribute='lft';
    protected $rightAttribute='rgt';
    protected $levelAttribute='level';

    public function attach($owner) {
        if ( !$owner->asa('NestedSetBehavior') )
            throw new CHttpException(403, 'Не подключено поведение NestedSetBehavior');

        $this->leftAttribute = $owner->NestedSetBehavior->leftAttribute;
        $this->rightAttribute = $owner->NestedSetBehavior->rightAttribute;
        $this->levelAttribute = $owner->NestedSetBehavior->levelAttribute;
        parent::attach($owner);
    }

    /**
     * Returns items for zii.widgets.CMenu widget
     * @param mixed $parent number, object or array of numbers
     * @param int $sub levels
     * @return array
     */
    public function getMenuList($sub = 1, $parent = 0)
    {
        $owner = $this->getOwner();
        if ( !$parent ) {
            $parent = $owner->roots()->find();
        }
        if ( !$parent )
            return array();

        return $this->_getMenuListRecursive($parent, $sub);
    }

    protected function _getMenuListRecursive($current, $sub)
    {
        $resultArray = array();
        $children = $current->children()->findAll();
        foreach ( $children as $item ) {
            $active = $item->{$this->linkActiveAttribute};
            $resultArray[$item->getPrimaryKey()] = array(
                'id'=>$item->getPrimaryKey(),
                'label'=>$item->{$this->titleAttribute},
                'url'=>$item->{$this->urlAttribute},
                'icon'=>$this->iconAttribute !== null ? $item->{$this->iconAttribute} : '',
                'active'=>$active,
                'itemOptions'=>array('class'=>'item_' . $item->getPrimaryKey()),
                'linkOptions'=>$active ? array('rel'=>'nofollow') : array(),
            ) + ($sub ? array('items'=>$this->_getMenuListRecursive($item, $sub - 1)) : array());
        }
        return $resultArray;
    }
}