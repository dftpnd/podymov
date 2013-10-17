<?php
/* @var $this ForumTagController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Forum Tags',
);

$this->menu=array(
	array('label'=>'Create ForumTag', 'url'=>array('create')),
	array('label'=>'Manage ForumTag', 'url'=>array('admin')),
);
?>

<h1>Forum Tags</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
