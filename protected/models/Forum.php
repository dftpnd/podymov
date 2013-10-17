<?php

/**
 * This is the model class for table "{{forum}}".
 *
 * The followings are the available columns in table '{{forum}}':
 * @property integer $id
 * @property string $content
 * @property integer $user_id
 * @property string $title
 * @property integer $created
 */
class Forum extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{forum}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, created', 'required'),
            array('user_id, created', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 255),
            array('content', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, content, user_id, title, created', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'forum_tag' => array(self::HAS_MANY, 'ForumTag', 'forum_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
//            'profile' => array(self::BELONGS_TO, 'profile', '', 'on' => '[t].user_id = profile.user_id'),
            //'test'=> array(self::HAS_MANY, 'ForumTag', 'tbl_forum_tag_id(forum_id, tag_id)')
            'test' => array(self::MANY_MANY, 'ForumTagId',
                'tbl_forum_tag(forum_id, tag_id)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'content' => 'Content',
            'user_id' => 'User',
            'title' => 'Title',
            'created' => 'Created',
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
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('created', $this->created);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Forum the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
