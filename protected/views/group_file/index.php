<div class="specific dounload_file_group">
    <div id="file-uploader-demo1">		
        <noscript>			
        <p>Включите JavaScript чтобы испльзовать file uploader.</p>
        <!-- or put a simple form for upload here -->
        </noscript>         
    </div>
    <ul class="uload_list">
    </ul>
    <div class="questions" title="Сайт сформирует ссылки которые вы будете использовать для вставки в пост" ></div>
    <p class="help_hint">Исключительно изображения, формата:png, jpg, gif<br />Не более 20 изображений за один раз <br />Один файл не более 10mb</p>
</div>
<script>        
    function createUploader(){  
        i = 1;
        var uploader = new qq.FileUploader({
            element: document.getElementById('file-uploader-demo1'),
            action: '/user/uploadfilegroup',
            debug: true, 
            onComplete: function(id, fileName, responseText)
            {
                $('#myForm').append('<input class="file_id_'+responseText.file_id+'" style="display:none;" name="files[]"  value="'+responseText.file_id+'" />');
                $('.qq-upload-success:nth-child('+i+')').append('<span onclick="deleteFileGroup('+responseText.file_id+',$(this))" class="delete_picter_post" >удалить<span>')
                $('.qq-upload-success:nth-child('+i+')').attr('num',i);
                i++;
            }
        });           
    }
    window.onload = createUploader;  
</script>

<div class="table_t group_files">

    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        
        'itemView' => 'application.views.group_file._view',
    ));
    ?>
</div>