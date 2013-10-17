<div class="vk">
  <h1>Папка</h1>
  <form id="save_folder">
    <input type="hidden" value="<?php echo (int) $folder->id; ?>" name="folder_id">
    <input type="hidden" value="<?php echo $folder->parent_id; ?>" name="Folder[parent_id]">
    <ul class="change_folder">
      <li>
        <label>
          Имя папки
          <input type="text" name="Folder[name]" value="<?php echo $folder->name; ?>">
        </label>
      </li>
      <li>
        <label>
          Область видимости папки
          <?php echo $select; ?>
        </label>
      </li>
      <li>
        <div class="anchor"></div>
        <input name="folder_id" type="submit"  onclick="saveChangeFolder(); return false" value="Сохранить" />
      </li>
    </ul>
  </form>
</div>