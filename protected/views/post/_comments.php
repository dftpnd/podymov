<?php
if ($gost_or_user == 'user') {
    $text_script_plus = "ObjectRating($type,$comment->id,$plus)";
    $text_script_minus = "ObjectRating($type,$comment->id,$minus)";
    $div_title_plus = 'Нравится';
    $div_title_minus = 'Не нравится';
} else if ($gost_or_user == 'gost') {
    $text_script_plus = '';
    $text_script_minus = '';
    $div_title_plus = $div_title_minus = 'Только зарегистрированные пользователи могут голосовать';
}
?>
<div class="anchor" ></div>
<div class="comment" id="c<?php echo $comment->id; ?>" >
    <div class="object_rating">
        <div class="object_plus" onclick='<?php echo $text_script_plus; ?>' title="<?php echo $div_title_plus; ?>">
        </div>
        <?php
        $znak_plus = '';
        if (!is_null($comment->rating)) {
            $state = $comment->rating;
            if ($state > 0) {
                $class = 'poloj';
                $znak_plus = '+';
            } else if ($state < 0) {
                $class = 'otr';
            } else {
                $class = 'null';
            }
        } else {
            $state = '0';
            $class = 'null';
        }
        ?>
        <div class="object_state <?php echo $class; ?>">
            <?php echo $znak_plus . $state; ?>
        </div>
        <div class="object_minus" onclick='<?php echo $text_script_minus; ?>' title="<?php echo $div_title_minus; ?>">
        </div>
    </div>
    <div class="table_t">
        <div class="tr_t">
            <div class="td_t">
                <?php
                $picter = Yii::app()->createAbsoluteUrl('i/mini_avatar.png');
                if (isset($comment->profile))
                    if (!is_null($comment->profile->file_id)) {
                        $file_name = $comment->profile->uploadedfiles->name;
                        $picter = Yii::app()->createAbsoluteUrl('uploads/avatar/mini_' . $file_name);
                    }
                ?>

                <?php
                echo CHtml::link(
                        "<img  src='$picter' />", Yii::app()->urlManager->createUrl('/user/ViewProfile', array('id' => $comment->profile->id)), array(
                    'title' => $comment->profile->name . ' ' . $comment->profile->surname,
                    'style' => 'display:block',
                    'async' => 'async',
                ));
                ?>
            </div>
            <div class="td_t">
                <div class="table_t">
                    <div class="tr_t">
                        <div class="td_t coment_fix" >
                            <?php
                            echo CHtml::link(
                                    $comment->profile->name . ' ' . $comment->profile->surname, Yii::app()->urlManager->createUrl('/user/ViewProfile', array('id' => $comment->profile->id)), array(
                                'class' => 'classic',
                                'async' => 'async'
                                    )
                            );
                            ?>
                        </div>
                        <div class="td_t coment_fix">
                            <div class="time">
<?php echo Utils::time($comment->create_time); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$opacity = '1';
if ($state < 0) {
    if ($state < -10) {
        $opacity = 0.1;
    } else {
        $opacity = '0.' . (10 + $state);
    }
}
?>
    <div class="comment_content" style="opacity:<?php echo $opacity ?>">
    <?php echo nl2br(CHtml::encode($comment->content)); ?>
    </div>
    <div class="anchor"></div>
</div><!-- comment -->
<div class="anchor" ></div>
