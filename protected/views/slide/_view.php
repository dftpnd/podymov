<?php
/* @var $this SlideController */
/* @var $data Slide */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('link')); ?>:</b>
	<?php echo CHtml::encode($data->link); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
	<?php echo CHtml::encode($data->text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('show_slide')); ?>:</b>
	<?php echo CHtml::encode($data->show_slide); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('img_link')); ?>:</b>
	<?php echo CHtml::encode($data->img_link); ?>
	<br />


</div>