<div class="form">
<script>
    $(function(){
        $("#Comment_content").val("");
    })
</script>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'comment-form',
        //'action' => 'UserValidete',
        'method' => 'post',
//        'htmlOptions' => array('enctype' => 'multipart/form-data'),
//        'enableAjaxValidation' => true,
//        'enableClientValidation' => true,
//        'clientOptions' => array(
////            'validateOnSubmit' => true,
//        //'validateOnType' => true,
//        ),
            ));
    ?>
    <div class="anchor" ></div>
    <div class="row write_comment">
        <?php echo $form->textArea($model, 'content', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'content'); ?>
        <div class="anchor" ></div>
        <div class="row buttons" id="add_new_comment">
            
        <?php echo Chtml::hiddenField('post_id',$post_id); ?>
            <?php //echo CHtml::submitButton($model->isNewRecord ? 'Отправить' : 'Save'); ?>
            <?php
            echo CHtml::ajaxSubmitButton('Отправить', CHtml::normalizeUrl(array('/post/AddComment')), array(
                'dataType' => 'json',
                'beforeSend' => 'js:function(){
                    $("#add_new_comment input").attr("disabled","disabled");
                    $("#add_new_comment input").addClass("loading");                               
        }',
                'success' => 'js:function(data){
                    $("#add_new_comment input").removeClass("loading");
                    $("#comments").append(data.div);
        }',
                'complete' => 'js:function(){
                    $("#Comment_content").val("");
                    $("#add_new_comment input").removeAttr("disabled");
                    $("#add_new_comment input").removeClass("loading");
        }',
                    )
            );
            ?>
        </div>
        <div class="anchor" ></div>
    </div>


    <?php $this->endWidget(); ?>
</div><!-- form -->