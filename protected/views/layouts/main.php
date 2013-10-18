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
                    <div class="podgotovlen">
                        <div>Сайт разработали:</div>
                        <div style="color: #16a085">Грязнов М.В</div>
                        <div style="color: #8e44ad">Мукминова А.Р.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_login">
        <?php if (Yii::app()->user->isGuest): ?>
            <div class="span4">
                <a class="btn btn-block btn-lg btn-primary" href="/site/prelogin">
                    <div class="image_login">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             id="Layer_1" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 100 100"
                             enable-background="new 0 0 100 100" xml:space="preserve">
<g>
    <path fill="#fff"
          d="M93.645,14.496H34.643c-0.526,0-0.952,0.426-0.952,0.952v10.658c0,0.526,0.425,0.952,0.952,0.952h47.392   v58.432H34.643c-0.526,0-0.952,0.425-0.952,0.95v10.659c0,0.524,0.425,0.952,0.952,0.952h59.001c0.525,0,0.952-0.428,0.952-0.952   V15.447C94.597,14.921,94.17,14.496,93.645,14.496z"/>
    <path fill="#fff"
          d="M41.304,77.416c0,0.352,0.194,0.674,0.505,0.84c0.14,0.075,0.293,0.112,0.447,0.112   c0.186,0,0.372-0.056,0.531-0.163L74.23,57.062c0.263-0.177,0.421-0.473,0.421-0.789c0-0.318-0.158-0.614-0.421-0.791   L42.787,34.339c-0.292-0.196-0.668-0.216-0.978-0.05c-0.311,0.166-0.505,0.488-0.505,0.84v12.504H5.522   c-0.526,0-0.951,0.426-0.951,0.952v15.376c0,0.525,0.425,0.95,0.951,0.95h35.781V77.416z"/>
</g>
</svg>
                    </div>
                    Авторизоваться
                </a>
            </div>
        <?php else: ?>
            <div class="span4">
                <a class="btn btn-block btn-lg btn-primary" href="/userAdmin/admin/index">
                    <div class="image_login">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             id="Layer_1" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 100 100"
                             enable-background="new 0 0 100 100" xml:space="preserve">
<g>
    <path fill="#fff"
          d="M93.645,14.496H34.643c-0.526,0-0.952,0.426-0.952,0.952v10.658c0,0.526,0.425,0.952,0.952,0.952h47.392   v58.432H34.643c-0.526,0-0.952,0.425-0.952,0.95v10.659c0,0.524,0.425,0.952,0.952,0.952h59.001c0.525,0,0.952-0.428,0.952-0.952   V15.447C94.597,14.921,94.17,14.496,93.645,14.496z"/>
    <path fill="#fff"
          d="M41.304,77.416c0,0.352,0.194,0.674,0.505,0.84c0.14,0.075,0.293,0.112,0.447,0.112   c0.186,0,0.372-0.056,0.531-0.163L74.23,57.062c0.263-0.177,0.421-0.473,0.421-0.789c0-0.318-0.158-0.614-0.421-0.791   L42.787,34.339c-0.292-0.196-0.668-0.216-0.978-0.05c-0.311,0.166-0.505,0.488-0.505,0.84v12.504H5.522   c-0.526,0-0.951,0.426-0.951,0.952v15.376c0,0.525,0.425,0.95,0.951,0.95h35.781V77.416z"/>
</g>
</svg>
                    </div>
                    Панель администратора
                </a>
            </div>
        <?php endif; ?>

    </div>
</footer>

</body>
</html>
