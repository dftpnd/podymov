<?php

/**
 * This is the model class for table "{{user_semestr_predmet}}".
 *
 * The followings are the available columns in table '{{user_semestr_predmet}}':
 * @property integer $id
 * @property integer $semestr_id
 * @property integer $user_id
 * @property integer $predmet_id
 * @property integer $rating
 */
class UserSemestrPredmet extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return UserSemestrPredmet the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{user_semestr_predmet}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('semestr_id, user_id, predmet_id', 'required'),
            array('semestr_id, user_id, predmet_id, rating_id', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, semestr_id, user_id, predmet_id, rating_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'semestr_id' => 'Semestr',
            'user_id' => 'User',
            'predmet_id' => 'Predmet',
            'rating_id' => 'Rating',
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
        $criteria->compare('semestr_id', $this->semestr_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('predmet_id', $this->predmet_id);
        $criteria->compare('rating', $this->rating);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}