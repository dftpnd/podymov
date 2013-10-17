<?php

/**
 * This is the model class for table "{{profile}}".
 *
 * The followings are the available columns in table '{{profile}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $group
 * @property string $start
 * @property string $End
 * @property string $private
 * @property string $status
 * @property integer $file_id
 * @property string skype
 * @property string kontakt_email
 * @property string pthon
 * @property string contact_email
 * @property string kontact
 * @property string website
 */
class Profile extends CActiveRecord {

  const STUDENT = 2;
  const PREPOD = 3;
  const STATUS_DAFAULT = 1;
  const STATUS_FAKE = 2;

  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return Profile the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{profile}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
        array('user_id, name, surname', 'required'),
        array('user_id, file_id, leader', 'numerical', 'integerOnly' => true),
        array('name, surname, patronymic, pthon, skype, status, leader, pthon, website, kontakt_email, kontact', 'length', 'max' => 128),
        array('start, End, private', 'safe'),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('id, minus, plus, skype, pthon, website, kontakt_email, kontact, user_id, name, surname, patronymic, start, End, private, status, file_id', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    return array(
        'uploadedfiles' => array(self::BELONGS_TO, 'Uploadedfiles', 'file_id'),
        'team' => array(self::BELONGS_TO, 'Group', 'group_id'),
        'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        'predmet_prepod' => array(self::HAS_MANY, 'PredmetPrepod', 'profile_id')
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
        'id' => 'ID',
        'user_id' => 'User',
        'name' => 'Имя',
        'surname' => 'Фамилия',
        'patronymic' => 'Отчество',
        //'group' => 'Group',
        'start' => 'Start',
        'End' => 'End',
        'private' => 'Что угодно',
        'status' => 'Статус',
        'file_id' => 'File',
        'leader' => 'leader',
        'pthon' => 'pthon',
        'kontakt_email' => 'kontakt_email',
        'website' => 'website',
        'kontact' => 'kontact',
        'skype' => 'skype',
    );
  }

  /**
   * Retrieves a list of models based on the current search/filter conditions.
   * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
   */
  public function search() {
    // Warning: Please modify the following code to remove attributes that
    // should not be searched.

    $criteria = new CDbCriteria;

    $criteria->compare('id', $this->id);
    $criteria->compare('user_id', $this->user_id);
    $criteria->compare('name', $this->name, true);
    $criteria->compare('surname', $this->surname, true);
    $criteria->compare('patronymic', $this->patronymic, true);
    //$criteria->compare('group', $this->group, true);
    $criteria->compare('start', $this->start, true);
    $criteria->compare('End', $this->End, true);
    $criteria->compare('private', $this->private, true);
    $criteria->compare('status', $this->status, true);
    $criteria->compare('file_id', $this->file_id);
    $criteria->compare('leader', $this->leader);

    return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
  }

  public function midleStats() {
    $student = $this->id;



    $entry = array();
    $sum = array();
    $polka = array();
    $rating_by_semestr = array();

    //узнаем оценки по предметам по семестрам
    $usp_model = UserSemestrPredmet::model()->findAllByAttributes(array('user_id' => $this->user_id), array('order' => 'semestr_id'));


    foreach ($usp_model as $value) {
      $rating = $value->rating_id + 1;
      $entry[$value->semestr_id][] = $rating;
      isset($rating_by_semestr[$value->semestr_id]) ? $rating_by_semestr[$value->semestr_id] += $rating : $rating_by_semestr[$value->semestr_id] = $rating;
    }


    //узнаем количество оценок полученных в семестре
    foreach ($entry as $key => $value) {
      $polka[$key] = count($value);
    }

    //узнаем среднюю оценку за семестр
    foreach ($rating_by_semestr as $key => $value) {
      $polka[$key] = substr($value / $polka[$key], 0, 5);
    }


    $co = '0';
    $j = 1;
    for ($i = 0; $i <= 9; $i++) {
      $mib = $j;
      if ($co == '0') {
        $co = '1';
        if ($i != 0) {
          $j++;
          $mib = $j;
        }
      } else {
        $co = '0';
        $mib = '';
      }
      if (isset($polka[$i])) {
        $predmas[$i]['point'] = $mib;
        if (isset($predmas[$i][$group_name]))
          $predmas[$i][$group_name] = ($polka[$i] + $predmas[$i][$group_name]) / 2;
        else {
          $predmas[$i][$group_name] = $polka[$i];
        }
      }
    }



    $graphs[] = array(
        'id' => $group_name,
        'name' => $this->name . ' ' . $this->surname,
    );
  }

  public static function getAvalibleProfile($profile_id) {

    $viewer = User::model()->findByPk(Yii::app()->user->id);
    if ((int) $profile_id === 0) {
      $profile = new self;
      $profile->group_id = $viewer->prof->group_id;
    } else {
      $profile = self::model()->findByPk($profile_id);
      if (empty($profile)) {
        $profile = new self;
      }
    }
    if ($profile->group_id == $viewer->prof->group_id)
      return $profile;
    else
      return FALSE;
  }

  public static function saveFakeProfile($params, $el) {
    $viewer = User::model()->findByPk(Yii::app()->user->id);


    if (!isset($params['Profile']['name']) || !isset($params['Profile']['surname'])) {
      return array('status' => 'fail');
    }

    $user = new User();
    $user->username = 'FAKE';
    $user->save(false);

    $profile = new self();
    $profile->attributes = $params['Profile'];
    $profile->group_id = $viewer->prof->group_id;
    $profile->user_id = $user->id;
    $profile->status = self::STUDENT;
    $profile->fake = self::STATUS_FAKE;
    $profile->save(false);

    $html = $el->renderPartial('/user/_manege_group_student', array('student' => $profile), true);

    return array('status' => 'success', 'html' => $html);
  }

  public static function processingStats($profile, $access, $el, $user_id, $params) {

    $group = Group::model()->findByPk($profile->group_id);
    $stats_srav = array();
    $psg_model = PredmetSemestrGroup::model()->with('predmet')->findAllByAttributes(array('group_id' => $profile->group_id));
    foreach ($psg_model as $box) {
      $stats_srav[$box->semestr_id][$box->id] = $box->predmet_id;
    }

    $rating = Rating::model()->findAll();
    $entry = array();
    if (isset($params['resultts'])) {
      if ($access) {
        $count_predmets = 0;
        $summa = 0;
        foreach ($params['resultts'] as $key => $semestr) {
          foreach ($semestr as $predmet => $result) {
            $usp = UserSemestrPredmet::model()->findByAttributes(array('semestr_id' => $key, 'user_id' => $user_id, 'predmet_id' => $predmet));
            if (empty($usp)) {
              $usp = new UserSemestrPredmet;
              $usp->semestr_id = $key;
              $usp->user_id = $user_id;
              $usp->predmet_id = $predmet;
            }
            if (!empty($result)) {
              if (isset($stats_srav[$key]))
                if (in_array($predmet, $stats_srav[$key])) {
                  $usp->rating_id = $result;
                  $usp->save();
                  $entry[$usp->semestr_id][$usp->predmet_id] = $usp->rating_id;
                  $summa += (int) $result + 1;
                  $count_predmets++;
                }
            } else {
              if (!$usp->isNewRecord)
                $usp->delete();
            }
          }
        }
        $gss = GroupSemestrStatistic::model();
        $statistic = Statistic::model();
//среднее для юзера
        $profile->mean = substr($summa / $count_predmets, 0, 5);
        $profile->save();
//среднее для группы
        $psofiles = Profile::model()->findAllByAttributes(array('group_id' => $profile->group_id));
        $count_profiles = 0;
        $summa_group = 0;
        foreach ($psofiles as $profile) {
          if (!is_null($profile->mean)) {
            $count_profiles++;
            $summa_group += $profile->mean;
          }
        }
        $group->mean = substr($summa_group / $count_profiles, 0, 5);
        $group->save();
        echo CJSON::encode(array('status' => 'success'));
        exit();
      } else {
        echo CJSON::encode(array('status' => 'error'));
        exit();
      }
    } else {

      $usp_model = UserSemestrPredmet::model()->findAllByAttributes(array('user_id' => $user_id));

      foreach ($usp_model as $value) {
        $entry[$value->semestr_id][$value->predmet_id] = $value->rating_id;
      }
    }

    $data['model'] = $profile;
    $data['group'] = $group;
    $data['psg_model'] = $psg_model;
    $data['rating'] = $rating;
    $data['entry'] = $entry;

    return $data;
  }

  public static function buildStats($params, $profile) {
    $chartData = array();
    $graphs = array();
    $entry = array();
    $sum = array();
    $polka = array();

    $group = Group::model()->findByPk($params['group_id']);
    $psg_model = PredmetSemestrGroup::model()->with('predmet')->findAllByAttributes(array('group_id' => $params['group_id']));
    $usp_model = UserSemestrPredmet::model()->findAllByAttributes(array('user_id' => $profile->user_id), array('order' => 'semestr_id'));

    $gyc = GroupYearCreate::model()->findByPk($group->id_year_create);
    $lop = $gyc->start_year;


    foreach ($usp_model as $value) {
      $yu = $value->rating_id + 1;
      $entry[$value->semestr_id][] = $yu;
      isset($sum[$value->semestr_id]) ? $sum[$value->semestr_id] += $yu : $sum[$value->semestr_id] = $yu;
    }
    foreach ($entry as $key => $value) {
      $polka[$key] = count($value);
    }
    foreach ($sum as $key => $value) {
      $polka[$key] = substr($value / $polka[$key], 0, 5);
    }
    $co = '0';
    $j = $lop;
    for ($i = $group->id_semestr; $i <= $group->id_semestr + 9; $i++) {
      $mib = $j;
      if ($co == '0') {
        $co = '1';
        if ($i != $group->id_semestr) {
          $j++;
          $mib = $j;
        }
      } else {
        $co = '0';
        $mib = '';
      }
      if (isset($polka[$i])) {
        $vrem = $polka[$i];
        $chartData[] = array(
            'point' => $mib,
            'view-student' => $vrem
        );
      }
    }


    $graphs[] = array(
        'id' => 'view-student',
        'name' => 'График успеваемости студента',
    );

    $options = array(
        'writeId' => 'chartdiv',
        'showAllGraph' => 'true'
    );


    return $data;
  }

  public static function viewProfileStats($model, $group) {

    $chartData = array();
    $entry = array();
    $sum = array();
    $polka = array();
    $rating_3 = 0;
    $rating_4 = 0;
    $rating_5 = 0;
    $psg_model = PredmetSemestrGroup::model()->with('predmet')->findAllByAttributes(array('group_id' => $group->id));
    $usp_model = UserSemestrPredmet::model()->findAllByAttributes(array('user_id' => $model->user_id), array('order' => 'semestr_id'));
    $gyc = GroupYearCreate::model()->findByPk($group->id_year_create);
    $lop = $gyc->start_year;
    foreach ($usp_model as $value) {
      $yu = $value->rating_id + 1;
      $entry[$value->semestr_id][] = $yu;
      isset($sum[$value->semestr_id]) ? $sum[$value->semestr_id] += $yu : $sum[$value->semestr_id] = $yu;
      if ($value->rating_id == 2) {
        $rating_3++;
      }
      if ($value->rating_id == 3) {
        $rating_4++;
      }
      if ($value->rating_id == 4) {
        $rating_5++;
      }
    }
    foreach ($entry as $key => $value) {
      $polka[$key] = count($value);
    }
    foreach ($sum as $key => $value) {
      $polka[$key] = substr($value / $polka[$key], 0, 5);
    }
    $co = '0';
    $j = $lop;
    for ($i = $group->id_semestr; $i <= $group->id_semestr + 9; $i++) {
      $mib = $j;
      if ($co == '0') {
        $co = '1';
        if ($i != $group->id_semestr) {
          $j++;
          $mib = $j;
        }
      } else {
        $co = '0';
        $mib = '';
      }
      if (isset($polka[$i])) {
        $vrem = $polka[$i];
        $chartData[] = array(
            'point' => $mib,
            'view-student' => $vrem
        );
      }
    }


    $graphs = array();
    $graphs[] = array(
        'id' => 'view-student',
        'name' => 'График успеваемости студента',
    );
    $options = array(
        'writeId' => 'chartdiv',
        'showAllGraph' => 'true'
    );

    $data['options'] = $options;
    $data['graphs'] = $graphs;
    $data['chartData'] = $chartData;
    $data['rating_3'] = $rating_3;
    $data['rating_4'] = $rating_4;
    $data['rating_5'] = $rating_5;

    return $data;
  }

}