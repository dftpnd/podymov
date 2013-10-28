<?php

/**
 * This is the model class for table "{{feedback}}".
 *
 * The followings are the available columns in table '{{feedback}}':
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property integer $created
 * @property integer $id
 * @property string $content
 */
class Feedback extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{feedback}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, surname, email, created', 'required'),
            array('created', 'numerical', 'integerOnly' => true),
            array('name, surname, email', 'length', 'max' => 255),
            array('email', 'email'),
            array('content', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('name, surname, email, created, id, content', 'safe', 'on' => 'search'),
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
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'email' => 'email',
            'created' => 'создан',
            'id' => 'ID',
            'content' => 'Сообщение',
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

        $criteria->compare('name', $this->name, true);
        $criteria->compare('surname', $this->surname, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('created', $this->created);
        $criteria->compare('id', $this->id);
        $criteria->compare('content', $this->content, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Feedback the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function sendLetter($feedback)
    {

        $user = User::model()->findByAttributes(array('username' => User::USERNAME));
        $email = $user->email;

        $params['feedback'] = $feedback;
        $params['title'] = 'Вам написали c вашего сайта';
        $view = 'feedback';


        $mail_config = Yii::app()->params['smtp_params'];
        $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
        $mailer->SMTPAuth = TRUE;
        $mailer->IsSMTP();
        $mailer->Host = $mail_config['host'];
        $mailer->Username = $mail_config['user'];
        $mailer->Password = $mail_config['password'];
        $mailer->From = $mail_config['user'];
        $mailer->AddAddress($email);
        $mailer->Subject = $params['title'];
        $mailer->FromName = 'Ваш сайт';
        $mailer->setPathViews('application.views.mailTemplates');
        $mailer->getView($view, $params);

        if (!$mailer->Send()) {
            Yii::log('Try to login with params: ' . print_r($mail_config, 1), 'warning');
            Yii::log($mailer->ErrorInfo, 'warning');
            return false;
        }
        return true;

    }
}
