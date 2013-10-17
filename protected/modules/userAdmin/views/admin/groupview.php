<div id="breadcrambs">
    <?php
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => array(
            'Группы' => '/userAdmin/admin/group',
            'Просмотр группы'
        ),
        'separator' => '<span> / <span>'
    ));
    ?>
</div>
<div class="podobiu" onclick="podobiu(<?php echo $model->id; ?>)">
    Заполнить по подобию
</div>
<div class="infogroup" onclick="infogroup(<?php echo $model->id; ?>)">
    Инфа группы
</div>

<h1 class="maine_group" group_id='<?php echo $model->id; ?>'>
    Группа: <?php echo $model->name . " 1-" . $model->inseption->prefix_year; ?>

</h1>
<ul>
    <div class='group_user_redact' onclick="groupList(<?php echo $model->id; ?>)">Редактировать список группы</div>

</ul>
<div class="form-box">
    <div class="resume__hint__block g-round m-round_5">Тщательно и внимательно заполняйте эту форму, список этих предметов будет виден Всем.</div>
    <div class="resume__hint__block__tail g-shy"> </div>
</div>
<?php
$semestr = 1;

$kurs = '1'; //
$odd = "1";
$even = "2";
for ($i = 0; $i <= 9; $i++) {
    echo "<div class='block_kurs'>";
    echo "<div class='resume__experiences__total'></div>";
    echo "<h4 class='lokol'>$kurs курс</h4>";
    echo "<div class='block_semestr'>";
    echo "<h4>$odd семестр</h4>";
    echo "<ul class='predmets_for_groups'>";
    $do_increment = $semestr + $i;
    $mk = '1';

    foreach ($psg_model as $prdemt_semestr) {
        if ($prdemt_semestr->semestr_id == $do_increment) {
            if (isset($prdemt_semestr->predmet)) {
                echo "<li>";
                echo CHtml::link($prdemt_semestr->predmet->name, Yii::app()->urlManager->createUrl('/userAdmin/admin/predmetview', array('id' => $prdemt_semestr->predmet_id)), array('class' => 'predmets_group'));
                echo "</li>";
            }
            $mk++;
        }
    }
    echo "</ul>";
    if ($mk != '1') {
        echo "<div class='semestr_create redact-s' onclick='EditList($model->id, $do_increment)' >Редактировать семестр</div><div class='anchor'></div>";
    } else {
        echo "<div class='semestr_create add-s' semestr_id='$do_increment' onclick='EditList($model->id, $do_increment)'>Создать семестр</div><div class='anchor'></div>";
    }

    echo "</div>";

    echo "<div class='peregordka'></div>";

    echo '<div class="block_semestr">';
    echo "<h4>$even семестр</h4>";
    echo "<ul class='predmets_for_groups'>";
    $posle_increment = $semestr + (++$i);
    $lk = '1';
    foreach ($psg_model as $prdemt_semestr) {
        if ($prdemt_semestr->semestr_id == $posle_increment) {
            echo "<li>";
            echo CHtml::link($prdemt_semestr->predmet->name, Yii::app()->urlManager->createUrl('/userAdmin/admin/predmetview', array('id' => $prdemt_semestr->predmet_id)), array('class' => 'predmets_group'));
            echo "</li>";
            $lk++;
        }
    }
    echo "</ul>";
    if ($lk != '1') {
        echo "<div class='semestr_create redact-s'  onclick='EditList($model->id, $posle_increment)'>Редактировать семестр</div><div class='anchor'></div>";
    } else {
        echo "<div class='semestr_create add-s' semestr_id='$posle_increment' onclick='EditList($model->id, $posle_increment)' >Создать семестр</div><div class='anchor'></div>";
    }
    echo "</div>";
    echo "</div>";
    $kurs++;
}
?>
