<?php
/* @var $this UserController */
/* @var $model GroupFile */

$this->breadcrumbs=array(
	'Group Files'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GroupFile', 'url'=>array('index')),
	array('label'=>'Manage GroupFile', 'url'=>array('admin')),
);
?>

<h1>Create GroupFile</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>