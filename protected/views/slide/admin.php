<?php
/* @var $this SlideController */
/* @var $model Slide */

$this->breadcrumbs = array(
    'Slides' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Slide', 'url' => array('index')),
    array('label' => 'Create Slide', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('slide-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo $this->renderPartial('create', array('model' => $model_new)); ?>
<div class="anchor"></div>
<h1>Управление слайдами</h1>


<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'slide-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'link',
        'text',
        'show_slide',
        'img_link',
        'top_slide',
        'left_slide',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
