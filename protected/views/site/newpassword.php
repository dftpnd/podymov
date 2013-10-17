<h1>Создание нового пароля</h1>
<h2><b>
        <?php if (isset($er)) echo $er ?>
    </b></h2>
<div class="table_t new_pass_create">
    <form method="post" >
        <div class="tr_t">
            <div class="td_t">Введите новый пароль</div>
            <div class="td_t">
                <input  type="password" name="pas1" />
            </div>
        </div>
        <div class="tr_t">
            <div class="td_t">Повторите пароль</div>
            <div class="td_t">
                <input  type="password" name="pas2" />
            </div>
        </div>
        <input type="hidden" name='pin2' value='<?php if (isset($_GET['pin'])) echo $_GET['pin'] ?>' />
        <input type="submit" value="Сохранить" />
    </form>
</div>