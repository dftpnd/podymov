<?php

/**
 * This is the model class for table "{{folder}}".
 *
 * The followings are the available columns in table '{{folder}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property integer $created
 * @property integer $private_status
 * @property integer $parent_id
 */
class Folder extends CActiveRecord {

  const FOLDER = 1;
  const FILE = 2;
  const FILE_SHOW = 1;
  const FILE_HIDE = 2;

  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return Folder the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{folder}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
        array('user_id, name, created', 'required'),
        array('user_id, created, private_status, parent_id', 'numerical', 'integerOnly' => true),
        array('name', 'length', 'max' => 255),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('id, user_id, name, created, private_status, parent_id', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
        'parent' => array(self::BELONGS_TO, 'Folder', 'parent_id'),
        'ps' => array(self::BELONGS_TO, 'Privatestatus', 'private_status'),
        'uploadedfiles' => array(self::BELONGS_TO, 'Uploadedfiles', 'uploads_id'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
        'id' => 'ID',
        'user_id' => 'User',
        'name' => 'Name',
        'created' => 'Created',
        'private_status' => 'Private Status',
        'parent_id' => 'Parent',
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
    $criteria->compare('user_id', $this->user_id);
    $criteria->compare('name', $this->name, true);
    $criteria->compare('created', $this->created);
    $criteria->compare('private_status', $this->private_status);
    $criteria->compare('parent_id', $this->parent_id);

    return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
  }

  public static function checkAccess($folder) {
    if (Yii::app()->user->isGuest) {
      return FALSE;
    }

    $user = User::model()->findByPk(Yii::app()->user->id);

    if ($user->id == $folder->user_id)
      return TRUE;

    switch ($folder->private_status) {
      case PrivateStatus::ONLY_ME:
        return FALSE;
        break;
      case PrivateStatus::ME_AND_STUDENTS:
        if ($user->prof->status == 2)
          return TRUE;
        break;
      case PrivateStatus::ME_AND_TEACHERS:
        if ($user->prof->status == 3)
          return TRUE;
        break;
      case PrivateStatus::EVERYONE:
        return TRUE;
        break;
      default:
        break;
    }

    return FALSE;
  }

  public static function getMyFolder($folder_id, $parent_id = 0) {


    if ($folder_id == 0) {
      $folder = new Folder();
      $folder->parent_id = $parent_id;
    } else {
      $folder = self::model()->findByPk($folder_id);

      if (empty($folder)) {
        echo json_encode(array('status' => 'faile', 'error' => 'Не существует такой папки'));
        Yii::app()->end();
      }

      if ($folder->user_id !== Yii::app()->user->id) {
        echo json_encode(array('status' => 'faile', 'error' => 'У вас нет доступа'));
        Yii::app()->end();
      }
    }


    return $folder;
  }

  public static function deleteFolder($folder_id) {
    $folder = self::model()->findByPk($folder_id);

    if (empty($folder)) {
      return array('status' => 'faile', 'error' => 'Не существует такой папки');
    }

    if ($folder->user_id !== Yii::app()->user->id) {
      return array('status' => 'faile', 'error' => 'У вас нет доступа');
    }

    $folder->hide = self::FILE_HIDE;
    if ($folder->save()) {
      return array('status' => 'success');
    } else {
      return array('status' => 'faile', 'error' => 'Ошибка. что то пошло не так');
    }
  }

  public static function getAvailableFolder($parent_id, $author_id, $cond = self::FILE_SHOW) {
    if (Yii::app()->user->isGuest) {
      Yii::app()->user->logout();
      Yii::app()->getController()->redirect('/site/login');
    }


    $user_id = Yii::app()->user->id;

    if ($author_id == $user_id) {
      return self::model()->findAllByAttributes
                      (
                      array(
                  'user_id' => $author_id,
                  'parent_id' => $parent_id,
                  'hide' => $cond
                      ), array('order' => 'created  DESC')
      );
    } else {

      $user = User::model()->findByPk($user_id);


      switch ($user->prof->status) {
        case Profile::STUDENT:
          //вытащить разрешенные для студентов и для всех
          $privete_status = PrivateStatus::ME_AND_STUDENTS;
          break;
        case Profile::PREPOD:
          //вытащить разрешенные для преподов и для всех
          $privete_status = PrivateStatus::ME_AND_TEACHERS;
          break;
        default:
          die('а кто ты?');
          break;
      }

      return self::model()->findAll(
                      array(
                          'order' => 'created DESC',
                          'condition' =>
                          '(
                            parent_id = ' . $parent_id . '
                            and
                            user_id = ' . $author_id . '
                            and
                            hide = ' . $cond . '  
                            and 
                            private_status in (' . $privete_status . ', ' . PrivateStatus::EVERYONE . '))',
              ));
    }
  }

  public static function recursiveBuild($array, $relation) {
    if (isset($relation->parent_id)) {
      $array[$relation->id] = $relation->name;
      return $array + self::recursiveBuild($array, $relation->parent);
    } else {
      return $array;
    }
  }

  public static function breadcrambs($parent_id, $user_id) {
    if ($parent_id == 0)
      return array();

    $array = array();
    $folder = self::model()->findByAttributes(array(
        'id' => $parent_id,
        'user_id' => $user_id
            ));

    $breadcrambs = self::recursiveBuild($array, $folder);

    if (empty($breadcrambs))
      return $breadcrambs;
    else
      return array_reverse($breadcrambs, true);
  }

  public static function allowedExtensions() {
    $array = array(
        "png",
        "jpg",
        "jpeg",
        "gif", //картинки
        "rar",
        "zip", //архивы
        "doc",
        "docx",
        "xlsx",
        "pdf",
        "txt", //документы
        "mp3",
        "exe",
        'html',
        'js',
        'css',
        'djvu',
        "", //без расширения
    );
    return $array;
  }

  public static function basePath($user_id) {
    $uf = DIRECTORY_SEPARATOR;

    $basePath = Yii::app()->basePath . "{$uf}..{$uf}uploads{$uf}user_{$user_id}{$uf}";
    if (!file_exists($basePath))
      mkdir($basePath);

    return $basePath;
  }

}