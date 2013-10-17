<?php

class Video extends CActiveRecord
{

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{video}}';
	}

	public function rules()
	{
		return array(
			array('url, date, user_id, size', 'required'),
			array('category_id, date_update,  date, user_id, size, status_id, view, like, dislike, rating', 'numerical', 'integerOnly' => true),
			array('name, tags, mime_type', 'length', 'max' => 255),
			array('name, category_id, description, url, thumbnail_url', 'safe'),
			array('id, name,date_update, description, url, tags, thumbnail_url, category_id,  date, user_id, size, mime_type, status_id, view, like, dislike, rating', 'safe', 'on' => 'search'),
		);
	}

	public function relations()
	{
		return array(
			'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
			'status' => array(self::BELONGS_TO, 'VideoStatus', 'status_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'comment' => array(self::HAS_MANY, 'Comment', 'video_id',
				'condition' => 'comment.parent_id=0', 'order' => 'comment.time ASC',),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'description' => 'Description',
			'url' => 'Url',
			'tags' => 'Tags',
			'thumbnail_url' => 'Thumbnail Url',
			'category_id' => 'Category',
			'date_update' => 'Update Date',
			'date' => 'Date',
			'user_id' => 'User',
			'size' => 'Size',
			'mime_type' => 'Mime Type',
			'status_id' => 'Status',
			'view' => 'View',
			'like' => 'Like',
			'dislike' => 'Dislike',
			'rating' => 'Rating',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('url', $this->url, true);
		$criteria->compare('tags', $this->tags, true);
		$criteria->compare('thumbnail_url', $this->thumbnail_url, true);
		$criteria->compare('category_id', $this->category_id);
		$criteria->compare('date', $this->date);
		$criteria->compare('date_update', $this->date_update);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('size', $this->size);
		$criteria->compare('mime_type', $this->mime_type, true);
		$criteria->compare('status_id', $this->status_id);
		$criteria->compare('view', $this->view);
		$criteria->compare('like', $this->like);
		$criteria->compare('dislike', $this->dislike);
		$criteria->compare('rating', $this->rating);

		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
					'pagination' => array(
						'pageSize' => Yii::app()->params['pageSize'],
					),
				));
	}

	public function search_my()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('url', $this->url, true);
		$criteria->compare('tags', $this->tags, true);
		$criteria->compare('thumbnail_url', $this->thumbnail_url, true);
		$criteria->compare('category_id', $this->category_id);
		$criteria->compare('date', $this->date);
		$criteria->compare('date_update', $this->date_update);
		$criteria->compare('user_id', Yii::app()->user->id);
		$criteria->compare('size', $this->size);
		$criteria->compare('mime_type', $this->mime_type, true);
		$criteria->compare('status_id', $this->status_id);
		$criteria->compare('view', $this->view);
		$criteria->compare('like', $this->like);
		$criteria->compare('dislike', $this->dislike);
		$criteria->compare('rating', $this->rating);

		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
					'pagination' => array(
						'pageSize' => Yii::app()->params['pageSize'],
					),
				));
	}

	
	
	public function search_admin()
	{
		$criteria = new CDbCriteria;
		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('url', $this->url, true);
		$criteria->compare('tags', $this->tags, true);
		$criteria->compare('thumbnail_url', $this->thumbnail_url, true);
		$criteria->compare('category_id', $this->category_id);
		$criteria->compare('date', $this->date);
		$criteria->compare('date_update', $this->date_update);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('size', $this->size);
		$criteria->compare('mime_type', $this->mime_type, true);
		$criteria->compare('status_id', $this->status_id);
		$criteria->compare('view', $this->view);
		$criteria->compare('like', $this->like);
		$criteria->compare('dislike', $this->dislike);
		$criteria->compare('rating', $this->rating);

		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
					'pagination' => array(
						'pageSize' => Yii::app()->params['pageSize'],
					),
				));
	}
	
	public function search_main()
	{
		$criteria = new CDbCriteria;

		//$criteria->compare('id', $this->id);
		
		
		if (!empty($_GET['Video_search']))
		{	
			$like = explode(" ", trim(mb_strtolower($_GET['Video_search'],'UTF-8')));
			$sql1 = array();
			$sql2 = array();
			foreach ($like as $key => $value)
			{
				$sql1[] = " t.name LIKE '%" . trim($value) . "%' ";
				$sql2[] = " t.description LIKE '%" .  trim($value) . "%' ";
			}
			$criteria->addCondition('(' . implode(' OR ', $sql1) . ') OR (' . implode(' OR ', $sql2) . ')');
		} else
		{
			$criteria->compare('name', $this->name, true);
			$criteria->compare('description', $this->description, true);
		}
		$criteria->compare('url', $this->url, true);
		$criteria->compare('tags', $this->tags, true);
		$criteria->compare('thumbnail_url', $this->thumbnail_url, true);
		$criteria->compare('category_id', $this->category_id);
		$criteria->compare('date', $this->date);
		$criteria->compare('date_update', $this->date_update);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('size', $this->size);
		$criteria->compare('mime_type', $this->mime_type, true);
		$criteria->compare('status_id', 4);
		$criteria->compare('view', $this->view);
		$criteria->compare('like', $this->like);
		$criteria->compare('dislike', $this->dislike);
		$criteria->compare('rating', $this->rating);
		$criteria->order = 'FROM_UNIXTIME(date,"%Y%D%M") DESC, rating DESC';


		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
					'pagination' => array(
						'pageSize' => Yii::app()->params['pageSize'],
					),
				));
	}

	public function getSize($retstring = null)
	{
		$sizes = array('bytes', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');

		if ($retstring === null)
			$retstring = '%01.2f %s';

		$lastsizestring = end($sizes);

		foreach ($sizes as $sizestring)
		{
			if ($this->size < 1024)
				break;

			if ($sizestring != $lastsizestring)
				$this->size /= 1024;
		}

		if ($sizestring == $sizes[0])
			$retstring = '%01d %s';

		return sprintf($retstring, $this->size, $sizestring);
	}

}