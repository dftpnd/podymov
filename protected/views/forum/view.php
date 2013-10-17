<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '/forumTag/_view',
    'cssFile' => false,
    'template'=>"{items}",
    'pager' => array(
        'cssFile' => false
    )
));
?>
<h1>Коментариии</h1>
<a name="comments"></a>
<?php
//all comment

foreach ($comments as $comment) {
    $this->renderPartial('_view_comment',
        array(
            'comment' => $comment,
        ));
}

//new comment
$this->renderPartial('_new_comment', array(
    'forum_id' => $forum_id
));
?>
