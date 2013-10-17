<?php

class SiteController extends Controller
{

    public $layout = 'column1';

    public $title_controller = 'Сайт';
    public $href_controller = '/site';

    /**
     * Declares class-based actions.
     */


    public function actionIndex()
    {


        $day = '';
        $act = array();
        $mounth = date('n'); //номер месяца
        $year = date('Y'); //год
        $activitys = Activity::model()->findAll();
        $slides = Slide::model()->findAllByAttributes(array('show_slide' => 1), array('order' => 'id DESC'));

        $timestamp = '01-' . $mounth . '-2012';
        $timestamp = strtotime($timestamp); //
        $mounth_count = date('t', $timestamp); // количесво дней в месяце

        foreach ($activitys as $activity) {
            $act[$activity->day]['contente'] = $activity->content;
            $act[$activity->day]['title'] = $activity->title;
        }


        $title = 'Главная';
        MyHelper::render($this, 'index', array(
            'act' => $act,
            'day' => $day,
            'year' => $year,
            'timestamp' => $timestamp,
            'mounth' => $mounth,
            'mounth_count' => $mounth_count,
            'activitys' => $activitys,
            'slides' => $slides,
        ), $title);
    }

    public function actionChangeMonth()
    {
        $day = '';
        $act = array();
        if (!isset($_POST['where_id']) || !isset($_POST['mounth']) || !isset($_POST['year']))
            die('.!.');

        $mounth = $_POST['mounth']; //номер месяца
        $year = $_POST['year']; //год
        if ($_POST['where_id'] == '1') {
            if ($mounth == '1') {
                $mounth = '12';
                $year--;
            } else {
                $mounth--;
            }
        } elseif ($_POST['where_id'] == '2') {
            if ($mounth == '12') {
                $mounth = '1';
                $year++;
            } else {
                $mounth++;
            }
        }
        if ($mounth < 10) {
            $mounth = '0' . $mounth;
        }
        $activitys = Activity::model()->findAllByAttributes(array('mounth' => $mounth, 'year' => $year));

        $timestamp = '01-' . $mounth . '-2012';
        $timestamp = strtotime($timestamp); //
        $mounth_count = date('t', $timestamp); // количесво дней в месяце


        foreach ($activitys as $activity) {
            $act[$activity->day]['contente'] = $activity->content;
        }

        $data = $this->renderPartial('/site/activity_feed', array(
            'act' => $act,
            'day' => $day,
            'year' => $year,
            'timestamp' => $timestamp,
            'mounth' => $mounth,
            'mounth_count' => $mounth_count
        ), true);

        echo json_encode(array('div' => $data, 'mounth' => $mounth, 'year' => $year));
    }

    public function actionSlide()
    {
        $this->render('slide');
    }

    public function actionTest()
    {
        $this->renderPartial('test');
    }

    public function actionSearch()
    {
        if (isset($_POST['search'])) {
            $searchCriteria = new stdClass();
            $pages = new CPagination();
            $pages->pageSize = Yii::app()->params['firmPerPage'];
            $searchCriteria->select = 'project_id';
            $searchCriteria->filters = array('project_id' => $project_id);
            $searchCriteria->query = '@name ' . $query . '*';
            $searchCriteria->paginator = $pages;
            $searchCriteria->groupby = $groupby;
            $searchCriteria->orders = array('f_name' => 'ASC');
            $searchCriteria->from = 'firm';
            $resIterator = Yii::App()->search->search($searchCriteria); // interator result

            var_dump($resIterator);
            die();
        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $model->create_time = time();
                $model->save(false);
                Yii::app()->user->setFlash('contact', 'Благодарим Вас за обращение к нам. Мы постараемся ответить как можно скорее.');
                $this->refresh();
            }
        }

        $title = 'Контакты';
        MyHelper::render($this, 'contact', array(
            'model' => $model
        ), $title);
    }

    protected function performAjaxValidation($models)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($models);
            Yii::app()->end();
        }
    }

    ///regform
    public function actionRegistration()
    {
        $title = 'Регистрация';
        $user = new User();

        $crumbs[1]['href'] = 'registration';
        $crumbs[1]['title'] = $title;

        MyHelper::render($this, 'registration', array(
            'user' => $user
        ), $title, $crumbs);
    }

    public function actionValidatUser()
    {

        if (isset($_POST['userseach'])) {
            $user = User::model()->findByAttributes(array('pin' => $_POST['userseach']));
            $model = Profile::model()->findByAttributes(array('user_id' => $user->id));
            if (!empty($model)) {
                if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
                }

                if (isset($_POST['Profile'])) {
                    if (!isset($_POST['Profile']['name']))
                        exit();
                    if (!isset($_POST['Profile']['surname']))
                        exit();
                    if (isset($_POST['Profile']['status'])) {
                        if ($_POST['Profile']['status'] == 3) {
                            $model->name = $_POST['Profile']['name'];
                            $model->surname = $_POST['Profile']['surname'];
                            $model->status = $_POST['Profile']['status'];
                            if ($model->validate()) {
                                $model->update(false);
                                $user->active = 1;
                                $user->banned = 0;

                                $ass_status = Assignments::model()->findByAttributes(array('userid' => $user->id));
                                if (empty($ass_status)) {
                                    $assigmants = new Assignments();
                                    $assigmants->itemname = 'Prepod';
                                    $assigmants->userid = $user->id;
                                    $assigmants->bizrule = NULL;
                                    $assigmants->data = NULL;
                                    $assigmants->save();
                                }


                                if ($user->update()) {

                                    $data = $this->renderPartial(
                                        '/site/aproveusername', array(
                                            'profile' => $model
                                        ), true
                                    );
                                    echo json_encode(array('div' => $data));
                                    exit();
                                } else {
                                    $data = $this->renderPartial('/site/aproveusername', array('profile' => $model), true);
                                    echo json_encode(array('div' => $data));
                                }
                            }
                        }
                    } else {
                        exit();
                    }

                    if (!isset($_POST['Profile']['group_id']))
                        exit();


                    $model->name = $_POST['Profile']['name'];
                    $model->surname = $_POST['Profile']['surname'];
                    $model->status = $_POST['Profile']['status'];
                    $model->group_id = $_POST['Profile']['group_id'];

                    if ($model->validate()) {
                        $model->update(false);

                        $user->active = 1;
                        if ($user->update(false)) {
                            $data = $this->renderPartial('/site/aproveusername', array('profile' => $model), true);
                            echo json_encode(array('div' => $data));
                        }
                    }
                }
            }
        }
    }

    /**
     * @assert (0) == 0
     * @assert (1) == 1
     */
    public function actionMailPrivet($pin)
    {
        if (!isset($pin))
            exit();
        $user = User::model()->findByAttributes(array('pin' => $pin));
        if (!empty($user)) {
            if ($user->active != 1) {
                $id = $user->id;
                $model = Profile::model()->findByAttributes(array('user_id' => $id));
                if (!empty($model)) {
                    $profile = $model;
                } else {
                    $profile = new Profile;
                    $profile->user_id = $id;
                    $profile->save(false);
                }
                $this->render('first_entry', array('model' => $profile));
                exit();
            } else {
                echo 'Вы уже подтвердили регистрацию';
            }
        }
        $this->render('reg_not_valid');
    }

    public function actionVkReg($code)
    {
        if (isset($code)) {
            $url = "https://api.vkontakte.ru/oauth/access_token?client_id=3211710&redirect_uri=http://atpp.in/site/VkReg/&client_secret=cjC7EUeQZo0HMPGjWLnA&code=" . $code;
            $response = json_decode(@file_get_contents($url));
            if (isset($response->error) || $response == NULL) {
                Yii::app()->user->setFlash('bad_vk_reg', 'Соедение кконтакта было сброшено. Попробуйте еще раз.');
                $this->render('/site/index', array());
                exit();
            }
            $arrResponse = json_decode(@file_get_contents("https://api.vkontakte.ru/method/getProfiles?uid=$response->user_id&access_token=$response->access_token&fields=first_name"))->response;

            $vk_id = '';
            $name = '';
            $last_name = '';
            if (!empty($arrResponse)) {
                foreach ($arrResponse as $vk_user) {
                    $vk_id = $vk_user->uid;
                    $name = $vk_user->first_name;
                    $last_name = $vk_user->last_name;
                }
            }
            $vk_user = User::model()->findByAttributes(array('vk_id' => $vk_id));
            if (!empty($vk_user)) {
                if ($vk_user->active == 1) {
                    Yii::app()->user->setFlash('user_is_isset', 'Такой пользователь уже есть, авторизуйтесь');
                    $this->render('/site/index', array());
                    exit();
                } else {
                    $profile_vk = Profile::model()->findByAttributes(array('user_id' => $vk_user->id));
                    $this->render('first_entry', array('model' => $profile_vk, 'vk_pin' => $vk_user->pin));
                    exit();
                }
            } else {
                // новый регистрируем
                $user = new User();
                $user->vk_id = $vk_id;
                $user->username = 'mail.vk.' . md5($vk_id) . '@gmail.com';
                $user->password = 'sol' . md5('sol' . $vk_id);
                $user->pin = md5('asd' . $vk_id . ' ');
                $user->save(false);

                $ass = new Assignments;
                $ass->itemname = 'User';
                $ass->userid = $user->id;
                $ass->save(false);

                $id = $user->id;
                $model = Profile::model()->findByAttributes(array('user_id' => $id));
                if (!empty($model)) {
                    $profile = $model;
                } else {
                    $profile = new Profile;
                    $profile->user_id = $id;
                    $profile->name = $name;
                    $profile->surname = $last_name;
                    $profile->save(false);
                }
                $this->render('first_entry', array('model' => $profile, 'vk_pin' => $user->pin));
                exit();
            }
        }
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

        $this->render('/site/login', array('model' => $model));
    }

    //1212
    public function actionVkVhod($code)
    {
        if (isset($code)) {
            $url = "https://api.vkontakte.ru/oauth/access_token?client_id=3211710&redirect_uri=http://atpp.in/site/VkVhod/&client_secret=cjC7EUeQZo0HMPGjWLnA&code=" . $code;
            $response = json_decode(@file_get_contents($url));
            if (isset($response->error) || $response == NULL) {
                die('Ошибка');
            }
            $arrResponse = json_decode(@file_get_contents("https://api.vkontakte.ru/method/getProfiles?uid=$response->user_id&access_token=$response->access_token&fields=first_name"))->response;

            $vk_id = '';
            $name = '';
            $last_name = '';
            if (!empty($arrResponse)) {
                foreach ($arrResponse as $vk_user) {
                    $vk_id = $vk_user->uid;
                    $name = $vk_user->first_name;
                    $last_name = $vk_user->last_name;
                }
            }
            $vk_user = User::model()->findByAttributes(array('vk_id' => $vk_id));

            if (!empty($vk_user)) {
                if ($vk_user->active != 1) {
                    $profile_vk = Profile::model()->findByAttributes(array('user_id' => $vk_user->id));
                    $this->render('first_entry', array('model' => $profile_vk, 'vk_pin' => $vk_user->pin));
                    exit();
                }
                $model = new LoginForm;
                $model->username = $vk_user->username;
                $model->password = $vk_user->password;
                $model->login();
                $profile = Profile::model()->findByAttributes(array('user_id' =>
                $vk_user->id));
                $day = '';
                $act = array();
                $mounth = date('n'); //номер месяца
                $year = date('Y'); //год
                $activitys = Activity::model()->findAll();
                $slides = Slide::model()->findAllByAttributes(array('show_slide' => 1));

                $timestamp = '01-' . $mounth . '-2012';
                $timestamp = strtotime($timestamp); //
                $mounth_count = date('t', $timestamp); // количесво дней в месяце

                foreach ($activitys as $activity) {
                    $act[$activity->day]['contente'] = $activity->content;
                    $act[$activity->day]['title'] = $activity->title;
                }


                $this->render('index', array(
                        'act' => $act,
                        'day' => $day,
                        'year' => $year,
                        'timestamp' => $timestamp,
                        'mounth' => $mounth,
                        'mounth_count' => $mounth_count,
                        'activitys' => $activitys,
                        'slides' => $slides
                    )
                );


                exit();
            } else {
                Yii::app()->user->setFlash('bad_vk_vhod_1', 'Перед тем как войти, необходимо зарегистрироваться.');
                $this->render('/site/registration', array());
                exit();
            }
            Yii::app()->user->setFlash('bad_vk_vhod_2', 'Произошла ошибка..попробуйте еще раз.');
            $this->render('/site/index', array());
            exit();
        }
    }

    //323
    public function actionUserValidete()
    {
        $user = new User();

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($user);
            Yii::app()->end();
        }
        if (isset($_POST['User'])) {
            $recipient = '';
            $user->attributes = $_POST['User'];

            if (!$user->validate()) {
                $data_eror = $user->getErrors();
                echo CJSON::encode(array('status' => 'valure'));
                //echo json_encode(array('div' => $data_eror, 'status' => 'valure'));
            } else {
                $user->password = md5($user->password);
                // $user->password_repeat = md5($user->password_repeat);
                $user->pin = md5('23' . crc32($user->password) . crc32($user->username) . '23');
                $user->save(false);
                $ass = new Assignments;
                $ass->itemname = 'User';
                $ass->userid = $user->id;
                $ass->save(false);
                $recipient = $user->username;
                User::sendMail('mailebody', array('user' => $user, 'recipient' => $recipient));
                $data = $this->renderPartial('/doors/_psedo_reg_3_finish', array('user' => $user), true);
                echo json_encode(array('div' => $data, 'status' => 'success'));
            }
        }
    }

    /**
     * Displays the login page
     */
    public function actionPreLogin()
    {
        $model = new LoginForm;

        $data = $this->renderPartial('/doors/_login', array('model' => $model), true);
        echo json_encode(array('div' => $data));
    }

    public function actionPhotos()
    {
        $topic = 1;
        $status = 2;
        $show_foto = 1;
        $posts = Post::model()->with(
            array(
                'filetopost.file' => array(
                    'condition' => 'filetopost.file_id is not null')
            )
        )->findAllByAttributes(array('topic' => $topic, 'status' => $status, 'show_foto' => $show_foto));

        $title = 'Фотогалерея';
        MyHelper::render($this, 'photos', array(
            'posts' => $posts
        ), $title);
    }

    public function actionSpy()
    {
        $category = array();
        if (!isset($_POST['category'])) {
            echo CJSON::encode(array('status' => 'failure_cat'));
            exit();
        }
        if (!isset($_POST['ee'])) {
            echo CJSON::encode(array('status' => 'failure_ee'));
            exit();
        }
        if (!isset($_POST['ww'])) {
            echo CJSON::encode(array('status' => 'failure_ww'));
            exit();
        }

        if (isset($_POST['category']['raz']) ||
            isset($_POST['category']['dva']) ||
            isset($_POST['category']['pyt']) ||
            isset($_POST['category']['shet']) ||
            isset($_POST['category']['sem'])
        ) {
            echo CJSON::encode(array('status' => 'failure'));
            exit();
        }
        if (!isset($_POST['ww']) ||
            !isset($_POST['ee']) ||
            !isset($_POST['category']['tri']) ||
            !isset($_POST['category']['chet'])
        ) {
            echo CJSON::encode(array('status' => 'failure'));
            exit();
        }
        if ($_POST['ee'] != '7') {
            echo CJSON::encode(array('status' => 'failure'));
            exit();
        }
        if ($_POST['ww'] != '4') {
            echo CJSON::encode(array('status' => 'failure'));
            exit();
        }
        $category = $_POST['category'];
        if ($category['chet'] != '4' || $category['tri'] != '3') {
            echo CJSON::encode(array('status' => 'failure'));
            exit();
        }
        $shlak = '';
        $data = $this->renderPartial('/doors/_psedo_reg_1', array('user' => $shlak), true);
        echo json_encode(array('div' => $data));
    }

    public function actionUserNew()
    {
        $user = new User();
        $data = $this->renderPartial('/doors/_psedo_reg_2', array('user' => $user), true, true);
        echo json_encode(array('div' => $data));
    }

    public function actionPhototools($post_id)
    {
        $model = Post::model()->with('filetopost', 'filetopost.file')->findByAttributes(array('id' => $post_id));

        $this->render('phototools', array('post_id' => $post_id, 'model' => $model));
    }

    public function actionMail()
    {
        $criteria = new CDbCriteria; //добавляется критерий выборки
        $criteria->order = 'id DESC'; //задается критерий выборки по айдишнику начиная с последнего
        $letters = ContactForm::model()->findAll($criteria);


        $this->render('mail', array('letters' => $letters));
    }

    public function actionMailDelete()
    {
        $messege_id_after = $_POST['messege_id'];

        if (ContactForm::model()->deleteByPk($messege_id_after) !== 0) {
            echo json_encode($messege_id_after);
        } else {
            echo json_encode(false);
        }
    }

    public function actionFileDelete()
    {
        $file_id = $_POST['file_id'];
        $obj = Uploadedfiles::model()->findByPk($file_id);
        try {
            Uploadedfiles::DeleteFiles($obj);
        } catch (Exception $e) {
            echo json_encode(false);
        }
        echo json_encode(true);
    }

    public function actionFileHide()
    {
        $file_id = $_POST['file_id'];
        $file = Uploadedfiles::model()->findByPk($file_id);
        $file->invisible = 1;
        echo json_decode($file->save());
    }

    public function actionFileShow()
    {
        $file_id = $_POST['file_id'];
        $file = Uploadedfiles::model()->findByPk($file_id);
        $file->invisible = null;
        echo json_decode($file->save());
    }

    public function actionAbout()
    {
        $this->render('about');
    }

    public function actionCoverselect()
    {
        $file_id = $_POST['file_id'];
        $post_id = $_POST['post_id'];
        $post = Post::model()->findByPk($post_id);
        $post->cover_id = $file_id;
        echo json_decode($post->save());
    }

    public function actionFriends()
    {
        $this->render('friends');
    }

    /**
     * render for view frends
     *
     */

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionIeblokad()
    {
        $data = $this->renderPartial('/doors/oshib_ie', array(), true, true);
        echo json_encode(array('div' => $data));
    }

    public function actionRecoveryPassword()
    {
        if (isset($_POST['login'])) {
            $user = User::model()->findByAttributes(array('username' => $_POST['login']));
            if (!empty($user)) {
                User::sendMail('recoverepass', array('user' => $user, 'recipient' => $_POST['login']));
                $data = $this->renderPartial('recovery_password_info', array('login' => $_POST['login']), true);
                echo json_encode(array('div' => $data, 'status' => 'seccess'));
                exit();
            } else {
                echo CJSON::encode(array('status' => 'failure'));
                exit();
            }
        }

        $this->render('recovery_password');
    }

    public function actionActivity()
    {
        $model = new Activity();
        if (isset($_POST['Activity'])) {
            $model->attributes = $_POST['Activity'];
            $dd = explode('/', $_POST['Activity']['magnite_date']);
            $model->mounth = $dd[0];
            $model->day = $dd[1];

            if ($dd[2] < 10) {
                $model->year = '0' . $dd[2];
            } else {
                $model->year = $dd[2];
            }
            $model->save();
        }

        $activitys = Activity::model()->findAll(array('order' => 'id DESC'));

        $title = 'Управление событиями';
        MyHelper::render($this, '/site/activity', array(
            'activitys' => $activitys,
            'model' => $model
        ), $title);
    }

    public function actionHappyPass($pin)
    {
        if (isset($pin)) {
            $user = User::model()->findByAttributes(array('pin' => $pin));
            if (!empty($user)) {
                if (isset($_POST['pin2'])) {
                    if (!isset($_POST['pas1'])) {
                        $er = 'Заполните пароль';
                        $this->render('newpassword', array('user' => $user, 'er' => $er));
                        exit();
                    } elseif (!isset($_POST['pas2'])) {
                        $er = 'Заполните пароль';
                        $this->render('newpassword', array('user' => $user, 'er' => $er));
                        exit();
                    } elseif ($_POST['pas1'] != $_POST['pas2']) {
                        $er = 'Пароли не совпадают';
                        $this->render('newpassword', array('user' => $user, 'er' => $er));
                        exit();
                    } elseif ($_POST['pas1'] == $_POST['pas2']) {
                        $user->password = md5($_POST['pas1']);
                        $user->save(false);
                        $this->render('pas_save');
                        exit();
                    }
                }
                $this->render('newpassword', array('user' => $user));
            } else {
                $this->render('reg_not_valid', array());
            }
        }
    }

}

