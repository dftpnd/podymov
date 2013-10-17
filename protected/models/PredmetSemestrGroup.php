<?php

/**
 * This is the model class for table "{{predmet_semestr_group}}".
 *
 * The followings are the available columns in table '{{predmet_semestr_group}}':
 * @property integer $id
 * @property integer $predmet_id
 * @property integer $semestr_id
 * @property integer $group_id
 */
class PredmetSemestrGroup extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PredmetSemestrGroup the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{predmet_semestr_group}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('predmet_id, semestr_id, group_id', 'required'),
            array('predmet_id, semestr_id, group_id', 'numerical', 'integerOnly' => true),
            array('hash_psg', 'unique'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, predmet_id, semestr_id, group_id, hash_psg', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'predmet' => array(self::BELONGS_TO, 'Predmet', 'predmet_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'predmet_id' => 'Predmet',
            'semestr_id' => 'Semestr',
            'group_id' => 'Group',
            'hash_psg' => 'hash_psg'
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
        $criteria->compare('predmet_id', $this->predmet_id);
        $criteria->compare('semestr_id', $this->semestr_id);
        $criteria->compare('group_id', $this->group_id);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public static function NowKurs($start_year) {
        if (date('n') > 6) {
            $index_god = date('Y') - $start_year;
            if ($index_god == 0) {
                $kurs = 1;
            } else if ($index_god == 1) {
                $kurs = 2;
            } else if ($index_god == 2) {
                $kurs = 3;
            } else if ($index_god == 3) {
                $kurs = 4;
            } else if ($index_god == 4) {
                $kurs = 5;
            } else {
                $kurs = '';
            }
            return $kurs;
        } else {
            $index_god = date('Y') - $start_year;
            if ($index_god == 1) {
                $kurs = 1;
            } else if ($index_god == 2) {
                $kurs = 2;
            } else if ($index_god == 3) {
                $kurs = 3;
            } else if ($index_god == 4) {
                $kurs = 4;
            } else if ($index_god == 5) {
                $kurs = 5;
            } else {
                $kurs = '';
            }
            return $kurs;
        }
    }

    public static function NowSemestr() {
        $mouth = date('m');
        if ($mouth == 2 || $mouth == 3 || $mouth == 4 || $mouth == 5 || $mouth == 1) {
            $semest = '2';
        } else if ($mouth == 9 || $mouth == 10 || $mouth == 11 || $mouth == 12) {
            $semest = '1';
        } else {
            $semest = '';
        }
        return $semest;
    }

    public static function hash_psg_model($predmet_id, $group_id, $semestr_id) {
        return $predmet_id . '0' . $group_id . '0' . $semestr_id;
    }

}