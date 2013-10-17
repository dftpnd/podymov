<form action="/userAdmin/admin/institute" method="POST" class="create_institute">
  Создать институт
  <input type="text" name="institute" />
  <input type="submit" value="Сохранить" />
</form>

<?php foreach ($institutes as $value) : ?>

  <div class="view_institute">
    <h1><?php echo $value->name ?></h1>
    <div class="delete_institute" onclick="deleteInstitute($(this),<?php echo $value->id ?>)" >удалить институт</div>
    <div class="box-view-caf">
      <?php foreach ($value->institutecafedra as $val): ?>
        <div class="cafedra_view">
          <?php echo $val->cafedra->name; ?>
        </div>
      <?php endforeach; ?>

      <form action="/userAdmin/admin/institute" method="POST" class="create_cafedra" >
        <input type="text" name="cafedra[<?php echo $value->id ?>][cafedra_name]" value="" />
        <input type="submit" value="Сохранить" />
      </form>
    </div>
  </div>
<?php endforeach; ?>
