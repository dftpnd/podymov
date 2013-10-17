<?php
$text_script_plus = "ObjectRating($type,$discussion->id,$plus)";
$text_script_minus = "ObjectRating($type,$discussion->id,$minus)";
$div_title_plus = 'Нравится';
$div_title_minus = 'Не нравится';
?>


<div class="view_small_post" id="sp_<?php echo $discussion->id; ?>">
  <?php if ($type == '4') : ?>
    <?php if ($discussion->profile_id == $profile->id) : ?>
      <div class="delete_small_post"  onclick="DeleteSmallPost(<?php echo $discussion->id; ?>,<?php echo $type; ?>,'<?php echo md5($profile->id * $profile->id + $profile->id + $profile->id); ?>')" title="Без возможности восстановления">удалить</div>
    <?php elseif (isset($hozyin->id)) : ?>
      <?php if ($profile->id == $hozyin->id) : ?>
        <div class="delete_small_post"  onclick="DeleteSmallPost(<?php echo $discussion->id; ?>,<?php echo $type; ?>,'<?php echo md5($profile->id * $profile->id + $profile->id + $profile->id); ?>')" title="Без возможности восстановления">удалить</div>
      <?php endif; ?>
    <?php endif; ?>
  <?php elseif ($type == '3') : ?>

    <?php if ($discussion->profile_id == $profile->id) : ?>
      <div class="delete_small_post"  onclick="DeleteSmallPost(<?php echo $discussion->id; ?>,<?php echo $type; ?>,'<?php echo md5($profile->id * $profile->id + $profile->id + $profile->id); ?>')" title="Без возможности восстановления">удалить</div>
    <?php endif; ?>
  <?php elseif ($type == '6') : ?>
    <?php if (isset($profile->id)): ?>    
      <?php if ($discussion->profile_id == $profile->id) : ?>
        <div class="delete_small_post"  onclick="DeleteSmallPost(<?php echo $discussion->id; ?>,<?php echo $type; ?>,'<?php echo md5($profile->id * $profile->id + $profile->id + $profile->id); ?>')" title="Без возможности восстановления">удалить</div>
      <?php endif; ?>
    <?php endif; ?>
  <?php endif; ?>






  <div class="object_rating sp_rating">
    <div class="object_plus" onclick='<?php echo $text_script_plus; ?>' title="<?php echo $div_title_plus; ?>">
    </div>
    <?php
    $znak_plus = '';
    if (!is_null($discussion->rating)) {
      $state = $discussion->rating;
      if ($state > 0) {
        $class = 'poloj';
        $znak_plus = '+';
      } else if ($state < 0) {
        $class = 'otr';
      } else {
        $class = 'null';
      }
    } else {
      $state = '0';
      $class = 'null';
    }
    ?>
    <div class="object_state <?php echo $class; ?>">
      <?php echo $znak_plus . $state; ?>
    </div>
    <div class="object_minus" onclick='<?php echo $text_script_minus; ?>' title="<?php echo $div_title_minus; ?>">
    </div>
  </div>


  <div class="table_t sp_kaj">
    <div class="tr_t">
      <div class="td_t wsp">
        <div class="my_p ">
          <?php
          $my_picter = Yii::app()->createAbsoluteUrl('i/mini_avatar.png');
          if (!is_null($discussion->profile->file_id)) {
            $file_name = $discussion->profile->uploadedfiles->name;
            $my_picter = Yii::app()->createAbsoluteUrl('uploads/avatar/mini_' . $file_name);
          }
          ?>
          <?php
          echo CHtml::link("<img  src='$my_picter' />", Yii::app()->urlManager->createUrl('/user/ViewProfile', array('id' => $discussion->profile_id)), array(
              'async' => 'async'
                  )
          );
          ?>
        </div>
      </div>
      <div class="td_t">
        <?php
        echo CHtml::link(MyHelper::getUsername(false, true, $discussion->profile, true), Yii::app()->urlManager->createUrl('/user/ViewProfile', array('id' => $discussion->profile_id)), array(
            'class' => 'classic',
            'async' => 'async'
        ));
        ?>
        <span class="time-create"><?php echo $discussion->date ?></span>
        <?php
        $opacity = '1';
        if ($state < 0) {
          if ($state < -10) {
            $opacity = 0.1;
          } else {
            $opacity = '0.' . (10 + $state);
          }
        }
        ?>
        <div class="my_t" style="opacity:<?php echo $opacity ?>" >
          <?php echo MyHelper::makeClickableLinks($discussion->content); ?>
          <div class="anchor"></div>

        </div>

      </div>
    </div>
  </div>

  <?php
  if (isset($discussion->child)) {
    $count_sp_com = count($discussion->child);
  } else {
    $count_sp_com = 0;
  }
  ?>
  <?php if ($count_sp_com > 3): ?>
    <div class="show_com" onclick="showComment($(this), <?php echo $discussion->id; ?>)">
      <?php
      $endingArray = array('комментарий', 'комментария', 'комментариев');
      $word = MyHelper::getNumEnding($count_sp_com, $endingArray);
      ?>
      Показать все <span id="count_com_id_<?php echo $discussion->id; ?>" class="count_com"><?php echo $count_sp_com; ?> </span><?php echo $word; ?>
    </div>
    <div class="hide_com" onclick="hideComment($(this), <?php echo $discussion->id; ?>)">
      Скрыть комментарии
    </div>
  <?php endif; ?>
  <div class="comment_small_post">
    <div class="comment_small_post" id="sp_id_fo_com_<?php echo $discussion->id; ?>">

      <?php if (isset($discussion->child)): ?>
        <?php $i_com = 1; ?>
        <?php foreach ($discussion->child as $comment) : ?>
          <?php
          $this->renderPartial('application.views.user._sp_comment', array(
              'comment' => $comment,
              'profile' => $profile,
              'count_sp_com' => $count_sp_com,
              'i_com' => $i_com,
              'type' => $type
                  )
          );
          $i_com++;
          ?>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
    <?php if (!Yii::app()->user->isGuest): ?>
      <div class="new_comment">
        <div class="new_comment_psevdo" id="ncp_<?php echo $discussion->id; ?>">
          <textarea class="psedo_area" onfocus="zamenaTextArea(<?php echo $discussion->id; ?>, <?php echo $type; ?>)">Комментировать...</textarea>
        </div>
        <div class="new_comment_real" id="ncr_<?php echo $discussion->id; ?>">
          <div class="box_new_com_1">
            <?php
            $my_picter = Yii::app()->createAbsoluteUrl('i/mini_avatar.png');
            if (!is_null($profile->file_id)) {
              $file_name = $profile->uploadedfiles->name;
              $my_picter = Yii::app()->createAbsoluteUrl('uploads/avatar/mini_' . $file_name);
            }
            ?>
            <?php
            echo CHtml::link("<img  src='$my_picter' />", Yii::app()->urlManager->createUrl('/user/ViewProfile', array('id' => $discussion->profile_id)), array(
                'async' => 'async'
            ));
            ?>
          </div>
          <div class="box_new_com">
            <div class="div_textare" id="dt_<?php echo $discussion->id; ?>" contentEditable="true" onblur="getBackCom(<?php echo $discussion->id; ?>)"></div>
            <div class="inp_sub" class="" onclick="newSmallPostComment(<?php echo $discussion->id; ?>, $(this),<?php echo $type; ?>)">Отправить</div>
          </div>
          <div class="anchor"></div>

        </div>
      </div>
    <?php endif; ?>
  </div>

</div>

