<?php

/**
 * This is the model class for table "{{group}}".
 *
 * The followings are the available columns in table '{{group}}':
 * @property integer $id
 * @property string $name
 * @property integer $leader_id
 */
class Group extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Group the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{group}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('name', 'unique'),
            array('name, id_year_create', 'required'),
            array('id_year_create, all_man', 'numerical', 'integerOnly' => true),
            array('name, curator', 'length', 'max' => 128),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, id_year_create, curator', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            // 'students' => array(self::HAS_ONE, 'Profile', '', 'on' => 't.group_id = profile.user_id'),
            //   'profile' => array(self::HAS_ONE, 'Profile', '', 'on' => 't.leader_id = profile.user_id'),
            'inseption' => array(self::BELONGS_TO, 'GroupYearCreate', 'id_year_create'),
            'students' => array(self::STAT, 'Profile', 'group_id', 'select' => 'COUNT(*)'),
//            'students' => array(self::HAS_ONE, 'Profile', '', 'on' => 't.group_id = profile.user_id'),
//            'students' => array(self::BELONGS_TO, 'Profile', 'id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'id_year_create' => 'year',
            'curator' => 'curator',
            'all_man' => 'all_man'
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
        $criteria->compare('name', $this->name, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    static function searchUniqueGroup($name, $year) {
        $attributes = array(
            'name' => $name,
            'id_year_create' => $year
        );
        $model = Group::model()->countByAttributes($attributes);
        if ($model == '1') {
            return false;
        } elseif ($model != '1') {
            return true;
        }
    }

}