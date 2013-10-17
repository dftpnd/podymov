<?php

class SiteController extends Controller
{
    public function actionIndex()
    {

        $this->title = 'Главная';
        $this->render('index');


    }

}

