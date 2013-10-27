<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="Подымов В.Н."/>
    <meta name="description" content="Подымов В.Н."/>
    <title>Подымов В.Н.</title>
</head>
<body>
<?php echo $content; ?>
<footer>
    <a href="#" class="login" title="Вход"></a>

    <div class="foter_info centrator">
        <div class="table table_classic">
            <div class="tr">
                <div class="td">
                    <span class="year_continea">2013 &mdash; <?php echo date('Y'); ?></span>

                    <div>
                        &copy; Сайт Подымова В.Н.
                    </div>
                </div>
                <div class="td">

                </div>
            </div>
        </div>
    </div>
    <div class="footer_login">
        <?php if (Yii::app()->user->isGuest): ?>
            <div class="span4">
                <a class="btn btn-block btn-lg btn-primary" href="/site/prelogin">
                    <span class="icon-key"></span>
                    Авторизоваться
                </a>
            </div>
        <?php else: ?>
            <div class="span4">
                <a class="btn btn-block btn-lg btn-primary" href="/userAdmin/admin/index">
                    <span class="icon-key"></span>
                    Панель администратора
                </a>
            </div>
        <?php endif; ?>

    </div>
</footer>

</body>
</html>
