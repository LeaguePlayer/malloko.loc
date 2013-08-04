<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n\$this->breadcrumbs=array(
	\"{\$model->translition()}\"=>array('list'),
	'Создание',
);\n";
?>

$this->menu=array(
	array('label'=>'Список','url'=>array('list')),
);
?>

<h1><?php echo "<?php echo \$model->translition(); ?>"; ?> - Добавление</h1>

<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
