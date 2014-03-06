<?php $this->beginContent('/layouts/main'); ?>

    <div class="container">
        <div class="row">
            <div class="span12">
                <?php $this->widget('bootstrap.widgets.TbBreadcrumb', array(
                    'links'=>$this->breadcrumbs,
                    'homeUrl'=> '/admin'
                )); ?>
                <?php echo $content; ?>
            </div>
        </div>
    </div>

<?php $this->endContent(); ?>