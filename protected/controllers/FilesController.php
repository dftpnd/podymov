<?php

class FilesController extends Controller
{
    public $title_controller = 'Файлы';
    public $href_controller = '/files';
    public $inherited = 'Reestr';


    public function actionFiles($id, $parent_id = 0)
    {
        $new = FALSE;
        $mu_path = FALSE;
        $user = User::model()->findByPk($id);
        $profile = Profile::model()->findByAttributes(array('user_id' => $user->id));

        if ($user->id == Yii::app()->user->id)
            $mu_path = TRUE;


        $breadcrambs = Folder::model()->breadcrambs($parent_id, $id);
        $html_breadcrambs = $this->renderPartial('_breadcrambs', array(
            'breadcrambs' => $breadcrambs,
            'user' => $user,
        ), true);

        $folders = Folder::getAvailableFolder($parent_id, $user->id);

        $title = 'Файлы';
        $private_status = PrivateStatus::model()->findAll();


        $crumbs[1]['href'] = '/reestr/group/' . $profile->group_id;
        $crumbs[1]['title'] = 'Группы';
        $crumbs[2]['href'] = '/user/ViewProfile/' . $profile->id;
        $crumbs[2]['title'] = MyHelper::getUsername($user->id);
        $crumbs[3]['href'] = '/user/files';
        $crumbs[3]['title'] = $title;

        MyHelper::render($this, 'user_files', array(
            'user' => $user,
            'folders' => $folders,
            'html_breadcrambs' => $html_breadcrambs,
            'private_status' => $private_status,
            'new' => $new,
            'mu_path' => $mu_path
        ), $title, $crumbs);
    }

    public function actionChangeFolder()
    {
        $mu_path = FALSE;
        if (!isset($_POST['folder_id']) || !isset($_POST['parent_id'])) {
            echo json_encode(array('status' => 'faile', 'error' => 'Ошибка, неверный запрос'));
            Yii::app()->end();
        }

        $folder = Folder::getMyFolder($_POST['folder_id'], $_POST['parent_id']);

        if (empty($folder->id)) {
            $mu_path = TRUE;
            $new = TRUE;
        } else
            $new = FALSE;

        if ($folder->user_id == Yii::app()->user->id)
            $mu_path = TRUE;

        $private_status = PrivateStatus::model()->findAll();

        $html = $this->renderPartial('_folder', array(
            'folder' => $folder,
            'private_status' => $private_status,
            'new' => $new,
            'mu_path' => $mu_path
        ), true);

        echo json_encode(array('status' => 'success', 'html' => $html));
    }

    public function actionDeleteFolder()
    {
        if (!isset($_POST['folder_id'])) {
            echo json_encode(array('status' => 'faile', 'error' => 'неверный file_id'));
            Yii::app()->end();
        }
        echo json_encode(Folder::deleteFolder($_POST['folder_id']));
    }

    public function actionUpdateDirectory()
    {
        $html = '';
        $mu_path = FALSE;

        if (!isset($_POST['parent_id']) || !isset($_POST['author_id'])) {
            echo json_encode(array('status' => 'faile', 'error' => 'Ошибка, поробуйте перезагрузить страницу'));
            Yii::app()->end();
        }
        $folders = Folder::getAvailableFolder($_POST['parent_id'], $_POST['author_id']);

        $private_status = PrivateStatus::model()->findAll();


        foreach ($folders as $folder) {
            if ($folder->user_id == Yii::app()->user->id)
                $mu_path = TRUE;

            $html .= $this->renderPartial('_folder', array(
                'folder' => $folder,
                'new' => false,
                'private_status' => $private_status,
                'mu_path' => $mu_path
            ), true);
        }

        echo json_encode(array('status' => 'success', 'html' => $html));
    }

    public function actionSaveChangeFolder()
    {

        $folder = Folder::getMyFolder($_POST['folder_id']);
        $folder->attributes = $_POST['Folder'][$_POST['folder_id']];


        $folder->user_id = Yii::app()->user->id;
        $folder->created = time();


        if ($folder->save()) {
            echo json_encode(array('status' => 'success', 'parent_id' => $folder->parent_id, 'author_id' => $folder->user_id,));
        } else {
            echo json_encode(array('status' => 'fail', 'error' => 'Сохранение не удалось, имя папки файла не должно быть пустым'));
        }
    }

    public function actionOpenFolder()
    {
        $html = '';
        $mu_path = FALSE;

        if (!isset($_POST['folder_id'])) {
            echo json_encode(array('status' => 'fail', 'error' => 'Ошибка, поробуйте перезагрузить страницу'));
            Yii::app()->end();
        }


        $folder = Folder::model()->findByPk($_POST['folder_id']);

        if ($folder->user_id == Yii::app()->user->id)
            $mu_path = TRUE;


        if (empty($folder)) {
            echo json_encode(array('status' => 'fail', 'error' => 'Не существует такой дирректори'));
            Yii::app()->end();
        }

        if (!Folder::checkAccess($folder)) {
            echo json_encode(array('status' => 'fail', 'error' => 'У вас недостаточно прав, для просмтора этой дирректории'));
            Yii::app()->end();
        }

        $user = User::model()->findByPk($folder->user_id);
        $folders = Folder::getAvailableFolder($folder->id, $folder->user_id);

        $private_status = PrivateStatus::model()->findAll();
        foreach ($folders as $model) {
            $html .= $this->renderPartial('_folder', array(
                'folder' => $model,
                'new' => FALSE,
                'private_status' => $private_status,
                'mu_path' => $mu_path
            ), true);
        }

        $breadcrambs = Folder::model()->breadcrambs($folder->id, $folder->user_id);

        $html_breadcrambs = $this->renderPartial('_breadcrambs', array(
            'breadcrambs' => $breadcrambs,
            'user' => $user,
        ), true);

        echo json_encode(
            array(
                'status' => 'success',
                'html' => $html,
                'folder' => (array)$folder->attributes,
                'html_breadcrambs' => $html_breadcrambs
            )
        );
    }

    public function actionDownloadFile($user_id, $parent_id)
    {
        if ($user_id !== Yii::app()->user->id) {
            echo json_encode(array('status' => 'fail', 'error' => 'Ошибка доступа'));
            Yii::app()->end();
        }

        $user = User::model()->findByPk($user_id);
        $basePath = Folder::basePath($user->id);
        $allowedExtensions = Folder::allowedExtensions();
        $sizeLimit = 50 * 1024 * 1024;
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($basePath);


        if (!empty($result['error'])) {
            echo json_encode(array('status' => 'fail', 'error' => $result['error']));
            Yii::app()->end();
        }

        $file = array(
            'name' => $result['filename'],
            'orig_name' => $result['user_filename'],
            'size' => $result['size'],
            'ext' => $result['ext'],
        );

        $Uploadedfiles = new Uploadedfiles();
        $Uploadedfiles->attributes = $file;
        if (!$Uploadedfiles->save()) {
            echo json_encode(array('status' => 'fail', 'error' => 'Ошибка, сохранение не произошло 1'));
            Yii::app()->end();
        }

        $result['file_id'] = $Uploadedfiles->id;

        $folder = new Folder();
        $folder->user_id = $user->id;
        $folder->name = $result['user_filename'];
        $folder->parent_id = (int)$parent_id;
        $folder->created = time();
        $folder->uploads_id = $Uploadedfiles->id;
        $folder->private_status = PrivateStatus::ONLY_ME;
        $folder->type = Folder::FILE;
        if (!$folder->save()) {
            echo json_encode(array('status' => 'fail', 'error' => var_dump($folder->getErrors())));
            Yii::app()->end();
        }

        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
    }

    public function actionDoorDownloadFile()
    {
        if (!isset($_POST['parent_id'])) {
            echo json_encode(array('status' => 'fail', 'error' => 'Ошибка, поробуйте перезагрузить страницу'));
            Yii::app()->end();
        }
        $parent_id = $_POST['parent_id'];


        if ((int)$parent_id == 0) {

            $folder = new Folder();

            $folder->name = MyHelper::getUsername(false, true, false, false);
        } else {
            $folder = Folder::model()->findByPk($parent_id);
            if (!Folder::checkAccess($folder)) {
                echo json_encode(array('status' => 'fail', 'error' => 'Ошибка, недостаточно прав'));
                Yii::app()->end();
            }
        }

        $user = User::model()->findByPk(Yii::app()->user->id);


        $html = $this->renderPartial('_door_download_file', array(
            'folder' => $folder,
            'user' => $user,
        ), true);

        echo json_encode(
            array(
                'status' => 'success',
                'html' => $html
            )
        );
    }

    public function actionDownloads($id)
    {
        $folder = Folder::model()->findByPk($id);

        if ($folder->private_status != PrivateStatus::EVERYONE) {
            if (!Folder::checkAccess($folder)) {
                die('недостаточно прав для скачивания');
            }
        }

        $file = Uploadedfiles::model()->findByPk($folder->uploads_id);

        if (!empty($file)) {
            $ds = DIRECTORY_SEPARATOR;
            $path = Yii::app()->basePath . $ds . '..' . $ds . 'uploads' . $ds . 'user_' . $folder->user_id . $ds . $file->name;
            if (file_exists($path)) {
                //папка с названием реестра
                //посыл хедеров браузеру
                header('Content-Disposition: attachment; filename="' . $folder->name . '"');
                header("Content-Type: application/force-download");
                header("Content-Type: application/octet-stream");
                header("Content-Type: application/download");
                header("Content-Description: File Transfer");
                header('Content-Length: ' . $file->size);

                //скачивание
                echo file_get_contents($path);
                exit();
            }
        }
    }


}