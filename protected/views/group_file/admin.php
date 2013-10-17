<?php
/* @var $this UserController */
/* @var $model GroupFile */

$this->breadcrumbs = array(
    'Group Files' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List GroupFile', 'url' => array('index')),
    array('label' => 'Create GroupFile', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('group-file-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<?php //echo CHtml::link('Предварительный поиск', '#', array('class' => 'classic search-button')); ?>
<!--<div class="search-form" style="display:none">-->
    <?php
//    $this->renderPartial('application.views.group_file._search', array(
//        'model' => $model,
//    ));
    ?>
<!--</div> search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'group-file-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'afterAjaxUpdate' => "function() { 
        jQuery('#GroupFile_create_time').datepicker(jQuery.extend(jQuery.datepicker.regional['ru'],{'showAnim':'fold','dateFormat':'yy-mm-dd','changeMonth':'true','showButtonPanel':'true','changeYear':'true'})); 
    }",
    'columns' => array(
        'id',
        'file_id',
        'group_id',
        'scope_id',
        'profile_id',
        array(
            'name' => 'create_time',
            'type' => 'raw',
//            'filter' => false,
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'attribute' => 'create_time',
                'language' => 'ru',
                'options' => array(
                    'showAnim' => 'fold',
                    'dateFormat' => 'yy-mm-dd',
                    'changeMonth' => 'true',
                    'changeYear' => 'true',
                    'showButtonPanel' => 'true',
                ),
                    ), true),
            'htmlOptions' => array('style' => 'width:130px;'),
        ),
//        array(
//            'class' => 'CButtonColumn',
//            'deleteConfirmation' => 'Are you sure you want to delete this news?',
//            //'viewButtonUrl' => 'asdasd',
//        ),
    ),
));
?>
