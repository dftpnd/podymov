<?php if (isset($_GET['post_id'])): ?>
    <?php $st = "Редактирование" ?>
<?php else: ?>
    <?php $st = "Создание" ?>
<?php endif; ?>

<ol class="breadcrumb">
    <li><a href="/userAdmin/admin/post">Публикации</a></li>
    <li class="active"><?php echo $st;?></li>
</ol>

<div class="page-header">
        <h1>
            <?php echo $st;?> публикации
        </h1>
</div>

<form id="form-save-post">
    <div class="post_id">
        <?php if (!empty($post->id)): ?>
            <input type="hidden" name="Post[id]" value="<?php echo $post->id ?>"/>
        <?php endif; ?>
    </div>
    <div class="jumbotron theme-showcase">
        <h2>Заголовок публикации</h2>
        <input name="Post[title]" placeholder="Введите текст заголовка" type="text" value="<?php echo $post->title ?>"/>
    </div>
    <div class="jumbotron theme-showcase">
        <h2>Настройки видимости публикации</h2>
        <select name="Post[visible]">
            <?php if ($post->visible != 1): ?>
                <option value="0" selected="selected">Публикация скрыта</option>
                <option value="1">Публикация доступна</option>
            <?php else: ?>
                <option value="0">Публикация скрыта</option>
                <option value="1" selected="selected">Публикация доступна</option>
            <?php endif; ?>
        </select>
    </div>
    <div class="jumbotron theme-showcase">
        <h2>Оригинальный файл статьи в .doc формате</h2>

        <p class="help_hint">Загрузите сюда вашу статью в .doc формате, для того что бы её могли скачать</p>

        <div class="file_icon doc_icon"></div>
        <div class="file-box doc-box">
            <?php if (!empty($post->doc_file)): ?>
                <div file_id="<?php echo $post->doc_file ?>">
                    <a href="/site/file/<?php echo $post->doc_file ?>"><?php echo $post->uploded_doc->orig_name ?></a>
                    <span class="fds">Файл загружен</span> <span title="Удалить файл" class="dds"
                                                                 onclick="deleteFile($(this))">Удалить</span>
                </div>
            <?php endif; ?>
        </div>
        <div class="upload-area">
            <div id="file-uploader-doc">
                <noscript>
                    <p>Включите JavaScript чтобы испльзовать file uploader.</p>
                    <!-- or put a simple form for upload here -->
                </noscript>
            </div>
            <div class="file-uploader-doc"></div>

        </div>
        <div id="doc-box-waring" class="alert alert-warning hide_block">
            Внимание. После обновления файла, сохраните публикцию. Чтобы файл сохранился в ней.
        </div>
    </div>

    <div class="jumbotron theme-showcase">
        <h2>Оригинальный файл статьи в .pdf формате</h2>

        <p class="help_hint">Загрузите сюда файл вашу статью в .pdf формате, для того что бы её могли скачать</p>

        <div class="file-box pdf-box">
            <?php if (!empty($post->pdf_file)): ?>
                <div file_id="<?php echo $post->pdf_file ?>">
                    <a href="/site/file/<?php echo $post->pdf_file ?>"><?php echo $post->uploded_pdf->orig_name ?></a>
                    <span class="fds">Файл загружен</span> <span title="Удалить файл" class="dds"
                                                                 onclick="deleteFile($(this))">Удалить</span>
                </div>
            <?php endif; ?>
        </div>
        <div class="file_icon pdf_icon"></div>
        <div class="upload-area">
            <div id="file-uploader-pdf">
                <noscript>
                    <p>Включите JavaScript чтобы испльзовать file uploader.</p>
                    <!-- or put a simple form for upload here -->
                </noscript>
            </div>
            <div class="file-uploader-pdf"></div>
        </div>

        <div id="pdf-box-waring" class="alert alert-warning hide_block">
            Внимание. После обновления файла, сохраните публикцию. Чтобы файл сохранился в ней.
        </div>
    </div>

    <div class="jumbotron theme-showcase">
        <h2>Содержимое публикации</h2>

        <?php

        $this->widget('ImperaviRedactorWidget', array(
            // You can either use it for model attribute
            'model' => $post,
            'attribute' => 'content',


            // Some options, see http://imperavi.com/redactor/docs/
            'options' => array(
                'lang' => 'ru',
                'toolbar' => true,
                'iframe' => false,
                'fixed' => true,
                'toolbarFixedBox' => "toolbarFixedBox",
                'imageUpload' => '/userAdmin/admin/ImperaviUpload'
            ),
        ));

        ?>
    </div>


    <button id="save-post" class="btn btn-lg btn-success" onclick="savePost($(this));return false">Сохранить</button>
</form>


<script>

    function createUploaderPdf() {
        var uploader = new qq.FileUploader({
            element: document.getElementById('file-uploader-pdf'),
            action: '/userAdmin/admin/uploadPdf',
            onComplete: function (id, fileName, responseText) {
                $.loaderus();
                if (responseText.status == 'success') {
                    $('#pdf-box-waring').show();
                    $('.file-uploader-pdf').html('<input type="hidden"  name="Post[pdf_file]" value="' + responseText.file_id + '">');
                    $('.pdf-box').html('<div file_id="' + responseText.file_id + '"><a href="/site/file/' + responseText.file_id + '">' + responseText.orig_name + '</a><span class="fds">Файл загружен</span> <span title="Удалить файл" class="dds"onclick="deleteFile($(this))">Удалить</span></div>');
                }
            },
            onSubmit: function () {
                $.loaderus();
            }
        });
    }
    function createUploaderDoc() {
        var uploader = new qq.FileUploader({
            element: document.getElementById('file-uploader-doc'),
            action: '/userAdmin/admin/uploaddDoc',
            onComplete: function (id, fileName, responseText) {
                $.loaderus();
                if (responseText.status == 'success') {
                    $('#doc-box-waring').show();
                    $('.file-uploader-doc').html('<input type="hidden" name="Post[doc_file]" value="' + responseText.file_id + '">');
                    $('.doc-box').html('<div file_id="' + responseText.file_id + '"><a href="/site/file/' + responseText.file_id + '">' + responseText.orig_name + '</a><span class="fds">Файл загружен</span> <span title="Удалить файл" class="dds"onclick="deleteFile($(this))">Удалить</span></div>');
                }
            },
            onSubmit: function () {
                $.loaderus();
            }
        });
    }

    createUploaderPdf();
    createUploaderDoc();
</script>