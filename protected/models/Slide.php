<?php

/**
 * This is the model class for table "{{slide}}".
 *
 * The followings are the available columns in table '{{slide}}':
 * @property integer $id
 * @property string $link
 * @property string $text
 * @property integer $show_slide
 * @property string $img_link
 * @property string $left_slide
 * @property string $top_slide
 */
class Slide extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Slide the static model class
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
		return '{{slide}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('show_slide', 'required'),
			array('show_slide', 'numerical', 'integerOnly'=>true),
			array('link, text, img_link', 'length', 'max'=>255),
			array('left_slide, top_slide', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, link, text, show_slide, img_link, left_slide, top_slide', 'safe', 'on'=>'search'),
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
			'link' => 'Ссылка на пост',
			'text' => 'Заголовок',
			'show_slide' => 'Показать слайд',
			'img_link' => 'Ссылка на изображение',
			'left_slide' => 'Отступ слева',
			'top_slide' => 'Отступ сверху',
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
		$criteria->compare('link',$this->link,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('show_slide',$this->show_slide);
		$criteria->compare('img_link',$this->img_link,true);
		$criteria->compare('left_slide',$this->left_slide,true);
		$criteria->compare('top_slide',$this->top_slide,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}