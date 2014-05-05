<?php
/**
 * @var $this GalleryManager
 * @var $model GalleryPhoto
 *
 * @author Bogdan Savluk <savluk.bogdan@gmail.com>
 */
?>
<?php echo CHtml::openTag('div', $this->htmlOptions); ?>
	<?php echo CHtml::hiddenField('Galleries['.$this->gallery->id.'][id]', $this->gallery->id) ?>

    <!-- Gallery Toolbar -->
    <div class="btn-toolbar gform">
		<div>
			<h3 class="gallery_name"><?= $this->gallery->gallery_name ?></h3>
			<div class="btn-group pull-right actions">
				<span class="btn edit-gallery">
					<i class="icon-edit"></i>
				</span>
				<?php if ( $this->enableUnlinkButton ): ?>
					<span class="btn unlink-gallery" data-id="<?= $this->gallery->id ?>">
						<i class="icon-remove"></i>
					</span>
				<?php endif ?>

				<?php if ( $this->enableDeleteButton ): ?>
					<span class="btn remove-gallery btn-danger" data-id="<?= $this->gallery->id ?>">
						<i class="icon-trash icon-white"></i>
					</span>
				<?php endif ?>
			</div>
		</div>
		<hr/>

        <span class="btn btn-success fileinput-button">
            <i class="icon-plus icon-white"></i>
            <?php echo Yii::t('galleryManager.main', 'Add…');?>
            <input type="file" name="image" class="afile" accept="image/*" multiple="multiple"/>
        </span>

        <div class="btn-group">
            <label class="btn">
                <input type="checkbox" style="margin: 0;" class="select_all"/>
                <?php echo Yii::t('galleryManager.main', 'Select all');?>
            </label>
            <span class="btn disabled edit_selected"><i class="icon-pencil"></i> <?php echo Yii::t('galleryManager.main', 'Edit');?></span>
            <span class="btn disabled remove_selected"><i class="icon-remove"></i> <?php echo Yii::t('galleryManager.main', 'Remove');?></span>
        </div>
    </div>
    <hr/>
    <!-- Gallery Photos -->
    <div class="sorter">
        <div class="images"></div>
        <br style="clear: both;"/>
    </div>

    <!-- Modal window to edit photo information -->
    <div class="modal hide editor-modal">
        <div class="modal-header">
            <a class="close" data-dismiss="modal">×</a>

            <h3><?php echo Yii::t('galleryManager.main', 'Edit information')?></h3>
        </div>
        <div class="modal-body">
            <div class="form"></div>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary save-changes">
                <?php echo Yii::t('galleryManager.main', 'Save changes')?>
            </a>
            <a href="#" class="btn" data-dismiss="modal"><?php echo Yii::t('galleryManager.main', 'Close')?></a>
        </div>
    </div>
	<!-- Modal window to edit gallery params -->
	<div class="modal hide change_gallery-modal">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3><?php echo Yii::t('GalleryContainer.main', 'Editing gallery')?></h3>
		</div>
		<div class="modal-body">
			<div class="gform">

				<?php echo TbHtml::activeTextFieldControlGroup($this->gallery, 'gallery_name') ?>
				<?php echo TbHtml::activeTextFieldControlGroup($this->gallery, 'alias', array('disabled'=>true)) ?>
				<?php echo TbHtml::activeCheckBoxControlGroup($this->gallery, 'name', array('disabled'=>true)) ?>
				<?php echo TbHtml::activeCheckBoxControlGroup($this->gallery, 'description', array('disabled'=>true)) ?>

				<div class="control-group">
					<table class="table thumbs-settings">
						<thead>
						<th>Префикс</th>
						<th>Метод</th>
						</thead>
						<tbody>
						<? //foreach ( $this->gallery->getVersions() as $version ): ?>
							<tr>
								<td>
									<input name="Gallery[versions][0][prefix]" type="text" value="small" placeholder="Префикс" class="thumb-prefix" />
								</td>
								<td>
									<div class="thumb-methods">
										<div class="thumb-method">
											<?php echo CHtml::dropDownList('Gallery[versions][0][methods][0][method]', '', Gallery::getMethods(), array(
												'empty'=>'Выберите метод обработки',
												'class'=>'select_method',
												'disabled'=>true,
											)) ?>
											<input name="Gallery[versions][0][methods][0][x]" type="text" class="thumb_param-x" placeholder="x" disabled="disabled" />
											<input name="Gallery[versions][0][methods][0][y]" type="text" class="thumb_param-y" placeholder="y" disabled="disabled" />
											<input name="Gallery[versions][0][methods][0][w]" type="text" class="thumb_param-w" placeholder="Ширина" disabled="disabled" />
											<input name="Gallery[versions][0][methods][0][h]" type="text" class="thumb_param-h" placeholder="Высота" disabled="disabled" />
											<a href="#" class="remove-method"><i class="icon icon-remove"></i></a>
										</div>
									</div>
									<a class="btn btn-link add-method" href="#"><b>+ </b>Еще метод</a>
								</td>
							</tr>
						<? //endforeach ?>
						</tbody>
					</table>
					<a class="btn btn-link add-thumb" href="#"><b>+ </b>Добавить версию картинки</a>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn btn-primary save-changes"><?php echo Yii::t('GalleryContainer.main', 'Save changes')?></a>
			<a href="#" class="btn" data-dismiss="modal"><?php echo Yii::t('GalleryContainer.main', 'Close')?></a>
		</div>


		<div class="hide">
			<div class="thumb-method method-tpl">
				<?php echo CHtml::dropDownList('Gallery[versions][0][methods][0][method]', '', Gallery::getMethods(), array(
					'empty'=>'Выберите метод обработки',
					'class'=>'select_method',
					'id'=>'',
					'disabled'=>true,
				)) ?>
				<input name="Gallery[versions][0][methods][0][params][x]" type="text" class="thumb_param-x" placeholder="x" disabled="disabled" />
				<input name="Gallery[versions][0][methods][0][params][y]" type="text" class="thumb_param-y" placeholder="y" disabled="disabled" />
				<input name="Gallery[versions][0][methods][0][params][w]" type="text" class="thumb_param-w" placeholder="Ширина" disabled="disabled" />
				<input name="Gallery[versions][0][methods][0][params][h]" type="text" class="thumb_param-h" placeholder="Высота" disabled="disabled" />
				<a href="#" class="remove-method"><i class="icon icon-remove"></i></a>
			</div>
		</div>
	</div>
    <div class="overlay">
        <div class="overlay-bg">&nbsp;</div>
        <div class="drop-hint">
            <span class="drop-hint-info"><?php echo Yii::t('galleryManager.main', 'Drop Files Here…')?></span>
        </div>
    </div>
    <div class="progress-overlay">
        <div class="overlay-bg">&nbsp;</div>
        <!-- Upload Progress Modal-->
        <div class="modal progress-modal">
            <div class="modal-header">
                <h3><?php echo Yii::t('galleryManager.main', 'Uploading images…')?></h3>
            </div>
            <div class="modal-body">
                <div class="progress progress-striped active">
                    <div class="bar upload-progress"></div>
                </div>
            </div>
        </div>
    </div>

	<!-- Tpl to gallery methods -->
	<div class="hide">
		<div class="thumb-method method-tpl">
			<?php echo CHtml::dropDownList('Gallery[versions][0][methods][0][method]', '', Gallery::getMethods(), array(
				'empty'=>'Выберите метод обработки',
				'class'=>'select_method',
				'id'=>'',
				'disabled'=>true,
			)) ?>
			<input name="Gallery[versions][0][methods][0][params][x]" type="text" class="thumb_param-x" placeholder="x" disabled="disabled" />
			<input name="Gallery[versions][0][methods][0][params][y]" type="text" class="thumb_param-y" placeholder="y" disabled="disabled" />
			<input name="Gallery[versions][0][methods][0][params][w]" type="text" class="thumb_param-w" placeholder="Ширина" disabled="disabled" />
			<input name="Gallery[versions][0][methods][0][params][h]" type="text" class="thumb_param-h" placeholder="Высота" disabled="disabled" />
			<a href="#" class="remove-method"><i class="icon icon-remove"></i></a>
		</div>
	</div>
<?php echo CHtml::closeTag('div'); ?>