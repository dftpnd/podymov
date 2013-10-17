<?php

/**
 * This is the model class for table "{{schedule}}".
 *
 * The followings are the available columns in table '{{schedule}}':
 * @property integer $id
 * @property integer $group_id
 * @property integer $semestr_id
 * @property integer $weekday_id
 * @property integer $predmet_id
 * @property integer $predmet_1_id
 * @property integer $predmet_2_id
 * @property integer $time_pair_id
 * @property integer $type_pair_id
 * @property string $room
 * @property integer $order
 * @property integer $week_razd
 */
class Schedule extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Schedule the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{schedule}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('group_id, semestr_id, weekday_id, order, week_razd', 'required'),
            array('group_id, semestr_id, weekday_id, predmet_id, predmet_1_id, predmet_2_id, time_pair_id, type_pair_id, order, week_razd', 'numerical', 'integerOnly' => true),
            array('room', 'length', 'max' => 64),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, group_id, semestr_id, weekday_id, predmet_id, predmet_1_id, predmet_2_id, time_pair_id, type_pair_id, room, order, week_razd', 'safe', 'on' => 'search'),
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
            'predmet_1' => array(self::BELONGS_TO, 'Predmet', 'predmet_1_id'),
            'predmet_2' => array(self::BELONGS_TO, 'Predmet', 'predmet_2_id'),
            'type_pair' => array(self::BELONGS_TO, 'TypePair', 'type_pair_id'),
            'time_pair' => array(self::BELONGS_TO, 'TimePair', 'time_pair_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'group_id' => 'Group',
            'semestr_id' => 'Semestr',
            'weekday_id' => 'Weekday',
            'predmet_id' => 'Predmet',
            'predmet_1_id' => 'Predmet 1',
            'predmet_2_id' => 'Predmet 2',
            'time_pair_id' => 'Time Pair',
            'type_pair_id' => 'Type Pair',
            'room' => 'Room',
            'order' => 'Order',
            'week_razd' => 'Week Razd',
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
        $criteria->compare('group_id', $this->group_id);
        $criteria->compare('semestr_id', $this->semestr_id);
        $criteria->compare('weekday_id', $this->weekday_id);
        $criteria->compare('predmet_id', $this->predmet_id);
        $criteria->compare('predmet_1_id', $this->predmet_1_id);
        $criteria->compare('predmet_2_id', $this->predmet_2_id);
        $criteria->compare('time_pair_id', $this->time_pair_id);
        $criteria->compare('type_pair_id', $this->type_pair_id);
        $criteria->compare('room', $this->room, true);
        $criteria->compare('order', $this->order);
        $criteria->compare('week_razd', $this->week_razd);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}