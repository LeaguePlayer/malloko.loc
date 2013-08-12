<?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
		'itemsTagName'=>'ul',
		'itemsCssClass'=>'',
        'itemView'=>'application.extensions.reviews.views._item',
        'ajaxUpdate'=>false,
        'template'=>'{items}',
		'htmlOptions'=>array(
			'class' => 'reviews-list'
		)
    ));
?>
