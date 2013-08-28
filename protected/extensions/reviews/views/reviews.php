
<section id="reviews" class="reviews">
	<h2 class="caption">Отзывы клиентов</h2>
	<?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
			'itemsTagName'=>'ul',
			'itemsCssClass'=>'',
            'itemView'=>'_item',
            'ajaxUpdate'=>false,
            'template'=>"{items}",
			'htmlOptions'=>array(
				'class' => 'reviews-list'
			)
        ));
    ?>
	
	<?php if ($dataProvider->totalItemCount > $dataProvider->pagination->pageSize): ?>
	<div class="progress">
		<span class="loader"><span class="arrow"></span></span><a href="#" class="more">Еще отзывы</a>
	</div>
	<?php endif ?>

	<div class="add_review">
		<p>Поделитесь впечатлениями о нашем ресторане</p>
		<a class="fancybox-ajax" href="<?=$this->owner->createUrl('/reviews/add');?>">Оставить отзыв</a>
	</div>				
</section>
