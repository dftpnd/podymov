<div class="vk">
  <div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableAjaxValidation' => true,
            ));
    ?>
    <div id="maineeror">Неправильный логин или пароль</div>
    <table class="reg_form">
      <tr>
        <td class="spechak">
          <?php echo $form->labelEx($model, 'username'); ?>
        </td>
        <td>
          <?php echo $form->textField($model, 'username', array('class' => 'regform_tro')); ?>  
        </td>
      </tr>
      <tr>
        <td class="spechak">
          <?php echo $form->labelEx($model, 'password'); ?>
        </td>
        <td>
          <?php echo $form->passwordField($model, 'password', array('class' => 'regform_tro')); ?>
        </td>
      </tr>
      <tr>
        <td>

        </td>
        <td>
          <?php echo $form->checkBox($model, 'rememberMe'); ?>
          <?php echo $form->label($model, 'rememberMe'); ?><br/>
          <?php echo CHtml::link('Регистрация', Yii::app()->urlManager->createUrl('site/registration'), array('class' => 'regform')); ?>
          <?php echo CHtml::link('Забыли пароль?', Yii::app()->urlManager->createUrl('site/recoverypassword'), array('class' => 'foget_passsword')); ?>
        </td>
      </tr>
      <tr>
        <td>
        </td>
        <td>
          <div class="close close_srtyle" onclick='closeDoor()()'>Отмена</div>
          <span id="ajax_loade_enter"></span>
          <div class="ajax_loade_help"></div>
          <?php echo CHtml::submitButton('Войти', array('class' => 'enter', 'onclick' => 'loginEnter($(this));return false')); ?>
          <script>
            function loginEnter(el){
              el.addClass('loading');
              $.ajax({
                url: '/site/login',
                type: 'POST',
                dataType:'json',
                data: {
                  "LoginForm[password]":$.md5($('#LoginForm_password').val()),
                  "LoginForm[username]":$("#LoginForm_username").val()
                },
                success: function(data){                                                       
                  if( data.status == "success"){
                    el.removeClass('loading');
                    goSpiner();
                    window.location=('/site/index'); 
                  }
                  else{
                    el.removeClass('loading');
                    $("#maineeror").show();
                    $('.regform_tro').css('background','#FF9999');
                  }
                                        
                }
              });
            }
          </script>

        </td>
      </tr>

    </table>
    <?php $this->endWidget(); ?>
  </div>
  <div class="social">
    <div class="social_text">Войти через:</div>
    <a href="http://api.vkontakte.ru/oauth/authorize?client_id=3211710&amp;scope=&amp;redirect_uri=http://atpp.in/site/VkVhod/&amp;response_type=code" class="enter_in_vk"></a>
    <div class="danger_enter">
      <span>*</span> Вы сможете войти через контакт, только если вы уже  <?php echo CHtml::link('зарегистрировались', Yii::app()->urlManager->createUrl('site/registration'), array('class' => 'classic')); ?>
    </div>
  </div>

</div>