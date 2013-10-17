<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru" >
<head>
    <link href="/favicon.ico" rel="icon" type="image/x-icon"/>
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="АТПП, Кафедра КГЭУ Автоматизации Технологических Процессов и Производств"/>
    <meta name="description" content="<?php echo CHtml::encode($this->pageTitle); ?>"/>
    <meta name="generator" content="АТПП"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css"/>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<?php if (Yii::app()->user->isGuest): ?>
    <?php $authorizad = 'notauthorizad' ?>
<?php else: ?>
    <?php $authorizad = 'authorizad' ?>
<?php endif; ?>
<body class="home blog <?php echo $authorizad ?>" >
<h1 class="nonedisplay">АТПП, Кафедра КГЭУ Автоматизации Технологических Процессов и Производств</h1>

<div class="oshib"></div>
<div class="fixed_panel_for_close" title="Закрыть" onclick="ClearFileGroup()"></div>
<div class="door">
    <div class="door_box_1">
        <div class="my_cont">
            <div class="big_but close_door"></div>
            <div class="kamen" onclick="event.stopPropagation()">
                <div class="title_door">
                    <h1></h1>

                    <div class="zakrytb" onclick='closeDoor()'>Закрыть</div>
                </div>
                <div class="insert_here">
                </div>
            </div>
        </div>
    </div>
    <div class='door_box_2 close_door'></div>
</div>
<div id="notice" class="notice_block_yellow">
    <div class="notice_hide" onclick="noticeHide()"></div>
    <div class="notice_insert">
        <div class="notice_text">
            Ваш голос учтен
        </div>
    </div>
</div>
<div class="universe">
    <div class="is-home wrapper cacada_4">
        <div class="in_head">
            <div class="header midelton">
                <div class="header-box-image"></div>
                <a href="<?php echo Yii::app()->urlManager->createUrl('site/index'); ?>" id="logo" async="async"
                   title="Главная"></a>

                <div id="search">
                    <label for="search_inp">Введите текст</label>
                    <input id="search_inp" type="search"/>
                </div>
                <div id="menu">
                    <?php $this->renderPartial('application.views.layouts._menu', array('current_item' => 'about')) ?>
                </div>
            </div>

        </div>
        <div class="pila_top"></div>
        <div class="contentus midelton">
            <div class="content_loader">
                <div id="cl_ajax" class="cl_ajax"></div>
            </div>
            <?php if (!Yii::app()->user->isGuest): ?>
                <?php $this->renderPartial('application.views.layouts._menu_work', array('current_item' => 'about')); ?>
                <img class="up_head" title="Вверх!"
                     src="<?php echo Yii::app()->request->baseUrl; ?>/i/sky/apeak_0.png"/>
                <div id="yaokor"></div>
            <?php endif; ?>
            <div id="dynamic_content">
                <?php echo $content; ?>
            </div>
            <div class="push"></div>
        </div>
    </div>
    <div class="footer ">
        <div class="pila_bot"></div>
        <div class="midelton">
            <div class="footer_spa">
                <a class="git-hub" href="https://github.com/lkdnvc/atpp"></a>

                <div class="table_t foter_menu">
                    <div class="tr_t">
                        <div class="td_t">
                            <a href="/site/photos" class="aspx_7" async="async">Кафедра в лицах</a>
                        </div>
                        <div class="td_t">
                            <a href="/site/contact" class="aspx_4" async="async">Контакты</a>
                        </div>
                    </div>
                    <div class="tr_t">
                        <div class="td_t">
                            <a href="#" class="aspx_3" async="async">Что такое АТПП?</a>
                        </div>
                        <div class="td_t">
                            <a href="#" class="aspx_8" async="async">Научная работа</a>
                        </div>
                    </div>
                </div>
                <div class="year">
                    2000 - <?php echo date('Y') ?>
                </div>
                <div class="caros">
                    &copy; Кафедра КГЭУ &laquo;Автоматизации Технологических Процессов и Производств&raquo;
                </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>
