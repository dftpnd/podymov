<?php

class User extends CActiveRecord
{

    public $password_repeat;


    const USERNAME = 'podymov';

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{user}}';
    }

    public function rules()
    {
        return array(
            array('username', 'unique'),
            array('email', 'email'),
            array('username, laste_enter', 'length', 'max' => 128),

            array('username, password', 'required', 'on' => 'register'),
            array('password password_repeat', 'compare', 'compareAttribute' => 'password', 'on' => 'register'),
        );
    }

// $model->scenario='register';

    public function attributeLabels()
    {
        return array(
            'id' => 'Id',
            'password_repeat' => 'Пароль',
            'password' => 'Пароль',
            'username' => 'Эл. почта',
            'verifyCode' => '',
            'laste_enter' => 'laste_enter'
        );
    }

    public function validatePassword($password)
    {
        //return $this->hashPassword($password,$this->salt)===$this->password;
        return $password === $this->password;
    }

    public static function sendMail($view, $params)
    {

        $user = User::model()->findByAttributes(array('username' => User::USERNAME));
        $email = $user->email;

        $mail_config = Yii::app()->params['smtp_params'];
        $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
        $mailer->SMTPAuth = TRUE;
        $mailer->IsSMTP();
        $mailer->Host = $mail_config['host'];
        $mailer->Username = $mail_config['user'];
        $mailer->Password = $mail_config['password'];
        $mailer->From = $mail_config['user'];
        $mailer->AddAddress($email);
        $mailer->Subject = $params['title'];
        $mailer->FromName = 'Ваш сайт';
        $mailer->setPathViews('application.views.mailTemplates');
        $mailer->getView($view, $params);
        if (!$mailer->Send()) {
            Yii::log('Try to login with params: ' . print_r($mail_config, 1), 'warning');
            Yii::log($mailer->ErrorInfo, 'warning');
            return false;
        }
        return true;
    }

    public static function updateEmail($email)
    {


        $user = self::model()->findByAttributes(array('username' => self::USERNAME));

        if ($email == $user->email) {
            $response = array('status' => 'success');
        } else {

            $user->email = $email;
            if ($user->save()) {
                $user->confirm_email = 0;
                $user->save(false);
                $response = array('status' => 'success');
            } else {
                $response = array('status' => 'failure', 'message' => $user->getErrors());
            }
        }
        echo CJSON::encode($response);

        Yii::app()->end();
    }

    public static function updatePaasword()
    {
        $user = self::model()->findByAttributes(array('username' => self::USERNAME));
        $user->openpass = $_POST['User']['password'];
        $user->password = md5($_POST['User']['password']);
        $user->password_repeat = md5($_POST['User']['password_repeat']);
        $user->setScenario('register');


        if ($user->save()) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'failure', 'message' => $user->getErrors());
        }
        echo CJSON::encode($response);

        Yii::app()->end();
    }


}