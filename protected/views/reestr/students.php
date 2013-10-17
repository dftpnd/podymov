<form id="student_compare">

  <div class="anchor"></div>
  <div class="table_t reestr">
    <div class="tr_t">
      <div class="td_t">
        <span>
          <span class="compare_values" onclick="prepearStudent()" title="Сравнить"></span>
        </span>
        <div></div>
      </div>
      <div class="td_t">
        <span>
          <label >Фото</label>
        </span>
        <div></div>
      </div>
      <div class="td_t">
        <span>
          <label >ФИО:</label>
        </span>
        <div></div>
      </div>
      <div class="td_t">
        <span>
          <label >Группа</label>
        </span>
        <div></div>
      </div>
      <div class="td_t">
        <span>
          <label >Средний балл</label>
        </span>
        <div></div>
      </div>
      <div class="td_t">
        <span>
          <label >Последний визит на сайт</label>
        </span>
        <div></div>
      </div>

    </div>
    <?php $index = 1; ?>
    <?php foreach ($models as $model): ?>
      <div class="tr_t">
        <div class="td_t">
          <input type="hidden" name="group_id" value="<?php echo $model->prof->group_id; ?>">
          <input type="checkbox" name="students[<?php echo $model->prof->id; ?>]"  value="<?php echo $model->prof->id; ?>"/>
        </div>
        <div class="td_t">
          <?php
          $picter = Yii::app()->createAbsoluteUrl('i/mini_avatar.png');
          if (!is_null($model->prof->file_id)) {
            $file_name = $model->prof->uploadedfiles->name;
            $picter = Yii::app()->createAbsoluteUrl('uploads/avatar/mini_' . $file_name);
          }
          ?>
          <?php echo MyHelper::linkFaker($model->prof, "<img  src='$picter' />"); ?>
        </div>
        <div class="td_t">
          <?php echo MyHelper::linkFaker($model->prof); ?>
        </div>
        <div class="td_t">
          <?php
          echo CHtml::link($model->prof->team->name . ' 1-' . $model->prof->team->inseption->prefix_year, Yii::app()->urlManager->createUrl('/reestr/group/' . $model->prof->team->id), array(
              'class' => 'classic',
              'async' => 'async',
                  )
          );
          ?>
        </div>
        <div class="td_t">
          <?php echo $model->prof->mean ?>
        </div>
        <div class="td_t">
          <?php if (!is_null($model->laste_enter)): ?>
            <?php echo date('j', $model->laste_enter); ?>&nbsp;<?php echo MyHelper::getRusMonth((int) date('n', $model->laste_enter)) ?>&nbsp;<?php echo date('Y', $model->laste_enter); ?>
          <?php endif; ?>
        </div>
      </div>
      <?php $index++; ?>
    <?php endforeach; ?>

  </div>
  <script>
    $(document).ready(function(){
      $('.reestr').fixedtableheader(); 
    });
  </script>
</form>