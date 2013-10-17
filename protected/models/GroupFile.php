<?php

/**
 * This is the model class for table "{{group_file}}".
 *
 * The followings are the available columns in table '{{group_file}}':
 * @property integer $id
 * @property integer $file_id
 * @property integer $group_id
 * @property integer $scope_id
 * @property integer $profile_id
 * @property integer $create_time
 */
class GroupFile extends CActiveRecord {

  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return GroupFile the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{group_file}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
        array('file_id, group_id, profile_id, create_time', 'required'),
        array('file_id, group_id, scope_id, profile_id', 'numerical', 'integerOnly' => true),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('id, file_id, group_id, scope_id, profile_id, create_time, comment, group_name', 'safe', 'on' => 'search'),
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
        'uploadedfiles' => array(self::BELONGS_TO, 'Uploadedfiles', 'file_id'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
        'id' => 'ID',
        'file_id' => 'Имя файла',
        'group_id' => 'Группа',
        'scope_id' => 'Scope',
        'profile_id' => 'Автор',
        'create_time' => 'Время создания',
        'comment' => 'Коментарий'
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
    $criteria->with = array('profile', 'uploadedfiles');

    $criteria->compare('id', $this->id);
    $criteria->compare('uploadedfiles.orig_name', $this->file_id, true);
    $criteria->compare('group_name', $this->group_id, true);
    $criteria->compare('scope_id', $this->scope_id);
    $criteria->compare('profile.name', $this->profile_id, true);
    $criteria->compare('comment', $this->comment);
    $criteria->compare('create_time', $this->create_time, true);


    return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
                'sort' => array(
                    'defaultOrder' => 'create_time DESC',
                ),
                'pagination' => array(
                    'pageSize' => 30,
                ),
            ));
  }

}