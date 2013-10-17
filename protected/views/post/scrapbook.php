<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.lightbox-0.5.css" />
<?php
$more = getenv("HTTP_REFERER");
$post_now = 'http://' . $_SERVER['SERVER_NAME'] . '/post/' . $model->id . '?title=' . $model->title;
if ($more != $post_now) {
  echo CHtml::link('Прочитать статью', Yii::app()->urlManager->createUrl('post/' . $model->id . '?title=' . $model->title), array(
      'class' => 'huas',
      'async' => 'async'
  ));
}
?><br>
<?php
?>
<div class="reset"></div>
<div id="gallery" >
  <ul>

    <?php
    $i = 1;
    foreach ($model->filetopost as $ftp) {
      if ($ftp->file->invisible != 1) {
        if ($ftp->file != null) {
          echo '<li><a href="../../uploads/oli_' . ($ftp->file->name) . '" rel="lightbox[roadtrip]" ><img  index="' . $i++ . '" src="../../uploads/thumb_' . ($ftp->file->name) . ' "/></a></li>';
        }
      }
    }
    ?>
  </ul>
  <div class="anchor"></div>
  <!--    <div class="reset"></div>-->
</div>
<div class="reset"></div>




<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.lightbox-0.5.js"></script>
<script>
    
  $('#gallery a').lightBox();
    
</script>