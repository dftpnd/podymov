<?php

/**
 * This is the model class for table "{{predmet_file}}".
 *
 * The followings are the available columns in table '{{predmet_file}}':
 * @property integer $id
 * @property integer $uploads_id
 * @property integer $predmet_id
 * @property integer $profile_id
 * @property string $comment
 * @property integer $rating
 * @property integer $created
 * @property integer $count_uploads
 */
class PredmetFile extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PredmetFile the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{predmet_file}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('uploads_id, predmet_id, profile_id', 'required'),
            array('uploads_id, predmet_id, profile_id, rating, created, count_uploads', 'numerical', 'integerOnly' => true),
            array('comment', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, uploads_id, predmet_id, profile_id, comment, rating, created, count_uploads', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'uploadedfiles' => array(self::BELONGS_TO, 'Uploadedfiles', 'uploads_id'),
            'predmet' => array(self::BELONGS_TO, 'Predmet', 'predmet_id'),
            'profile' => array(self::BELONGS_TO, 'Profile', 'profile_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'uploads_id' => 'Uploads',
            'predmet_id' => 'Predmet',
            'profile_id' => 'Profile',
            'comment' => 'Comment',
            'rating' => 'Rating',
            'created' => 'Created',
            'count_uploads' => 'Count Uploads',
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
        $criteria->compare('uploads_id', $this->uploads_id);
        $criteria->compare('predmet_id', $this->predmet_id);
        $criteria->compare('profile_id', $this->profile_id);
        $criteria->compare('comment', $this->comment, true);
        $criteria->compare('rating', $this->rating);
        $criteria->compare('created', $this->created);
        $criteria->compare('count_uploads', $this->count_uploads);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}