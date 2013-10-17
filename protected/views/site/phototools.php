<h1>Редактирование фотоальбома</h1>
<div class="dopinfo" style="display:none">
    <div>Справка</div>
    <ul>
        <li><span>Скрыть изображение</span>
            Изображение становится скрытым для пользователей, продолжая хранится в базе
        </li>
        <li><span>Удалить из базы</span>
            Изображение полность удаляется из базы, при этом, если на него была использованы ссылка в каком либо из постов, оно удалится одновреммно и из поста(безвазвратно, навсегда.)<br/>
            (вообще навсегда)
        </li>
        <li></li>
    </ul>
</div>
<?php // $post_id ?>
<ul class="fototools">
    <?php
    $i = 1;
    foreach ($model->filetopost as $ftp) {

        if (!empty($ftp->file->name)) {

            echo '<li id="li_id_' . $ftp->file->id . '">';
            echo '<div class="udaleno" id="udaleno_' . $ftp->file->id . '">Изображение успешно удалено</div>';
            if ($ftp->file->id == $model->cover_id) {
                $show_active = 'cover_active';
            } else {
                $show_active = '';
            }
            echo '<div id="cover_id_' . $ftp->file->id . '" cover_id="' . $ftp->file->id . '" post_id="' . $model->id . '" class="cover"><span>Обложка альбома</span><div class="krug" ><div class="' . $show_active . '"></div></div></div>';
            echo '<div class="workphoto">';
            if ($ftp->file->invisible != 1) {
                $hide = "block";
                $show = 'none';
            } else {
                $hide = 'none';
                $show = 'block';
            }
            echo '<div style="display:' . $hide . '" id="none_id' . $ftp->file->id . '" hide_id="' . $ftp->file->id . '" class="hide">Скрыть изображение</div>';
            echo '<div style="display:' . $show . '"  id="show_id' . $ftp->file->id . '" hide_id="' . $ftp->file->id . '" class="show">Показывать изображение</div>';
            echo '<div class="delete_photo" id="' . $ftp->file->id . '">Удалить из базы</div>';
            echo '</div>';
            echo '<a href="../../uploads/oli_' . ($ftp->file->name) . '" rel="lightbox[roadtrip]" ><img  index="' . $i++ . '" src="../../uploads/thumb_' . ($ftp->file->name) . ' "/></a>';
            echo '</li>';
        }
        continue;
    }
    ?>
</ul>
<script>
    $(document).ready(function() {
        $('.delete_photo').click(function() {
            var file_id = $(this).attr('id');
            
            var a = confirm('Вы действительно хотите удалить изображение? #'+file_id); 
            if(a)
                $.ajax({
                    url: '<?php echo $this->CreateUrl('site/FileDelete'); ?>',
                    type: 'POST',
                    data: {
                        "file_id":file_id
                    },
                dataType: 'json',
                success: function(result)
                {
                    if (result = true)
                    {
                        $('#li_id_'+file_id).children('.workphoto').hide();
                        $('#udaleno_'+file_id).show();
                        
                    }
                    else{
                        alert('По неизвестной нам причине, удаление не произошло. Сообщите Грязнову Максиму');
                    }
                    
                }
            });
            else{
                return false;
            }
            
        });
        $('.hide').click(function() {
            var file_id = $(this).attr('hide_id');
            
            var a = confirm('Сделать скрытым#'+file_id); 
            if(a)
                $.ajax({
                    url: '<?php echo $this->CreateUrl('site/FileHide'); ?>',
                    type: 'POST',
                    data: {
                        "file_id":file_id
                    },
                dataType: 'json',
                success: function(result)
                {
                    if (result = true)
                    {
                        $('#none_id'+file_id).hide();
                        $('#show_id'+file_id).show();
                        
                    }
                    else{
                        alert('По неизвестной нам причине, удаление не произошло. Сообщите Грязнову Максиму');
                    }
                    
                }
            });
            else{
                return false;
            }
            
        });   
        $('.show').click(function() {
            var file_id = $(this).attr('hide_id');
            
            var a = confirm('Сделать Видимым'+file_id); 
            if(a)
                $.ajax({
                    url: '<?php echo $this->CreateUrl('site/FileShow'); ?>',
                    type: 'POST',
                    data: {
                        "file_id":file_id
                    },
                dataType: 'json',
                success: function(result)
                {
                    if (result = true)
                    {
                        $('#none_id'+file_id).show();
                        $('#show_id'+file_id).hide();
                        
                    }
                    else{
                        alert('По неизвестной нам причине, удаление не произошло. Сообщите Грязнову Максиму');
                    }
                    
                }
            });
            else{
                return false;
            }
            
        });
        $('.cover').click(function() {
            $('.krug').children('div').removeClass('cover_active');
            var file_id = $(this).attr('cover_id');
            var post_id = $(this).attr('post_id');

            $.ajax({
                url: '<?php echo $this->CreateUrl('site/CoverSelect'); ?>',
                type: 'POST',
                data: {
                    "file_id":file_id,
                    "post_id":post_id
                        
                },
                dataType: 'json',
                success: function(result)
                {
                    if (result = true)
                    {
                        $('#cover_id_'+file_id).children('.krug').children('div').addClass('cover_active')
                        
                    }
                    else{
                        alert('По неизвестной нам причине, удаление не произошло. Сообщите Грязнову Максиму');
                    }
                    
                }
            });
          
            
        });
    });
</script>