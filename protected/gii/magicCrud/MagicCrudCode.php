<?php
/**
 * BootstrapCode class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

Yii::import('gii.generators.crud.CrudCode');

class MagicCrudCode extends CrudCode
{
    public $baseAdminControllerClass='AdminController';
    public $baseControllerClass='FrontController';

    public function rules()
    {
        return array_merge(parent::rules(), array(
            array('model, controller', 'filter', 'filter'=>'trim'),
            array('model, controller, baseControllerClass, baseAdminControllerClass', 'required'),
            array('model', 'match', 'pattern'=>'/^\w+[\w+\\.]*$/', 'message'=>'{attribute} should only contain word characters and dots.'),
            array('controller', 'match', 'pattern'=>'/^\w+[\w+\\/]*$/', 'message'=>'{attribute} should only contain word characters and slashes.'),
            array('baseControllerClass, baseAdminControllerClass', 'match', 'pattern'=>'/^[a-zA-Z_][\w\\\\]*$/', 'message'=>'{attribute} should only contain word characters and backslashes.'),
            array('baseControllerClass, baseAdminControllerClass', 'validateReservedWord', 'skipOnError'=>true),
            array('model', 'validateModel'),
            array('baseControllerClass, baseAdminControllerClass', 'sticky'),
        ));
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), array(
            'model'=>'Model Class',
            'controller'=>'Controller ID',
            'baseControllerClass'=>'Base Controller Class',
            'adminController'=>'Контроллер админки',
            'baseAdminControllerClass'=>'Базовый класс контроллера админки',
        ));
    }

    public function requiredTemplates()
    {
        return array(
            'controller.php',
        );
    }

    public function successMessage()
    {
        $link=CHtml::link('try it now', Yii::app()->createUrl($this->controller), array('target'=>'_blank'));
        return "The controller has been generated successfully. You may $link.";
    }

    public function getAdminControllerFile()
    {
        if(($module=Yii::app()->getModule('admin'))===null)
           return false;
        $id=$this->getControllerID();
        if(($pos=strrpos($id,'/'))!==false)
            $id[$pos+1]=strtoupper($id[$pos+1]);
        else
            $id[0]=strtoupper($id[0]);
        return $module->getControllerPath().'/'.$id.'Controller.php';
    }

    public function getAdminViewPath()
    {
        return Yii::app()->getModule('admin')->getViewPath().'/'.$this->getControllerID();
    }

    public function getViewPath()
    {
        if ( isset(Yii::app()->theme) ) {
            return Yii::app()->theme->getViewPath().'/'.$this->getControllerID();
        }
        return parent::getViewPath();
    }

    public function prepare()
    {
        $this->files=array();
        $templatePath=$this->templatePath;

        $controllerTemplateFile=$templatePath.DIRECTORY_SEPARATOR.'controller.php';

        $this->files[]=new CCodeFile(
            $this->controllerFile,
            $this->render($controllerTemplateFile)
        );

        $files=scandir($templatePath);
        foreach($files as $file)
        {
            if(is_file($templatePath.'/'.$file) && CFileHelper::getExtension($file)==='php' && $file!=='controller.php')
            {
                $this->files[]=new CCodeFile(
                    $this->viewPath.DIRECTORY_SEPARATOR.$file,
                    $this->render($templatePath.'/'.$file)
                );
            }
        }

        $adminTemplatePath = $templatePath.DIRECTORY_SEPARATOR.'admin';
        $adminControllerTemplateFile=$adminTemplatePath.DIRECTORY_SEPARATOR.'controller.php';
        $this->files[]=new CCodeFile(
            $this->adminControllerFile,
            $this->render($adminControllerTemplateFile)
        );
        $adminFiles = scandir($adminTemplatePath);
        foreach($adminFiles as $file)
        {
            if(is_file($adminTemplatePath.'/'.$file) && CFileHelper::getExtension($file)==='php' && $file!=='controller.php')
            {
                $this->files[]=new CCodeFile(
                    $this->adminViewPath.DIRECTORY_SEPARATOR.$file,
                    $this->render($adminTemplatePath.'/'.$file)
                );
            }
        }
    }

    public function generateActiveRow($modelClass, $column)
    {
        if ( $column->name === 'sort' ) {
            return;
        }

        // датапикеры
        if ( strpos($column->name, 'tm_') === 0 ) {
            $genRow = "<div class='control-group'>\n";
            $genRow .= "\t\t<?php echo CHtml::activeLabelEx(\$model, '{$column->name}'); ?>\n";
            $genRow .= "\t\t<?php \$this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
			'model' => \$model,
			'attribute' => '{$column->name}',
			'pluginOptions' => array(
				'format' => 'hh:mm',
				'language' => 'ru',
                'pickSeconds' => false,
                'pickDate' => false
			)
		)); ?>\n";
            $genRow .= "\t\t<?php echo \$form->error(\$model, '{$column->name}'); ?>\n";
            $genRow .= "\t</div>\n";
            return $genRow;
        }
        if ( strpos($column->name, 'dt_') === 0 ) {
            $genRow = "<div class='control-group'>\n";
            $genRow .= "\t\t<?php echo CHtml::activeLabelEx(\$model, '{$column->name}'); ?>\n";
            $genRow .= "\t\t<?php \$this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
			'model' => \$model,
			'attribute' => '{$column->name}',
			'pluginOptions' => array(
				'format' => 'dd-MM-yyyy',
				'language' => 'ru',
                'pickSeconds' => false,
                'pickTime' => false
			)
		)); ?>\n";
            $genRow .= "\t\t<?php echo \$form->error(\$model, '{$column->name}'); ?>\n";
            $genRow .= "\t</div>\n";
            return $genRow;
        }
        if ( strpos($column->name, 'dttm_') === 0 ) {
            $genRow = "<div class='control-group'>\n";
            $genRow .= "\t\t<?php echo CHtml::activeLabelEx(\$model, '{$column->name}'); ?>\n";
            $genRow .= "\t\t<?php \$this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
			'model' => \$model,
			'attribute' => '{$column->name}',
			'pluginOptions' => array(
				'format' => 'dd-MM-yyyy hh:mm',
				'language' => 'ru',
                'pickSeconds' => false,
			)
		)); ?>\n";
            $genRow .= "\t\t<?php echo \$form->error(\$model, '{$column->name}'); ?>\n";
            $genRow .= "\t</div>\n";
            return $genRow;
        }

        // аплоадер
        if ( strpos($column->name, 'img_') === 0 ) {
            $smallName = ucfirst( substr($column->name, strlen('img_')) ) ;
            $genRow = "<div class='control-group'>\n";
            $genRow .= "\t\t<?php echo CHtml::activeLabelEx(\$model, '{$column->name}'); ?>\n";
            $genRow .= "\t\t<?php echo \$form->fileField(\$model,'{$column->name}', array('class'=>'span3')); ?>\n";
            $genRow .= "\t\t<div class='img_preview'>\n";
            $genRow .= "\t\t\t<?php if ( !empty(\$model->{$column->name}) ) echo TbHtml::imageRounded( \$model->imgBehavior{$smallName}->getImageUrl('small') ) ; ?>\n";
            $genRow .= "\t\t\t<span class='deletePhoto btn btn-danger btn-mini' data-modelname='{$this->modelClass}' data-attributename='{$smallName}' <?php if(empty(\$model->".$column->name.")) echo \"style='display:none;'\"; ?>><i class='icon-remove icon-white'></i></span>\n";
            $genRow .= "\t\t</div>\n";
            $genRow .= "\t\t<?php echo \$form->error(\$model, '{$column->name}'); ?>\n";
            $genRow .= "\t</div>\n";
            return $genRow;
        }

        // галерея
        if ( strpos($column->name, 'gllr_') === 0 ) {
            $smallName = ucfirst( substr($column->name, strlen('gllr_')) ) ;
            $genRow = "<div class='control-group'>\n";
            $genRow .= "\t\t<?php echo CHtml::activeLabelEx(\$model, '{$column->name}'); ?>\n";
            $genRow .= "\t\t<?php if (\$model->galleryBehavior{$smallName}->getGallery() === null) {
			echo '<p class=\"help-block\">Прежде чем загружать изображения, нужно сохранить текущее состояние</p>';
		} else {
			\$this->widget('appext.imagesgallery.GalleryManager', array(
				'gallery' => \$model->galleryBehavior{$smallName}->getGallery(),
				'controllerRoute' => '/admin/gallery',
			));
		} ?>\n";
            $genRow .= "\t</div>\n";
            return $genRow;
        }


        if ($column->name === 'status')
            return "<?php echo \$form->dropDownListControlGroup(\$model, 'status', {$modelClass}::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>";
        if ($column->type === 'boolean')
            return "<?php echo \$form->checkBoxControlGroup(\$model,'{$column->name}'); ?>\n";
        if (stripos($column->dbType,'text') !== false) {
            if ( strpos($column->name, 'wswg_') === 0 ) {
                $genRow = "<div class='control-group'>\n";
                $genRow .= "\t\t<?php echo CHtml::activeLabelEx(\$model, '{$column->name}'); ?>\n";
                $genRow .= "\t\t<?php \$this->widget('appext.ckeditor.CKEditorWidget', array('model' => \$model, 'attribute' => '{$column->name}', 'config' => array('width' => '100%')\n";
                $genRow .= "\t\t)); ?>\n";
                $genRow .= "\t\t<?php echo \$form->error(\$model, '{$column->name}'); ?>\n";
                $genRow .= "\t</div>\n";
                return $genRow;
            } else {
                return "<?php echo \$form->textAreaControlGroup(\$model,'{$column->name}',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>\n";
            }
        }
        if (preg_match('/^(password|pass|passwd|passcode|pswd_)$/i',$column->name))
            $inputField='passwordFieldControlGroup';
        else
            $inputField='textFieldControlGroup';

        if ($column->type!=='string' || $column->size===null)
            return "<?php echo \$form->{$inputField}(\$model,'{$column->name}',array('class'=>'span8')); ?>\n";
        else
            return "<?php echo \$form->{$inputField}(\$model,'{$column->name}',array('class'=>'span8','maxlength'=>$column->size)); ?>\n";
    }


    public function generateGridColumn($modelClass, $column)
    {
        if ( $column->autoIncrement )
            return '';
        if ( $column->name === 'create_time' or $column->name === 'update_time' or (strpos($column->name, 'dttm_') === 0) ) {
            $genColumn = "\t\tarray(\n".
                "\t\t\t'name'=>'{$column->name}',\n".
                "\t\t\t'type'=>'raw',\n";
            if ( $column->name === 'create_time' or $column->name === 'update_time' ) {
                $genColumn .= "\t\t\t'value'=>'\$data->{$column->name} ? SiteHelper::russianDate(\$data->{$column->name}).\' в \'.date(\'H:i\', strtotime(\$data->{$column->name})) : \"\"'\n";
            } else {
                $genColumn .= "\t\t\t'value'=>'SiteHelper::russianDate(\$data->{$column->name})'\n";
            }
            $genColumn .= "\t\t),\n";
            return $genColumn;
        }
        if ( strpos($column->name, 'dt_') === 0 ) {
            $genColumn = "\t\tarray(\n".
                "\t\t\t'name'=>'{$column->name}',\n".
                "\t\t\t'type'=>'raw',\n";
            if ( $column->name === 'create_time' or $column->name === 'update_time' ) {
                $genColumn .= "\t\t\t'value'=>'SiteHelper::russianDate(\$data->{$column->name}).\' в \'.date(\'H:i\', \$data->{$column->name})'\n";
            } else {
                $genColumn .= "\t\t\t'value'=>'SiteHelper::russianDate(\$data->{$column->name})'\n";
            }
            $genColumn .= "\t\t),\n";
            return $genColumn;
        }
        if ( strpos($column->name, 'img_') === 0 ) {
            $smallName = ucfirst( substr($column->name, strlen('img_')) ) ;
            return "\t\tarray(\n".
            "\t\t\t'header'=>'Фото',\n".
            "\t\t\t'type'=>'raw',\n".
            "\t\t\t'value'=>'TbHtml::imageCircle(\$data->imgBehavior{$smallName}->getImageUrl(\"icon\"))'\n".
            "\t\t),\n";
        }
        if ( $column->name === 'status' ) {
            return "\t\tarray(\n".
            "\t\t\t'name'=>'status',\n".
            "\t\t\t'type'=>'raw',\n".
            "\t\t\t'value'=>'{$modelClass}::getStatusAliases(\$data->status)',\n".
            "\t\t\t'filter'=>{$modelClass}::getStatusAliases()\n".
            "\t\t),\n";
        }
        if ( $column->dbType === 'text' ) {
            return '';
        }

        return "\t\t'".$column->name."',\n";
    }

    public function existUploadableColumns()
    {
        foreach ( $this->tableSchema->columns as $column ) {
            if ( strpos($column->name, 'img_') === 0 ) {
                return true;
            }
        }
        return false;
    }
}
