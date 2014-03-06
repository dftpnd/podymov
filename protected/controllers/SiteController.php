<?php

class SiteController extends Controller
{
    public function actionIndex()
    {

        $criteria = new CDbCriteria(
            array('order' => 'created ASC'));


        $posts = Post::model()->findAllByAttributes(array('visible' => 1), $criteria);
        $user = User::model()->findByAttributes(array('username' => User::USERNAME));

        $this->render('index', array('posts' => $posts, 'user' => $user));


    }

    public function actionPreLogin()
    {

        $this->render('site_prelogin');
    }

    public function actionLogin()
    {
        $_POST['LoginForm']['username'] = User::USERNAME;

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

    public function actionConfermd()
    {

        $model = User::model()->findByAttributes(array('username' => User::USERNAME));
        $model->confirm_email = 1;
        $model->save(false);
        $this->render('confermd');
    }

    public function actionRecovery()
    {
        $user = User::model()->findByAttributes(array('username' => User::USERNAME));
        User::sendMail('recovery', array('title' => 'Восстановление пароля', 'password' => $user->openpass));
    }

    public function actionFeedBack()
    {
        if (!isset($_POST['Feedback'])) {
            echo CJSON::encode(array('status' => 'failure'));
            Yii::app()->end();
        }

        $feedback = new Feedback();
        $feedback->attributes = $_POST['Feedback'];
        $feedback->created = time();

        if ($feedback->save()) {
            Feedback::sendLetter($feedback);
            echo CJSON::encode(array('status' => 'success'));
        } else {
            echo CJSON::encode(array('status' => 'failure', 'message' => $feedback->getErrors()));
        }

    }


    public function actionPostView($id)
    {
        $post = Post::model()->findByPk($id);
        $bu = Yii::app()->getBaseUrl(true);
        if (!empty($post->doc_file)) {
            $formW4Url = "{$bu}/uploads/{$post->uploded_doc->name}";
        } else {
            if (!empty($post->pdf_file)) {
                $formW4Url = "{$bu}/uploads/{$post->uploded_pdf->name}";
            } else {
                $formW4Url = '';
            }
        }

        
        Yii::import('ext.crocodoc-php.Crocodoc');

        Crocodoc::setApiToken('xakTrn7ZCepKQ319wAdbNH84');


        try {
            $uuid = CrocodocDocument::upload($formW4Url);
        } catch (CrocodocException $e) {
            echo 'failed :(' . "\n";
            echo '  Error Code: ' . $e->errorCode . "\n";
            echo '  Error Message: ' . $e->getMessage() . "\n";
        }

        try {
            $sessionKey = CrocodocSession::create($uuid);
        } catch (CrocodocException $e) {
            echo 'failed :(' . "\n";
            echo '  Error Code: ' . $e->errorCode . "\n";
            echo '  Error Message: ' . $e->getMessage() . "\n";
        }


        $this->render('postview', array(
            'post' => $post,
            'uuid' => $uuid,
            'sessionKey' => $sessionKey
        ));
    }

    public function actionFile($id)
    {
        $file = Files::model()->findByPk($id);
        if (!empty($file)) {
            $ds = DIRECTORY_SEPARATOR;
            $path = Yii::app()->basePath . $ds . '..' . $ds . 'uploads' . $ds . $file->name;
            if (file_exists($path)) {
                //папка с названием реестра
                //посыл хедеров браузеру
                header('Content-Disposition: attachment; filename="' . $file->orig_name . '"');
                header("Content-Type: application/force-download");
                header("Content-Type: application/octet-stream");
                header("Content-Type: application/download");
                header("Content-Description: File Transfer");
                header('Content-Length: ' . $file->size);

                //скачивание
                echo file_get_contents($path);
            }
        }
    }
}

