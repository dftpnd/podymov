<?php

/**
 * This is the model class for table "{{user_files}}".
 *
 * The followings are the available columns in table '{{user_files}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $file_id
 * @property integer $created
 * @property integer $downloads_count
 * @property integer $folder_id
 */
class UserFiles extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserFiles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_files}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, file_id, created', 'required'),
			array('user_id, file_id, created, downloads_count, folder_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, file_id, created, downloads_count, folder_id', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'file_id' => 'File',
			'created' => 'Created',
			'downloads_count' => 'Downloads Count',
			'folder_id' => 'Folder',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('file_id',$this->file_id);
		$criteria->compare('created',$this->created);
		$criteria->compare('downloads_count',$this->downloads_count);
		$criteria->compare('folder_id',$this->folder_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}