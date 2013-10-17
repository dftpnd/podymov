<div class="menu">
  <?php
  $this->widget('zii.widgets.CMenu', array(
      'items' => array(
          array(
              'label' => 'Главная',
              'url' => Yii::app()->urlManager->createUrl('site/index'),
              'linkOptions' => array(
                  'async' => 'async',
              ),
              'active' => (Yii::app()->controller->getId() == 'site' &&
              Yii::app()->controller->getAction()->getId() == 'index')),
          array(
              'label' => 'Статьи',
              'linkOptions' => array(
                  'async' => 'async',
              ),
              'url' => Yii::app()->urlManager->createUrl('post/index'), 'active' => (Yii::app()->controller->getId() == 'post' && Yii::app()->controller->getAction()->getId() == 'index') | (Yii::app()->controller->getId() == 'post' && Yii::app()->controller->getAction()->getId() == 'view')),
          array(
              'label' => 'Реестр',
              'url' => Yii::app()->urlManager->createUrl('reestr/index'),
              'linkOptions' => array(
                  'async' => 'async',
              ),
              'active' => (Yii::app()->controller->getId() == 'reestr' &&
              Yii::app()->controller->getAction()->getId() == 'index') |
              (Yii::app()->controller->getId() == 'reestr' &&
              Yii::app()->controller->getAction()->getId() == 'group') |
              (Yii::app()->controller->getId() == 'user' &&
              Yii::app()->controller->getAction()->getId() == 'students') |
              (Yii::app()->controller->getId() == 'user' &&
              Yii::app()->controller->getAction()->getId() == 'prepods') |
              (Yii::app()->controller->getId() == 'reestr' &&
              Yii::app()->controller->getAction()->getId() == 'GroupReestr') |
              (Yii::app()->controller->getId() == 'library' &&
              Yii::app()->controller->getAction()->getId() == 'index') |
              (Yii::app()->controller->getId() == 'library' &&
              Yii::app()->controller->getAction()->getId() == 'predmet')
          ),
          array(
              'label' => 'Форум',
              'url' => Yii::app()->urlManager->createUrl('forum/index'),
              'linkOptions' => array(
                  'async' => 'async',
              ),
              'active' => (Yii::app()->controller->getId() == 'forum')),
          array(
              'label' => 'Вход',
              'url' => ('#'),
              'linkOptions' => array('onclick' => 'EnterSite()'),
              'visible' => Yii::app()->user->isGuest,
          ),
          array(
              'label' => 'Выход',
              'url' => Yii::app()->urlManager->createUrl('site/logout'),
              'visible' => !Yii::app()->user->isGuest)
      ),));
  ?>
</div>
