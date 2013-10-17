<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Helper
 *
 * @author Maks
 */
class MyHelper
{

    public static function commentCount($forum_id)
    {
        return ForumComment::model()->countByAttributes(array('forum_id' => $forum_id));
    }
}

?>
