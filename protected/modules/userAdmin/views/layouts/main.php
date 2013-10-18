<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin.css"/>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin.js"></script>

    <title>Панель администрирования</title>
</head>
<body>
<div class="menu">
    <?php $this->renderPartial('application.modules.userAdmin.views.layouts._menu', array('current_item' => 'about')) ?>
</div>
<div class="content">
    <?php echo $content; ?>
</div>
</body>
</html>


