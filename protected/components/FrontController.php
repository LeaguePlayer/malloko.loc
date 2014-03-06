<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class FrontController extends Controller
{
    public $layout='//layouts/simple';
    public $menu=array();
    public $breadcrumbs=array();

    public function init() {
        parent::init();
        $this->title = Yii::app()->name;
    }

    //Check home page
    public function is_home(){
        return $this->route == 'site/index';
    }

    public function beforeRender($view)
    {
        $this->renderPartial('//layouts/clips/_main_menu');
        return parent::beforeRender($view);
    }

    public function buildMenu($currentNode = null)
    {
        $root = Menu::model()->cache(3600)->findByAttributes(array(
            'level' => 1
        ));
        if ( !$root ) return;
        $criteria = new CDbCriteria();
        $criteria->compare('status', 1);
        $criteria->addCondition('level<4');

        $items = $root->descendants()->cache(3600)->findAll($criteria);
        $mainActiveId = 0;
        $subActiveId = 0;

        if ( $currentNode ) {
            foreach ( $items as $item ) {
                if ( $item->level == 2 && $item->node_id == $currentNode->id ) {
                    $mainActiveId = $item->id;
                    break;
                }
                if ( $item->level == 3 && $item->node_id == $currentNode->id ) {
                    $subActiveId = $item->id;
                    $mainActiveId = $item->parent_id;
                    break;
                }
            }
        }

        foreach ( $items as $item ) {
            if ( $item->level == 2 ) {
                $this->mainMenu[] = array(
                    'active' => $item->id === $mainActiveId,
                    'label' => $item->name,
                    'url' => $item->getUrl(),
                    'class' => $item->item_class,
                );
                continue;
            }
            if ( $item->level == 3 && $item->parent_id === $mainActiveId ) {
                $this->subMenu[] = array(
                    'active' => $item->id === $subActiveId,
                    'label' => $item->name,
                    'url' => $item->getUrl(),
                    'class' => $item->item_class,
                );
                continue;
            }
        }
    }
}