<?php
foreach($this->tableSchema->columns as $column)
{
	//skip seo_id
	if($column->name === 'seo_id') continue;

	if($column->autoIncrement)
		continue;
	if ($column->name === 'create_time' or $column->name === 'update_time')
		continue;
	if ($column->name === 'sort')
		continue;
?>
	<?php echo $this->generateActiveRow($this->modelClass,$column); ?>

<?php
}
?>