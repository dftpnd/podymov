<?php

class WebUser extends CWebUser {

  private $_model = null;

  function getRole() {
    if ($user = $this->getModel()) {
      // в таблице User есть поле role
      return strtolower($user->itemname);
    }
  }

  private function getModel() {

    if (!$this->isGuest && $this->_model === null) {
      $this->_model = Assignments::model()->with('us')->find('userid = :userid', array(':userid' => $this->id));
      if (!empty($this->_model->us)) {
        $this->_model->us->laste_enter = time();
        $this->_model->us->save(false);
        if ($this->_model->us->banned != 0) {
          Yii::app()->getController()->redirect('/site/banned');
        }
      }
    }
    return $this->_model;
  }

  static function getProfile() {
    $profile = Profile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
    $ret = array();

    if (empty($profile)) {
      $ret[] = '1';
    }
    if (!isset($profile->group_id)) {
      $ret[] = '2';
    }
    if (!isset($profile->name)) {
      $ret[] = '3';
    }
    if (!isset($profile->surname)) {
      $ret[] = '4';
    }
    return $ret;
  }

  static function isPrepod() {
    $profile = Profile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
    if ($profile->status == 2)
      return FALSE;
    else if ($profile->status == 3)
      return TRUE;
  }

}