<div class="form">

  <?php
  $form = $this->beginWidget('CActiveForm', array(
      'id' => 'myForm',
      'action' => '/post/Create',
      'method' => 'post',
      'htmlOptions' => array('enctype' => 'multipart/form-data'),
      'enableAjaxValidation' => true,
      'enableClientValidation' => true,
      'clientOptions' => array(
          'validateOnSubmit' => true,
          'validateOnType' => true,
      ),
          ));
  ?>
  <?php echo CHtml::errorSummary($model); ?>
  <div class="row selection spekol">
    <div class="questions" title="Параметр скрывает фотоальбом в фотогалереи, если он был создан"></div>
    <?php echo $form->labelEx($model, 'show_foto'); ?>
    <?php echo $form->dropDownList($model, 'show_foto', Lookup::items('FotoStatus')); ?>
    <?php echo $form->error($model, 'show_foto'); ?>
  </div>
  <div class="row">
    <div class="questions" title="Заголовок поста"></div>
    <?php echo $form->labelEx($model, 'title'); ?>
    <?php echo $form->textField($model, 'title', array('size' => 80, 'maxlength' => 128)); ?>
    <?php echo $form->error($model, 'title'); ?>
    <p class="help_hint">Заголовок должен быть наполнен смыслом, чтобы можно было понять, о чем будет пост.</p>
  </div>
  <div class="row" >
    <div class="questions" title="Это поле отвечает, за то, что вы увидете перед просмотром поста, то есть его сокращенный вариант" ></div>
    <?php echo $form->labelEx($model, 'content_previews'); ?>
    <?php echo CHtml::activeTextArea($model, 'content_previews', array('rows' => 10, 'cols' => 70)); ?>
    <?php echo $form->error($model, 'content_previews'); ?>
  </div>
  <div class="row ">
    <div class="questions" title="Напишите тут полностью;)"></div>
    <?php echo $form->labelEx($model, 'content'); ?>
    <?php echo CHtml::activeTextArea($model, 'content', array('rows' => 10, 'cols' => 70)); ?>
    <?php echo $form->error($model, 'content'); ?>
  </div>
  <div class="row selection">
    <div class="questions" title="Если вы написали пост на тему как то касающийся кафедры, не меняйте параметр, иначе переведите его в мировые"></div>
    <?php echo $form->labelEx($model, 'tags'); ?>
    <?php echo $form->dropDownList($model, 'topic', Lookup::items('PostTopic')); ?>
    <?php echo $form->error($model, 'tags'); ?>
  </div>
  <div class="row selection">
    <div class="questions" title="Ваш пост опубликуется, как только его проверит администрация"></div>
    <?php echo $form->labelEx($model, 'status'); ?>
    <?php
    echo $form->dropDownList($model, 'status', Lookup::items('PostStatus'));
    ?>
    <?php echo $form->error($model, 'status'); ?>
  </div>
  <div class="for_form_create_post">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    <div class="anchor"></div>
  </div>
  <?php $this->endWidget(); ?>
</div><!-- form -->