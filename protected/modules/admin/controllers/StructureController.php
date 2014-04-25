<?php

class StructureController extends AdminController
{
    public $layout = '/layouts/structure';


	public function actionList($opened = false)
	{
		$openNode = Structure::model()->findByPk($opened);
//		var_dump( $openNode ); die();

		$this->render('list', array(
			'openNode' => $openNode
		));
	}


    public function actionCreate($parent_id = null)
    {
        $model = new Structure;
        if ( $parent_id )
            $parent = Structure::model()->findByPk($parent_id);

        if ( isset($_POST['Structure']) ) {
            $model->attributes = $_POST['Structure'];
            if ( $model->validate() ) {
                if ( $parent !== null ) {
                    $model->appendTo($parent, false);
                } else {
                    $model->saveNode(false);
                }
                $controllerID = lcfirst($model->material->class_name);
                $this->redirect(array("/admin/{$controllerID}/create", 'node_id'=>$model->id));
            }

        }
        $this->layout = '/layouts/admin_columns';
        $this->render('create', array(
            'model' => $model,
            'parent' => $parent
        ));
    }


    // Обновление раздела
    public function actionUpdate($id)
    {
        $model = Structure::model()->findByPk($id);
        if ( !$model ) {
            throw new CHttpException(404, 'Раздел не найден');
        }
        $parent = $model->parent()->find();

        $oldMaterialId = $model->material_id;
        if ( isset($_POST['Structure']) ) {
            $model->attributes = $_POST['Structure'];
            if ( $model->saveNode() ) {
                if ( $model->material_id !== $oldMaterialId ) {
                    $component = $model->getComponent();
                    if ( $component ) {
                        $component->delete();
                    }
                    $model->refresh();
                    $controllerID = strtolower($model->material->class_name);
                    $this->redirect(array("/admin/{$controllerID}/create", 'node_id'=>$model->id));
                }
                $this->redirect( array('list') );
            }
        }
        $this->layout = '/layouts/admin_columns';
        $this->render('update', array(
            'model' => $model,
            'parent' => $parent
        ));
    }


    public function actionDelete($id)
    {
        $model = Structure::model()->findByPk($id);
        $model->deleteNode();
        $this->redirect(array('list'));
    }


    public function actionUpdateMaterial($node_id) {
        $node = Structure::model()->findByPk($node_id);
        if ( !$node ) {
            throw new CHttpException(404, 'Раздел не найден');
        }

        $modelName = $node->material->class_name;
        $model = $modelName::model()->findByAttributes(array(
            'node_id'=>$node_id
        ));
        $controllerID = lcfirst($modelName);
        if ( !$model )
            $this->redirect(array("/admin/{$controllerID}/create", 'node_id'=>$node_id));
        $this->redirect(array("/admin/{$controllerID}/update", 'id'=>$model->id, 'node_id'=>$node_id));
    }


    public function actionMoveDown()
    {
        $id = $_POST['id'];
        $node = $this->loadModel('Structure', $id);
        $nextNode = $node->next()->find();
        if ( !$nextNode ) {
            $success = false;
        } else if ( $node->moveAfter($nextNode) ) {
            $success = true;
        } else {
            $success = false;
        }
        echo CJSON::encode(array('success'=>$success, 'action'=>'down'));
    }


    public function actionMoveUp()
    {
        $id = $_POST['id'];
        $node = $this->loadModel('Structure', $id);
        $prevNode = $node->prev()->find();
        if ( !$prevNode ) {
            $success = false;
        } else if ( $node->moveBefore($prevNode) ) {
            $success = true;
        } else {
            $success = false;
        }
        echo CJSON::encode(array('success'=>$success, 'action'=>'up'));
    }


    public function actionMoveToNext()
    {
        $id = $_POST['id'];
        $node = $this->loadModel('Structure', $id);
        $nextNode = $node->next()->find();
        if ( !$nextNode ) {
            $success = false;
        } else if ( $node->moveAsFirst($nextNode) ) {
            $success = true;
        } else {
            $success = false;
        }
        echo CJSON::encode(array('success'=>$success, 'action'=>'toNext'));
    }


    public function actionMoveToParent()
    {
        $id = $_POST['id'];
        $node = $this->loadModel('Structure', $id);
        $parentNode = $node->parent()->find();
        if ( !$parentNode ) {
            $success = false;
        } else if ( $node->moveBefore($parentNode) ) {
            $success = true;
        } else {
            $success = false;
        }
        echo CJSON::encode(array('success'=>$success, 'action'=>'toParent'));
    }
}
