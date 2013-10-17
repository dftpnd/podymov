<?php
$m = date('m', $comment->created);
$j = date('j', $comment->created);
$y = date('Y', $comment->created);

$my_picter = Yii::app()->createAbsoluteUrl('i/avatar.png');
if (!is_null($comment->user->prof->file_id)) {
    $file_name = $comment->user->prof->uploadedfiles->name;
    $my_picter = Yii::app()->createAbsoluteUrl('uploads/avatar/avatar_' . $file_name);
}
//еще я часто использую shift + alt + f  == это афтоформат, удобная вещь 
//на саммом деле, у меня уже тут есть заготовки подчти на всё) ща еще один штрих
?>

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.color.js"></script>

<script type="text/javascript">
jQuery(document).ready(function(){
jQuery("div.forum_comment").mouseenter(
function () {
jQuery(this).animate({
borderColor:"#03C",
}, 500 );
});
jQuery("div.forum_comment").mouseleave(function() {
jQuery(this).animate({
borderColor:"#0CF",
}, 500 );
});
});
</script>

<div class="forum_comment">
    <div class="datef"><?php echo $j . ' ' . MyHelper::getRusMonth($m) . ' ' . $y; ?></div><br/>
    <table width=100% border=0><tr><td width=30%><?php echo CHtml::link("<img  src='$my_picter' />", Yii::app()->urlManager->createUrl('/user/ViewProfile', array('id' => $comment->user->prof->id)), array('async' => 'async', 'class' => 'circle_picter')); ?>
    <a href="#" class="clasic"><?php echo MyHelper::getUsername($comment->user_id); ?></a>
            </td>
    <td width=70% class="cont">
    <?php echo $comment->text; ?></td></tr></table>
</div>