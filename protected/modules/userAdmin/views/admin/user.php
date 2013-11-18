<div class="jumbotron theme-showcase">

    <h1>Уведомления</h1>

    <?php if ($user->email == '') {
        $togler = 'hide_block';
    } else {
        if ($user->confirm_email == 1) {
            $togler = 'hide_block';
        } else {
            $togler = 'show_block';
        }

    }

    ?>
    <div id="send-test-message" class="alert alert-warning <?php echo $togler; ?>">Внимание. Отправьте себе <a href="#"
                                                                                                               onclick="sendTestEmail();return false">тестовое
            сообщение</a>,
        что бы быть
        уверенным, что сообщения доходят по адресу. Обратите внимание, что сообщения могут попасть в спам фильтр.
    </div>

    <div class="obertka">
        <form id='form-save-email'>
            <div class="row">
                <input id='user-email-input' type="text" placeholder="exemple@email.com" name="User[email]"
                       value="<?php echo $user->email; ?>">

                <p class="help_hint">Введите электронную почту, на которую вы хотите получать уведомления с сайта</p>
            </div>
            <button id="save-email" class="btn btn-primary btn-lg" onclick="saveEmail($(this));return false">Сохранить
            </button>
            <div class="anchor"></div>
        </form>
    </div>
</div>

<div class="jumbotron theme-showcase">
    <h1>Изменение пароля</h1>

    <div class="alert alert-danger">Внимание. После изменения пароля, Вы будете заходить в панель администрирования, с
        новым паролем.
    </div>
    <div class="obertka">
        <form id='form-save-password'>
            <p class="help_hint">Поля изменение пароля авторизации.</p>

            <div class="row">
                <input type="password" placeholder="Пароль" name="User[password]">
            </div>
            <div class="row">
                <input type="password" placeholder="Повторите пароль" name="User[password_repeat]">
            </div>

            <button id="save-password" class="btn btn-primary btn-lg" onclick="savePassword($(this));return false">
                Сохранить
            </button>
            <div class="anchor"></div>
        </form>
    </div>
</div>

<div class="jumbotron theme-showcase">
    <h1>Текст на главной странице под фото</h1>

    <div class="obertka">
        <form id='form-user-text'>
            <div class="row">
                <textarea name="user_text" style="width: 100%; min-height: 200px;margin-bottom: 20px"><?php echo $user->user_text?></textarea>
            </div>
            <div class="anchor"></div>
            <button id="user-text" class="btn btn-primary btn-lg" onclick="saveUserText($(this));return false">
                Сохранить
            </button>
            <div class="anchor"></div>
        </form>
    </div>
</div>