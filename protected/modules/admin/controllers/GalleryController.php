<?php
/**
 * Backend controller for GalleryManager widget.
 * Provides following features:
 *  - Image removal
 *  - Image upload/Multiple upload
 *  - Arrange images in gallery
 *  - Changing name/description associated with image
 *
 * @author Bogdan Savluk <savluk.bogdan@gmail.com>
 */

class GalleryController extends AdminController
{
	public $defaultAction = 'manage';

    public function filters()
    {
        return array(
            'postOnly + delete, ajaxUpload, order, changeData, changeMain',
        );
    }

    /**
     * Removes image with ids specified in post request.
     * On success returns 'OK'
     */
    public function actionDelete()
    {
        $id = $_POST['id'];
        /** @var $photos GalleryPhoto[] */
        $photos = GalleryPhoto::model()->findAllByPk($id);
        foreach ($photos as $photo) {
            if ($photo !== null) $photo->delete();
            else throw new CHttpException(400, 'Photo, not found');
        }
        echo 'OK';
    }

    /**
     * Method to handle file upload thought XHR2
     * On success returns JSON object with image info.
     * @param $gallery_id string Gallery Id to upload images
     * @throws CHttpException
     */
    public function actionAjaxUpload($gallery_id = null)
    {
        $model = new GalleryPhoto();
        $model->gallery_id = $gallery_id;
        $imageFile = CUploadedFile::getInstanceByName('image');
        $model->file_name = $imageFile->getName();
        $model->ext = $imageFile->extensionName;
        $model->save();

        $model->setImage($imageFile->getTempName());
        header("Content-Type: application/json");
        echo CJSON::encode(
            array(
                'id' => $model->id,
                'rank' => $model->rank,
                'name' => (string)$model->name,
                'description' => (string)$model->description,
                'preview' => $model->getPreview(),
                'main' => $model->main,
            ));
		$this->disableLogRoutes();
		Yii::app()->end();
    }

    /**
     * Saves images order according to request.
     * Variable $_POST['order'] - new arrange of image ids, to be saved
     * @throws CHttpException
     */
    public function actionOrder()
    {
        if (!isset($_POST['order'])) throw new CHttpException(400, 'No data, to save');
        $gp = $_POST['order'];
        $orders = array();
        $i = 0;
        foreach ($gp as $k => $v) {
            if (!$v) $gp[$k] = $k;
            $orders[] = $gp[$k];
            $i++;
        }
        sort($orders);
        $i = 0;
        $res = array();
        foreach ($gp as $k => $v) {
            /** @var $p GalleryPhoto */
            $p = GalleryPhoto::model()->findByPk($k);
            $p->rank = $orders[$i];
            $res[$k]=$orders[$i];
            $p->save(false);
            $i++;
        }

        echo CJSON::encode($res);

    }

    public function actionChangeMain(){
        if(!empty($_POST['main_id']) && !empty($_POST[  'id'])){
            $id = $_POST['id'];
            $main_id = $_POST['main_id'];
            /** @var $photos GalleryPhoto[] */
            $photos = GalleryPhoto::model()->findAllByPk($id);
            foreach ($photos as $photo) {
                if ($photo !== null){
                    $photo->main = 0;
                    $photo->save();
                }
                else throw new CHttpException(400, 'Photo, not found');
            }
            $main = GalleryPhoto::model()->findByPk($main_id);
            if($main !== null){
                $main->main = 1;
                $main->save();
            }
            else throw new CHttpException(400, 'Photo, not found');

            echo 'OK';
        }
    }

    /**
     * Method to update images name/description via AJAX.
     * On success returns JSON array od objects with new image info.
     * @throws CHttpException
     */
    public function actionChangeData()
    {
        if (!isset($_POST['photo'])) throw new CHttpException(400, 'Nothing, to save');
        $data = $_POST['photo'];
        $criteria = new CDbCriteria();
        $criteria->index = 'id';
        $criteria->addInCondition('id', array_keys($data));
        /** @var $models GalleryPhoto[] */
        $models = GalleryPhoto::model()->findAll($criteria);
        foreach ($data as $id => $attributes) {
            if (isset($attributes['name']))
                $models[$id]->name = $attributes['name'];
            if (isset($attributes['description']))
                $models[$id]->description = $attributes['description'];
            $models[$id]->save();
        }
        $resp = array();
        foreach ($models as $model) {
            $resp[] = array(
                'id' => $model->id,
                'rank' => $model->rank,
                'name' => (string)$model->name,
                'description' => (string)$model->description,
                'preview' => $model->getPreview(),
                'main' => $model->main,
            );
        }
        echo CJSON::encode($resp);
    }


	public function actionAddGallery()
	{
		$response = array(
			'widget' => '',
			'options' => array(),
		);
		if ( isset($_POST['Gallery']) ) {
			$gallery = new Gallery();
			$gallery->attributes = $_POST['Gallery'];
			$versions = array();
			foreach ($_POST['Gallery']['versions'] as $i => $post) {
				if ( empty($post['prefix']) || empty($post['methods']) ) {
					continue;
				}
				foreach ( $post['methods'] as $method ) {
					if ( empty($method['method']) )
						continue;
					$params = array();
					if ( isset($method['x']) ) $params[] = is_numeric($method['x']) ? $method['x'] : 0;
					if ( isset($method['y']) ) $params[] = is_numeric($method['y']) ? $method['y'] : 0;
					if ( isset($method['w']) ) $params[] = is_numeric($method['w']) ? $method['w'] : 0;
					if ( isset($method['h']) ) $params[] = is_numeric($method['h']) ? $method['h'] : 0;
					$versions[$post['prefix']][$method['method']] = $params;
				}
			}
			$gallery->versions = $versions;
			if ( !$gallery->save() ) {
				$response['errors'] = $gallery->errors;
			} else {
				$response['widget'] = $this->widget('application.extensions.imagesgallery.GalleryManager', array(
					'gallery' => $gallery,
					'controllerRoute' => '/admin/gallery',
				), true);
				$response['options'] = array(
					'gallery_id' => $gallery->id,
					'hasName' => $gallery->name ? true : false,
					'hasDesc' => $gallery->description ? true : false,
					'uploadUrl' => $this->createUrl($this->id . '/ajaxUpload', array('gallery_id' => $gallery->id)),
					'deleteUrl' => $this->createUrl($this->id . '/delete'),
					'updateUrl' => $this->createUrl($this->id . '/changeData'),
					'arrangeUrl' => $this->createUrl($this->id . '/order'),
					'changeMainUrl' => $this->createUrl($this->id . '/changeMain'),
					'nameLabel' => Yii::t('galleryManager.main', 'Name'),
					'descriptionLabel' => Yii::t('galleryManager.main', 'Description'),
					'photos' => array(),
				);
			}
		}

		echo CJSON::encode($response);
	}


	public function actionSelectGallery($id)
	{
		$response = array(
			'widget' => '',
			'options' => array(),
		);
		$gallery = Gallery::model()->findByPk($id);
		if ( $gallery ) {
			$response['widget'] = $this->widget('application.extensions.imagesgallery.GalleryManager', array(
				'gallery' => $gallery,
				'controllerRoute' => '/admin/gallery',
			), true);

			$photos = array();
			foreach ($gallery->galleryPhotos as $photo) {
				$photos[] = array(
					'id' => $photo->id,
					'rank' => $photo->rank,
					'name' => (string)$photo->name,
					'description' => (string)$photo->description,
					'preview' => $photo->getPreview(),
					'main' => $photo->main,
				);
			}

			$response['options'] = array(
				'gallery_id' => $gallery->id,
				'hasName' => $gallery->name ? true : false,
				'hasDesc' => $gallery->description ? true : false,
				'uploadUrl' => $this->createUrl($this->id . '/ajaxUpload', array('gallery_id' => $gallery->id)),
				'deleteUrl' => $this->createUrl($this->id . '/delete'),
				'updateUrl' => $this->createUrl($this->id . '/changeData'),
				'arrangeUrl' => $this->createUrl($this->id . '/order'),
				'changeMainUrl' => $this->createUrl($this->id . '/changeMain'),
				'nameLabel' => Yii::t('galleryManager.main', 'Name'),
				'descriptionLabel' => Yii::t('galleryManager.main', 'Description'),
				'photos' => $photos,
			);
		}
		echo CJSON::encode($response);
	}


	public function actionDeleteGallery()
	{
		$id = $id = isset($_POST['id']) ? $_POST['id'] : ( isset($_GET['id']) ? $_GET['id'] : 0 );;
		$gallery = Gallery::model()->findByPk($id);
		if ( $gallery )
			$gallery->delete();
		echo 'OK';
	}


	public function actionUnlinkGallery()
	{
		$entity_type = $_GET['entity_type'];
		$entity_id = $_GET['entity_id'];
		$gallery_id = $_GET['id'];
		if ( $entity_type && $entity_id ) {
			EntityGallery::model()->deleteAllByAttributes(array(
				'gallery_id' => $gallery_id,
				'entity_type' => $entity_type,
				'entity_id' => $entity_id,
			));
		}
		echo 'OK';
	}


	protected function disableLogRoutes()
	{
		foreach (Yii::app()->log->routes as $route)
		{
			if ($route instanceof CLogRoute)
			{
				$route->enabled = false;
			}
		}
	}


	public function actionManage()
	{
		$model = new Gallery('search');
		$model->unsetAttributes();

		if ( isset($_GET['Gallery']) )
			$model->attributes = $_GET['Gallery'];

		$this->render('manage', array(
			'model' => $model
		));
	}


	public function actionView($id)
	{
		$model = $this->loadModel('Gallery', $id);

		$this->render('view', array(
			'model' => $model
		));
	}
}
