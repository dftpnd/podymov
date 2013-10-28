var FIXED_MENU_HEIGHT, DIFF, active_id , $articles, click_ev;
var article_arr = [];
var li_arr = [];

var response = new Object();
response.success = 'success';
response.failure = 'failure';

function anchorFunction($el) {
    click_ev = true;
    var anchor = $el.attr('href');
    anchor = anchor.substring(1);
    var offset = $('#' + anchor).offset();
    var caclculate_offset = offset.top - FIXED_MENU_HEIGHT;
    active_id = anchor;
    evantMenu();
    $("html, body").animate({ scrollTop: caclculate_offset + "px" }, 500, function () {
        click_ev = false
    });
}
function calculateValue() {
    $.each($articles, function (index, el) {
        var offset = $(el).offset();
        var article = new Object();
        article.id = $(el).attr('id')
        article.from = offset.top - FIXED_MENU_HEIGHT - DIFF;
        article.before = $(el).outerHeight(true) + offset.top - FIXED_MENU_HEIGHT - DIFF;
        article_arr[index] = article;
    });

    $.each($('.main_menu li:not(.poplavok)'), function (index, el) {
        position = $(el).position();
        li_arr[$(el).find('a').attr('href')] = position.left;
    });
};


function evantMenu() {
    if (click_ev != true)
        getIdActiveMenu();

    if (typeof  active_id !== "undefined")
        $('.poplavok').css({left: li_arr['#' + active_id] + 'px'});
}

function getIdActiveMenu() {
    for (var article in article_arr) {
        active_id = article_arr[article].id;
        if ($(document).scrollTop() >= article_arr[article].from)
            if ($(document).scrollTop() <= article_arr[article].before) {
                return active_id
                break;
            }
    }
}

$.fn.navMenu = function (fan) {
    FIXED_MENU_HEIGHT = $('.main_menu').outerHeight(true);
    DIFF = 5;
    $articles = $(this);

    $(window).resize(function () {
        calculateValue();
    });

    $(window).scroll(function () {
        evantMenu();
    });

    calculateValue();
    evantMenu();
    return this;
};

$.loaderus = function () {
    if ($('.loaderus').is(":visible")) {
        $('.loaderus').hide();
    } else {
        $('.loaderus').show();
    }
}
/////


function recoveryPass() {
    if (confirm("Забыли пароль?")) {
        $.loaderus();
        $.ajax({
            url: '/site/recovery',
            type: 'POST',
            success: function () {
                alert('пароль отправлен вам, на электронную почту.');
                $.loaderus();
            }
        });
    }
}
function feedBack($element) {
    $.loaderus();
    $element.addClass('loading');

    var $element;
    var $form = $('#form-' + $element.attr('id'));

    $.ajax({
        url: '/site/feedBack',
        type: 'POST',
        dataType: 'json',
        data: ($form.serialize()),
        success: function (data) {
            if (data.status == response.success) {
                alert('Ваше письмо отправлено.')
                $form.find('input').val('');
                $form.find('textarea').val('');
            } else {
                for (key in data.message) {
                    alert(data.message[key]);
                }
            }
        },
        complete: function () {
            $element.removeClass('loading');
            $.loaderus();
        },
        error: function () {
            alert("Непредвиденная ошибка");
        }

    });
}
$(function () {

    /*
     *главное меню ( ресайз, актив линк, и пр.)
     * */
    $('article').navMenu();


});




