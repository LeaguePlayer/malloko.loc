<div class="email">
	<h3>Email</h3>
	
	<strong>To:</strong><?php echo CHtml::encode($to) ?><br />
	<strong>Subject:</strong><?php echo CHtml::encode($subject) ?>

	<div class="emailMessage"><?php echo $message ?></div>

	<h3>Additional headers</h3>
	<p>
		<?php foreach ($headers as $value): ?>
			<?php echo CHtml::encode($value); ?><br />
		<?php endforeach; ?>
	</p>
</div>