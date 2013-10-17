<?php if ($new): ?>
  <?php $status_class = 'st_new active'; ?>
<?php else: ?>
  <?php $status_class = 'st_old'; ?>
<?php endif; ?>

<?php if ($folder->type == Folder::FILE): ?>
  <?php $file = TRUE; ?>
  <?php $status_attr = 'status_attr="file"'; ?>
<?php else: ?>
  <?php $file = FALSE; ?>
  <?php $status_attr = 'status_attr="folder"'; ?>
<?php endif; ?>

<div class="tr_t tr_files  <?php echo $status_class; ?>" <?php echo $status_attr; ?> folder_id="<?php echo $folder->id; ?>" onclick="activeFolder($(this), event)" >
  <div class="td_t files_folder <?php echo $file ? 'folder_file' : ''; ?>">
    <?php if ($mu_path): ?>
      <span class="edet_block">
        <input type="text" id="input_name_<?php echo (int) $folder->id; ?>" class="name_folder" onclick='event.stopPropagation()'  name="Folder[<?php echo (int) $folder->id; ?>][name]" value="<?php echo $folder->name; ?>"/>
        <input type="hidden" value="<?php echo (int) $folder->id; ?>" name="folder_id">
        <input type="hidden" value="<?php echo $folder->parent_id; ?>" name="Folder[<?php echo (int) $folder->id; ?>][parent_id]" onblur="blurInputName($(this),event)" />
      </span>
    <?php endif; ?>
    <?php if ($file): ?>
      <span class="show_block cp">
        <a href="/user/downloads?id=<?php echo $folder->id; ?>" class=""><?php echo htmlspecialchars($folder->name); ?></a>
      </span>
    <?php else: ?>
      <span class="show_block cp" onclick="openFolder($(this), event)">
        <span class="">
          <?php echo htmlspecialchars($folder->name); ?>
        </span>
      </span>
    <?php endif; ?>
  </div>
  <div class="td_t">
    <span class="">
      <?php if ($file): ?>
        файл <span class="folder_ext"><?php echo $folder->uploadedfiles->ext ?></span>
      <?php else: ?>
        папка
      <?php endif; ?>
    </span>
  </div>
  <div class="td_t">
    <span>
      <?php if (!is_null($folder->created)): ?>
        <?php $time = $folder->created; ?>
      <?php else: ?>
        <?php $time = time(); ?>
      <?php endif; ?>
      <?php echo date('j', $time); ?>
      <?php echo MyHelper::getRusMonth((int) date('n', $time)) ?>
      <?php echo date('y', $time); ?>
    </span>
  </div>
  <?php if ($mu_path): ?>
    <div class="td_t">
      <?php if ($mu_path): ?>
        <span class="edet_block">
          <?php
          echo
          CHtml::dropDownList(
                  "Folder[" . (int) $folder->id . "][private_status]", $folder->private_status, CHtml::listData($private_status, 'id', 'name'), array('onchange' => 'editPriveteStatus(event)', 'onclick' => 'event.stopPropagation();')
          );
          ?>
        </span>
      <?php endif; ?>
      <span class="show_block">
        <?php echo $folder->ps->name; ?>
      </span>
    </div>
  <?php endif; ?>
</div>