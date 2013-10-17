<?php
/* @var $this UserController */
/* @var $model GroupFile */

$this->breadcrumbs=array(
	'Group Files'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GroupFile', 'url'=>array('index')),
	array('label'=>'Create GroupFile', 'url'=>array('create')),
	array('label'=>'View GroupFile', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GroupFile', 'url'=>array('admin')),
);
?>

<h1>Update GroupFile <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>