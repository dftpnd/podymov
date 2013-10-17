<div id="breadcrambs">
  <?php
  $this->widget('zii.widgets.CBreadcrumbs', array(
      'links' => array(
          'Предметы' => '/userAdmin/admin/predmet',
          'Редактировать предмет'
      ),
      'separator' => '<span> / <span>'
  ));
  ?>
</div>
<h1><?php echo $model->name; ?></h1>
<form method="POST" action="/userAdmin/admin/predmetedet/id/<?php echo $model->id; ?>">
  <h3>описание предмета</h3>
  <label>
    Выберите кафедру предмета
    <?php echo $select; ?>
  </label>
  <br/>
  <br/>
  <textarea name="Predmet[text]" style="width:100%;height:300px;">
    <?php
    if (isset($model->text)) {
      echo $model->text;
    }
    ?>
  </textarea>
  <input type="submit" value="Сохранить">
</form>