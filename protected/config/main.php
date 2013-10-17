<?php

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'podymov',
    'language' => 'ru',
    'preload' => array('log'),
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.srbac.controllers.SBaseController',
        'application.modules.*',
    ),
    'defaultController' => 'site',
    'modules' => array(
        'srbac' => array(
            'userclass' => 'User',
            'userid' => 'id',
            'username' => 'username',
            'debug' => false,
            'delimeter' => "@",
            'pageSize' => 10,
            'superUser' => 'Authority',
            'css' => 'srbac.css',
            'layout' => 'application.views.layouts.main',
            'notAuthorizedView' => 'srbac.views.authitem.unauthorized',
            'userActions' => array('show', 'View', 'List'),
            'listBoxNumberOfLines' => 15,
            'imagesPath' => 'srbac.images',
            'imagesPack' => 'tango',
            'iconText' => false,
            'header' => 'srbac.views.authitem.header',
            'footer' => 'srbac.views.authitem.footer',
            'showHeader' => true,
            'showFooter' => true,
            'alwaysAllowedPath' => 'srbac.components',
        ),
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '7878',
            'ipFilters' => array('*'),
        ),
        'userAdmin',
    ),
    'components' => array(
        'ih' => array(
            'class' => 'CImageHandler',
        ),
        'mailer' => array(
            'class' => 'application.extensions.mailer.EMailer',
            'pathViews' => 'application.views.email',
            'pathLayouts' => 'application.views.email.layouts'
        ),
        'authManager' => array(
            'class' => 'srbac.components.SDbAuthManager',
            'connectionID' => 'db',
            'itemTable' => 'items',
            'assignmentTable' => 'assignments',
            'itemChildTable' => 'itemchildren',
        ),
        'user' => array(
            'class' => 'WebUser',
            'allowAutoLogin' => true,
        ),
        'db' => require(dirname(__FILE__) . '/db.php'),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
    ),
    'params' => require(dirname(__FILE__) . '/params.php'),
);
