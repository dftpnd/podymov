<?php

/**
 * This is the model class for table "{{predmet}}".
 *
 * The followings are the available columns in table '{{predmet}}':
 * @property integer $id
 * @property string $name
 * @property string $text
 */
class Predmet extends CActiveRecord {

  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return Predmet the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{predmet}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
        array('name', 'unique'),
        array('name', 'required'),
        array('name', 'length', 'max' => 128),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('id, name, text, cafedra_id', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
        'predmetfile' => array(self::HAS_MANY, 'PredmetFile', 'predmet_id'),
        'predmetprepod' => array(self::HAS_MANY, 'PredmetPrepod', 'predmet_id'),
        'cafedra' => array(self::BELONGS_TO, 'Cafedra', 'cafedra_id'),
        'institutecafedra' => array(self::BELONGS_TO, 'InstituteCafedra', 'cafedra_id'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
        'id' => 'ID',
        'name' => 'Name',
        'text' => 'text',
        'cafedra_id' => 'cafedra_id'
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
    $criteria->compare('name', $this->name, true);
    $criteria->compare('name', $this->text, true);
    $criteria->compare('name', $this->cafedra_id, true);
    

    return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
  }

}