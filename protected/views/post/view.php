<?php $this->pageTitle = $model->title; ?>
<?php
$this->renderPartial('_view', array(
    'data' => $model,
    'gost_or_user' => $gost_or_user,
    'type_1' => $type_1,
    'plus_1' => $plus_1,
    'minus_1' => $minus_1
));
?>

<div id="comments">
    <?php if ($model->commentCount >= 1): ?>
        <h2 class="comments_title">комментарии(<?php echo $model->commentCount; ?>)</h2>
        <?php
        $comments = $model->comments;

        if (Yii::app()->user->isGuest) {
            $gost_or_user = 'gost';
        } else {
            $gost_or_user = 'user';
        }
        $type = ObjectRating::TYPE_COM;
        $plus = ObjectRating::PLUS;
        $minus = ObjectRating::MINUS;


        foreach ($comments as $comment) {
            $this->renderPartial('_comments', array(
                'post' => $model,
                'comment' => $comment,
                'type' => $type,
                'plus' => $plus,
                'minus' => $minus,
                'gost_or_user' => $gost_or_user
            ));
        }
        ?>
    <?php endif; ?>

</div><!-- comments -->
<div class="rgb">
    <?php if (Yii::app()->user->isGuest): ?>
        <div class="">Только зарегистрированные пользователи могут оставлять комментарии. <span class="classic" onclick='EnterSite()'>Войдите</span>, пожалуйста.</div>
    <?php else: ?>
        <?php $this->renderPartial('/comment/_form', array('model' => $comment, 'post_id' => $model->id)); ?>
    <?php endif; ?>
</div>

