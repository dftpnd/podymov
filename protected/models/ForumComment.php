<?php

/**
 * This is the model class for table "{{forum_comment}}".
 *
 * The followings are the available columns in table '{{forum_comment}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $text
 * @property integer $created
 * @property integer $rating
 * @property integer $forum_id
 */
class ForumComment extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{forum_comment}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, created, forum_id', 'required'),
            array('user_id, created, rating, forum_id', 'numerical', 'integerOnly' => true),
            array('text', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, text, created, rating, forum_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'text' => 'Text',
            'created' => 'Created',
            'rating' => 'Rating',
            'forum_id' => 'Forum',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('created', $this->created);
        $criteria->compare('rating', $this->rating);
        $criteria->compare('forum_id', $this->forum_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ForumComment the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
