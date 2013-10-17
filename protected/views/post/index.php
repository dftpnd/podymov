<?php
$class1 = '';
$class2 = '';
if (isset($_GET['topic'])) {
    if ($_GET['topic'] == 1) {
        $class1 = 'active';
    } else {
        $class2 = 'active';
    }
} else {
    $class1 = 'active';
}
?>

<div class="slide_menu">
    <ul class="deep">
        <li class="<?php echo $class1; ?>">
            <?php
            echo CHtml::link('Кафедральные<div class="k_post"></div>', Yii::app()->urlManager->createUrl('post/index', array(
                'group' => '1')), array('async' => 'async'));
            ?>
        </li>
        <li class="<?php echo $class2; ?>">
            <?php
            echo CHtml::link('Мировые<div class="w_post"></div>', Yii::app()->urlManager->createUrl('post/index', array(
                'topic' => '2')), array('async' => 'async'));
            ?>
        </li>
    </ul>
</div>
<div class="content-gallery">

    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'cssFile' => false,
        'viewData' => array(
            'type_1' => $type_1,
            'plus_1' => $plus_1,
            'minus_1' => $minus_1,
            'gost_or_user' => $gost_or_user,
        ),
        'itemView' => '_view2',
        'template' => "{items}\n{pager}",
        'pager' => array(
            'cssFile' => false
        )

    ));
    ?>


</div>