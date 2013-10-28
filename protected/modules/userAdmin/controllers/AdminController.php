<?php


class AdminController extends Controller
{

    public $layout = 'main';

    public function init()
    {
        if (Yii::app()->user->isGuest) {
            Yii::app()->getController()->redirect('/site/prelogin');
            Yii::app()->end();
        }

        $cs = Yii::app()->clientScript;
        $cs->registerCoreScript('jquery');
        $cs->registerScriptFile($this->createUrl('/js/jquery.jgrowl.min.js'));
        $cs->registerScriptFile($this->createUrl('/js/admin.js'));
//        $cs->registerScriptFile($this->createUrl('/js/fileuploader.js'));
    }

    public function actionIndex()
    {

        $this->render('index');
    }

    public function actionPost()
    {
        $this->render('post');
    }

    public function actionUser()
    {
        if (isset($_POST['User']['email'])) {
            User::updateEmail($_POST['User']['email']);
        }

        if (isset($_POST['User'])) {
            User::updatePaasword();
        }

        $user = User::model()->findByAttributes(array('username' => User::USERNAME));
        $this->render('user', array('user' => $user));
    }

    public function actionSendConferm()
    {

        User::sendMail('recovery', array('title' => 'Пароль от вашего сайта'));
        echo CJSON::encode(array('status' => 'success'));
    }


    public function actionCreatePost()
    {
        $this->render('edit_post');
    }

}