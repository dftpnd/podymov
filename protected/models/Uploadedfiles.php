<?php

class Uploadedfiles extends CActiveRecord {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return '{{uploadedfiles}}';
    }

    public function rules() {
        return array(
            array('name, orig_name,ext, size', 'required'),
            array('name, orig_name', 'length', 'max' => 255),
            array('id, name, orig_name, size, ext', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'filetopost' => array(self::HAS_MANY, 'Filetopost', 'file_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'orig_name' => 'Название',
            'size' => 'Объем, Кб',
            'ext' => 'Формат',
        );
    }

    public function search() {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('orig_name', $this->orig_name, true);
        $criteria->compare('size', $this->size, true);
        $criteria->compare('ext', $this->ext, true);
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function findRecentFiles() {
        
    }

    public function search_admin() {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('orig_name', $this->orig_name, true);
        $criteria->compare('size', $this->size, true);
        $criteria->compare('ext', $this->ext, true);
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
                    ),
                ));
    }

    public function noformat() {
        return substr($this->orig_name, 0, - strlen(strrchr($this->orig_name, ".")));
    }

    public function formatsize() {
        $str = strrev($this->size);
        $tstr = '';
        for ($i = 0; $i < strlen($str); $i++) {
            if ($i == 3 || $i == 6 || $i == 9)
                $tstr .= ' ';
            $tstr .= $str[$i];
        }
        return strrev($tstr);
    }
/**
 *функция для удаления файлов и связей с постом
 * 
 * @param type $obj mixed обьект класса Uploadedfiles 
 */
    public static function DeleteFiles($obj) {
        if(empty($obj)){
            return FALSE;
        }
        if (!is_array($obj)) {    //проверка на массив//если массив пропускаем
            $obj = array($obj); //иначе заворачиваем в массив
        }
        $ds = DIRECTORY_SEPARATOR;
        $basePath = Yii::app()->basePath . "{$ds}..{$ds}uploads{$ds}";
        foreach ($obj as $file) {//берем по одному и выполняем действия
            @unlink($basePath . $file->name); //удаляем физ. оригинал
            @unlink($basePath . 'oli_' . $file->name); //удаляем физ oli_оригинал
            @unlink($basePath . 'sm_' . $file->name); //удаляем физ sm_оригинал
            @unlink($basePath . 'thumb_' . $file->name); //удаляем физ thumb_оригинал
//                Uploadedfiles::model()->deleteByPk($file->id); //удаляем из базы
            Filetopost::model()->deleteAllByAttributes(array('file_id' => $file->id));
            $file->delete();
        }
    }

}