<?php
/* @var $this SlideController */
/* @var $model Slide */



$this->menu=array(
	array('label'=>'List Slide', 'url'=>array('index')),
	array('label'=>'Manage Slide', 'url'=>array('admin')),
);
?>

<h1>Создать слайд</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>