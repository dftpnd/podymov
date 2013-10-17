<div class="tr_t">
    <div class="td_t">
        <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    </div>
    <div class="td_t">
        <?php echo CHtml::encode($data->file_id); ?>
    </div>
    <div class="td_t">
        <?php echo CHtml::encode($data->group_id); ?>
    </div>
    <div class="td_t">
        <?php echo CHtml::encode($data->scope_id); ?>
    </div>
    <div class="td_t">
        <?php echo CHtml::encode($data->profile_id); ?>
    </div>
    <div class="td_t">
        <?php echo CHtml::encode($data->create_time); ?>
    </div>
</div>
