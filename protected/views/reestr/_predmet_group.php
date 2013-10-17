<?php
$semestr = 1;

$kurs = '1'; //
$odd = "1";
$even = "2";
for ($i = 0; $i <= 9; $i++) {

    echo "<div class='block_kurs resume__emptyblock'>";
    echo "<h1>$kurs курс</h1>";
    echo "<div class='block_semestr'>";
    echo "<h4>$odd семестр</h4>";
    echo "<ul class='predmets_for_groups'>";
    $do_increment = $semestr + $i;
    foreach ($psg_model as $prdemt_semestr) {
        if ($prdemt_semestr->semestr_id == $do_increment) {
            if (isset($prdemt_semestr->predmet)) {
                echo "<li>";
                echo CHtml::link($prdemt_semestr->predmet->name, Yii::app()->urlManager->createUrl('/library/predmet', array('id' => $prdemt_semestr->predmet_id)), array(
                    'class' => 'classic',
                    'async' => 'async'
                        )
                );
                $avdug = '';
                if (isset($entry[$do_increment][$prdemt_semestr->predmet_id])) {
                    $avdug = $entry[$do_increment][$prdemt_semestr->predmet_id];
                }
            }
        }
    }
    echo "</ul>";
    echo "</div>";
    echo "<div class='peregordka'></div>";
    echo '<div class="block_semestr">';
    echo "<h4>$even семестр</h4>";
    echo "<ul class='predmets_for_groups'>";
    $posle_increment = $semestr + (++$i);
    foreach ($psg_model as $prdemt_semestr) {
        if ($prdemt_semestr->semestr_id == $posle_increment) {
            echo "<li>";
            echo CHtml::link($prdemt_semestr->predmet->name, Yii::app()->urlManager->createUrl('/library/predmet', array('id' => $prdemt_semestr->predmet_id)), array(
                'class' => 'classic',
                'async' => 'async'
            ));
            $avdrug = '';
            if (isset($entry[$posle_increment][$prdemt_semestr->predmet_id])) {
                $avdrug = $entry[$posle_increment][$prdemt_semestr->predmet_id];
            }
            echo "</li>";
        }
    }
    echo "</ul>";
    echo "</div>";
    echo "</div>";
    $kurs++;
}
?>
<div class="anchor"></div>
