<div class="new_forum_comment">
    <form id="new_forum_comment">
        <input type="hidden" name="forum_id" value="<?php echo $forum_id?>">
        <label>
            Текст
        </label>
        <textarea name="comment_text" ></textarea>
    </form>
    <div class="anchor"></div>
    <input type="submit" onclick="newForumComment($(this))" value="Сохранить"/>

    <div class="anchor"></div>
</div>
