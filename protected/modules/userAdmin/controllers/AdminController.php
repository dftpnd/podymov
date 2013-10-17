<?php

class AdminController extends Controller {

    public $layout = 'main';

    public function actionIndex() {
        $this->render('index');
    }

    public function actionReject() {
        if (!isset($_GET['id']))
            throw new CHttpException(404);

        $id = (int) $_GET['id'];
        $user = User::model()->findByPk($id);
        $user->delete();


        $this->redirect('/userAdmin/admin/users');
    }

    public function actionPodobiu() {
        $groups = Group::model()->findAll();
        $data = $this->renderPartial('/doors/_groups_podobiu', array('groups' => $groups, 'group_id' => $_POST['group_id']), true);
        echo json_encode(array('div' => $data));
    }

    public function actionInstitute() {

        if (isset($_POST['institute'])) {
            $institute = new Institute();
            $institute->name = $_POST['institute'];
            $institute->save();
        }
//    var_dump($_POST);
//    die();
        if (isset($_POST['cafedra'])) {

            foreach ($_POST['cafedra'] as $ins_id => $val) {
                $cafedra = new Cafedra();
                $cafedra->name = $val['cafedra_name'];
                $cafedra->save();
                $model = new InstituteCafedra();
                $model->institute_id = $ins_id;
                $model->cafedra_id = $cafedra->id;
                $model->save();
            }
        }
        $institutes = Institute::model()->with('institutecafedra.cafedra')->findAll();
        $this->render('institute', array('institutes' => $institutes));
    }

    public function actiondeleteInstitute() {
        if (isset($_POST['institute_id'])) {
            $ins = Institute::model()->findByPk($_POST['institute_id']);
            $ins_caf = InstituteCafedra::model()->findAllByAttributes(array('institute_id' => $_POST['institute_id']));
            if (!empty($ins_caf)) {
                foreach ($ins_caf as $value) {
                    Cafedra::model()->deleteByPk($value->cafedra_id);
                    $value->delete();
                }
            }
            $ins->delete();
            echo json_encode(array('status' => 'succsess'));
        }
    }

    public function actionZapolnit() {
        if (!isset($_POST['group_id']) || !isset($_POST['group_podobiu']))
            die('нет пост параметров');

        $group_podobiu = PredmetSemestrGroup::model()->findAllByAttributes(array('group_id' => $_POST['group_podobiu']));

        foreach ($group_podobiu as $psg) {
            $model = new PredmetSemestrGroup();
            $model->predmet_id = $psg->predmet_id;
            $model->semestr_id = $psg->semestr_id;
            $model->group_id = $_POST['group_id'];
            $model->hash_psg = PredmetSemestrGroup::model()->hash_psg_model($model->predmet_id, $model->group_id, $model->semestr_id);
            $model->save();
        }
        echo json_encode(array('status' => 'good'));
    }

    public function actionGetGroupLeader() {
        if (!isset($_POST['id']))
            exit();
        $model = Profile::model()->findByPk($_POST['id']);
        $model->leader = '1';
        $model->save();
    }

    public function actionDeleteGroupLeader() {
        if (!isset($_POST['id']))
            exit();

        $model = Profile::model()->findByPk($_POST['id']);
        $model->leader = NULL;
        $model->save();
    }

    public function actionUsers() {
        $model = User::model()->with('prof')->findAll();
        $this->render('users', array('model' => $model));
    }

    public function actionBanuser($id) {
        $user = User::model()->findByPk($id);
        $user->active = 0;
        $user->save(false);
    }

    public function actionDeleteUser() {
        $user = User::model()->deleteByPk($_POST['user_id']);

        if ($_POST['profile_id'] != 0)
            $profile = Profile::model()->deleteByPk($_POST['profile_id']);

        echo json_encode(array('status' => 'good'));
    }

    public function actionMail() {
        $criteria = new CDbCriteria; //добавляется критерий выборки
        $criteria->order = 'id DESC'; //задается критерий выборки по айдишнику начиная с последнего
        $letters = ContactForm::model()->findAll($criteria);
        $this->render('mail', array('letters' => $letters));
    }

    public function actionGroupview($group) {
        //говно миграция
//        $lkps = PredmetSemestrGroup::model()->findAll();
//        $index = 1;
//        echo 'коунт = ' . count($lkps);
//        foreach ($lkps as $ikp) {
//            $ikp->hash_psg = PredmetSemestrGroup::model()->hash_psg_model($ikp->predmet_id, $ikp->group_id, $ikp->semestr_id);
//            if ($ikp->save(false)) {
//                echo $index . '<br/>';
//            } else {
//                $PSG->getErrors();
//            }
//            $index++;
//        }
//------------------------------------



        $model = Group::model()->findByPk($group);
        $psg_model = PredmetSemestrGroup::model()->with('predmet')->findAllByAttributes(array('group_id' => $group));
        $this->render('groupview', array('model' => $model, 'psg_model' => $psg_model));
    }

    public function actionInfogroup() {
        $group = $_POST['group_id'];
        $model = Group::model()->findByPk($group);


        $data = $this->renderPartial('infogroup', array('model' => $model), true);
        echo json_encode(array('div' => $data));
    }

    public function actionsaveInfogroup() {
        $group_id = $_POST['group_id'];
        $model = Group::model()->findByPk($group_id);
        $model->attributes = $_POST['Group'];

        if ($model->save()) {
            echo json_encode(array('status' => 'good'));
        } else {
            echo json_encode(array('status' => 'bad'));
        }
    }

    public function actionCreateTaskPlan() {
        if (isset($_POST['group'])) {
            $group = $_POST['group'];
            $model = Group::model()->findByPk($group);
            $year = AcademicYear::model()->findByAttributes(array('start' => $model->inseption->start_year));
            $semestr = Semestr::model()->findByPk($year->id);
            $model->id_semestr = $semestr->id;
            $model->save();
        }
    }

    public function actionSelectPredmets() {
        if (isset($_POST['group'])) {
            $group = $_POST['group'];
            $model = Group::model()->findByPk($group);
            $semestr_id = $_POST['semestr_id'];

            if (isset($_POST['predmets_id'])) {
                $predmets = array();
                $otm_predmets = array();
                $predmets = $_POST['predmets_id'];
                if (!is_null($predmets))
                    foreach ($predmets as $predmet) {
                        $PSG = new PredmetSemestrGroup;
                        $PSG->predmet_id = $predmet;
                        $PSG->semestr_id = $semestr_id;
                        $PSG->group_id = $group;
                        $PSG->hash_psg = PredmetSemestrGroup::model()->hash_psg_model($PSG->predmet_id, $PSG->group_id, $PSG->semestr_id);
                        if ($PSG->save()) {
                            
                        } else {
                            continue;
                            var_dump($predmet);
                            var_dump($semestr_id);
                            var_dump($group);
                            var_dump($PSG->getErrors());
                            die();
                        }
                    }
            }
            if (isset($_POST['otm_predmets_id'])) {
                $otm_predmets = array();
                $otm_predmets = $_POST['otm_predmets_id'];
                if (!is_null($otm_predmets)) {
                    foreach ($otm_predmets as $predmet_otm) {
                        $hash = PredmetSemestrGroup::model()->hash_psg_model($predmet_otm, $group, $semestr_id);
                        $otm_PSG = PredmetSemestrGroup::model()->deleteAllByAttributes(array('hash_psg' => $hash));
                    }

                    $users = Profile::model()->findAllByAttributes(array('group_id' => $group));

                    $users_id = array();
                    foreach ($users as $user) {
                        $users_id[] = $user->user_id;
                    }

                    $predmets = array();
                    foreach ($otm_predmets as $otm_predmet) {
                        $predmets[] = $otm_predmet;
                    }
                    UserSemestrPredmet::model()->deleteAllByAttributes(array('user_id' => $users_id, 'semestr_id' => $semestr_id, 'predmet_id' => $predmets));
                }
            }
        }
// $this->render('groupview', array('model' => $model));
    }

    public function actionPredmetedet($id) {
        if (isset($id)) {
            $caf_id = '';
            if (isset($_POST['Predmet'])) {

                $model = Predmet::model()->findByPk($id);

                if (isset($_POST['Predmet']['cafedra_id']))
                    $model->cafedra_id = $_POST['Predmet']['cafedra_id'];

                if (isset($_POST['Predmet']['text']))
                    $model->text = $_POST['Predmet']['text'];

                $model->save();
            } else {

                $model = Predmet::model()->findByPk($id);
            }
            if (isset($model->cafedra_id))
                $caf_id = $model->cafedra_id;

            $select = CHtml::dropDownList('Predmet[cafedra_id]', $caf_id, CHtml::listData(Cafedra::model()->findAll(), 'id', 'name'));


            $this->render('predmetedet', array('model' => $model, 'select' => $select));
        }
    }

    public function actionAproveModer() {
//        $criteria = new CDbCriteria;
//        $criteria->compare('active', '0');
//        $dataProvider = new CActiveDataProvider('User', array(
//                    'pagination' => array(
//                        'pageSize' => Yii::app()->params['postsPerPage'],
//                    ),
//                    'criteria' => $criteria,
//                ));
//
//
//        $this->render('aproveuser', array('model' => $dataProvider));
    }

    public function actionPredmet() {
        $model = new Predmet;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'predmet-predmet-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['Predmet'])) {
            $model->attributes = $_POST['Predmet'];
            if ($model->validate()) {
                $model->save();
// form inputs are valid, do something here
            }
        }
        $data = Predmet::model()->findAll();
        $this->render('predmet', array('model' => $model, 'data' => $data));
    }

    public function actionGroup() {
        $model = new Group;
        $gyc = GroupYearCreate::model()->findAll();


        if (isset($_POST['ajax']) && $_POST['ajax'] === 'group-group-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Group'])) {
            $model->attributes = $_POST['Group'];

            if ($model->validate()) {
                if (Group::searchUniqueGroup($model->name, $model->id_year_create)) {
                    $model->save();
//                    var_dump($model->id_year_create);
//                    die();
//
                    //$creat_ear = GroupYearCreate::model()->findByPk($model->id_year_create);
//$ay = AcademicYear::model()->findByAttributes(array('start' => $creat_ear->start_year));
// $gss = new GroupSemestrStatistic;


                    die();
                } else {
                    echo "<script>
                            //alert('Такая группа уже существует');
                        </script>";
                }
            }
        }


        $user = Profile::model()->findAllByAttributes(array('leader' => '1'));
        $group = Group::model()->findAll();

        $this->render('group', array('model' => $model, 'group' => $group, 'user' => $user, 'gyc' => $gyc));
    }

    public function actionDeleteGroup() {
        if (isset($_POST['group_id'])) {
            $group_id = $_POST['group_id'];
            $data = Group::model()->deleteByPk($group_id);
            echo 1;
        }
    }

    public function actionUpdateGroup() {
        if (isset($_POST['group_id'])) {
            $data = Group::model()->findByPk($_POST['group_id']);
            $data->id_year_create = $_POST['zxc'];
            $data->name = $_POST['value'];
            ;
            if (Group::searchUniqueGroup($data->name, $data->id_year_create)) {
                $data->update();
            } else {
                echo "<script>
                            alert('Такая группа уже существует');
                        </script>";
            }


            echo 1;
        }
    }

    public function actionDeletePredmet() {
        if (isset($_POST['predmet_id'])) {
            $predmet_id = $_POST['predmet_id'];
            $data = Predmet::model()->deleteByPk($predmet_id);
            echo 1;
        }
    }

    public function actionUpdatePredmet() {
        if (isset($_POST['predmet_id'])) {
            $name = $_POST['value'];
            $predmet_id = $_POST['predmet_id'];
            $data = Predmet::model()->findByPk($predmet_id);
            $data->name = $name;
            $data->update();
            echo 1;
        }
    }

    public function actionGroupUsers() {
        if (!isset($_POST['id']))
            exit();
        $profile = Profile::model()->findAllByAttributes(array('group_id' => $_POST['id']));
        $data = $this->renderPartial('/doors/_goupview_group_users', array('profile' => $profile), true);
        echo json_encode(array('div' => $data));
    }

    public function actionEditList() {
        if (!isset($_POST['group_id']) || !isset($_POST['semestr_id']))
            exit();

        $predmets = Predmet::model()->findAll();
        $predmet_semestr_group = PredmetSemestrGroup::model()->findAllByAttributes(array('group_id' => $_POST['group_id'], 'semestr_id' => $_POST['semestr_id']));
        $data = array();
        $i = '0';
        foreach ($predmet_semestr_group as $psg) {
            $data[$i]['id'] = $psg->id;
            $data[$i]['predmet_id'] = $psg->predmet_id;
            $data[$i]['semestr_id'] = $psg->semestr_id;
            $data[$i]['group_id'] = $psg->group_id;
            $i++;
        }

        $data_2 = $this->renderPartial('/doors/_edit_list_group', array('predmets' => $predmets, 'group_id' => $_POST['group_id'], 'semestr_id' => $_POST['semestr_id']), true);
        echo json_encode(array('div' => $data_2, 'predmets' => $data));
    }

    public function actionWeek() {
        $data_1 = '';
        $data_2 = '';

        if (isset($_POST['semestr_week'])) {
            if (isset($_POST['semestr_week']['1']))
                $data_1 = $_POST['semestr_week']['1'];
            if (isset($_POST['semestr_week']['2']))
                $data_2 = $_POST['semestr_week']['2'];
            if ($data_1 != '') {
                $now_week_1 = date('W', strtotime($data_1));
                $week_mask = WeekMask::model()->findByPk(1);
                $week_mask->week_num = $now_week_1;
                $week_mask->update(false);
            }
            if ($data_2 != '') {
                $now_week_2 = date('W', strtotime($data_2));
                $week_mask = WeekMask::model()->findByPk(2);
                $week_mask->week_num = $now_week_2;
                $week_mask->update(false);
            }
        }
        $this->render('week', array());
    }

// Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}