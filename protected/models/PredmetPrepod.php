<?php

/**
 * This is the model class for table "{{predmet_prepod}}".
 *
 * The followings are the available columns in table '{{predmet_prepod}}':
 * @property integer $id
 * @property integer $predmet_id
 * @property integer $profile_id
 * @property integer $rating
 * @property integer $uploads_count
 * @property integer $created
 */
class PredmetPrepod extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PredmetPrepod the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{predmet_prepod}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('predmet_id, profile_id', 'required'),
            array('predmet_id, profile_id', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, predmet_id, profile_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'predmet_prepod' => array(self::BELONGS_TO, 'Predmet', 'predmet_id'),
            'prepod' => array(self::BELONGS_TO, 'Profile', 'profile_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'predmet_id' => 'Predmet',
            'profile_id' => 'Profile',
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
        $criteria->compare('profile_id', $this->profile_id);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}