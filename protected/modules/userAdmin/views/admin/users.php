<div class='tabnav'>
    <ul class="tabnav-tabs">
        <l1 class="razdel1" >
            <a href="#" class='tabnav-tab selected'>Новые пользователи</a>
        </l1>
        <l1 class="razdel2" >
            <a href="#" class='tabnav-tab'>Все пользователи</a>
        </l1>
    </ul>
</div>
<div class='gem'>
    <div class="table_t">
        <div class="tr_t">
            <div class="td_t">id</div>
            <div class="td_t">username</div>
            <div class="td_t">ФИО</div>
            <div class="td_t">статус</div>
            <div class="td_t">&nbsp;</div>
            <div class="td_t">&nbsp;</div>
        </div>
        <?php foreach ($model as $user): ?>
            <div class="tr_t" id="user_<?php echo $user->id; ?>">
                <div class="td_t">
                    <?php echo $user->id; ?>
                </div>
                <div class="td_t">
                    <?php echo $user->username; ?>
                </div>
                <div class="td_t">
                    <?php if (isset($user->prof->name)): ?>
                        <?php echo $user->prof->name; ?>
                    <?php endif; ?>

                    <?php if (isset($user->prof->surname)): ?>
                        <?php echo $user->prof->surname; ?>
                    <?php endif; ?>

                    <?php if (isset($user->prof->patronymic)): ?>
                        <?php echo $user->prof->patronymic; ?>
                    <?php endif; ?>
                </div>
                <div class="td_t">
                    <?php if ($user->active == 1): ?>
                        <div class="user_activated">активирован</div>
                    <?php else: ?>
                        <div class="user_not_activated">не активирован</div>
                    <?php endif; ?>
                </div>
                <div class="td_t">

                </div>
                <div class="td_t">

                    <?php if ($user->active == 1): ?>
                        <?php echo CHtml::link('Забанить', Yii::app()->urlManager->createUrl('/userAdmin/admin/banuser', array('id' => $user->id))); ?>
                    <?php else: ?>
                        ЗАБАНЕН
                    <?php endif; ?>
                </div>
                <div class="td_t"><span class="delete_user" onclick="deleteUser('<?php echo $user->id; ?>','<?php if (isset($user->prof)) echo $user->prof->id;else echo '0' ?>')">Удалить</span></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
