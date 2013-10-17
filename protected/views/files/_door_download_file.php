<div class="vk">
  <h1>Загрузить в папку «<?php echo $folder->name; ?>»</h1>
    <div class="uploded_file">
    <div class="">
      <div id="download_file">		
        <noscript>			
        <p>Включите JavaScript чтобы испльзовать file uploader.</p>
        </noscript>         
      </div>
    </div>
  </div>
  <div class="">
    Вы можете загрузить несколько файлов.
    Размер максимальной загрузки 50мб.
    Область видимости файлов по умолчанию - "только мне".
    После загрузки область видимости можно изменить.
  </div>


  <script>
    var uploader = new qq.FileUploader({
      element: document.getElementById('download_file'),
      multiple: true,
      action: '/files/DownloadFile?user_id=<?php echo $user->id; ?>&parent_id=<?php echo $folder->id ?>',
      debug: false, 
      onSubmit: function(id, fileName){
        goSpiner();
      },
      onComplete: function(id, fileName, responseText)
      {   
        updateDirectory(<?php echo (int)$folder->id ?>, <?php echo (int)$user->id; ?>);
      }
    });           
  </script>
</div>