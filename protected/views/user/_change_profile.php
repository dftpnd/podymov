<div class="vk">
  Данные пользователя
  <form id="create_profile_fio">
    <label>
      Имя
      <input type="text" value="<?php echo $profile->name; ?>" name="Profile[name]" />
    </label>
    <label>
      Фамилия
      <input type="text" value="<?php echo $profile->surname; ?>" name="Profile[surname]" />
    </label>
    <input type="submit" value="Сохранить" onclick="saveFakeProfile($(this));return false" />
  </form>

</div>