<script>
    $(function(){
        
    })
</script>
<h1>Правила сайта</h1>
<div class='info_page'>
    <p>
        В одном занимательном политологическом пособии правила изображались как перила балкона: если их не будет, то можно упасть. Чтобы обезопасить наших пользователей от случайных падений, на сайте есть определённые перила. В смысле, правила.
    </p>
    <h2>Чем не является наш сайт</h2>
    <div class="table_t instrpl">
        <div class='tr_t'>
            <div class="td_t"><input type="checkbox" id="pr1"  class="1_qwer"/></div>
            <div class="td_t">
                <label for="pr1"  class="1_qwer">
                    <b>
                        Наш сайт — не место для копипастеров.
                    </b>
                    Размещение полностью скопированного чужого контента с других сайтов запрещено — даже при использовании гиперссылки на источник.
                </label>
            </div>
        </div>
        <div class='tr_t'>
            <div class="td_t"><input type="checkbox" id="pr2" disabled="disabled" class="2_qwer" /></div>
            <div class="td_t">
                <label for="" class="2_qwer">
                    <b>
                        Наш сайт — не магазин.
                    </b>
                    Рекламировать товары, услуги, события, аккаунты и прочее, размещать в своих топиках ссылку на свой блог/сайт запрещено.
                </label>
            </div>
        </div>
        <div class='tr_t'>
            <div class="td_t"><input type="checkbox" id="pr3" disabled="disabled" class="3_qwer" /></div>
            <div class="td_t">
                <label for="" class="3_qwer">
                    <b>
                        Наш сайт — не фишкинет.
                    </b>
                    Все мы любим посмеяться, особенно над качественными шутками. Тем не менее, не стоит превращать сайт в юмористический сайт и регулярно публиковать найденные в интернете смешные картинки.
                </label>
            </div>
        </div>
        <div class='tr_t'>
            <div class="td_t"><input type="checkbox" id="pr4" disabled="disabled" class="4_qwer"/></div>
            <div class="td_t">
                <label for="" class="4_qwer">
                    <b>
                        Наш сайт  — не для политики.
                    </b>
                    На сайте не приветствуются дискуссии на политические темы в любом их проявлении.
                </label>
            </div>
        </div>
        <div class='tr_t'>
            <div class="td_t"><input type="checkbox" id="pr5" disabled="disabled" class="5_qwer" /></div>
            <div class="td_t">
                <label for=""class="5_qwer">
                    <b>
                        Наш сайт  — для грамотных людей. 
                    </b>
                    Мы любим русский язык и не любим тех, кто его коверкает. Ошибки и опечатки бывают у всех — старайтесь проверять текст перед отправкой. Постоянные орфографические ошибки и игнорирование правил пунктуации не приветствуются, равно как намеренное коверканье слов, «падонкоффский сленг» и прочие смайлики.
                </label>
            </div>
        </div>
        <div class='tr_t'>
            <div class="td_t"><input type="checkbox" id="pr6" disabled="disabled" class="6_qwer" /></div>
            <div class="td_t">
                <label for="" class="6_qwer">
                    <b>
                        Наш сайт  —  для спокойных людей.
                    </b>
                    Просим оставить хамство, грубость и прочие проявления агрессии и неадекватности для других ресурсов — у нас это не в почёте. За мат и эвфемизмы НЛО забирает туда, где не светит солнце.
                </label>
            </div>
        </div>
        <div class='tr_t'>
            <div class="td_t"><input type="checkbox" id="pr7" disabled="disabled" class="7_qwer" /></div>
            <div class="td_t">
                <label for="" class="7_qwer">
                    <b>
                        Наш сайт  — не для попрошаек. 
                    </b>
                    Рейтинг зарабатываются у Нас только честным способом, то есть своими статьями и комментариями. Не стоит размещать чужие посты. Устраивать сборы средств тоже не стоит.
                </label>
            </div>
        </div>
    </div>
    <form id="instruct-form" method="POST">
        <input type="submit" id="instruct" value="Продолжить" disabled="disabled" name="isept"  />
    </form>
    <div class="anchor"></div>
</div>
<script>
    $(function(){
        $('.1_qwer').click(function() {
            if($('input.1_qwer').prop("checked")){
                setTimeout("$('input.2_qwer').removeAttr('disabled','disabled')",3000);
                setTimeout("$('label.2_qwer').attr('for','pr2')",3000);
            }
        });
        $('.2_qwer').click(function() {
            if($('input.2_qwer').prop("checked")){
                setTimeout("$('input.3_qwer').removeAttr('disabled','disabled')",3000);
                setTimeout("$('label.3_qwer').attr('for','pr3')",3000);
            }
        });
        $('.3_qwer').click(function() {
            if($('input.3_qwer').prop("checked")){
                setTimeout("$('input.4_qwer').removeAttr('disabled','disabled')",3000);
                setTimeout("$('label.4_qwer').attr('for','pr4')",3000);
            }
        });
        $('.4_qwer').click(function() {
            if($('input.4_qwer').prop("checked")){
                setTimeout("$('input.5_qwer').removeAttr('disabled','disabled')",3000);
                setTimeout("$('label.5_qwer').attr('for','pr5')",3000);
            }
        });
        $('.5_qwer').click(function() {
            if($('input.5_qwer').prop("checked")){
                setTimeout("$('input.6_qwer').removeAttr('disabled','disabled')",3000);
                setTimeout("$('label.6_qwer').attr('for','pr6')",3000);
            }
        });
        
        $('.6_qwer').click(function() {
            if($('input.6_qwer').prop("checked")){
                setTimeout("$('input.7_qwer').removeAttr('disabled','disabled')",3000);
                setTimeout("$('label.7_qwer').attr('for','pr7')",3000);
            }
        });
        
        $('.7_qwer').click(function() {
            if($('input.7_qwer').prop("checked")){
                $('input.#instruct').removeAttr('disabled','disabled');
            }
        });
        
        
    });
</script>