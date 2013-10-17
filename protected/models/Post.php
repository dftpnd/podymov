<?php

class Post extends CActiveRecord
{

    const STATUS_DRAFT = 1;
    const STATUS_PUBLISHED = 2;
    const STATUS_ARCHIVED = 3;

    private $_oldTags;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{post}}';
    }

    public function rules()
    {
        return array(
            array('title, content, status', 'required'),
            array('status', 'in', 'range' => array(1, 2, 3)),
            array('title, show_foto', 'length', 'max' => 128),
            array('tags', 'match', 'pattern' => '/^[\w\s,]+$/', 'message' => 'Tags can only contain word characters.'),
            array('tags', 'normalizeTags'),
            array('title, status, show_foto', 'safe', 'on' => 'search'),
            array('title, content_previews, show_foto, status, topic', 'required'),
            array('title, status', 'required'),
        );
    }

    public function relations()
    {

        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.

        return array(
            'author' => array(self::BELONGS_TO, 'User', 'author_id'),
            'profile' => array(self::BELONGS_TO, 'Profile', 'profile_id'),
            'comments' => array(self::HAS_MANY, 'Comment', 'post_id', 'condition' => 'comments.status=' . Comment::STATUS_APPROVED, 'order' => 'comments.create_time ASC'),
            'commentCount' => array(self::STAT, 'Comment', 'post_id', 'condition' => 'status=' . Comment::STATUS_APPROVED),
            'filetopost' => array(self::HAS_MANY, 'Filetopost', 'post_id'),
            'cover' => array(self::BELONGS_TO, 'Uploadedfiles', 'cover_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {

        return array(
            'profile_id' => 'profile_id',
            'id' => 'Идентификатор',
            'title' => 'Заголовок',
            'content' => 'Контент',
            'tags' => 'Тема',
            'status' => 'Статус',
            'create_time' => 'Время создания',
            'update_time' => 'Время редактирования',
            'author_id' => 'Автор',
            'content_previews' => 'Предпросмотр',
            'show_foto' => 'Показывать фотогалерею на вкладке "Фотогалерея" ?',
        );
    }

    /**
     * @return string the URL that shows the detail of the post
     */
    public function getUrl()
    {
        return Yii::app()->createUrl('post/view', array('id' => $this->id));
    }

    /**
     * @return array a list of links that point to the post list filtered by every tag of this post
     */
    public function getTagLinks()
    {

        $links = array();

        foreach (Tag::string2array($this->tags) as $tag)
            $links[] = CHtml::link(CHtml::encode($tag), array('post/index', 'tag' => $tag));

        return $links;
    }

    /**
     * Normalizes the user-entered tags.

     */
    public function normalizeTags($attribute, $params)
    {

        $this->tags = Tag::array2string(array_unique(Tag::string2array($this->tags)));
    }

    /**
     * Adds a new comment to this post.
     * This method will set status and post_id of the comment accordingly.
     * @param Comment the comment to be added
     * @return boolean whether the comment is saved successfully
     */
    public function addComment($comment)
    {

        if (Yii::app()->params['commentNeedApproval'])
            $comment->status = Comment::STATUS_PENDING;

        else
            $comment->status = Comment::STATUS_APPROVED;

        $comment->post_id = $this->id;

        return $comment->save();
    }

    /**
     * This is invoked when a record is populated with data from a find() call.

     */
    protected function afterFind()
    {

        parent::afterFind();

        $this->_oldTags = $this->tags;
    }

    /**
     * This is invoked before the record is saved.
     * @return boolean whether the record should be saved.
     */
    protected function beforeSave()
    {

        if (parent::beforeSave()) {

            if ($this->isNewRecord) {

                $this->create_time = $this->update_time = time();

                $this->author_id = Yii::app()->user->id;
            } else
                $this->update_time = time();

            return true;
        } else
            return false;
    }

    /**
     * This is invoked after the record is saved.

     */
    protected function afterSave()
    {

        parent::afterSave();
//
//        Tag::model()->updateFrequency($this->_oldTags, $this->tags);
    }

    /**
     * This is invoked after the record is deleted.

     */
    protected function afterDelete()
    {

        parent::afterDelete();

        Comment::model()->deleteAll('post_id=' . $this->id);

        //  Tag::model()->updateFrequency($this->tags, '');
    }

    /**
     * Retrieves the list of posts based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the needed posts.
     */
    public function search()
    {

        $criteria = new CDbCriteria;

        $criteria->compare('title', $this->title, true);

        $criteria->compare('status', $this->status);

        return new CActiveDataProvider('Post', array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'status, update_time DESC',
            ),
        ));
    }

    /*
     *           'profile_id' => 'profile_id',
            'id' => 'Идентификатор',
            'title' => 'Заголовок',
            'content' => 'Контент',
            'tags' => 'Тема',
            'status' => 'Статус',
            'create_time' => 'Время создания',
            'update_time' => 'Время редактирования',
            'author_id' => 'Автор',
            'content_previews' => 'Предпросмотр',
            'show_foto' => 'Показывать фотогалерею на вкладке "Фотогалерея" ?',*/

    public function search_my()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('status', $this->status, true);
        $criteria->compare('topic', $this->topic, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => '5',

            ),
            'sort' => array(
                'defaultOrder' => 'status, update_time DESC',
            ),
        ));
    }


}