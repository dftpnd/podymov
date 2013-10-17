<?php
/* @var $this UserController */
/* @var $model GroupFile */

$this->breadcrumbs=array(
	'Group Files'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List GroupFile', 'url'=>array('index')),
	array('label'=>'Create GroupFile', 'url'=>array('create')),
	array('label'=>'Update GroupFile', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GroupFile', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GroupFile', 'url'=>array('admin')),
);
?>

<h1>View GroupFile #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'file_id',
		'group_id',
		'scope_id',
		'profile_id',
		'create_time',
	),
)); ?>
