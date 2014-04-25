<?php
/**
 * Behavior for adding gallery to any model.
 *
 * @author Bogdan Savluk <savluk.bogdan@gmail.com>
 */
class GalleryBehavior extends CActiveRecordBehavior
{
	private $_entityName;
	private $_galleries;

	public function attach($owner)
	{
		parent::attach($owner);
		$this->_entityName = get_class($owner);
		$owner->metaData->addRelation('galleries', array($owner::MANY_MANY, 'Gallery', '{{entity_gallery}}(entity_id, gallery_id)', 'on'=>'entity_type="'.$this->_entityName.'"'));
		$owner->metaData->addRelation('galleries_associations', array($owner::HAS_MANY, 'EntityGallery', 'entity_id', 'condition'=>'entity_type="'.$this->_entityName.'"'));
		$owner->metaData->addRelation('gallery', array($owner::HAS_ONE, 'Gallery', array('gallery_id'=>'id'), 'through'=>'galleries_associations', 'order' => 'galleries_associations.id'));
	}


	public function getGalleries()
	{
		return $this->getOwner()->galleries;
	}


	/**
	 * @param mixed $id
	 */
	public function getGallery($id = false)
	{
		if ( !$id ) {
			return $this->getOwner()->gallery(array('limit'=>1));
		} else if ( is_numeric($id) ) {
			return Gallery::model()->findByPk($id);
		} else {
			return $this->getOwner()->gallery(array('condition'=>'gallery.alias=:g_alias', 'params'=>array(':g_alias'=>$id)));
		}
	}

	/** @return GalleryPhoto[] Photos from associated gallery */
	public function getGalleryPhotos($id = false)
	{
		$gallery = $this->getGallery($id);

		$criteria = new CDbCriteria();
		$criteria->condition = 'gallery_id = :gallery_id';
		$criteria->params[':gallery_id'] = $gallery->id;
		$criteria->order = '`rank` asc';
		return GalleryPhoto::model()->findAll($criteria);
	}

	/** Will create new gallery after save if no associated gallery exists */
	public function afterSave($event)
	{
		parent::afterSave($event);
		// Удаляю все связи с галереями, но не сами галереи
		EntityGallery::model()->deleteAll(array(
			'condition' => 'entity_id=:e_id AND entity_type=:e_type',
			'params'=>array(':e_id'=>$this->getOwner()->id, ':e_type'=>$this->_entityName),
		));

		// Восстанавливаю все связи с галереями
		if ( isset( $_POST['Galleries'] ) ) {
			foreach ( $_POST['Galleries'] as $post ) {
				$gallery_id = $post['id'];
				$entityGallery = new EntityGallery();
				$entityGallery->entity_id = $this->getOwner()->id;
				$entityGallery->gallery_id = $gallery_id;
				$entityGallery->entity_type = $this->_entityName;
				$entityGallery->save();
			}
		}
	}

    /** Will remove associated Gallery before object removal */
    public function beforeDelete($event)
    {
		EntityGallery::model()->deleteAll(array(
			'condition' => 'entity_id=:e_id AND entity_type=:e_type',
			'params'=>array(':e_id'=>$this->getOwner()->id, ':e_type'=>$this->_entityName),
		));
        parent::beforeDelete($event);
    }

    /** Method for changing gallery configuration and regeneration of images versions */
//    public function changeConfig()
//    {
//        /** @var $gallery Gallery */
//        $gallery = Gallery::model()->findByPk($this->getOwner()->{$this->idAttribute});
//        if($gallery == null) return;
//        foreach ($gallery->galleryPhotos as $photo) {
//            $photo->removeImages();
//        }
//
//        $gallery->name = $this->name;
//        $gallery->description = $this->description;
//        $gallery->versions = $this->versions;
//        $gallery->save();
//
//        foreach ($gallery->galleryPhotos as $photo) {
//            $photo->updateImages();
//        }
//
//        $this->getOwner()->{$this->idAttribute} = $gallery->id;
//        $this->getOwner()->saveAttributes($this->getOwner()->getAttributes());
//    }
}
