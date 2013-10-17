<?php

class User extends CActiveRecord {

  public $password_repeat;

  const ROLE_AUTHORITY = 'Authority';
  const ROLE_MANEGER_GROUP = 'ManegerGroup';
  const ROLE_PREPOD = 'Prepod';
  const ROLE_USER = 'User';

  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  public function tableName() {
    return '{{user}}';
  }

  public function rules() {
    return array(
        array('username, password, password_repeat', 'required'),
        array('username', 'unique'),
        array('username', 'email'),
        array('username, banned, laste_enter', 'length', 'max' => 128),
        array('profile', 'safe'),
        array('password_repeat', 'required', 'on' => 'register'),
        array('password password_repeat', 'compare', 'compareAttribute' => 'password'),
    );
  }

  public function relations() {
    return array(
        'posts' => array(self::HAS_MANY, 'Post', 'author_id'),
        'prof' => array(self::HAS_ONE, 'Profile', 'user_id'),
    );
  }

  public function attributeLabels() {
    return array(
        'id' => 'Id',
        'password_repeat' => 'Пароль',
        'password' => 'Пароль',
        'username' => 'Эл. почта',
        'profile' => 'Profile',
        'banned' => 'banned',
        'verifyCode' => '',
        'laste_enter' => 'laste_enter'
    );
  }

  public function validatePassword($password) {
    //return $this->hashPassword($password,$this->salt)===$this->password;
    return $password === $this->password;
  }

  public static function sendMail($view, $params) {
    $email = $params['recipient'];

    $mail_config = Yii::app()->params['smtp_params'];
    $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
    $mailer->SMTPAuth = TRUE;
    $mailer->IsSMTP();
    $mailer->Host = $mail_config['host']; 
    $mailer->Username = $mail_config['user']; 
    $mailer->Password = $mail_config['password']; 
    $mailer->From = $mail_config['user']; 
    $mailer->AddAddress($email);
    $mailer->Subject = 'Подтверждение регистрации';
    $mailer->FromName = 'Сайт кафедры АТПП';
    $mailer->setPathViews('application.views.mailTemplates');
    $mailer->getView($view, $params);
    if (!$mailer->Send()) {
      Yii::log('Try to login with params: ' . print_r($mail_config, 1), 'warning');
      Yii::log($mailer->ErrorInfo, 'warning');
      return false;
    }
    return true;
  }

  public static function checkAccessEditUser($user_id) {

    if (Yii::app()->user->isGuest)
      return FALSE;

    $viewer_id = Yii::app()->user->id;
    if ($user_id == $viewer_id)
      return TRUE;

    $assignments = Assignments::model()->findAllByAttributes(array('userid' => $viewer_id));
    foreach ($assignments as $role) {
      switch ($role->itemname) {
        case self::ROLE_AUTHORITY:
          return TRUE;
          break;
        case self::ROLE_MANEGER_GROUP:
          $user = self::model()->findByPk($user_id);
          $viewer = self::model()->findByPk($viewer_id);
          if ($viewer->prof->group_id === $user->prof->group_id) {
            return TRUE;
          } else {

            return FALSE;
          }
          break;
      }
    }
    return false;
  }

}