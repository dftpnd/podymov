<?php
/* @var $this ForumTagController */
/* @var $model ForumTag */

$this->breadcrumbs=array(
	'Forum Tags'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ForumTag', 'url'=>array('index')),
	array('label'=>'Manage ForumTag', 'url'=>array('admin')),
);
?>

<h1>Create ForumTag</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>