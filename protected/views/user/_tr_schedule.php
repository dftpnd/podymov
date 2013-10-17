<?php
$selected = '';
$selected1 = '';
$selected2 = '';

$class_chenge_week = 'day' . $wekday_id . '_pair' . $schedule->order;
?>

<div class='tr_t ' id="day_schesule_<?php echo $schedule->id; ?>" >
  <div class='td_t'>


    <?php
    echo CHtml::dropDownList(
            "order[$schedule->id]", $schedule->order, $data2);
    ?>
  </div>
  <div class='td_t'>
    <?php
    if (!empty($schedule->predmet_id)) {
      echo CHtml::dropDownList(
              "predmet[$schedule->id]", $schedule->predmet_id, $data
      );
      $selected = 'selected';
      $selected1 = '';
      $selected2 = '';
    } else if (!empty($schedule->predmet_1_id)) {
      echo CHtml::dropDownList(
              "predmet_1[$schedule->id]", $schedule->predmet_1_id, $data
      );
      $selected = '';
      $selected1 = 'selected';
      $selected2 = '';
    } else if (!empty($schedule->predmet_2_id)) {
      echo CHtml::dropDownList(
              "predmet_2[$schedule->id]", $schedule->predmet_2_id, $data
      );
      $selected = '';
      $selected1 = '';
      $selected2 = 'selected';
    } else {
      if (!empty($schedule->id))
        if (!empty($data))
          echo CHtml::dropDownList("predmet_2[$schedule->id]", '', $data);
        else
          echo CHtml::dropDownList("predmet_2[$schedule->id]", '');
    }
    ?>
  </div>
  <div class='td_t' >
    <?php
    echo CHtml::dropDownList(
            "week_razd[$schedule->id]", $schedule->week_razd, $data3
    );
    ?>


  </div>
  <div class='td_t'>
    <?php
    echo CHtml::dropDownList(
            "type_pair[$schedule->id]", $schedule->type_pair_id, CHtml::listData($type_pair, 'id', 'name')
    );
    ?>

  </div>
  <div class='td_t'>
    <?php
    echo CHtml::dropDownList(
            "time_pair[$schedule->id]", $schedule->time_pair_id, CHtml::listData($time_pair, 'id', 'name')
    );
    ?>
  </div>
  <div class='td_t'>
    <input type='text' value="<?php if (isset($schedule->room)) echo $schedule->room; ?>" name="room[<?php echo $schedule->id; ?>]">
  </div>

  <div class='td_t'><span class='delete_par' onclick="deletePair(<?php echo $schedule->id; ?>)">удалить</span></div>
</div>
