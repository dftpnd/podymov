<div class="menu_work ">
  <?php
  $this->widget('zii.widgets.CMenu', array(
      'items' => array(
          array(
              'label' => 'Моя страница',
              'url' => Yii::app()->urlManager->createUrl('user/ViewProfile/'),
              'itemOptions' => array('class' => 'menu_profile'),
              'linkOptions' => array(
                  'async' => 'async',
              ),
          ),
          array(
              'label' => 'ред.',
              'url' => Yii::app()->urlManager->createUrl('user/editprofile/' . Yii::app()->user->id),
              'itemOptions' => array(
                  'class' => 'menu_editprofile'
              ),
              'linkOptions' => array(),
          ),
          array(
              'label' => 'Мои файлы',
              'url' => Yii::app()->urlManager->createUrl('/files/files?id=' . Yii::app()->user->id),
              'itemOptions' => array('class' => 'menu_files'),
              'linkOptions' => array(
                  'async' => 'async',
              ),
          ),
          array(
              'label' => 'Моя зачетка',
              'url' => Yii::app()->urlManager->createUrl('/user/stats?user_id=' . Yii::app()->user->id),
              'visible' => Yii::app()->user->getRole() != 'prepod',
              'itemOptions' => array('class' => 'menu_record_book'),
              'linkOptions' => array(
                  'async' => 'async',
              ),
          ),
          array(
              'label' => 'Моё расписание',
              'url' => Yii::app()->urlManager->createUrl('/user/schedule'),
              'visible' => Yii::app()->user->getRole() != 'prepod',
              'itemOptions' => array('class' => 'menu_schedule'),
              'linkOptions' => array(
                  'async' => 'async',
              ),
          ),
          array(
              'label' => 'Мои статьи',
              'url' => Yii::app()->urlManager->createUrl('/post/mypost'),
              'itemOptions' => array('class' => 'menu_review'),
              'linkOptions' => array(
                  'async' => 'async',
              ),
          ),
          array(
              'label' => 'Управление группой',
              'url' => Yii::app()->urlManager->createUrl('/user/ManageGroup'),
              'visible' => (Yii::app()->user->getRole() == 'manegergroup') || (Yii::app()->user->getRole() == 'authority'),
              'itemOptions' => array('class' => 'manage_group'),
              'linkOptions' => array(
                  'async' => 'async',
              ),
          ),
          array(
              'label' => 'Упр. статьями',
              'url' => Yii::app()->urlManager->createUrl('/post/admin'),
              'visible' => (
              (
              Yii::app()->user->getRole() == 'authority')
              ),
              'itemOptions' => array('class' => 'menu_management'),
              'linkOptions' => array(
                  'async' => 'async',
              ),
          ),
          array(
              'label' => 'Cобытие',
              'url' => Yii::app()->urlManager->createUrl('/site/activity'),
              'visible' => (
              Yii::app()->user->getRole() == 'authority'
              ),
              'itemOptions' => array('class' => 'activity'),
              'linkOptions' => array(
                  'async' => 'async',
              ),
          ),
          array(
              'label' => 'Слайды',
              'url' => Yii::app()->urlManager->createUrl('/slide/admin'),
              'visible' => (
              Yii::app()->user->getRole() == 'authority'),
              'itemOptions' => array('class' => 'slide_menus'),
              'linkOptions' => array(
                  'async' => 'async',
              ),
          ),
          array(
              'label' => 'Админка',
              'url' => Yii::app()->urlManager->createUrl('/userAdmin/admin/users'),
              'visible' => (Yii::app()->user->getRole() == 'authority'),
              'itemOptions' => array('class' => 'menu_admin')
          ),
      ),));
  ?>
</div>