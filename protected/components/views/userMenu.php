<div class="menu left_pos adm">
        <?php
        $this->widget('zii.widgets.CMenu', array(
            'items' => array(
                array('label' => 'Создать новый пост', 'url' => Yii::app()->urlManager->createUrl('post/create'), 'active' => Yii::app()->controller->getAction()->getId() == 'create'),
                array('label' => 'Управление постами', 'url' => Yii::app()->urlManager->createUrl('post/admin'), 'active' => Yii::app()->controller->getAction()->getId() == 'admin'),
                array('label' => 'Комментарии' . ' (' . Comment::model()->pendingCommentCount . ')', 'url' => Yii::app()->urlManager->createUrl('comment/index'), 'active' => Yii::app()->controller->getId() == 'comment'),
//            array('label' => 'Новые пользователи', 'url' => Yii::app()->urlManager->createUrl('site/aprovemoder'), 'active' => Yii::app()->controller->getId() == ''),
//            array('label' => 'Srbac', 'url' => Yii::app()->urlManager->createUrl('srbac/authitem/frontpage'), 'active' => Yii::app()->controller->getId() == 'srbac')
            ),
        ));
        ?>
    <?php // Yii::app()->controller->getAction()->getId();?>
   <div class='anchor'></div>
</div>
<div class='anchor'></div
