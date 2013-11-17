<?php
//
$this->widget('zii.widgets.CMenu', array(
    'htmlOptions' => array('class' => 'nav nav-justified'),
    'items' => array(
        array('label' => 'Главная', 'url' => Yii::app()->urlManager->createUrl('/site/index')),
        array('label' => 'Инструкции', 'url' => Yii::app()->urlManager->createUrl('/userAdmin/admin/index'), 'active' => (Yii::app()->controller->getId() == 'admin' && Yii::app()->controller->getAction()->getId() == 'index')),
        array('label' => 'Публикации', 'url' => Yii::app()->urlManager->createUrl('/userAdmin/admin/post'),
            'active' => (Yii::app()->controller->getAction()->getId() == 'post') || Yii::app()->controller->getAction()->getId() == 'postedit'),
        array('label' => 'Настройки', 'url' => Yii::app()->urlManager->createUrl('/userAdmin/admin/user'), 'active' => (Yii::app()->controller->getId() == 'admin' && Yii::app()->controller->getAction()->getId() == 'user')),
        array('label' => 'Выход', 'url' => Yii::app()->urlManager->createUrl('site/logout'), 'visible' => !Yii::app()->user->isGuest)
    ),));
?>

