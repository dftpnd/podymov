<?php
$disp = 'show_c';
if (isset($count_sp_com)) {
  if ($count_sp_com != 0) {
    $res_sum = $count_sp_com - 2;
    if ($i_com < $res_sum) {
      $disp = 'hide_c';
    } else {
      $disp = 'show_c';
    }
  }
}
?>

<div class="sp_comment <?php echo $disp; ?>" id="lkasd_<?php echo $comment->id; ?>">
  <?php if (isset($profile->id)): ?>
    <?php if ($comment->profile->id == $profile->id) : ?>
      <div class="delete_small_post"  onclick="DeleteSPComment(<?php echo $comment->id; ?>, <?php echo $type; ?>,'<?php echo md5($comment->profile->id * $comment->profile->id + $comment->profile->id + $comment->profile->id); ?>')" title="Без возможности восстановления" >удалить</div>
    <?php endif; ?>
  <?php endif; ?>
  <div class="table_t ">
    <div class="tr_t">
      <div class="td_t wsp">
        <div class="my_p ">
          <?php
          $my_picter = Yii::app()->createAbsoluteUrl('i/mini_avatar.png');
          if (!is_null($comment->profile->file_id)) {
            $file_name = $comment->profile->uploadedfiles->name;
            $my_picter = Yii::app()->createAbsoluteUrl('uploads/avatar/mini_' . $file_name);
          }
          ?>
          <?php echo CHtml::link("<img  src='$my_picter' />", Yii::app()->urlManager->createUrl('/user/ViewProfile', array('id' => $comment->profile_id)), array('async' => 'async'));
          ?>
        </div>
      </div>
      <div class="td_t">
        <?php
        echo CHtml::link(MyHelper::getUsername(false, true, $comment->profile, true), Yii::app()->urlManager->createUrl('/user/ViewProfile', array('id' => $comment->profile_id)), array(
            'class' => 'classic',
            'async' => 'async'
        ));
        ?>
        <div class="my_t9" >
          <?php $cont_text = str_replace("<br>", "\n", $comment->content); ?>
          <?php $cont_text = str_replace("&nbsp;", " ", $cont_text); ?>
          <?php $cont_text = str_replace("<div>", "", $cont_text); ?>
          <?php $cont_text = str_replace("</div>", "", $cont_text); ?>
          <?php echo MyHelper::makeClickableLinks($cont_text); ?>
        </div>
      </div>
    </div>
  </div>
</div>