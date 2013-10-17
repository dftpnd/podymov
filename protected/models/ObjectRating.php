<?php

/**
 * This is the model class for table "{{object_rating}}".
 *
 * The followings are the available columns in table '{{object_rating}}':
 * @property integer $id
 * @property integer $profile_id
 * @property integer $type
 * @property integer $object_id
 * @property integer $value
 */
class ObjectRating extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ObjectRating the static model class
     */

    const TYPE_COM = 1;
    const TYPE_POST = 2;
    const TYPE_SMALL_POST = 3;
    const TYPE_WALL = 4;
    const lIBRARY_FILES = 5;
    const FORUM = 6;
    const NEW_FORUM = 7;
    const PLUS = 1;
    const MINUS = 0;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{object_rating}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, type, object_id, value', 'required'),
            array('user_id, type, object_id, value', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user_id, type, object_id, value', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'user_id' => 'user',
            'type' => 'Type',
            'object_id' => 'Object',
            'value' => 'Value',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('profile_id', $this->profile_id);
        $criteria->compare('type', $this->type);
        $criteria->compare('object_id', $this->object_id);
        $criteria->compare('value', $this->value);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function check($type, $object_id)
    {
        $number_entries = self::model()->countByAttributes(array('user_id' => Yii::app()->user->id, 'type' => $type, 'object_id' => $object_id));
        if ($number_entries == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function addRating($type, $object_id, $value)
    {
        $or = new ObjectRating();
        $or->user_id = Yii::app()->user->id;
        $or->type = $type;
        $or->object_id = $object_id;
        $or->value = $value;
        if ($or->save()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function solve($author, $model)
    {

        if (ObjectRating::check($_POST['type'], $_POST['object_id'])) {

            if (ObjectRating::addRating($_POST['type'], $_POST['object_id'], $_POST['value'])) {

                if ($_POST['value'] == ObjectRating::PLUS) {
                    $model->rating += 1;
                    $author->plus += 1;
                } else if ($_POST['value'] == ObjectRating::MINUS) {
                    $model->rating -= 1;
                    $author->minus += 1;
                }
                $author->save(false);
                $model->save();
                $this_rating = $model->rating;
                echo CJSON::encode(array('status' => 'success', 'this_rating' => $this_rating));
                exit();
            } else {
                echo CJSON::encode(array('status' => 'failure'));
                exit();
            }
        } else {
            echo CJSON::encode(array('status' => 'voted'));
            exit();
        }

    }


}