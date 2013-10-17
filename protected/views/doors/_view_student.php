<div class="vk">
    <div class="avatar_door">

        <?php
        $picter = Yii::app()->createAbsoluteUrl('i/avatar.png');
        if (!is_null($profile->file_id)) {
            $file_name = $profile->uploadedfiles->name;
            $picter = Yii::app()->createAbsoluteUrl('uploads/avatar/avatar_' . $file_name);
        }
        ?>
        <img src="<?php echo $picter; ?>" />

    </div>
    <div class="door_info_block">
        <div class="table_t">
            <div class="tr_t">
                <div class="td_t bar_wi">Имя:</div>
                <div class="td_t"><?php echo $profile->name; ?></div>
            </div>
            <div class="tr_t">
                <div class="td_t bar_wi">Фамилия:</div>
                <div class="td_t"><?php echo $profile->surname; ?></div>
            </div>
            <div class="tr_t">
                <div class="td_t bar_wi">Отчество:</div>
                <div class="td_t"><?php echo $profile->patronymic; ?></div>
            </div>
        </div>
    </div>
    <div class="anchor"></div>


    <div id="chartdiv" style="width: 100%; height: 350px"></div>


</div>