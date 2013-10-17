<div class="activity_info">
    Лента событий
    <span><?php echo MyHelper::getRusMonth2($mounth) . ' ' . $year; ?></span>
</div>
<div class="table_t">
    <div class="tr_t">
        <?php $i = 1; ?>
        <?php for ($index = 0; $index < $mounth_count; $index++) : ?>
            <?php if ($index < 10) $prefix = '0';else $prefix = ''; ?>
            <div class="td_t">
                <?php $activ = ''; ?>
                <?php if (isset($act[$prefix . $index]['contente'])): ?>
                    <div class="activity_hint">
                        <div class="head_hint">
                            <?php // echo  $act[$prefix . $index]['title']; ?>
                        </div>
                        <div class="body_hint">
                            <?php echo $act[$prefix . $index]['contente']; ?>
                        </div>
                    </div>
                    <?php $activ = 'activ_day'; ?>
                <?php endif; ?>

                <span class="<?php echo $activ; ?>" ><?php echo $i; ?> </span>

            </div>
            <?php $i++; ?>
        <?php endfor; ?>
    </div>
</div>

