<?php
foreach ($posts as $post) {
    $file_name = null;
    $post_name = $post->title;
    $count_all = count($post->filetopost);
    $hide_cont = count(Uploadedfiles::model()->findAllByAttributes(array('invisible' => '1')));
    $count = $count_all - $hide_cont;
    if ($post->cover != null) {
        $file_name = $post->cover->name;
    } else {
        if (!empty($post->filetopost[0])) {
            if (!empty($post->filetopost[0]->file)) {
                $file_name = $post->filetopost[0]->file->name;
            }
        }
    }

    if (!is_null($file_name)) {
        echo '<div class="konfetka">';
        if (Yii::app()->user->id == 1) {
            echo '<div class="redact">';
            echo '</div>';
            echo CHtml::link('', Yii::app()->urlManager->createUrl('site/phototools', array('post_id' => $post->id)), array('class' => 'phototools_link'));
        }


        echo CHtml::link('<div class="iformation"><span>' . $post_name . '</span><div class="name_post"></div><div class="col">' . $count . '</div></div><img src="../uploads/thumb_' . $file_name . '" />', Yii::app()->urlManager->createUrl('post/scrapbook', array('post_id' => $post->id)), array('class' => 'album', 'id' => ''));
        echo '</div>';
    } else {
        echo 'ПОСТ БЕЗ КАРТИНОК';
    }
}
?>
<div class="anchor"></div>