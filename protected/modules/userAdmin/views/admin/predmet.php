<div id="breadcrambs">
    <?php
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => array(
            'Предметы' => ''
        ),
        'separator' => '<span> / <span>'
    ));
    ?>
</div>
<div class='tabnav'>
    <ul class="tabnav-tabs">
        <l1>
            <a href="#" class='tabnav-tab selected'>Список предметов</a>
        </l1>
        <l1 class="">
            <a href="#" class='tabnav-tab'>Все предметы</a>
        </l1>
    </ul>
</div>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'predmet-predmet-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
            'validateOnType' => true,
        ),
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name'); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<div class="view">
    <table class="predet_generat">
        <tr>
            <th>id</th>
            <th>name</th>
            <th>Действие</th>
        </tr>

        <?php
        if (isset($data)) {
            $st = 'voush';
            foreach ($data as $key => $value) {
                if ($st == 'voush') {
                    $st = 'lizba';
                } else {
                    $st = 'voush';
                }
                echo "<tr class='predet_id_$value->id  $st'>";
                echo "<td>" . $value->id . "</td>";
                echo "<td>";
                echo CHtml::link($value->name, Yii::app()->urlManager->createUrl('/userAdmin/admin/predmetedet', array('id' => $value->id)), array('class' => 'premet_name', 'id_input' => $value->id, 'id' => 'span_id_' . $value->id));
                echo "<input  id='id_input_$value->id' typy='text' class='predmet_name_inp' value='$value->name' /></td>";

                echo "<td class='actions'>
                <div class='ediat_premet' id_input='$value->id'></div>
                <span title='$value->name' class='pendulum' predmet_id='$value->id'></span>
                <span class='otmena' id_input='$value->id' id='id_input_otm_$value->id' ></span>
                <span class='save' id='id_input_save_$value->id' predmet_id='$value->id'></span>
                </td>";
                echo "</tr>";
            }
        }
        ?>
    </table>

</div> 
