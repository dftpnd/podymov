<script src="../../../js/jquery.md5.js"></script>
<div class="universe">
    <div class="container">

        <form class="form-signin" id="LoginForm">

            <h2 class="form-signin-heading">Введите пароль</h2>

            <div class="error_enter">
                Неправильный пароль<br/>
            </div>
            <div class="login_inp spod">
                <input type="password" class="form-control" placeholder="Пароль" name="LoginForm[password]"
                       id="LoginForm_password">
            </div>
            <div class="span-4 spod">
                <button id="enterbtn" class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
            </div>
            <div class="recovery_psss_div"><a href="#" class="recovery_psss" onclick="recoveryPass()">Восстановление
                    пароля</a>
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
            },
            success: function (data) {
                if (data.status == "success") {
                    window.location = ('/userAdmin/admin/index');
                    $.loaderus();
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
