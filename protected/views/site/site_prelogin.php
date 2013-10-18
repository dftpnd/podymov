<script src="../../../js/jquery.md5.js"></script>
<div class="universe">
    <div class="container">

        <form class="form-signin" id="LoginForm">
            <h2 class="form-signin-heading">Авторизуйтесь</h2>
            <div class="error_enter">
                Неправильный логин или пароль
            </div>
            <div class="login_inp spod">
                <input type="text" class="form-control" placeholder="E-mail" autofocus name="LoginForm[username]"
                       id="LoginForm_username">
            </div>
            <div class="login_inp spod">
                <input type="password" class="form-control" placeholder="Пароль" name="LoginForm[password]"
                       id="LoginForm_password">
            </div>
            <div class="span-4 spod">
                <button id="enterbtn" class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
            </div>
        </form>

    </div>
    <!-- /container -->
</div>
<script>

    $('#enterbtn').click(function () {


        $(this).addClass('loading');
        var returns = false;
        $.ajax({
            url: '/site/login',
            type: 'POST',
            dataType: 'json',
            data: {
                "LoginForm[password]": $.md5($('#LoginForm_password').val()),
                "LoginForm[username]": $("#LoginForm_username").val()
            },
            success: function (data) {
                if (data.status == "success") {
                    window.location = ('/userAdmin/admin/index');
                    $.pageLoaded();
                }
                else {
                    $('#LoginForm').addClass('get_error')
                }

            },
            complete: function (data) {
                $('#enterbtn').removeClass('loading');

            },
            error: function (data) {
                alert('Произошла непредвиденная ошибка')
            }
        });
        return returns;
    });

</script>
