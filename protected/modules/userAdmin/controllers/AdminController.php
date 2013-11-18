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
        $posts = Post::model()->findAll();
        $this->render('post', array('posts' => $posts));
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


    public function actionPostEdit()
    {

        if (isset($_POST['Post'])) {
            Post::model()->savePost();
            Yii::app()->end();
        }
        if (isset($_GET['post_id'])) {
            $post = Post::model()->findByPk($_GET['post_id']);
        } else {
            $post = new Post();
        }

        Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');
        $this->render('edit_post', array('post' => $post));
    }


    public function actionUploadPdf()
    {
        $basePath = Files::getBasePath();

        $allowedExtensions = array("pdf");
        $sizeLimit = 100 * 1024 * 1024;

        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($basePath);


        $result['status'] = 'failure';
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
            $result['orig_name'] = $files->orig_name;
            $result['status'] = 'success';
        }
        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
    }

    public function actionUploaddDoc()
    {
        $basePath = Files::getBasePath();

        $allowedExtensions = array("doc", "docx");
        $sizeLimit = 100 * 1024 * 1024;

        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($basePath);

        $result['status'] = 'failure';
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
            $result['orig_name'] = $files->orig_name;
            $result['status'] = 'success';
        }
        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
    }


    public function actionImperaviUpload()
    {
        $t = time() . '_';
        $basePath = Files::getBasePath();
        $new_file = $basePath . $t . $_FILES['file']['name'];


        if (!copy($_FILES['file']['tmp_name'], $new_file)) {
            echo "не удалось скопировать";
        }

        $array = array(
            'filelink' => '/uploads/' . $t . $_FILES['file']['name']
        );

        echo stripslashes(json_encode($array));
    }

    public function actionDeletePostFile()
    {
        $file_id = $_GET['file_id'];


        $post = Post::model()->findByAttributes(array('doc_file' => $file_id));


        if (empty($post)) {
            $post = Post::model()->findByAttributes(array('pdf_file' => $file_id));
            if (!empty($post)) {
                $post->pdf_file = NULL;
            }
        } else {
            $post->doc_file = NULL;
        }

        if (!empty($post)) {
            $post->save();
        }


        echo CJSON::encode(array('status' => 'success'));

    }


    public function actionDeletePublish()
    {
        if (!isset($_GET['post_id'])) {
            echo CJSON::encode(array('status' => 'failure', 'message' => 'Неправильный параметр запроса'));
            Yii::app()->end;
        }

        $post = Post::model()->findByPk($_GET['post_id']);

        if ($post->delete()) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'failure', 'message' => 'Удаление не произошло. Обратитесь к админестратору или попробуйте еще раз');
        }

        echo CJSON::encode($response);

    }


    public function  actionSaveUserText()
    {

        $user = $user = User::model()->findByAttributes(array('username' => User::USERNAME));
        $user->user_text = $_POST['user_text'];
        $user->save(false);

        echo json_encode(
            array(
                'status' => 'success'
            )
        );
    }
}