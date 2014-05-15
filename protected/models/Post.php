<?php

/**
 * This is the model class for table "{{post}}".
 *
 * The followings are the available columns in table '{{post}}':
 * @property integer $id
 * @property integer $created
 * @property string $content
 * @property integer $visible
 */
class Post extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{post}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('created, content, pdf_file, title', 'required'),
            array('created, visible, pdf_file, doc_file', 'numerical', 'integerOnly' => true),
            array('content', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, created, content, visible', 'safe', 'on' => 'search'),
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
            'uploded_pdf' => array(self::BELONGS_TO, 'Files', 'pdf_file'),
            'uploded_doc' => array(self::BELONGS_TO, 'Files', 'doc_file'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Заголовок',
            'created' => 'Created',
            'content' => 'Содержимое публикации',
            'visible' => 'Настройки видимости поста',
            'doc_file' => 'doc_file',
            'pdf_file' => 'pdf_file',
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
        $criteria->compare('created', $this->created);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('visible', $this->visible);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Post the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function savePost()
    {

        if (isset($_POST['Post']['id'])) {
            $model = self::model()->findByPk($_POST['Post']['id']);
        } else {
            $model = new self;
        }


        $model->attributes = $_POST['Post'];

        $model->created = time();


        if ($model->save()) {
            $response = array('status' => 'success', 'post_id' => $model->id);
        } else {
            $response = array('status' => 'failure', 'message' => $model->getErrors());
        }
        echo CJSON::encode($response);

        Yii::app()->end();


    }


}
