<div class="anchor"></div>
<div class="table_t reestr">
    <div class="tr_t">
        <div class="td_t">
            <span>
                <label >№</label>
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
                <label >Предметы</label>
            </span>
            <div></div>
        </div>

    </div>
    <?php $index = 1; ?>
    <?php foreach ($models as $model): ?>
        <div class="tr_t">
            <div class="td_t">
                <label ><?php echo $index; ?></label>
            </div>
            <div class="td_t">
                <?php
                $picter = Yii::app()->createAbsoluteUrl('i/mini_avatar.png');
                if (!is_null($model->file_id)) {
                    $file_name = $model->uploadedfiles->name;
                    $picter = Yii::app()->createAbsoluteUrl('uploads/avatar/mini_' . $file_name);
                }
                ?>
                <?php
                echo CHtml::link("<img  src='$picter' />", Yii::app()->urlManager->createUrl('user/ViewProfile/', array('id' => $model->id)), array(
                    'class' => 'classic',
                    'async' => 'async'
                        )
                )
                ;
                ?>
            </div>
            <div class="td_t">
                <?php
                if (isset($model->patronymic)) {
                    $name = $model->surname . ' ' . $name = $model->name . ' ' . $model->patronymic;
                } else {
                    $name = $model->surname . ' ' . $name = $model->name;
                }
                ?>

                <?php
                echo CHtml::link($name, Yii::app()->urlManager->createUrl('user/ViewProfile/', array('id' => $model->id)), array(
                    'class' => 'classic',
                    'async' => 'async'
                ));
                ?>
            </div>
            <div class="td_t">

                <?php foreach ($model->predmet_prepod as $predmet): ?>
                    <?php
                    echo CHtml::link($predmet->predmet_prepod->name, Yii::app()->urlManager->createUrl('/library/predmet/' . $predmet->predmet_prepod->id), array(
                        'class' => 'classic',
                        'async' => 'async'
                    ));
                    ?><br/>
    <?php endforeach; ?>


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