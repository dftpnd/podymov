
<div class="razdel " list='1'>
  <?php
  $form = $this->beginWidget('CActiveForm', array(
      'id' => 'user-lk',
      'method' => 'post',
      'htmlOptions' => array('enctype' => 'multipart/form-data'),
          ));
  ?>
  <div class="table_t editprofile">
    <div class="tr_t">
      <div class="td_t">
        <div class="lft_b resume__emptyblock" >
          <div class="avatar">
            <?php
            $picter = Yii::app()->createAbsoluteUrl('i/avatar.svg');
            if (!empty($model->file_id)) {
              $file_name = $model->uploadedfiles->name;
              $picter = Yii::app()->createAbsoluteUrl('uploads/avatar/avatar_' . $file_name);
            }
            ?>
            <img src="<?php echo $picter; ?>" />
          </div>

          <div class="avatar_wind">
            <div id="file-uploader-demo1">		
              <noscript>			
              <p>Включите JavaScript чтобы испльзовать file uploader.</p>
              <!-- or put a simple form for upload here -->
              </noscript>         
            </div>
            <ul class="uload_list">
            </ul>
          </div>
        </div>
        <div class="anchor"></div>
        <?php if ($model->status == 2): ?>
          <div class="medal">
            <span title="Средний балл успеваемости">
              <?php if (isset($model->mean)) echo $model->mean ?>
            </span>
          </div>
        <?php endif; ?>

        <div class="anchor"></div>


      </div>
      <div class="td_t">
        <div class="resume__emptyblock" id="">
          <ul class="social_contact">
            <li>
              <label class="social_img thone_c"  title="Контактактный телефон">
                <?php echo $form->textField($model, 'pthon'); ?>
                <?php echo $form->error($model, 'pthon'); ?>
              </label>
            </li>
            <li>
              <label class="social_img email_c" title="Контактактный адрес эл. почты">
                <?php echo $form->textField($model, 'kontakt_email'); ?>
                <?php echo $form->error($model, 'kontakt_email'); ?>
              </label>
            </li>
            <li>
              <label class="social_img web_c" title="Веб сайт">
                <?php echo $form->textField($model, 'website'); ?>
                <?php echo $form->error($model, 'website'); ?>
              </label>
            </li>
            <li>
              <label class="social_img vk_c" title="Авторизоваться">
                <?php echo $form->textField($model, 'kontact'); ?>
                <?php echo $form->error($model, 'kontact'); ?>
              </label>
            </li>
            <li>
              <label class="social_img skype_c" title="Скайп">
                <?php echo $form->textField($model, 'skype'); ?>
                <?php echo $form->error($model, 'skype'); ?>
              </label>
            </li>
          </ul>
          <div class="anchor"></div>
        </div>

        <div class="right_b resume__emptyblock" id="idet_prof">
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
            <?php echo $form->labelEx($model, 'patronymic'); ?>:
            <?php echo $form->textField($model, 'patronymic'); ?>
            <?php echo $form->error($model, 'patronymic'); ?>
          </div>
        </div>
        <div class="anchor"></div>


      </div>

    </div>
    <?php if ($model->status == 3): ?>
      <div class="tr_t">
        <div class="td_t">
        </div>
        <div class="td_t">
          <div class="last_b resume__emptyblock">
            Выберите предметы которые вы припадаете
            <div class="">
              <?php foreach ($predmetprepod as $predmet): ?>
                <?php echo CHtml::link($predmet->predmet_prepod->name, Yii::app()->urlManager->createUrl('/library/predmet', array('id' => $predmet->predmet_id)), array('class' => 'classic')); ?>
              <?php endforeach; ?>
            </div>
            <input type="submit" onclick="Predmetson();return false" value="Закрепить предметы" >
          </div>
        </div>
      </div>
    <?php endif; ?> 
    <div class="tr_t">
      <div class="td_t">

      </div>
      <div class="td_t">
        <div class="last_b resume__emptyblock">
          <?php echo $form->labelEx($model, 'private'); ?>:
          <?php echo $form->textArea($model, 'private'); ?>
          <?php echo $form->error($model, 'private'); ?>
        </div>
      </div>
    </div>
    <div class="tr_t">
      <div class="td_t">

      </div>
      <div class="td_t">
        <div class="clone_2">
          <div class="ldk" id="save_but">
            <?php
            if (!isset($model->group_id)) {
              $disabled_w = 'disabled';
            } else {
              $disabled_w = '';
            }
            ?>
            <?php echo CHtml::submitButton('Сохранить'); ?>
          </div>
        </div>

      </div>
    </div>
  </div>
  <?php $this->endWidget(); ?>
</div>



<script>
   
  function createUploader(){
    var uploader = new qq.FileUploader({
      element: document.getElementById('file-uploader-demo1'),
      action: '/user/UploadAvatar',
      onComplete: function(id, fileName, responseText)
      {   
        $('.avatar img').remove();
        $('.avatar').append('<img src="'+responseText.file_url+'" />');
      }
    });           
  }
  window.onload = createUploader;  
           
  if($('#Profile_status option[selected = selected]').attr('value') == '2'){
    $('select#Group_id_year_create option[value=<?php echo $yc; ?>]').attr('selected','selected');
<?php if (!isset($model->group_id)): ?>
      buldGroup(<?php echo $yc; ?>);
<?php endif; ?>
            
  }
        
  $('#Profile_status').change(function() {
    goSpiner();
    m = $(this).attr('value');
    if( m == '1'){
      $('.id_year_create-mask').hide()
      $('.group-mask').hide()
    }
    else if( m == '2'){
      $('.id_year_create-mask').show();
      $('.group-mask').show();
                
    }
    else if( m == '3'){
      $('.id_year_create-mask').hide()
      $('.group-mask').hide() 
    }
    else{
      //хайд ол
    }
    hideSpiner();
  });  
  $('#Group_id_year_create').change(function(){
    goSpiner();
    year_create_id = $(this).attr('value');
    if(year_create_id != ''){
      buldGroup(year_create_id);
    }
    hideSpiner();
  });
<?php if (!isset($model->group_id)): ?>
    function buldGroup(year_create_id){
      $.ajax({
        url: '<?php echo $this->CreateUrl('user/FindGroup'); ?>',
        type: 'POST',
        data: {
          "year_create_id":year_create_id
        },
        dataType: 'html',
        success: function(data)
        {
          if (data != null)
          {   
            $('.group-mask').html(data)
            $('.group-mask').show()
            $('select#Profile_group_id option[value=<?php echo $gi; ?>]').attr('selected','selected');
            $('#Profile_group_id').change(function(){
              if($(this).val() != ''){
                //alert('asdads');
                $('#save_but input').removeAttr('disabled','disabled ');                     
              }
            });
          }
          else{
            alert('Произошла ошибка :(');
          }
        }
      });
    }
                                                                                                                                                                                                                                                                                          
<?php endif; ?>
   
</script>