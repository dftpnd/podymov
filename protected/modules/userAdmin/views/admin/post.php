<ol class="breadcrumb">
    <li class="active">Публикации</li>
</ol>


<div class="page-header">
    <a href="/userAdmin/admin/postedit" class="btn btn-primary btn-lg btn_reate_publish">Создать
        публикацию</a>

    <div class="anchor"></div>
</div>

<div class="page-header">
    <h1>Список публикаций</h1>
    <?php if (!empty($posts)): ?>
    <table class="table">
        <tr>
            <th>
                №
            </th>
            <th>
                Заголовок
            </th>
            <th>
                Статус
            </th>
            <th>

            </th>
            <th>

            </th>
        </tr>
        <?php foreach ($posts as $post): ?>
            <tr post_id="<?php echo $post->id ?>">
                <td>
                    <?php echo $post->id; ?>
                </td>
                <td>
                    <a href="/uploads/<?php echo $post->uploded_pdf->name; ?>" class="post_title_link"
                       title="Передти на страницу публикации">
                        <?php echo $post->title; ?>
                    </a>


                </td>
                <td>
                    <?php if ($post->visible == 0): ?>
                        <div class="status_red">
                            Публикация скрыта
                        </div>
                    <?php else: ?>
                        <div class="status_green">
                            Публикация видна
                        </div>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="/userAdmin/admin/postedit?post_id=<?php echo $post->id ?>">
                        Редактировать
                    </a>
                </td>
                <td>
                    <span class="delete_publish" title="Удалить безвозвратно" onclick="deletePublish($(this))">
                        Удалить
                    </span>
                </td>
            </tr>
        <?php endforeach; ?>
        <table>
            <?php else: ?>
                <h3>У вас пока нет созданных публикация</h3>
            <?php
            endif;
            ?>
</div>