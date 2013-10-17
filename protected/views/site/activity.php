<div class="create_activity">
    <div class="form">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'activity-asd-form',
            'enableAjaxValidation' => false,
                ));
        ?>
        <?php echo $form->errorSummary($model); ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'magnite_date'); ?>
            <?php echo $form->textField($model, 'magnite_date'); ?>
            <?php echo $form->error($model, 'magnite_date'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'title'); ?>
            <?php echo $form->textField($model, 'title'); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'content'); ?>
            <?php echo $form->textArea($model, 'content'); ?>
            <?php echo $form->error($model, 'content'); ?>
        </div>
        <div class="row buttons">
            <?php echo CHtml::submitButton('Сохранить'); ?>
        </div>
        <div class="anchor"></div>
        <?php $this->endWidget(); ?>

    </div><!-- form --> 
</div>
<script>
    $(function() {
        $( "#Activity_magnite_date" ).datepicker();
    });
</script>
<div class="view_activity">
    <?php $odd = 'odd'; ?> 
    <?php if (!empty($activitys)): ?>
        <?php foreach ($activitys as $activity) : ?>
            <?php if ($odd == 'odd') $odd = 'even';  else$odd = 'odd'; ?>
            <div id="vas_<?php echo $activity->id ?>" class="one_activity <?php echo $odd; ?>">
                <div class="bloc_1">
                    <span class="link_edit_activity" onclick="pred_activity($(this))" >редактировать</span>
                    <span class="link_delet_activity" onclick="delete_activity(<?php echo $activity->id; ?>)" >удалить</span>
                </div>
                <div class="bloc_2">
                    <span class="link_edit_activity" onclick="save_activity(<?php echo $activity->id; ?>)" >сохранить</span>
                    <span class="link_delet_activity" onclick="pred_activity($(this))" >отменить</span>
                </div>
                <div class="one_activity_view" >
                    <div class="date_activity">
                        <?php echo $activity->magnite_date ?>
                    </div>
                    <div class="title__activity">
                        <?php echo $activity->title ?>
                    </div>
                    <div class="content__activity">
                        <?php echo $activity->content ?>
                    </div>
                </div>
                <div class="one_activity_edit">
                    <form class="form_edit_<?php echo $activity->id; ?>" >
                        <input type="hidden" name="id" value="<?php echo $activity->id; ?>" >
                        <div class="date_activity">
                            <input type="text" value="<?php echo $activity->magnite_date ?>" name="Activity[magnite_date]" />
                        </div>
                        <div class="title__activity">
                            <input type="text" value="<?php echo $activity->title ?>" name="Activity[title]" />

                        </div>
                        <div class="content__activity">
                            <textarea name="Activity[content]" ><?php echo $activity->content ?></textarea>
                        </div>
                    </form>
                </div>
            </div>

        <?php endforeach; ?>
    <?php endif; ?>
</div>