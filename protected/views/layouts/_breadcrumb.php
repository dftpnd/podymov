<?php


if (
    ($this->href_controller != '/site') &&
    ($this->href_controller != '/user') &&
    ($this->href_controller != '/files')
    ) {

    $cont_bread['href'] = $this->href_controller;
    $cont_bread['title'] = $this->title_controller;
    array_unshift($crumbs, $cont_bread);
}


if (isset($this->inherited)) {
    $el = Yii::app()->createController($this->inherited);

    $cont_bread['href'] = $el[0]->href_controller;
    $cont_bread['title'] = $el[0]->title_controller;
    array_unshift($crumbs, $cont_bread);
}

$cont_bread['href'] = '/';
$cont_bread['title'] = 'Главная';
array_unshift($crumbs, $cont_bread);

?>
<div class="breadcrumb_wrap">
    <ul class="breadcrumb">
        <?php foreach ($crumbs as $crumb): ?>
            <li><a href="<?php echo $crumb['href']; ?>" async="async"><?php echo $crumb['title']; ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>
<div class="anchor"></div>
