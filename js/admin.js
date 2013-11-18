var response = new Object();
response.success = 'success';
response.failure = 'failure';


//

function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

///


$.fn.jax = function (complete, success, url) {
    var $element = $(this);
    var data = '';
    $element.addClass('loading');

    if (typeof url === "undefined") {
        url = window.location;
    }

    if ($('#form-' + $element.attr('id')).length !== 0) {
        data = $('#form-' + $element.attr('id')).serialize();
    }


    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: data,
        success: function (data) {
            if (data.status == response.success) {
                if (typeof success !== "undefined") {
                    success(data);
                }
                $('#jgrowl_success').jGrowl("Сохранено");
            } else {
                for (key in data.message) {
                    $('#jgrowl_error').jGrowl(data.message[key]);
                }
            }
        },
        complete: function () {
            $element.removeClass('loading');
            if (typeof complete !== "undefined") {
                complete();
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
        data: ($('#form-save-post').serialize()),
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

function savePost($element) {
    $element.addClass('loading');
    $.loaderus();

    $element.jax(function () {
        $.loaderus();
    }, function (data) {
        $('.post_id').html('<input type="hidden" name="Post[id]"  value="' + data.post_id + '" />');
    });

}


function deleteFile($element) {
    var file_id = $element.parent().attr('file_id')
    var file_name = $element.siblings('a').text();

    if (confirm('Удалить файл  "' + file_name + '"')) {
        $.loaderus();
        $element.jax(function () {
            $.loaderus();
        }, function (data) {
            $('[file_id="' + file_id + '"]').remove();
        }, '/userAdmin/admin/deletePostFile?file_id=' + file_id);
    }
}

function deletePublish($element) {
    var post_id = $element.parents('tr').attr('post_id');
    var post_name = $element.parents('tr').find('.post_title_link').text();
    $.loaderus();
    if (confirm('Если вы удалите публикацию "' + post_name + '", восстановить её будет невозможно, продолжить?')) {
        $element.jax(function () {
            $.loaderus();
        }, function (data) {
            $('[post_id="' + post_id + '"]').remove();
        }, '/userAdmin/admin/deletePublish?post_id=' + post_id);
    }
}
function saveUserText($element){
    $element.jax(function () {

    }, function () {}, '/userAdmin/admin/saveUserText');
}