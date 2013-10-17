<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
    <!--    <link href="/favicon.ico" rel="icon" type="image/x-icon"/>-->
    <!--    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon"/>-->
    <!--    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>-->
    <meta name="keywords" content="Подымов"/>
    <meta name="description" content="<?php echo CHtml::encode($this->title); ?>"/>
    <meta name="generator" content="АТПП"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css"/>
    <title><?php echo CHtml::encode($this->title); ?></title>
</head>
<body>

<div id="menu">

</div>
<div id="dynamic_content">
    <?php echo $content; ?>
</div>

</body>
</html>
