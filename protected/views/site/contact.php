
<?php if (Yii::app()->user->hasFlash('contact')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('contact'); ?>
    </div>
<?php else: ?>
    <p class="hint_contact_form">
        Если у вас есть бизнес-предложения или вопросы, пожалуйста, заполните приведенную ниже форму, чтобы связаться с нами. Спасибо.
    </p>
    <div class="contact_form">
        <div class="form">
            <?php //$form = $this->beginWidget('CActiveForm'); ?>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                //'id' => 'comment-form',
                'action' => '/site/contact',
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





            <p class="note">Поля помеченные<span class="required">*</span> обязательны для заполнения.</p>
            <?php echo $form->errorSummary($model); ?>

            <div class="ldjf">
                <?php echo $form->labelEx($model, 'name'); ?>
                <?php echo $form->textField($model, 'name'); ?>
            </div>
            <div class="ldjf">
                <?php echo $form->labelEx($model, 'email'); ?>
                <?php echo $form->textField($model, 'email'); ?>
            </div>
            <div class="ldjf">
                <?php echo $form->labelEx($model, 'body'); ?>
                <?php echo $form->textArea($model, 'body', array('rows' => 6, 'cols' => 50)); ?>
            </div>
            <?php if (extension_loaded('gd')): ?>
                <div class="ldjf">
                    <?php echo $form->labelEx($model, 'verifyCode'); ?>
                    <div>
                        <?php $this->widget('CCaptcha'); ?>
                        <?php echo $form->textField($model, 'verifyCode'); ?>
                    </div>
                    <div class="hint">Пожалуйста, введите буквы, изображенные на картинке выше.</div>
                </div>
            <?php endif; ?>

            <div class="submit">
                <?php echo CHtml::submitButton('Отправить'); ?>
            </div>
            <div class="anchor"></div>
            <?php $this->endWidget(); ?>
        </div><!-- form -->
    </div>
<?php endif; ?>