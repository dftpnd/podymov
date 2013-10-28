var response = new Object();
response.success = 'success';
response.failure = 'failure';


//

function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

///


$.fn.jax = function (callback) {
    var $element = $(this);
    $element.addClass('loading');

    $.ajax({
        url: window.location,
        type: 'POST',
        dataType: 'json',
        data: ($('#form-' + $element.attr('id')).serialize()),
        success: function (data) {
            if (data.status == response.success) {
                $('#jgrowl_success').jGrowl("Сохранено");
            } else {
                for (key in data.message) {
                    $('#jgrowl_error').jGrowl(data.message[key]);
                }
            }
        },
        complete: function () {
            $element.removeClass('loading');
            if (typeof callback !== "undefined") {
                callback();
            }
        },
        error: function () {
            $('#jgrowl_error').jGrowl("Непредвиденная ошибка");
        }

    });

    return $element;
}
$.loaderus = function () {
    if ($('.loaderus').is(":visible")) {
        $('.loaderus').hide();
    } else {
        $('.loaderus').show();
    }
}


function saveEmail($element) {
    $element.jax(function () {
        if ((IsEmail($('#user-email-input').val()))) {
            $('#send-test-message').show();
        } else {
            $('#send-test-message').hide();
        }

    });
}
function savePassword($element) {
    $element.jax(function () {
        //alert('asd');
    });
}
function sendTestEmail() {
    $.loaderus();
    $.ajax({
        url: '/userAdmin/admin/sendConferm',
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            if (data.status == response.success) {

                $('#jgrowl_complete').jGrowl('Сообщение отправлено вам на эл. почту. Пройдите по ссылки в письме, чтобы подвердить его получение.', { sticky: true });
            }
        },
        complete: function () {
            $.loaderus();
        },
        error: function () {
            $('#jgrowl_error').jGrowl("Непредвиденная ошибка");
        }

    });
}
