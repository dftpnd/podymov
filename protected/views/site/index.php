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
                    <div class="plashka"></div>
                    <p class="maine_text">
                        <?php echo $user->user_text; ?>
                    </p>
                </div>
            </div>
        </div>
    </article>
    <article id="mission" class="site_index">
        <div class="article_wrapper">
            <h2>
            <span>
            Статьи по учебному процессу
            </span>

                <div class=""></div>
            </h2>

            <div class="article_logo">
                <span class="icon-uniE602"></span>
            </div>
            <div class="centrator">
                <?php if (!empty($posts)): ?>
                    <?php foreach ($posts as $post): ?>
                        <?php if (!empty($post->pdf_file)): ?>
                            <div class="publikation">
                                <div class="publikation_content">
                                    <a class="title_link"
                                       href="/uploads/<?php echo $post->uploded_pdf->name ?>"><?php echo $post->title; ?></a>

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

                                    <div class="anchor"></div>
                                </div>
                            </div>
                        <?php endif; ?>
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
