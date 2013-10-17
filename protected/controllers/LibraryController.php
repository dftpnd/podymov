<?php

class LibraryController extends Controller
{

    public $title_controller = 'Библиотека';
    public $href_controller = '/library';
    public $inherited = 'Reestr';

    public function actionIndex()
    {
        $title = 'Библиотека';
        $institute = array();
        $predmets = Predmet::model()->findAll(array('order' => 'name ASC'));
        $ins = Institute::model()->with('institutecafedra.cafedra')->findAll();


        MyHelper::render($this, 'index', array(
            'predmets' => $predmets,
            'institute' => $institute,
            'ins' => $ins
        ), $title);
    }

    public function actionUpload($id)
    {
        $user_id = Yii::app()->user->id;
        $profile = Profile::model()->findByAttributes(array('user_id' => $user_id));

        $uf = DIRECTORY_SEPARATOR;
        if (!file_exists(Yii::app()->basePath . "{$uf}..{$uf}uploads{$uf}predmet{$uf}"))
            mkdir(Yii::app()->basePath . "{$uf}..{$uf}uploads{$uf}predmet{$uf}");

        $basePath = Yii::app()->basePath . "{$uf}..{$uf}uploads{$uf}predmet{$uf}$id{$uf}";
        if (!file_exists($basePath))
            mkdir($basePath);

        $allowedExtensions = array("png", "jpg", "jpeg", "gif", "rar", "zip", "doc", "docx", "xlsx", "pdf", "txt");
        $sizeLimit = 50 * 1024 * 1024;

        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($basePath);


        if (empty($result['error'])) {
            $file = array(
                'name' => $result['filename'],
                'orig_name' => $result['user_filename'],
                'size' => $result['size'],
                'ext' => $result['ext'],
            );

            $Uploadedfiles = new Uploadedfiles();
            $Uploadedfiles->attributes = $file;
            $Uploadedfiles->save();

            $result['file_id'] = $Uploadedfiles->id;

            $predmet_file = new PredmetFile();
            $predmet_file->profile_id = $profile->id;
            $predmet_file->uploads_id = $Uploadedfiles->id;
            $predmet_file->predmet_id = $id;
            $predmet_file->save();
        }


        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
    }

    public function actionPredmet($id)
    {
        $type = ObjectRating::lIBRARY_FILES;
        $plus = ObjectRating::PLUS;
        $minus = ObjectRating::MINUS;
        $profile = FALSE;
        $redact = FALSE;

        if (!Yii::app()->user->isGuest) {
            $profile = Profile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
            if ($profile->status == 3) {
                if (!is_null(PredmetPrepod::model()->findAllByAttributes(array('profile_id' => $profile->id)))) {
                    $redact = TRUE;
                }
            }
        }
        $files = PredmetFile::model()->findAllByAttributes(array('predmet_id' => $id));
        $prepods_predmet = PredmetPrepod::model()->findAllByAttributes(array('predmet_id' => $id));
        $model = Predmet::model()->findByPk($id);

        $title = $model->name;

        $crumbs[1]['href'] = '/library/predmet/' . $id;
        $crumbs[1]['title'] = $title;

        MyHelper::render($this, 'predmet', array(
            'model' => $model,
            'files' => $files,
            'type' => $type,
            'plus' => $plus,
            'minus' => $minus,
            'prepods_predmet' => $prepods_predmet,
            'profile' => $profile,
            'redact' => $redact
        ), $title, $crumbs);
    }

    public function actionPrepodpredmets()
    {
        $models = Predmet::model()->findAll(array('order' => 'name ASC'));
        $profile = Profile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
        $prepodpredmets = PredmetPrepod::model()->findAllByAttributes(array('profile_id' => $profile->id));
        $data = $this->renderPartial('/doors/_edit_list_prepod', array('models' => $models, 'prepodpredmets' => $prepodpredmets), true);
        echo json_encode(array('div' => $data));
    }

    public function actionChangepredmets()
    {
        $profile = Profile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));

        if (isset($_POST['predmets_id'])) {
            foreach ($_POST['predmets_id'] as $predmet_id) {
                $model = new PredmetPrepod();
                $model->predmet_id = $predmet_id;
                $model->profile_id = $profile->id;
                $time_model = PredmetPrepod::model()->findByAttributes(array('profile_id' => $model->profile_id, 'predmet_id' => $model->predmet_id));
                if (empty($time_model)) {
                    $model->save();
                }
            }
        }
        if (isset($_POST['otm_predmets_id'])) {
            foreach ($_POST['otm_predmets_id'] as $otm_predmets_id) {
                PredmetPrepod::model()->deleteAllByAttributes(array('profile_id' => $profile->id, 'predmet_id' => $otm_predmets_id));
            }
        }
        echo json_encode(array('status' => 'good'));
    }

    public function actionDownloads($id)
    {
        $file = PredmetFile::model()->with('uploadedfiles')->findByPk($id);
        if (!empty($file)) {
            $ds = DIRECTORY_SEPARATOR;
            $path = Yii::app()->basePath . $ds . '..' . $ds . 'uploads' . $ds . 'predmet' . $ds . $file->predmet_id . $ds . $file->uploadedfiles->name;
            if (file_exists($path)) {
                //папка с названием реестра
                //посыл хедеров браузеру
                header('Content-Disposition: attachment; filename="' . $file->uploadedfiles->orig_name . '"');
                header("Content-Type: application/force-download");
                header("Content-Type: application/octet-stream");
                header("Content-Type: application/download");
                header("Content-Description: File Transfer");
                header('Content-Length: ' . $file->uploadedfiles->size);

                //скачивание
                echo file_get_contents($path);
                exit();
            }
        }
    }

    public function actionDeleteFile()
    {
        if (isset($_POST['file_id'])) {
            $file = PredmetFile::model()->findByPk($_POST['file_id']);
            $file->delete();
            if (!empty($file)) {
                $ds = DIRECTORY_SEPARATOR;
                $path = Yii::app()->basePath . $ds . '..' . $ds . 'uploads' . $ds . 'predmet' . $ds . $file->predmet_id . $ds . $file->uploadedfiles->name;
                if (file_exists($path)) {
                    unlink($path);
                    echo json_encode(array('status' => 'good'));
                }
            }
        }
    }

    public function actionEditText()
    {
        if (isset($_POST['text']) && isset($_POST['predmet_id'])) {
            $predmet = Predmet::model()->findByPk($_POST['predmet_id']);
            $predmet->text = $_POST['text'];
            $predmet->save();
            echo json_encode(array('status' => 'good'));
        }
    }

}