<nav class="main_menu">
    <ul class="centrator">
        <li>
            <a href="#home" onclick="anchorFunction($(this));return false">Главная
                <span class="icon-noun_project_11792"></span>

                <div></div>
            </a>
        </li>
        <li>
            <a href="#mission" onclick="anchorFunction($(this));return false">Публикации
                <span class="icon-uniE602"></span>

                <div></div>
            </a>
        </li>
        <li>
            <a href="#contact" onclick="anchorFunction($(this));return false">Контакты
                <span class="icon-uniE601"></span>

                <div></div>
            </a>
        </li>
        <li class="poplavok"></li>
    </ul>
</nav>
<section>
    <article id="home">
        <div class="article_wrapper">
            <h2>
            <span>
                Подымов Владимир Николаевич
            </span>

                <div></div>
            </h2>
            <div class="centrator">


                <div class="foto"></div>


                <div class='text_classic'>
                    <p>
                        Рыба в веб-дизайне — временное наполнение макета
                        страницы
                        для имитации её законченного вида. У дизайнера не всегда есть под рукой материалы,
                        которые
                        планируется публиковать на веб-сайте и поэтому нужно использовать что-то иное, чтобы
                        показать, как дизайн будет работать в естественных условиях. При этом «рыбное»
                        содержимое не
                        обязано обладать смыслом — здесь важно визуальное восприятие. «Рыбным» содержимым
                        может
                        быть
                        не только текст, но и изображения (например, иллюстрации к статье, аватары
                        пользователей,
                        кадры из видео для видеоплеера, баннеры и т. д.).
                    </p>

                    <p>
                        Дизайнер рыбу может придумать
                        самостоятельно, а может скопировать с другого аналогичного сайта. В случае с текстом
                        можно
                        воспользоваться программой-бредогенератором или же вставить классический рыбный
                        текст
                        «Lorem
                        ipsum».
                    </p>

                    <p>
                        На макете дизайна веб-страницы рыба может обладать и информативными функциями.
                        Например,
                        в
                        рыбном тексте дизайнер может показать верстальщику какие следует выставить отступы,
                        межстрочный интервал, маркеры списков, цвета различных ссылок и подобное. Эти же
                        моменты
                        он
                        может описать и непосредственно рыбным текстом.
                        Рыба может понадобиться не только веб-дизайнеру, но и на последующих этапах создания
                        сайта.
                        Так как верстальщик получает от дизайнера макет вместе с рыбой, то на выходе у него
                        получается свёрстанная страница с рыбным содержимым. В этом случае рыба ещё и
                        демонстрирует
                        как работает вёрстка в различных веб-браузерах. Далее рыба может применяться
                        программистами
                        для временного наполнения сайта демонстрационным содержимым на этапе тестирования
                        или
                        демонстрации функционала заказчику. В связи с этим в некоторые редакторы исходного
                        кода
                        встраивают бредогенераторы (например, в PSPad).
                    </p>

                </div>
            </div>
        </div>
    </article>
    <article id="mission" class="site_index">
        <div class="article_wrapper">
            <h2>
            <span>
            Публикации
            </span>

                <div class=""></div>
            </h2>

            <div class="article_logo">
                <span class="icon-uniE602"></span>
            </div>
            <div class="centrator">
                <?php if (!empty($posts)): ?>
                    <?php foreach ($posts as $post): ?>
                        <div class="publikation">
                            <div class="publikation_content">
                                <a class="title_link"
                                   href="/site/postview/<?php echo $post->id ?>"><?php echo $post->title; ?></a>

                                <div class='text_classic'>
                                    <?php echo $post->content; ?>
                                </div>
                            </div>
                            <div class="publikation_panel">
                                <?php if (!empty($post->pdf_file)): ?>
                                    <a class="panel_icon pdf_icon" href="/site/file/<?php echo $post->pdf_file; ?>"
                                       title="Скачать в .pdf"></a>
                                <?php endif; ?>
                                <?php if (!empty($post->doc_file)): ?>
                                    <a class="panel_icon doc_icon" href="/site/file/<?php echo $post->doc_file; ?>"
                                       title="Скачать в .doc"></a>
                                <?php endif; ?>

                                <div class="span3">
                                    <a class="btn btn-large btn-block btn-info button_see"
                                       href="/site/postview/<?php echo $post->id ?>" title="<?php $post->title ?>">Читать
                                        далее...</a>
                                </div>
                                <?php if (!empty($post->pdf_file)): ?>
                                    <div class="span3 otstup">
                                        <a class="btn btn-large btn-block btn-success button_see"
                                           title="<?php echo $post->uploded_pdf->orig_name ?>"
                                           href="/uploads/<?php echo $post->uploded_pdf->name ?>">Просмотреть
                                            в
                                            .pdf</a>
                                    </div>
                                <?php endif; ?>

                                <div class="anchor"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Здесь пока ничего нет</p>
                <?php endif; ?>
            </div>

        </div>
    </article>
    <article id="contact">
        <div class="article_wrapper">
            <h2>
            <span>
                Форма обратной связи
            </span>

                <div></div>
            </h2>
            <div class="article_logo">
                <span class="icon-uniE601"></span>
            </div>
            <form id="form-feedback" class="centrator">
                <div class='form_description'> Если у вас есть, что мне сказать - заполните форму
                </div>
                <div class="form_designing_wrap">
                    <div class="form_designing">
                        <input type="text" value="" placeholder="Имя" name="Feedback[name]"/>
                        <input type="text" value="" placeholder="Фамилия" name="Feedback[surname]"/>
                        <input type="text" value="" placeholder="E-mail" name="Feedback[email]" class="last"/>
                        <textarea placeholder="Текст сообщения" name="Feedback[content]"></textarea>
                    </div>
                    <button id="feedback" class="btn btn-large btn-block btn-success button_see submit"
                            onclick="feedBack($(this));return false">Отправить
                    </button>
                    <div class="anchor"></div>
                </div>
            </form>
        </div>
    </article>
</section>
