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
        $cs->registerScriptFile($this->createUrl('/js/fileuploader.js'));
        $cs->registerScriptFile($this->createUrl('/js/admin.js'));
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

    public function actionUpload()
    {
        $uf = DIRECTORY_SEPARATOR;
        $basePath = Yii::app()->basePath . "{$uf}..{$uf}uploads{$uf}";

        $allowedExtensions = array("png", "jpg", "gif", "jpeg");
        $sizeLimit = 2 * 1024 * 1024;

        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($basePath);

        if (empty($result['error'])) {
            $file = array(
                'name' => $result['filename'],
                'orig_name' => $result['user_filename'],
                'size' => $result['size'],
                'ext' => $result['ext'],
            );
            $files = new Files();
            $files->attributes = $file;
            $files->save();

            $result['file_id'] = $files->id;
            $result['file_url'] = Yii::app()->createAbsoluteUrl('uploads/avatar/' . $files->name);
        }
        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
    }


}