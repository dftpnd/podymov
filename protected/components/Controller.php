<?php

class Controller extends SBaseController
{

    public $layout = 'main';
    public $menu = array();
    public $breadcrumbs = array();
    public $title = '';


    public function init()
    {
        $cs = Yii::app()->clientScript;
        $cs->registerCoreScript('jquery');
        //$cs->registerCoreScript('jquery.ui');
//        $cs->registerScriptFile($this->createUrl('/js/fileuploader.js'));
        $cs->registerScriptFile($this->createUrl('/js/main.js'));

    }

}

// Yii::app()->clientScript->scriptMap['jquery.ba-bbq.js'] = false;
//$cs->registerScriptFile($this->createUrl('/js/jquery.ba-bbq.js'));