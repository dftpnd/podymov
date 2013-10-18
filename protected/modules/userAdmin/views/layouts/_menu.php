<?php

$this->widget('zii.widgets.CMenu', array(
    'htmlOptions' => array('class' => 'top-nav logged_out fsdg'),
    'items' => array(
        array('label' => 'Главная', 'url' => Yii::app()->urlManager->createUrl('site/index'), 'active' => (Yii::app()->controller->getId() == 'site' && Yii::app()->controller->getAction()->getId() == 'index')),
        array('label' => 'Выход (' . Yii::app()->user->name . ')', 'url' => Yii::app()->urlManager->createUrl('site/logout'), 'visible' => !Yii::app()->user->isGuest)
    ),));
?>

