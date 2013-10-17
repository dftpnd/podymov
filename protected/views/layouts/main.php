<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="Подымов"/>
    <meta name="description" content="<?php echo CHtml::encode($this->title); ?>"/>
    <meta name="generator" content="АТПП"/>

    <title><?php echo CHtml::encode($this->title); ?></title>
</head>
<body>
<?php // echo $content; ?>

<nav class="main_menu">
    <ul class="centrator">
        <li>
            <a href="#home" onclick="anchorFunction($(this));return false">Главная
                <span class="icon_home"></span>

                <div></div>
            </a>
        </li>
        <li>
            <a href="#mission" onclick="anchorFunction($(this));return false">Публикации
                <span class="icon_mission"></span>

                <div></div>
            </a>
        </li>
        <li>
            <a href="#contact" onclick="anchorFunction($(this));return false">Контакты
                <span class="icon_projects"></span>

                <div></div>
            </a>
        </li>
    </ul>
</nav>
<section>
    <article id="home">
        <div class="article_wrapper">
            <div class="foto"></div>
        </div>
        </article>
<article id="mission">
    <div class="article_wrapper">
    <h2>
            <span>
            Миссия
            </span>

        <div></div>
    </h2>
    </div>
</article>
<article id="contact">
    <div class="article_wrapper">
    <h2>
            <span>
                Форма обратно связи
            </span>

        <div></div>
    </h2>
    <form id="apply" class="centrator">
        <div class='form_description'>От идеи до успешного бизнеса всего один шаг. Оставьте заявку, и мы сделаем
            этот шаг вместе.
        </div>
        <div class="form_designing_wrap">
            <div class="form_designing">
                <input type="text" value="" placeholder="Имя"/>
                <input type="text" value="" placeholder="Фамилия"/>
                <input type="text" value="" placeholder="E-mail" class="last"/>
                <textarea placeholder="Текст сообщения"></textarea>
            </div>
            <button class="submit">Отправить</button>
            <div class="anchor"></div>
        </div>
    </form>
        </div>
</article>
</section>
<footer>

</footer>
</body>
</html>
