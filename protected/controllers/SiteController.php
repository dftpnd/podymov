<?php

class SiteController extends Controller
{
    public function actionIndex()
    {

        $this->title = 'Главная';
        $this->render('index');


    }

    public function actionPreLogin()
    {
        $this->title = 'Главная';
        $this->render('site_prelogin');
    }

    public function actionLogin()
    {

        $model = new LoginForm;
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid


            if ($model->validate() && $model->login())
                echo CJSON::encode(array('status' => 'success'));
            else {
                echo CJSON::encode(array('status' => 'failure'));
                //echo CJSON::encode(array('status' => 'activate', 'url' => $model->activate));
            }


            Yii::app()->end();
        }

        $this->render('/site/prelogin', array('model' => $model));
    }
    public function actionManage()
    {
        $this->render('/site/manage');
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('/site/error', $error);
        }
    }

}

