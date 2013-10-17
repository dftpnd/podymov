<?php $val = '';
$tegs = MyHelper::forumTag($forum->id);


?>

<?php if (!empty($tegs)): ?>
    <?php foreach ($tegs as $tag): ?>
        <?php if (isset($tag->tag)): ?>
            <?php $val = $tag->tag->name . ', ' . $val; ?>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>

<div class="vk">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>

    <h1>Создать / изменить вопрос</h1>

    <form id="create_forum" class="default_form">
        <label class="df_lvl_1">
            <div class="info_to_help">Заголовок</div>
            <input type="text" value="<?php echo $forum->title ?>" name="Forum[title]"/>
        </label>
        <label class="df_lvl_1">
            <div class="info_to_help">Содержание</div>
            <textarea name="Forum[content]" class="create_forum_area"><?php echo $forum->content ?></textarea>
        </label>
        <label class="df_lvl_1">
            <div class="info_to_help">Тэги:</div>
            <div class="ui-widget">
                <input id="tags" name="Forum[tags]" value="<?php echo $val; ?>"/>
            </div>
        </label>

        <input type="submit" value="Сохранить" onclick="updateForum(<?php echo $id ?>, $(this));return false"/>
    </form>
</div>