<?php

$this->widget('zii.widgets.CMenu', array(
    'htmlOptions' => array('class' => 'top-nav logged_out fsdg'),
    'items' => array(
        array('label' => 'Главная', 'url' => Yii::app()->urlManager->createUrl('site/index'), 'active' => (Yii::app()->controller->getId() == 'site' && Yii::app()->controller->getAction()->getId() == 'index')),
        array('label' => 'Пользователи', 'url' => Yii::app()->urlManager->createUrl('userAdmin/admin/users'), 'active' => (Yii::app()->controller->getId() == 'admin' && Yii::app()->controller->getAction()->getId() == 'users')),
        array('label' => 'Группы', 'url' => Yii::app()->urlManager->createUrl('userAdmin/admin/group'), 'active' => (Yii::app()->controller->getId() == 'admin' && Yii::app()->controller->getAction()->getId() == 'group') | (Yii::app()->controller->getId() == 'admin' && Yii::app()->controller->getAction()->getId() == 'groupview')),
        array('label' => 'Институты', 'url' => Yii::app()->urlManager->createUrl('userAdmin/admin/institute'), 'active' => (Yii::app()->controller->getId() == 'admin' && Yii::app()->controller->getAction()->getId() == 'institute') ),
        array('label' => 'Предметы', 'url' => Yii::app()->urlManager->createUrl('userAdmin/admin/predmet'), 'active' => (Yii::app()->controller->getId() == 'admin' && Yii::app()->controller->getAction()->getId() == 'predmet') | (Yii::app()->controller->getId() == 'admin' && Yii::app()->controller->getAction()->getId() == 'predmetedet')),
        array('label' => 'Почта', 'url' => Yii::app()->urlManager->createUrl('userAdmin/admin/mail'), 'active' => (Yii::app()->controller->getId() == 'admin' && Yii::app()->controller->getAction()->getId() == 'mail')),
        array('label' => 'Учебнаые недели', 'url' => Yii::app()->urlManager->createUrl('userAdmin/admin/week'), 'active' => (Yii::app()->controller->getId() == 'admin') && Yii::app()->controller->getAction()->getId() == 'week'),
        array('label' => 'Роли', 'url' => Yii::app()->urlManager->createUrl('srbac/authitem/manage'), 'active' => (Yii::app()->controller->getId() == 'authitem')),
        array('label' => 'Выход (' . Yii::app()->user->name . ')', 'url' => Yii::app()->urlManager->createUrl('site/logout'), 'visible' => !Yii::app()->user->isGuest)
    ),));
?>

