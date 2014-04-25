<?php echo CHtml::openTag('fieldset', $this->htmlOptions); ?>
	<?= TbHtml::alert(TbHtml::ALERT_COLOR_INFO, 'После добавления или удаления галерей не забудьте сохранить изменения.') ?>
	<legend>Галереи</legend>
	<div id="all_galleries">
		<?php
		$galleries = $this->model->getGalleries();
		foreach ( $galleries as $gallery ) {
			$this->widget('application.extensions.imagesgallery.GalleryManager', array(
				'gallery'=>$gallery,
				'controllerRoute'=>$this->controllerRoute
			));
		}
		?>
	</div>



	<div class="gallery-box thumbnail">
		<a class="btn btn-success btn-large addgallery" href="#">
			<i class="icon icon-plus icon-white"></i>
			<?php echo Yii::t('GalleryContainer.main', 'New Gallery') ?>
		</a>
		<a class="btn btn-large select-gallery-btn" href="#">
			<i class="icon icon-check"></i>
			<?php echo Yii::t('GalleryContainer.main', 'Select Gallery') ?>
		</a>
	</div>



	<div class="modal hide create_gallery-modal">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3><?php echo Yii::t('GalleryContainer.main', 'Adding gallery')?></h3>
		</div>
		<div class="modal-body">
			<div class="gform">

				<?php echo TbHtml::activeTextFieldControlGroup($newGallery, 'gallery_name') ?>
				<?php echo TbHtml::activeTextFieldControlGroup($newGallery, 'alias', array('disabled'=>true)) ?>
				<?php echo TbHtml::activeCheckBoxControlGroup($newGallery, 'name', array('disabled'=>true)) ?>
				<?php echo TbHtml::activeCheckBoxControlGroup($newGallery, 'description', array('disabled'=>true)) ?>

				<div class="control-group">
					<table class="table thumbs-settings">
						<thead>
							<th>Префикс</th>
							<th>Метод</th>
						</thead>
						<tbody>
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



	<div class="hide modal select_gallery">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3><?php echo Yii::t('GalleryContainer.main', 'Select Gallery')?></h3>
		</div>
		<div class="modal-body">
			<div class="gform">
				<?php echo TbHtml::dropDownListControlGroup('Gallery[id]', '', CHtml::listData($otherGalleries, 'id', 'gallery_name'), array('empty' => 'Выберите галерею')) ?>
			</div>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn btn-primary save-changes"><?php echo Yii::t('GalleryContainer.main', 'Save changes')?></a>
			<a href="#" class="btn" data-dismiss="modal"><?php echo Yii::t('GalleryContainer.main', 'Close')?></a>
		</div>
	</div>
<?php echo CHtml::closeTag('fieldset'); ?>