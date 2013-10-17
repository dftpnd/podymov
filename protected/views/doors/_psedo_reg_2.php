<h1>Выберите удобный способ регистрации</h1>
<?php

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    'action' => '/site/UserValidete',
    'method' => 'post',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => true,
        'validateOnType' => true,
        'afterValidateAttribute' => 'js:function(form, attribute, data, hasError){ 
            elblock = $("."+attribute.inputID);
            
            if(hasError != true)
            {
                elblock.removeClass("bade")
                elblock.addClass("perfect")
            }
            else{
                elblock.removeClass("perfect")
                elblock.addClass("bade")
            }
            ;}'
    ),
));
?>
<div class="social">
    <div class="social_text">Регистрация через вконтакте:</div>
    <a href="http://api.vkontakte.ru/oauth/authorize?client_id=3211710&amp;scope=&amp;redirect_uri=http://atpp.in/site/VkReg/&amp;response_type=code"
       class="enter_in_vk"></a>
</div>
<div class="lasdasd"></div>
<div class="social">
    <div class="social_text">Регистрация через email:</div>
    <div class="table_t reg_new">
        <div class='tr_t'>
            <div class='td_t reg_new_ferst'>
                <?php echo $form->labelEx($user, 'username'); ?>
            </div>
            <div class='td_t'>
                <?php echo $form->textField($user, 'username'); ?>
                <?php echo $form->error($user, 'username'); ?>
            </div>
            <div class='td_t'>
                <div class="input_stat User_username" inp="User_username"></div>
            </div>
        </div>
        <div class='tr_t '>
            <div class='td_t reg_new_ferst'>
                <?php echo $form->labelEx($user, 'password'); ?>
            </div>
            <div class='td_t'>
                <?php echo $form->passwordField($user, 'password'); ?>
                <?php echo $form->error($user, 'password'); ?>
            </div>
            <div class='td_t'>
                <div class="input_stat User_password" inp="User_password"></div>
            </div>
        </div>
        <div class='tr_t'>
            <div class='td_t reg_new_ferst'>
                <label for='User_password_repeat'>Повторите пароль</label><span class="required"> *</span>
            </div>
            <div class='td_t'>
                <?php echo $form->passwordField($user, 'password_repeat'); ?>
                <?php echo $form->error($user, 'password_repeat'); ?>

            </div>
            <div class='td_t'>
                <div class="input_stat User_password_repeat" inp="User_password_repeat"></div>
            </div>
        </div>
        <div class='tr_t'>
            <div class='td_t reg_new_ferst'>
            </div>
            <div class='td_t'>
                <div class="anchor"></div>
                <div id='zareg'>
                    <?php
                    echo CHtml::ajaxSubmitButton('Зарегистрироваться', CHtml::normalizeUrl(array('/site/UserValidete')), array(
                            'dataType' => 'json',
                            'beforeSend' => 'js:function(){
                $("#zareg input").addClass("loading");                               
        }',
                            'success' => 'js:function(data){
                    function finishback(){
                        $(".step4").show( "slide", {
                            direction: "down"
                            }, 1000 );
                     }; 
                    if(data.status == "success"){    
                    $("#zareg input").removeClass("loading");
                     $("#hippodrome .step3").hide( "slide", {
                        direction: "up"
                        }, 1000, finishback );
                      
                     $(".step4").html(data.div);
                     }else if(data.status == "valure"){
                     
                     }
        }',
                            'complete' => 'js:function(){
                $("#zareg input").removeClass("loading");
        }',

                        )
                    );
                    ?>
                </div>
                <div class="anchor"></div>
            </div>
            <div class='td_t'></div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>


