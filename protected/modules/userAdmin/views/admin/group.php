<div id="breadcrambs">
    <?php
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => array(
            'Группы',
        ),
        'separator' => '<span> / <span>'
    ));
    ?>
</div>
<div class='tabnav'>
    <ul class="tabnav-tabs">
        <l1>
            <a href="#" class='tabnav-tab selected'>Список групп</a>
        </l1>
        <l1 class="">
            <a href="#" class='tabnav-tab'>Создать группу</a>
        </l1>
    </ul>
</div>
<div class='razdel'>
    <div class="view">
        <table class="group_generat">
            <tr>
                <th class="id_group">id</th>
                <th>Имя группы</th>
                <th>Год создания</th>
                <th class="manege_group" >Действие</th>
            </tr>

            <?php
            if (isset($group)) {
                foreach ($group as $value) {
                    echo "<tr class='group_id_$value->id'>";
                    echo "<td>" . $value->id . "</td>";
                    echo "<td>";
                    echo CHtml::link($value->name, Yii::app()->urlManager->createUrl('/userAdmin/admin/groupview', array('group' => $value->id)), array('class' => 'group_name', 'id' => 'span_id_' . $value->id, 'id_input' => $value->id));
                    echo "<input  id='id_input_$value->id' typy='text' class='group_name_inp' value='$value->name' />
                </td>";
                    echo "<td>";

                    echo "<span class='show_god'>" . $value->inseption->start_year . "</span>";
                    echo "<span class='change_god'>";
                    echo CHtml::dropDownList('group_year_' . $value->id, $value->inseption->id, CHtml::listData($gyc, 'id', 'start_year'), array('prompt' => ' - '));
                    echo "</span>";
                    echo "</td>";
                    echo "<td>";
                    
                    echo "</td>";
                    echo "<td>
                          <div id_input='$value->id' class='ediat_group'  ></div>
                          <div class='otmena2' id_input='$value->id' id='id_input_otm_$value->id' ></div>
                          <div class='save2' id='id_input_save_$value->id' group_id='$value->id'></div>
                          <div title='$value->name' class='deadmau5' group_id='$value->id'></div>
                        </td>";

                    echo "</tr>";
                }
            }
            ?>
        </table>

    </div>
</div>
<div class='razdel'>
    <div class="form">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'group-group-form',
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
        <div class="row">
            <?php echo $form->labelEx($model, 'id_year_create'); ?>
            <br />
            <?php echo CHtml::dropDownList('Group[id_year_create]', '', CHtml::listData(GroupYearCreate::model()->findAll(), 'id', 'start_year'), array('prompt' => 'Год поступления группы')) ?>
            <?php echo $form->error($model, 'id_year_create'); ?>
        </div>



        <div class="row buttons">
            <?php echo CHtml::submitButton('Создать'); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->
</div>
