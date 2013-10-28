<form>
    <div class="jumbotron theme-showcase">
        <h2>Заголовок</h2>
        <input placeholder="Введите текст заголовка" type="text" value=""/>
    </div>
    <div class="jumbotron theme-showcase">
        <h2>Оригинальный файл статьи в .doc формате</h2>
        <p class="help_hint">Загрузите сюда вашу статью в .doc формате, для того что бы её могли скачать</p>
        <div class="file_icon doc_icon"></div>
        <div class="upload-area">
            <div id="file-uploader-doc">
                <noscript>
                    <p>Включите JavaScript чтобы испльзовать file uploader.</p>
                    <!-- or put a simple form for upload here -->
                </noscript>
            </div>
            <ul class="uload_list">
            </ul>
        </div>
    </div>
    <div class="jumbotron theme-showcase">
        <h2>Оригинальный файл статьи в .pdf формате</h2>
        <p class="help_hint">Загрузите сюда файл вашу статью в .pdf формате, для того что бы её могли скачать</p>
        <div class="file_icon pdf_icon"></div>
        <div class="upload-area">
            <div id="file-uploader-pdf">
                <noscript>
                    <p>Включите JavaScript чтобы испльзовать file uploader.</p>
                    <!-- or put a simple form for upload here -->
                </noscript>
            </div>
            <ul class="uload_list">
            </ul>
        </div>
    </div>
    <div class="jumbotron theme-showcase">
        <h2>Загрузчик картинок</h2>

        <div class="upload-area">
            <div id="file-uploader-picter">
                <noscript>
                    <p>Включите JavaScript чтобы испльзовать file uploader.</p>
                    <!-- or put a simple form for upload here -->
                </noscript>
            </div>
            <ul class="uload_list">
            </ul>
        </div>
    </div>
    <div class="jumbotron theme-showcase">
        <h2>Содержимое публикации</h2>

        <div class="texare_div" contenteditable="true"></div>
    </div>
    <button id="save-post" class="btn btn-lg btn-success" onclick="return false">Сохранить</button>
</form>
<script>
    function createUploader() {
        var uploader = new qq.FileUploader({
            element: document.getElementById('file-uploader-picter'),
            action: '/userAdmin/admin/Upload',
            onComplete: function (id, fileName, responseText) {
                $('.avatar img').remove();
                $('.avatar').append('<img src="' + responseText.file_url + '" />');
            }
        });
    }

    function createUploaderPdf() {
        var uploader = new qq.FileUploader({
            element: document.getElementById('file-uploader-pdf'),
            action: '/userAdmin/admin/uploaded',
            onComplete: function (id, fileName, responseText) {
                $('.avatar img').remove();
                $('.avatar').append('<img src="' + responseText.file_url + '" />');
            }
        });
    }
    function createUploaderDoc() {
        var uploader = new qq.FileUploader({
            element: document.getElementById('file-uploader-doc'),
            action: '/userAdmin/admin/uploaded',
            onComplete: function (id, fileName, responseText) {
                $('.avatar img').remove();
                $('.avatar').append('<img src="' + responseText.file_url + '" />');
            }
        });
    }

    createUploader();
    createUploaderPdf();
    createUploaderDoc();
</script>