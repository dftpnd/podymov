<form id="student_group">
    <div class="table_t reestr">
        <div class="tr_t ">
            <div class="td_t">
                <span>
                    <span class="compare_values" title="Сравнить" onclick="prepearGroup()"></span>
                </span>
                <div></div>
            </div>
            <div class="td_t">
                <span>
                    <label for="name">Группа:</label>
                    <select>
                        <option>все</option>
                        <?php foreach ($name_group as $key => $value): ?>
                            <option value="<?php echo $value; ?>"><?php echo $key; ?></option>
                        <?php endforeach; ?>
                    </select>
                </span>
                <div></div>
            </div>
            <div class="td_t">
                <span>
                    <label for="year">Год:</label>
                    <select>
                        <option>все</option>
                        <?php foreach ($year as $key => $value): ?>
                            <option value="<?php echo $value; ?>"><?php echo $key; ?></option>
                        <?php endforeach; ?>
                    </select>
                </span>
                <div></div>
            </div>
            <div class="td_t">
                <span>
                    <label > Средний балл</label>
                </span>
                <div></div>
            </div>
            <div class="td_t">
                <span>
                    <label >Процент зарегистрировавшихся</label>
                </span>
                <div></div>
            </div>
            <div class="td_t">
                <span>
                    <label >Куратор группы</label>
                </span>
                <div></div>
            </div>


        </div>


        <?php
        foreach ($groups as $group):
            if (!is_null($group->students) && !is_null($group->all_man)) {
                $percent = round(($group->students * 100) / $group->all_man);
            } else {
                $percent = 1;
            }
            ?>

            <div class='tr_t' id='<?php echo $group->id; ?>'>
                <div class='td_t'><input type='checkbox' name='groups[]' value='<?php echo $group->id; ?>' /></div>
                <div class='td_t'>
                    <?php echo CHtml::link($group->name . ' 1-' . $group->inseption->prefix_year, Yii::app()->urlManager->createUrl('/reestr/group', array('id' => $group->id)), 
                            array(
                                'class' => 'group classic',
                                'async' => 'async'
                                )
                            ); ?>
                </div>
                <div class='td_t'><?php echo $group->inseption->start_year; ?></div>
                <div class='td_t'><?php echo $group->mean ?></div>
                <div class='td_t'>
                    <div class='maine_bar'  title='<?php echo $percent; ?>%' >
                        <div class='' style='width:<?php echo $percent; ?>%'  title='<?php echo $percent; ?>%' >
                        </div>
                    </div>
                </div>
                <div class='td_t'><?php echo $group->curator; ?> </div>


            </div>

        <?php endforeach; ?>
    </div>
</form>
<script>
    $(document).ready(function(){
        $('.reestr').fixedtableheader(); 
    });
</script>