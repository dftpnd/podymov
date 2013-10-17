<?php

if (!empty($discussions)) {
    foreach ($discussions as $discussion) {
        if ($discussion->parent_id == NULL)
            $this->renderPartial('application.views.user._small_post', array(
                'discussion' => $discussion,
                'type' => $type,
                'plus' => $plus,
                'minus' => $minus,
                'profile' => $profile,
                'hozyin' => $hozyin
                    )
            );
    }
}
?>