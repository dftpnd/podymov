<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Панель управления сайтом</title>
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/jquery.jgrowl.min.css" rel="stylesheet">
    <link href="/css/admin.css" rel="stylesheet">
</head>
<body>
<div class="loaderus"></div>
<div class="container">
    <div class="masthead">
        <h3 class="text-muted">Панель управления сайтом</h3>
        <?php $this->renderPartial('application.modules.userAdmin.views.layouts._menu') ?>
    </div>
    <?php echo $content; ?>
    <div class="footer"></div>

</div>
<div id="jgrowl_error" class="jGrowl top-right"></div>
<div id="jgrowl_success" class="jGrowl top-right"></div>
<div id="jgrowl_complete" class="jGrowl center"></div>
</body>
</html>
