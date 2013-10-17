<?php
/* @var $this ForumTagController */
/* @var $model ForumTag */

$this->breadcrumbs=array(
	'Forum Tags'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ForumTag', 'url'=>array('index')),
	array('label'=>'Create ForumTag', 'url'=>array('create')),
	array('label'=>'View ForumTag', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ForumTag', 'url'=>array('admin')),
);
?>

<h1>Update ForumTag <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>