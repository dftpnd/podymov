<?php

/**
 * This is the model class for table "{{forum_tag}}".
 *
 * The followings are the available columns in table '{{forum_tag}}':
 * @property integer $id
 * @property integer $forum_id
 * @property integer $tag_id
 */
class ForumTag extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{forum_tag}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('forum_id, tag_id', 'required'),
            array('forum_id, tag_id', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, forum_id, tag_id', 'safe', 'on' => 'search'),
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
            'tag' => array(self::BELONGS_TO, 'Tag', 'tag_id'),
            'forum' => array(self::BELONGS_TO, 'Forum', 'forum_id')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'forum_id' => 'Forum',
            'tag_id' => 'Tag',
        );
    }


    public function search($tag_id = false, $forum_id = false)
    {

        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('forum_id', $this->forum_id);
        $criteria->compare('tag_id', $this->tag_id);
        $criteria->order = 'id DESC';
        $criteria->group = "forum_id";

        if ($tag_id && $tag_id != 0) {
            $criteria->condition = 'tag_id = ' . $tag_id;
        }

        if ($forum_id) {
            $criteria->condition = 'forum_id = ' . $forum_id;

        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ForumTag the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
