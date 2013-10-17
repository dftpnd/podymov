<?php

/**
 * This is the model class for table "{{wall}}".
 *
 * The followings are the available columns in table '{{wall}}':
 * @property integer $id
 * @property integer $profile_id
 * @property integer $parent_id
 * @property string $date
 * @property integer $rating
 * @property string $content
 * @property integer $belong_id
 * @property string $last_update
 */
class Wall extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Discussion the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{wall}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('profile_id, date, content, belong_id', 'required'),
            array('profile_id, parent_id, rating, belong_id', 'numerical', 'integerOnly' => true),
            //array('content', 'length', 'max' => 255),
            array('last_update', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, profile_id, parent_id, date, rating, content, belong_id, last_update', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'profile' => array(self::BELONGS_TO, 'Profile', 'profile_id'),
            'child' => array(self::HAS_MANY, 'Wall', 'parent_id'),
            'parent' => array(self::BELONGS_TO, 'Wall', 'parent_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'profile_id' => 'Profile',
            'parent_id' => 'Parent',
            'date' => 'Date',
            'rating' => 'Rating',
            'content' => 'Content',
            'belong_id' => 'belong_id',
            'last_update' => 'Last Update',
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
        $criteria->compare('profile_id', $this->profile_id);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('rating', $this->rating);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('belong_id', $this->belong_id);
        $criteria->compare('last_update', $this->last_update, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}