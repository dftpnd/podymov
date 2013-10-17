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
                <label >Наименование:</label>
            </span>
            <div></div>
        </div>
        <div class="td_t">
            <span>
                <label >Кол. загруженых файлов:</label>
            </span>
            <div></div>
        </div>
        <div class="td_t">
            <span>
                <label >Кол. преподавателей</label>
            </span>
            <div></div>
        </div>
        <div class="td_t">
            <span>
                <label >Институт</label>
            </span>
            <div></div>
        </div>
        <div class="td_t">
            <span>
                <label >Кафедра</label>
            </span>
            <div></div>
        </div>
    </div>
    <?php $index = 1; ?>
    <?php foreach ($predmets as $predmet): ?>
        <div class="tr_t">
            <div class="td_t">
                <label ><?php echo $index; ?></label>
            </div>
            <div class="td_t">
                <?php echo CHtml::link($predmet->name, Yii::app()->urlManager->createUrl('/library/predmet', array('id' => $predmet->id)), array('class' => 'classic', 'async'=>'async')); ?>
            </div>
            <div class="td_t">
                <label class="fosee" >   
                    <?php if (count($predmet->predmetfile) == 0): ?>
                        -
                    <?php else: ?>
                        <?php echo count($predmet->predmetfile); ?>
                    <?php endif; ?>
                </label>
            </div>
            <div class="td_t">
                <label class="fosee" > 
                    <?php if (count($predmet->predmetprepod) == 0): ?>
                        -
                    <?php else: ?>
                        <?php echo count($predmet->predmetprepod); ?>
                    <?php endif; ?>
                </label>
            </div>
            <div class="td_t">
                <?php
                $ins_name = '';
                $caf_name = '';

                if (isset($predmet->cafedra->id)) {
                    $caf_name = $predmet->cafedra->name;
                    $ins_name = '';

                    if ($predmet->institutecafedra->institute_id == 2) {
                        $ins_name = "ИТЭ";
                    } elseif (($predmet->institutecafedra->institute_id == 3)) {
                        $ins_name = "ИЭИТ";
                    } elseif (($predmet->institutecafedra->institute_id == 4)) {
                        $ins_name = "ИЭЭ";
                    }
                }
                ?>
                <label >
                    <?php echo $ins_name; ?>
                </label>
            </div>
            <div class="td_t">
                <label >
                    <?php echo $caf_name; ?>
                </label>
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