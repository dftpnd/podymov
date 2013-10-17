<script>
    $.fn.alf = function (data) {
        var tag = 'div';
        if(data.tag)
            tag = data.tag;

        var items = this.find(tag);
        var leters = [];

        items.each(function(index) {
            leters[index] = $(this).html();
        });

        leters.sort(function(a, b) {
            var compA = a.toUpperCase();
            var compB = b.toUpperCase();
            return (compA < compB) ? -1 : (compA > compB) ? 1 : 0;
        });

        var html = '';
        $.each(leters,function(index) {
            html += '<'+tag+'>' +leters[index] + '</'+tag+'>' ;
        });

        this.html('').html(html);
        return this;
    };


    $('#alf').alf({tag:'span'});


</script>

<?php if (isset($_GET['tag_id'])): ?>
    <a href="/forum/index" class="classic delete_sort" async="async">Убрать сортировку</a>
    <style>
        .tag_ <?php echo $_GET['tag_id'];?> {
            background: #00FF66 !important;
        }
    </style>
<?php endif; ?>

<?php if (!Yii::app()->user->isGuest): ?>
    <div class="create_forum" onclick="openUpdateForum(0)"><input type="submit" value="Создать обсуждение"/></div>
<?php endif; ?>

<div class="anchor"></div>
<div class="forum_area">
    <div class="forum_tag">
        <div class="forum_tag_obert">
            <h3>Список тэгов:</h3>
            <?php if (!empty($tags)): ?>
                <?php foreach ($tags as $tag_id => $tag): ?>
                    <?php if ($tag['count'] != 0): ?>
                        <a async="async" href="/forum/index?tag_id=<?php echo $tag_id; ?>" title="<?php echo $tag['name']; ?>" >#<?php echo $tag['name']; ?>(<?php echo $tag['count']; ?>)</a>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="forum_content">
        <?php $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '/forumTag/_view',
            'cssFile' => false,
            'template' => '{items}  {pager}',
            'afterAjaxUpdate'=> 'function(){NProgress.done();}',
            'beforeAjaxUpdate'=> 'function(){$(document).scrollTop("0");scroll = 0;NProgress.start();}',
            'pager' => array(
                'cssFile' => false,

            )
        )); ?>
    </div>
    <div class="anchor"></div>
</div>



