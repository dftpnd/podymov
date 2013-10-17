<?php
/* @var $this SlideController */
/* @var $model Slide */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'slide-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Поля помеченны <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>



    <div class="row">
        <?php echo $form->labelEx($model, 'link'); ?>
        <?php echo $form->textField($model, 'link', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'link'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'text'); ?>
        <?php echo $form->textField($model, 'text', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'text'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'show_slide'); ?>
        <?php echo $form->textField($model, 'show_slide'); ?>
        <?php echo $form->error($model, 'show_slide'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'img_link'); ?>
        <?php echo $form->textField($model, 'img_link', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'img_link'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'left_slide'); ?>
        <?php echo $form->textField($model, 'left_slide', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'left_slide'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'top_slide'); ?>
        <?php echo $form->textField($model, 'top_slide', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'top_slide'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->