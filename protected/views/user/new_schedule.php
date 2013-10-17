<?php
$dn = date('N');
if ($dn == 1) {
    $day = '1';
    $day_text = 'Понедельник';
} else if ($dn == 2) {
    $day = '2';
    $day_text = 'Вторник';
} else if ($dn == 3) {
    $day = '3';
    $day_text = 'Среда';
} else if ($dn == 4) {
    $day = '4';
    $day_text = 'Четверг';
} else if ($dn == 5) {
    $day = '5';
    $day_text = 'Пятница';
} else if ($dn == 6) {
    $day = '6';
    $day_text = 'Суббота';
} else if ($dn == 7) {
    $day = '7';
    $day_text = 'Воскресенье';
}
?>
<?php if ($semestr != ""): ?>

    <div class="dinamic_day">
        <span class="for_day_date">сегодня:  </span>

        <h2 class="day_date"><?php
            echo date('d ') . MyHelper::getRusMonth(date('n'));
            ?>
        </h2>
        <?php echo $day_text; ?>
    </div>






    <div class="fixed_tabs">
        <form>
            <div id="radio">
                <input type="radio" id="radio1" name="radio"/><label for="radio1">Еженедельно</label>
                <input type="radio" id="radio2" name="radio" checked="checked"/><label for="radio2">Четная
                    неделя</label>
                <input type="radio" id="radio3" name="radio"/><label for="radio3">Нечетная неделя</label>
            </div>
        </form>
    </div>

    <div class="this_day">


        <?php
        $count_day = 1;
        foreach ($wekdays as $wekday) :
            ?>

            <div class="school_day resume__emptyblock dc_<?php echo $wekday->id; ?>">
                <div class="week_day_in_schedule">
                    <?php
                    echo $wekday->name;
                    ?>
                    <div class="wekday_name"></div>


                </div>

                <div class="days">
                    <form id="day_<?php echo $wekday->tab ?>" method="post">
                        <input type="hidden" name="day_id" value="<?php echo $wekday->id ?>">
                        <?php if (!empty($wekday->schedule)) : ?>
                            <div class="table_t sost_day_<?php echo $wekday->id ?>">
                                <?php $sta = 'prh'; ?>
                                <?php foreach ($wekday->schedule as $schedule) : ?>
                                    <?php
                                    if ($sta == 'prh') {
                                        $sta = 'sta';
                                    } else {
                                        $sta = 'prh';
                                    }
                                    ?>
                                    <?php
                                    $this->renderPartial('application.views.user._view_tr_schedule', array(
                                            'schedule' => $schedule,
                                            'data' => $data,
                                            'data2' => $data2,
                                            'data3' => $data3,
                                            'type_pair' => $type_pair,
                                            'time_pair' => $time_pair,
                                            'wekday_id' => $wekday->id,
                                            'sta' => $sta
                                        )
                                    )
                                    ?>
                                    <?php $count_day++; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>


                        <?php endif; ?>

                    </form>
                </div>
                <div class="anchor"></div>
            </div>
        <?php endforeach; ?>
        <div class="anchor"></div>
    </div>
<?php else: ?>
    <h1>Каникулы!</h1>

    <img src="<?php echo Yii::app()->urlManager->createUrl('/i/otdyh.jpg'); ?>"/>
<?php endif; ?>




<script>

    getActiveDay(<?php echo $day; ?>);
    getWeek(<?php echo $we; ?>);



    $("#radio").buttonset()


    $('.ui-button').click(function () {
        var rad = $(this).attr('for');
        if (rad == 'radio1') {
            getAllWeek();
        } else if (rad == 'radio2') {
            getChetWeek();
        } else if (rad == 'radio3') {
            getNeChetWeek();
        }
    });


    <?php if (Yii::app()->user->hasFlash('commentSubmitted')): ?>
    text = "<?php echo Yii::app()->user->getFlash('commentSubmitted'); ?>";
    noticeOpen(text, "1");
    <?php endif; ?>
</script>
