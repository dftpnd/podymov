<div class="vk">
    <form id="infogroup">
        <input type="hidden" name="group_id" value="<?php echo $model->id; ?>">
        <label>
            Имя Куратора
            <input type="text" name="Group[curator]" value="<?php if (isset($model->curator)) echo $model->curator; ?>">
        </label>
        <label>
            Полный состав группы
            <input type="text" name="Group[all_man]" value="<?php if (isset($model->all_man)) echo $model->all_man; ?>">
        </label>
        <div class="anchor"></div>
        <div class="submit_but" onclick="saveInfogroup()" style="float: right;">
            Сохранить
        </div>
        <div class="anchor"></div>
    </form>
</div>
