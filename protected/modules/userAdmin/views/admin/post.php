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
                Дата публикации
            </th>
            <th>
                Статус
            </th>
            <th>
                .doc
            </th>
            <th>
                .pdf
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
                    <a href="/site/postview/<?php echo $post->id; ?>" class="post_title_link"
                       title="Передти на страницу публикации">
                        <?php echo $post->title; ?>
                    </a>
                </td>
                <td>
                    <?php echo date('d-m-Y', $post->created); ?>
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
                    <?php if (empty($post->doc_file)): ?>
                        &mdash;
                    <?php else: ?>
                        <a href="/site/file/<?php echo $post->doc_file; ?>"><?php echo $post->uploded_doc->orig_name; ?></a>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if (empty($post->pdf_file)): ?>
                        &mdash;
                    <?php else: ?>
                        <a href="/site/file/<?php echo $post->pdf_file; ?>"><?php echo $post->uploded_pdf->orig_name; ?></a>
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