<div class="tr_t">
  <div class="td_t">
    <?php
    $picter = Yii::app()->createAbsoluteUrl('i/mini_avatar.png');
    if (!is_null($student->file_id)) {
      $file_name = $student->uploadedfiles->name;
      $picter = Yii::app()->createAbsoluteUrl('uploads/avatar/mini_' . $file_name);
    }
    ?>
    <?php $img = "<img  src='" . $picter . "' />"; ?>
    <?php echo MyHelper::linkFaker($student, $img); ?>
  </div>
  <div class="td_t">
    <?php echo MyHelper::linkFaker($student); ?>
  </div>
  <div class="td_t">
    <?php echo CHtml::link($student->team->name . ' 1-' . $student->team->inseption->prefix_year, Yii::app()->urlManager->createUrl('/reestr/group/' . $student->team->id), array('class' => 'classic')); ?>
  </div>
  <div class="td_t">
    <span class="classic_delete" onclick="deleteStudent(<?php echo $student->id ?>)">
      удалить
    </span>
  </div>
  <div class="td_t">
    <?php if (isset($student->user)): ?>
      <?php if ($student->user->banned != 1): ?>
        <span class="classic_delete" onclick="banStudent(<?php echo $student->id ?>)">
          забанить
        </span>
      <?php else : ?>
        <span class="classic" onclick="razBanStudent(<?php echo $student->id ?>)">
          разбанить
        </span>
      <?php endif; ?>
    <?php endif; ?>
  </div>
  <div class="td_t">
    <?php echo $student->mean ?>
  </div>
  <div class="td_t">
    <?php if ($student->fake == Profile::STATUS_FAKE): ?>
      <div  onclick="inheritStats(<?php echo $student->user_id ?>)"></div>
    <?php else : ?>

    <?php endif; ?>

  </div>
</div>