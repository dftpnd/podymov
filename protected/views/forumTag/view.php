<?php
/* @var $this ForumTagController */
/* @var $model ForumTag */

$this->breadcrumbs=array(
	'Forum Tags'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ForumTag', 'url'=>array('index')),
	array('label'=>'Create ForumTag', 'url'=>array('create')),
	array('label'=>'Update ForumTag', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ForumTag', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ForumTag', 'url'=>array('admin')),
);
?>

<h1>View ForumTag #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'forum_id',
		'tag_id',
	),
)); ?>
