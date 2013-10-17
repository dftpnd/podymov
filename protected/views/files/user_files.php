<div id="breadcrambs">
  <?php echo $html_breadcrambs; ?>
</div>



<div class="mydropbox">
  <div class="test">
    <?php if ($mu_path): ?>
      <div class="dop_menu">
        <div class="files_upload" onclick="doorDownloadFile(event)">
          <span>Загрузить</span>
        </div>
        <div class="files_newfolder" onclick="changeFolder(0, event)" title="Создать папку">
          <span>Новая папка</span>
        </div>
      </div>
      <ul class="ul_files_actions">
        <!--        <li class="files_dowland">
                  <div></div>
                  <span>Скачать</span>
                </li>-->
        <li class="files_delete" onclick="deleteFolder(event)">
          <div></div>
          <span>Удалить</span>
        </li>
        <li class="files_rename" onclick="editLineFolder(event)" >
          <div></div>
          <span >Изменить</span>
        </li>
      </ul>
    <?php endif; ?>
  </div>
  <div class="anchor"></div>

  <div class="table_t table_files">
    <div class="table_head_t">
      <div class="tr_t table_files_head">
        <div class="td_t">
          <div class="block_panel">

          </div>
          <span>Название</span>
        </div>
        <div class="td_t">
          <div class="block_panel"></div>
          <span>Тип</span>
        </div>
        <div class="td_t">
          <div class="block_panel"></div>
          <span>Изменено</span>
        </div>
        <?php if ($mu_path): ?>
          <div class="td_t">
            <div class="block_panel"></div>
            <span>Область видимости</span>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <div class="table_body_t">
      <?php foreach ($folders as $folder): ?>
        <?php
        echo $this->renderPartial('_folder', array(
            'folder' => $folder,
            'private_status' => $private_status,
            'new' => $new,
            'mu_path' => $mu_path
                ), true);
        ?>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<script>
  $('.table_files').fixedtableheader(); 
</script>