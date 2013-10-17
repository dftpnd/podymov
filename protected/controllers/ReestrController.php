<?php

class ReestrController extends Controller
{


    public $title_controller = 'Реестр';
    public $href_controller = '/reestr';


    public function actionIndex()
    {
        $title = 'Реестр';
        MyHelper::render($this, 'index', array(), $title);
    }

    public function actionGroupReestr()
    {
        $title = 'Реестр групп';
        $groups = Group::model()->findAll();

        foreach ($groups as $group)
            $year[$group->inseption->start_year] = $group->id_year_create;

        foreach ($groups as $group)
            $name_group[mb_strtoupper($group->name, 'UTF-8')] = mb_strtoupper($group->name, 'UTF-8');


        $crumbs[1]['href'] = '/reestr/GroupReestr';
        $crumbs[1]['title'] = 'Группы';

        MyHelper::render($this, 'group', array(
            'groups' => $groups,
            'year' => $year,
            'name_group' => $name_group
        ), $title, $crumbs);
    }

    public function actionGroup($id)
    {
        $week_num = '';
        $group_id = $id;
        $group = Group::model()->findByPk($group_id);
        $criteria = new CDbCriteria();
        $criteria->order = 'prof.surname ASC';
        $criteria->condition = 'prof.status = 2 and group_id = ' . $group_id;
        $profiles = User::model()->with('prof')->findAll($criteria);

        $kurs = PredmetSemestrGroup::NowKurs($group->inseption->start_year);
        $semestr = PredmetSemestrGroup::NowSemestr();

        $semestr_id = (($kurs - 1) * 2) + $semestr;

        $psg_model = PredmetSemestrGroup::model()->with('predmet')->findAllByAttributes(array('group_id' => $group->id));

        $predmets_id = '';
        foreach ($psg_model as $predmets) {
            if ($predmets_id == '')
                $predmets_id = $predmets->predmet_id;
            else
                $predmets_id .= ', ' . $predmets->predmet_id;

            $predmets_condition[] = $predmets->predmet_id;
        }
        $type_pair = TypePair::model()->findAll();
        $order_pair = OrderPair::model()->findAll();
        $premets = Predmet::model()->findAllByAttributes(array('id' => $predmets_condition));
        $data = CHtml::listData($premets, 'id', 'name');
        $data2 = CHtml::listData($order_pair, 'id', 'name');
        $week_razd = WeekRazd::model()->findAll();
        $data3 = CHtml::listData($week_razd, 'id', 'name');
        $time_pair = TimePair::model()->findAll();

        $wekdays = Weekday::model()->
            with('schedule')->
            findAll(
                '   (
                        schedule.group_id = "' . $group->id . '"
                    and schedule.semestr_id = "' . $semestr_id . '"
                     )
                        or
                    (schedule.id is null)'
            );
        /* определение четности недели */
        $masc_week = WeekMask::model()->findByPk($semestr);


        if (isset($masc_week->week_num))
            $week_num = $masc_week->week_num;

        $now_week = date('W') - $week_num;
        if ($now_week == 0) {
            $we = '3';
        } else {
            if ($now_week % 2) {
                $we = '2';
            } else {
                $we = '3';
            }
        }
        /* определение четности недели */
        $title = $group->name . ' 1-' . $group->inseption->prefix_year;


        $crumbs[1]['href'] = '/reestr/GroupReestr';
        $crumbs[1]['title'] = 'Группы';
        $crumbs[2]['href'] = '/reestr/group/' . $group->id;
        $crumbs[2]['title'] = $title;

        MyHelper::render($this, 'group_card', array(
            'group' => $group,
            'profiles' => $profiles,
            'wekdays' => $wekdays,
            'data' => $data,
            'data2' => $data2,
            'data3' => $data3,
            'type_pair' => $type_pair,
            'time_pair' => $time_pair,
            'semestr' => $semestr,
            'we' => $we
        ), $title, $crumbs);
    }

    public function actionPredmetGroup()
    {
        if (isset($_POST['group_id'])) {
            $psg_model = PredmetSemestrGroup::model()->with('predmet')->findAllByAttributes(array('group_id' => $_POST['group_id']));


            $data = $this->renderPartial('/reestr/_predmet_group', array(
                'psg_model' => $psg_model
            ), true);
            echo json_encode(array('div' => $data));
        } else {
            die('ты куда?');
        }
    }

    public function actionCompareGroup()
    {
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $cs->registerCoreScript('jquery.ui');
        $cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/amcharts.js');
        $cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/amcharts_ui.js');
        $cs->registerCssFile(Yii::app()->request->baseUrl . '/css/jquery-ui-1.9.2.custom.min.css');

        if (!isset($_POST['groups']))
            exit();


        // первый форич по группам
        foreach ($_POST['groups'] as $group_id) {
            //вытащили все профили за группой
            $profiles = Profile::model()->findAllByAttributes(array('group_id' => $group_id));

            $chartData = array();
            $group = Group::model()->findByPk($group_id);
            $gyc = GroupYearCreate::model()->findByPk($group->id_year_create);
            $psg_model = PredmetSemestrGroup::model()->with('predmet')->findAllByAttributes(array('group_id' => $group_id));
            $lop = $gyc->start_year;
            $group_name = $group->name . ' 1-' . $group->inseption->prefix_year;
            $count_profiles = count($profiles);
            //теперь бегаем по профилям
            foreach ($profiles as $profile) {
                $asd = $profile->midleStats();
            }
        }


//        foreach ($predmas as $key => $value) {
//            $chartData[] = $predmas[$key];
//        }


        $graphs[] = array(
            'id' => 'view-student',
        );


        $options = array(
            'writeId' => 'chartdiv',
            'showAllGraph' => 'true'
        );

        $data = $this->renderPartial('/doors/_compare_student', array('profile' => $profile), true);
        echo json_encode(array('div' => $data, 'chartData' => $chartData, 'graphs' => $graphs, 'options' => $options,));
    }

    public function actionGetSchedule()
    {
        if (isset($_POST['group_id'])) {
            $psg_model = PredmetSemestrGroup::model()->with('predmet')->findAllByAttributes(array('group_id' => $_POST['group_id']));


            $data = $this->renderPartial('/reestr/_predmet_group', array(
                'psg_model' => $psg_model
            ), true);
            echo json_encode(array('div2' => $data));
        } else {
            die('ты куда?');
        }
    }

    public function actionManagePredmet()
    {

        $this->render('manage_predmet', array());
    }

    public function actionPrepods()
    {
        $title = 'Преподователи';
        $prepods = array();

        $criteria = new CDbCriteria();
        $criteria->order = 't.surname ASC';

        $prepods = Profile::model()->with('uploadedfiles')->findAllByAttributes(array('status' => '3'), $criteria);


        $crumbs[2]['href'] = '/reestr/prepods';
        $crumbs[2]['title'] = "Преподаватели";

        MyHelper::render($this, '/reestr/prepods', array('models' => $prepods), $title, $crumbs);
    }

}

