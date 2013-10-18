<?php


class AdminController extends Controller
{

    public $layout = 'main';

    public function init()
    {
        if (Yii::app()->user->isGuest) {
            Yii::app()->getController()->redirect('/site/prelogin');
            Yii::app()->end();
        }
    }

    public function actionIndex()
    {
        $this->render('index');
    }

}