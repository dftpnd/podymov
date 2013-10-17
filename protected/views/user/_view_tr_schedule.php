<?php
$selected = '';
$selected1 = '';
$selected2 = '';

$class_chenge_week = 'day' . $wekday_id . '_pair' . $schedule->order;
?>
<?php
if ($schedule->week_razd == 1) {
    $vb = '';
    $show_class = '1';
} else if ($schedule->week_razd == 2) {
    $vb = '*'; //по нечетным ( * )
    $show_class = '2';
} else if ($schedule->week_razd == 3) {
    $vb = '**'; //по четным ( ** )
    $show_class = '3';
}
?>
<div class='tr_t <?php echo $sta; ?> show_class_<?php echo $show_class; ?>' id="day_schesule_<?php echo $schedule->id; ?>" >
    <div class='td_t'>
        <span class="">
            <?php
            echo $schedule->order . '&nbsp;' . $vb;
            ?>

        </span>
    </div>
    <div class='td_t'>
        <?php
        if (!empty($schedule->predmet->name))
            echo CHtml::link($schedule->predmet->name, Yii::app()->urlManager->createUrl('/library/predmet/' . $schedule->predmet->id), array('class' => 'classic'));
        else if (!empty($schedule->predmet_1->name))
            echo CHtml::link($schedule->predmet_1->name, Yii::app()->urlManager->createUrl('/library/predmet/' . $schedule->predmet_1->id), array('class' => 'classic'));
        else if (!empty($schedule->predmet_2->name))
            echo CHtml::link($schedule->predmet_2->name, Yii::app()->urlManager->createUrl('/library/predmet/' . $schedule->predmet_2->id), array('class' => 'classic'));
        else
            echo 'Предмет не выбран старостой'
            ?>
    </div>
    <div class='td_t'>
        <?php
        if (isset($schedule->type_pair->name))
            echo $schedule->type_pair->name;
        ?>

    </div>
    <div class='td_t'>
        <?php
        if (isset($schedule->time_pair->name))
            echo $schedule->time_pair->name;
        ?>
    </div>
    <div class='td_t'>
        <?php if (isset($schedule->room)) echo $schedule->room; ?>
    </div>

    <div class='td_t'>

    </div>
</div>