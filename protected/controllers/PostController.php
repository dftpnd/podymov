<?php

class PostController extends Controller
{

    //public $layout = 'column2';

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;
    public $title_controller = 'Статьи';
    public $href_controller = '/post';

    /**
     * Displays a particular model.
     */
    public function actionView()
    {

        if (!Yii::app()->user->isGuest) {
            $gost_or_user = 'user';
        } else {
            $gost_or_user = 'gost';
        }
        $post = $this->loadModel();
        $comment = $this->newComment($post);

        $type_1 = ObjectRating::TYPE_POST;
        $plus_1 = ObjectRating::PLUS;
        $minus_1 = ObjectRating::MINUS;
        $title = $post->title;

        $crumbs[1]['href'] = '/post/' . $post->id;
        $crumbs[1]['title'] = $post->title;

        MyHelper::render($this, 'view', array(
            'model' => $post,
            'comment' => $comment,
            'gost_or_user' => $gost_or_user,
            'type_1' => $type_1,
            'plus_1' => $plus_1,
            'minus_1' => $minus_1,
        ), $title, $crumbs);
    }

    public function actionScrapbook($post_id)
    {
        $model = Post::model()->with('filetopost', 'filetopost.file')->findByAttributes(array('id' => $post_id));
        $title = 'Фотогалерея';
        MyHelper::render($this, 'scrapbook', array(
            'model' => $model,
        ), $title);
    }

    public function actionUpdate()
    {

        $model = $this->loadModel();
        if (isset($_POST['Post'])) {
            $model->attributes = $_POST['Post'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $title = 'Создать пост';
        $user_id = Yii::app()->user->id;
        $profile = Profile::model()->findByAttributes(array('user_id' => $user_id));
        if (isset($_POST['isept'])) {
            $profile->instruct = 1;
            $profile->save();
        }
        if ($profile->instruct == null) {
            MyHelper::render($this, 'instruct', array(), $title);
            exit();
        }

        $model = new Post;

        if (isset($_POST['Post'])) {
            $model->attributes = $_POST['Post'];
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'myForm') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            $model->profile_id = $profile->id;
            if ($model->save()) {
                if (isset($_POST['files'])) {
                    $files_ar = $_POST['files'];
                    $model->cover_id = $files_ar[0];

                    $model->save();

                    foreach ($files_ar as $value) {
                        $zsp = new Filetopost();
                        $zsp->post_id = $model->id;
                        $zsp->file_id = $value;
                        $zsp->save();
                    }
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }


        MyHelper::render($this, 'create', array(
            'model' => $model,
        ), $title);
    }

    public function actionUploadPE()
    {
        $uf = DIRECTORY_SEPARATOR;
        $basePath = Yii::app()->basePath . "{$uf}..{$uf}uploads{$uf}";
        $basePathDefalt = Yii::app()->basePath . "{$uf}..{$uf}uploads{$uf}oli_";
        $allowedExtensions = array("png", "jpg", "gif", "jpeg");
        $sizeLimit = 10 * 1024 * 1024;
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

            $img = Yii::app()->ih
                ->load($basePath . $Uploadedfiles->name);
            $result['file_url'] = Yii::app()->createAbsoluteUrl('uploads/' . $Uploadedfiles->name);

            if ($img->width > 1000) {
                $img->resize(900, 800) //обрезаем изображение для фотогалерии
                    ->save($basePath . 'oli_' . $Uploadedfiles->name);
                $result['file_url'] = Yii::app()->createAbsoluteUrl('uploads/oli_' . $Uploadedfiles->name);
            } else {
                $source = $basePath . $Uploadedfiles->name;
                $dest = $basePath . 'oli_' . $Uploadedfiles->name;
                copy($source, $dest);
            }

            if ($img->width > 650) {
                $img->resize(650, 500) //обрезаем изображение для поста
                    ->save($basePath . '/sm_' . $Uploadedfiles->name);
                $result['file_url'] = Yii::app()->createAbsoluteUrl('uploads/sm_' . $Uploadedfiles->name);
            } else {
                $source = $basePath . $Uploadedfiles->name; //делаем копию для маленького изображения
                $dest = $basePath . 'oli_' . $Uploadedfiles->name;
                copy($source, $dest);
            }
            $img->crop(220, 220)
                ->save(Yii::app()->basePath . '/../uploads/thumb_' . $Uploadedfiles->name);

            $img->resize(45, 45)
                ->save(Yii::app()->basePath . '/../uploads/mini_' . $Uploadedfiles->name);
            $result['file_url_mini'] = Yii::app()->createAbsoluteUrl('uploads/mini_' . $Uploadedfiles->name);
        }
        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
    }

    public function actionDeletePicterPost()
    {
        $uf = DIRECTORY_SEPARATOR;
        if (isset($_POST['id'])) {
            $model = Uploadedfiles::model()->findByPk($_POST['id']);
            if (!empty($model)) {
                if (file_exists(Yii::app()->basePath . "..{$uf}..{$uf}uploads{$uf}mini_" . $model->name)) {
                    unlink(Yii::app()->basePath . "..{$uf}..{$uf}uploads{$uf}mini_" . $model->name);
                }
                if (file_exists(Yii::app()->basePath . "..{$uf}..{$uf}uploads{$uf}" . $model->name)) {
                    unlink(Yii::app()->basePath . "..{$uf}..{$uf}uploads{$uf}" . $model->name);
                }
                if (file_exists(Yii::app()->basePath . "..{$uf}..{$uf}uploads{$uf}oli_" . $model->name)) {
                    unlink(Yii::app()->basePath . "..{$uf}..{$uf}uploads{$uf}oli_" . $model->name);
                }
                if (file_exists(Yii::app()->basePath . "..{$uf}..{$uf}uploads{$uf}sm_" . $model->name)) {
                    unlink(Yii::app()->basePath . "..{$uf}..{$uf}uploads{$uf}sm_" . $model->name);
                }
                if (file_exists(Yii::app()->basePath . "..{$uf}..{$uf}uploads{$uf}thumb_" . $model->name)) {
                    unlink(Yii::app()->basePath . "}..{$uf}..{$uf}uploads{$uf}thumb_" . $model->name);
                }
                $model->delete();
                echo CJSON::encode(array('status' => 'success'));
                exit();
            }
        }
        exit();
    }

    public function actionDelete()
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel();
            foreach ($model->filetopost as $filetopost) {
                Uploadedfiles::DeleteFiles($filetopost->file);
            }
            $model->delete();
            if (!isset($_GET['ajax']))
                $this->redirect(array('index'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        if (!Yii::app()->user->isGuest) {
            $gost_or_user = 'user';
        } else {
            $gost_or_user = 'gost';
        }

        $type_1 = ObjectRating::TYPE_POST;
        $plus_1 = ObjectRating::PLUS;
        $minus_1 = ObjectRating::MINUS;
        $criteria = new CDbCriteria(array(
            'condition' => 'status=' . Post::STATUS_PUBLISHED,
            'order' => 'create_time DESC',
            'with' => 'commentCount',
        ));
        if (isset($_GET['topic'])) {
            $topic = $_GET['topic'];
        } else {
            $topic = 1;
        }
        $criteria->addSearchCondition('topic', $topic);
        $dataProvider = new CActiveDataProvider('Post', array(
            'pagination' => array(
                'pageSize' => 10,
            ),
            'criteria' => $criteria,
        ));


        $title = 'Статьи';
        MyHelper::render($this, 'index', array(
            'dataProvider' => $dataProvider,
            'gost_or_user' => $gost_or_user,
            'type_1' => $type_1,
            'plus_1' => $plus_1,
            'minus_1' => $minus_1,
        ), $title);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Post('search');
        if (isset($_GET['Post']))
            $model->attributes = $_GET['Post'];


        $title = 'Управление постами';
        MyHelper::render($this, 'admin', array(
            'model' => $model,
        ), $title);
    }

    public function actionSuggestTags()
    {
        if (isset($_GET['q']) && ($keyword = trim($_GET['q'])) !== '') {
            $tags = Tag::model()->suggestTags($keyword);
            if ($tags !== array())
                echo implode("\n", $tags);
        }
    }

    public function loadModel()
    {
        if ($this->_model === null) {
            if (isset($_GET['id'])) {
                if (Yii::app()->user->isGuest)
                    $condition = 'status=' . Post::STATUS_PUBLISHED . ' OR status=' . Post::STATUS_ARCHIVED;
                else
                    $condition = '';
                $this->_model = Post::model()->findByPk($_GET['id'], $condition);
            }
            if ($this->_model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $this->_model;
    }

    protected function newComment($post)
    {
        $comment = new Comment;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'comment-form') {
            echo CActiveForm::validate($comment);
            Yii::app()->end();
        }

        if (isset($_POST['Comment'])) {
            $profile = Profile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
            $comment->content = $_POST['Comment']['content'];
            $comment->profile_id = $profile->id;
            $comment->save(false);
            if ($post->addComment($comment)) {

            }
        }
        return $comment;
    }

    public function actionAddComment()
    {
        if (isset($_POST['post_id'])) {
            $gost_or_user = 'user';
            $type = ObjectRating::TYPE_COM;
            $plus = ObjectRating::PLUS;
            $minus = ObjectRating::MINUS;


            $profile = Profile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
            $new_com = new Comment;
            $new_com->content = $_POST['Comment']['content'];
            $new_com->post_id = $_POST['post_id'];
            $new_com->create_time = time();
            $new_com->profile_id = $profile->id;
            $new_com->save();
            $comment = Comment::model()->findByPk($new_com->id);
            $data = $this->renderPartial('_comments', array(
                'comment' => $comment,
                'gost_or_user' => $gost_or_user,
                'type' => $type,
                'plus' => $plus,
                'minus' => $minus,
            ), true);
            echo json_encode(array('div' => $data));
        }
    }

    public function actionMyPost()
    {
        $posts = Post::model()->findAllByAttributes(array('author_id' => Yii::app()->user->id));
        $title = 'Мои статьи';
        MyHelper::render($this, 'my_post', array(
            'posts' => $posts,
        ), $title);
    }

    public function actionDeleteMyPost($id)
    {
        $post = Post::model()->findByPk($id);

        if (Yii::app()->user->id === $post->author_id) {
            $post->delete();
            echo json_encode(array('status' => 'success'));
            exit();
        }
        echo json_encode(array('status' => 'error'));
    }

}
