<?php

class ProjectController extends Controller
{


    public $title_controller = 'Проекты';
    public $href_controller = '/project';
    public $inherited = 'Reestr';

    public function actionIndex()
    {
        $title = 'Проекты';
        MyHelper::render($this, 'index', array(), $title);
    }

    public function actionDampfturbine()
    {
        $this->pageTitle = 'Мой проект';

        $this->renderPartial('MyProjrct');
    }

}