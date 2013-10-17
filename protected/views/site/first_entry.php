<?php
if (isset($_GET['pin'])) {
  $pin = $_GET['pin'];
} elseif (isset($vk_pin)) {
  $pin = $vk_pin;
} else {
  $pin = '';
}
?>
<div class="danger_reg">
  Внимание!<br />
  Выберите группу, в которой вы действительно учитесь<br />
  В дальнейшем поменять ее будет невозможно,<br />
  Если же вы все таки зарегистрируетесь в друггой группе, вы будете забанены.<br />
  И вам придется заного регистрироваться.
</div>
<div class="first_entry">
  <?php
  $form = $this->beginWidget('CActiveForm', array(
      'id' => 'user-lk',
      'action' => '/site/ValidatUser',
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
  <input type="hidden" value="<?php echo $pin; ?>" name="userseach"/>
  <div class="right_b resume__emptyblock">
    <div class="ldk">
      <?php echo $form->labelEx($model, 'name'); ?>:
      <?php echo $form->textField($model, 'name'); ?>
      <?php echo $form->error($model, 'name'); ?>
    </div>
    <div class="ldk">
      <?php echo $form->labelEx($model, 'surname'); ?>:
      <?php echo $form->textField($model, 'surname'); ?>
      <?php echo $form->error($model, 'surname'); ?>
    </div>
    <div class="ldk">
      <?php echo $form->labelEx($model, 'status'); ?>:<br />
      <?php echo $form->dropDownList($model, 'status', Lookup::items('userstatus')); ?>
      <?php echo $form->error($model, 'status'); ?>
    </div>
    <div class="ldk level_2">
      <div class="group_id_year_create_fe">
        <label>Год начала учебы:</label><br />
        <?php echo CHtml::dropDownList('Group[id_year_create]', '', CHtml::listData(GroupYearCreate::model()->findAll(), 'id', 'start_year'), array('prompt' => ' &mdash; ')) ?>
      </div>

    </div>
    <div class="ldk level_3">
    </div>
  </div>
  <div style="max-width: 650px;margin:0 auto;padding-top:20px;">
    <?php
    echo CHtml::ajaxSubmitButton('Сохранить', CHtml::normalizeUrl(array('/site/ValidatUser')), array(
        'dataType' => 'json',
        'beforeSend' => 'js:function(){
                $("#save_fe").addClass("loading");                               
        }',
        'success' => 'js:function(data){
                    $(".first_entry").remove();                     
                    $("#content").html(data.div);
        }',
        'complete' => 'js:function(){
                $("#save_fe").removeClass("loading");
        }',
            ), array('disabled' => 'disabled', 'id' => 'save_fe')
    );
    ?>
    <div class="anchor"></div>
  </div>
  <?php $this->endWidget(); ?>
</div>
<script>
  $(function(){
    $('#Profile_status').change(function(){
      if($(this).val() == 1){
        $('.group_id_year_create_fe').hide();
        $('.preposd_fe').hide();
        $('.level_3').hide();
      }else if($(this).val() == 2){
        $('.preposd_fe').hide();
        $('.group_id_year_create_fe').show();
        $('.level_3').show();
                
      }else if($(this).val() == 3){
        $('.group_id_year_create_fe').hide();
        $('.level_3').hide();
        $('.preposd_fe').show();
        $('#save_fe').removeAttr('disabled');
      }
    });
        
    $('#Group_id_year_create').change(function(){
      buldGroupFe($(this).val());
    });
        
    function buldGroupFe(year_create_id){
      goSpiner();
      $.ajax({
        url: '<?php echo $this->CreateUrl('user/FindGroup'); ?>',
        type: 'POST',
        data: {
          "year_create_id":year_create_id
        },
        dataType: 'html',
        success: function(data){
          if(data == '{"status":"falure"}'){
            text = 'К сожеление вашей группы нет в нашей базе данных.<br/>Мы делаем все возможное, что бы она появилась.';
            noticeOpen(text, 3);
          }else{
            if (data != null)
            {   
              $('.level_3').html(data)
              $('#Profile_group_id').change(function(){
                if($(this).val() != ''){
                  $('#save_fe').removeAttr('disabled','disabled ');
                }
              });
            }
            else{
              alert('Произошла ошибка :(');
            }
          }
        },
        complete: function(data){     
          hideSpiner();
        }
      });
          
    }
  })
</script>