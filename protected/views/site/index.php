<?php echo $this->renderPartial('_notice'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/calendar.css" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr.custom.63321.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.calendario.js"></script>


<!--подключалки-->
<div class="page-header">
    <h1>Сайт кафедры КГЭУ "АТПП"</h1>
    <div class="world_info">&#9728; Сообщество людей, которым не безразлична жизнь кафедры</div>
</div>
<div class="news_info">Новости</div>
<div class="calendar_info">Календарь событий</div>
<div class="anchor"></div>
<section class="main">
    <div class="custom-calendar-wrap">
        <div id="custom-inner" class="custom-inner">
            <div class="custom-header clearfix">
                <nav>
                    <span id="custom-prev" class="custom-prev"></span>
                    <span id="custom-next" class="custom-next"></span>
                </nav>
                <h2 id="custom-month" class="custom-month"></h2>
                <h3 id="custom-year" class="custom-year"></h3>
            </div>
            <div id="calendar" class="fc-calendar-container"></div>
        </div>
    </div>
</section>

<!-- Дом -->
<div class="dom">
    <div id="slides" class="slides">
        <div class="slide_box">
            <?php $active_class = ''; ?>
            <?php $slide_ferst = 1; ?>
            <?php foreach ($slides as $slide): ?>

                <?php if ($slide_ferst === 1): ?>
                    <?php $active_class = 'active'; ?>
                <?php else: ?>
                    <?php $active_class = ''; ?>
                <?php endif; ?>

                <div class="slide" slide="<?php echo $active_class; ?>" >
                    <div class="in_xlide aspx_4">
                        <?php echo $slide->text; ?><br/>
                        <a href="<?php echo $slide->link; ?>">Читать далее&rarr;</a>
                    </div>

                    <?php $left_slide = '0'; ?>
                    <?php $top_slide = '0'; ?>
                    <?php if (empty($slide->left_slide)) $left_slide = '0';
                    else $left_slide = $slide->left_slide . 'px'; ?>
    <?php if (empty($slide->top_slide)) $top_slide = '0';
    else $top_slide = $slide->top_slide . 'px'; ?>

                    <img src="<?php echo $slide->img_link; ?>" style="left:<?php echo $left_slide; ?>;top:<?php echo $top_slide; ?>" />
                </div>

    <?php $slide_ferst++; ?>
<?php endforeach; ?>
        </div>
        <span class="prev slide_prev" onclick="NextPrevSlide(0, 1)">
            <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="100%" height="100%" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
            <g id="Captions">
            </g>
            <g id="Plus">
            </g>
            <g id="Minus">
            </g>
            <g id="Right" >
            <circle  fill="#fff" stroke="#000000" stroke-width="6" stroke-miterlimit="10" cx="50" cy="50" r="47"/>
            <polygon   points="21,47 68,47 54,33 62,33 79,50 62,67 54,67 68,53 21,53  "/>
            </g>
            <g id="Left">
            </g>
            <g id="Up">
            </g>
            <g id="Down">
            </g>
            <g id="Play">
            </g>
            <g id="Forward">
            </g>
            <g id="Reverse">
            </g>
            <g id="Stop">
            </g>
            <g id="Pause_1_">
            </g>
            <g id="Record">
            </g>
            <g id="Close">
            </g>
            <g id="Check">
            </g>
            <g id="Power">
            </g>
            <g id="Skip_Forward">
            </g>
            <g id="Skip_Backward">
            </g>
            <g id="Cancel">
            </g>
            <g id="Info">
            </g>
            <g id="Help">
            </g>
            </svg>
        </span>
        <span class="next slide_next" onclick="NextPrevSlide(1, 1)">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="100%" height="100%" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
            <g id="Captions">
            </g>
            <g id="Plus">
            </g>
            <g id="Minus">
            </g>
            <g id="Right">
            <circle fill="#fff" stroke="#000000" stroke-width="6" stroke-miterlimit="10" cx="50" cy="50" r="47"/>
            <polygon points="21,47 68,47 54,33 62,33 79,50 62,67 54,67 68,53 21,53  "/>
            </g>
            <g id="Left">
            </g>
            <g id="Up">
            </g>
            <g id="Down">
            </g>
            <g id="Play">
            </g>
            <g id="Forward">
            </g>
            <g id="Reverse">
            </g>
            <g id="Stop">
            </g>
            <g id="Pause_1_">
            </g>
            <g id="Record">
            </g>
            <g id="Close">
            </g>
            <g id="Check">
            </g>
            <g id="Power">
            </g>
            <g id="Skip_Forward"></g><g id="Skip_Backward"></g><g id="Cancel"></g><g id="Info"></g><g id="Help"></g></svg>
        </span>
        <div class="slide-navigation-box">
            <ul class="slide-navigation">
                <?php $active_class = ''; ?>
                <?php $slide_ferst = 1; ?>
                <?php foreach ($slides as $slide): ?>

                    <?php if ($slide_ferst === 1): ?>
                        <?php $active_class = 'active'; ?>
                    <?php else: ?>
        <?php $active_class = ''; ?>
                    <?php endif; ?>

                    <li class="<?php echo $active_class; ?>" onclick="ButtonSlide($(this))"></li>
    <?php $slide_ferst++; ?>
<?php endforeach; ?>
            </ul>
        </div>
    </div>

</div>
<script>
        var i_slide = $('.slide').length;
        var sleder_width = $('#slides').width();
        var factor = 0;

        BuildSlider();
        setInterval("LiftSlide(1,1)", 40000);

        function BuildSlider() {

            for (i_slide; i_slide > 1; i_slide--) {
                $('.slide:nth-child(' + i_slide + ')').css('left', (i_slide - 1) * sleder_width + 'px');
            }

            $('.slide_box').css('width', (i_slide * sleder_width) + 'px');
            $('.slide').css('width', sleder_width + 'px');
        }

        function ButtonSlide(el) {
            var now_click = el.index();//куда нажали
            var now_is = ($('.slide-navigation li.active').index());//сейчас находится

            if (now_is > now_click)
                var when_go = 0;//назад
            else if (now_is === now_click) {
                return;//стоп
            } else
                var when_go = 1;//вперед

            factor = Math.abs(now_is - now_click);
            LiftSlide(when_go, factor);
        }
        function NextPrevSlide(when_go, factor) {
            LiftSlide(when_go, factor);
        }
        function LiftSlide(when_go, factor) {
            var slide_num = $('.slide[slide = active]').index();
            $('.slide[slide = active]').removeAttr('slide');
            $('.slide-navigation li').removeClass('active');

            if (when_go == '1') {
                slide_num = slide_num + factor;
            }
            else
                slide_num = slide_num - factor;

            //блок проверки если элемент последжний в какаю либо сторону
            if ($('#slides  .slide').eq(slide_num).length === 0)
                slide_num = 0;
            else if (slide_num < 0)
                slide_num = $('#slides .slide').length - 1;

            $('#slides .slide').eq(slide_num).attr('slide', 'active');
            $('.slide-navigation li').eq(slide_num).addClass('active');
            var otkl = slide_num * sleder_width;
            AnimateSlide(otkl, when_go);
        }
        function AnimateSlide(otkl, when_go) {
            $('.slide_box').css("transform", "translate(-" + otkl + "px,0)");
            $('.slide_box').css("-ms-transform", "translate(-" + otkl + "px,0)");
            $('.slide_box').css("-moz-transform:translate", "translate(-" + otkl + "px,0)");
            $('.slide_box').css("-webkit-transform", "translate(-" + otkl + "px,0)");
            $('.slide_box').css("-o-transform:translate", "translate(-" + otkl + "px,0)");
        }
</script>
<div class=""></div>

<div class="page-header">
    <h1>Студент нашей кафедры?</h1>
    <div class="reg_tut">
        <span>&rarr;&nbsp;</span><a href="<?php echo Yii::app()->createAbsoluteUrl('/site/registration'); ?>" class="classic" async="async" >регистрация тут</a>
    </div>
</div>
<div class="student_mine">
    <div class="wants">
        <div class="table_t">
            <div class="tr_t">
                <div class="td_t">
                    <h2>Новости</h2>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/post/index" class="wants_rot aspx_4 active_poplavok" space="1" async="async" >
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" x="0px" y="0px" fill="#fff" width="100px" height="100px" viewBox="0 0 100 100" overflow="" enable-background="new 0 0 100 100" xml:space="preserve">
                        <path d="M87.989,14.304H43.423H27.825c-5.898,0-10.677,4.779-10.677,10.682v0.009h-5.435 c-3.706,0-6.969,1.894-8.884,4.766C1.676,31.462,1,33.523,1,35.735v0.004V68.34c0,11.236,5.188,18.838,17.81,18.838h69.18 c5.899,0,10.673-4.787,10.673-10.681V24.986C98.662,19.083,93.889,14.304,87.989,14.304z M12.537,75.321 c-2.543,0-4.606-2.072-4.606-4.621V35.348c0.345-1.552,1.733-2.721,3.395-2.721h5.822v7.883h-4.387v4.736h4.387v6.242h-4.387v4.738 h4.387v6.24h-4.387v4.741h4.387V70.7C17.148,73.249,15.086,75.321,12.537,75.321z M91.859,72.901h-0.018 c0,4.271-3.462,7.738-7.74,7.738l-0.004,0.018H18.873c4.111-0.18,7.392-3.561,7.392-7.722l0.013-47.523 c0-1.922,1.561-3.479,3.48-3.479H88.38c1.916,0,3.479,1.557,3.479,3.479V72.901z"/>
                        <rect x="33.251" y="28.686" width="22.357" height="29.443"/>
                        <rect x="62.636" y="28.529" width="22.35" height="4.512"/>
                        <rect x="62.636" y="41.103" width="22.35" height="4.512"/>
                        <rect x="62.636" y="53.672" width="22.35" height="4.512"/>
                        <rect x="33.157" y="66.244" width="51.828" height="4.515"/>
                        </svg>
                        <div class="poplavok" ></div>
                    </a>
                </div>
                <div class="td_t">
                    <h2>Статистика</h2>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/reestr/index" async="async" class="wants_rot aspx_5" space="4">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#fff" version="1.0" x="0px" y="0px" width="100px" height="100px" viewBox="0 0 100 100" overflow="" enable-background="new 0 0 100 100" xml:space="preserve">
                        <path d="M65.188,42.455c-3.204,0.722-5.215,3.912-4.485,7.116c0.096,0.454,0.256,0.872,0.438,1.273l-4.561,6.611 c-2.066-0.298-4.214,0.509-5.567,2.265l-6.474-1.052c-0.22-0.762-0.581-1.476-1.109-2.121c-2.082-2.539-5.825-2.92-8.371-0.849 c-2.545,2.087-2.915,5.831-0.843,8.377c0.167,0.212,0.364,0.407,0.557,0.589l-1.885,6.671c-2.142,0.609-3.859,2.396-4.253,4.74 c-0.55,3.239,1.632,6.31,4.87,6.854c3.248,0.544,6.314-1.642,6.865-4.881c0.324-1.978-0.359-3.883-1.674-5.2l1.935-6.869 c0.692-0.226,1.357-0.57,1.958-1.055c0.164-0.143,0.316-0.284,0.474-0.438l7.191,1.185c0.417,0.953,1.065,1.82,1.963,2.479 c2.665,1.935,6.384,1.351,8.322-1.313c1.237-1.692,1.44-3.825,0.727-5.644l4.845-6.997c0.567,0.031,1.135-0.014,1.698-0.135 c3.214-0.728,5.225-3.909,4.499-7.116C71.582,43.739,68.391,41.728,65.188,42.455z"/>
                        <path d="M50.269,16.437c2.604,0,4.701-2.098,4.701-4.695c0-2.594-2.097-4.702-4.701-4.702 c-2.588,0-4.691,2.107-4.691,4.702C45.577,14.339,47.68,16.437,50.269,16.437z"/>
                        <path d="M77.011,6.925H63.046c-1.423-2.828-4.055-4.942-7.225-5.638c-0.023-0.012-0.049-0.012-0.058-0.029 c-0.069-0.007-0.138-0.024-0.2-0.024c-0.423,0-0.766,0.343-0.766,0.761c0,0.327,0.21,0.605,0.497,0.706 c3.342,1.812,5.627,5.342,5.627,9.417h8.872c5.901,0,10.688,4.792,10.688,10.696v3.37c0,1.781-1.452,3.239-3.24,3.239H23.218 c-1.795,0-3.241-1.458-3.241-3.239v-3.37c0-5.904,4.788-10.696,10.688-10.696h8.876c0-1.885,0.488-3.651,1.349-5.192H23.969 c-7.202,0-13.036,5.844-13.036,13.049v66.982v0.006c0,7.205,5.833,13.038,13.036,13.038h53.045c7.203,0,13.037-5.833,13.037-13.038 v-0.006V19.974C90.052,12.77,84.214,6.925,77.011,6.925z M77.242,85.384c0,1.797-1.454,3.241-3.247,3.241h-47.46 c-1.788,0-3.239-1.444-3.239-3.241V40.078c0-1.789,1.451-3.24,3.239-3.24h47.46c1.793,0,3.247,1.451,3.247,3.24V85.384z"/>
                        </svg>
                        <div class="poplavok" ></div>
                    </a>
                </div>
                <div class="td_t">
                    <h2>Вопросы</h2>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/forum/index" async="async" class="wants_rot aspx_7" space="2" >
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#fff" version="1.1" x="0px" y="0px" width="100px" height="100px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">

                        <g id="Your_Icon">
                        <circle cx="48.594" cy="22.661" r="11.902"/>
                        <path d="M91.053,89L80.472,74H50.411H23.585c-3.565-4-8.998-9.924-9.573-11c-1.066-2,17.149-15.573,17.149-15.573L29.143,69h39.496   l-1.58-22.86c7.39-3.512,23.697-9.554,23.697-14.096s-5.925-18.699-9.479-22.648c-3.555-3.95-5.925-3.129-5.728,0.03   c0.155,2.47,5.529,17.197,3.949,19.566c-1.579,2.37-22.145,6.58-22.145,6.58s-5.712,3.875-8.905,3.584   c-3.194,0.291-9.284-3.74-9.284-3.74S23.207,38.292,20.9,39.97C19.208,41.201,2.714,62.417,3.004,64.158   c0.188,1.124,8.117,8.102,14.738,13.273L9.77,89H21v6h5v-6h48v6h5v-6H91.053z"/>
                        <polygon points="221.09,21.82 224.311,33.515 227.531,21.82  "/>
                        <polygon points="221.09,44.841 224.311,33.146 227.531,44.841  "/>
                        <path d="M219.639,36.025v-8.637h-10.683l-4.877-4.876h-13.454L178.86,11h-7.32l6.744,16.389h-10.446   c-7.898,0-14.123-11.905-14.123-11.905h-4.506l0.487,15.575l18.142,9.844h10.155l-6.515,15.487h11.637l14.809-15.487h17.229   c0,0,2.814,0.004,3.753-0.935C219.845,39.028,219.639,36.025,219.639,36.025z"/>
                        <path d="M204.079,34.523"/>
                        <polygon points="141.509,89.04 141.533,83.077 163.798,64.442 186.062,83.077 186.069,88.992 163.798,70.353  "/>
                        <polygon points="178.77,81.762 175.166,78.866 205.083,53.825 234.941,78.866 234.941,84.705 205.083,59.736  "/>
                        </g>
                        </svg>
                        <div class="poplavok" ></div>
                    </a>
                </div>
                <div class="td_t">
                    <h2>Библиотека</h2>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/library/index" async="async" class="wants_rot aspx_9" space="3" >
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#fff" version="1.1" id="Calque_2" x="0px" y="0px" width="100px" height="100px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                        <g>
                        <path d="M96.151,33.194c0-11.975-9.729-21.716-21.689-21.716c-2.779,0-5.536,0.536-8.098,1.563   C62.134,6.176,54.548,1.86,46.398,1.86c-11.827,0-21.659,8.744-23.213,20.251c-4.758,1.181-8.77,4.407-10.938,8.836   c-4.831,1.754-8.105,6.353-8.105,11.592c0,6.806,5.537,12.343,12.343,12.343h8.223l11.747,30.521   c3.241,7.666,10.713,12.619,19.035,12.619c11.393,0,20.66-9.269,20.66-20.658l0.028-22.558   C87.336,53.931,96.151,44.576,96.151,33.194z M53.078,46.888c0-1.44,0.983-2.657,2.145-2.657c1.162,0,2.146,1.217,2.146,2.657   v13.812c0,0.798,0.65,1.447,1.448,1.447c0.801,0,1.448-0.649,1.448-1.447V46.888c0-1.44,0.983-2.657,2.146-2.657   c1.164,0,2.146,1.217,2.146,2.657v13.812c0,0.798,0.648,1.447,1.449,1.447s1.448-0.649,1.448-1.447V50.511   c0-1.442,0.984-2.658,2.146-2.658c1.163,0,2.146,1.216,2.146,2.655l-0.034,26.855c0,8.946-7.277,16.223-16.222,16.223   c-6.535,0-12.401-3.889-14.931-9.863L28.666,52.814c-0.341-0.867,0.084-1.932,0.966-2.343l0.772-0.39   c0.844-0.393,1.933-0.034,2.376,0.781l10.381,19.112c0.317,0.583,0.991,0.876,1.63,0.712c0.642-0.163,1.093-0.743,1.093-1.404   l0.006-41.232c0-1.44,0.982-2.658,2.145-2.658S50.18,26.61,50.18,29.5l0.005,31.199c0,0.798,0.649,1.447,1.45,1.447   s1.449-0.649,1.449-1.447L53.078,46.888z M40.015,54.884h1.434l-0.001,2.639L40.015,54.884z M76.14,49.728   c-0.362-3.545-3.156-6.314-6.54-6.314c-0.46,0-0.92,0.053-1.369,0.16c-1.116-2.291-3.327-3.781-5.82-3.781   c-1.298,0-2.535,0.401-3.594,1.149c-1.058-0.748-2.295-1.149-3.594-1.149c-0.202,0-0.404,0.01-0.603,0.029V28.051   c0-3.913-2.954-7.095-6.584-7.095c-3.63,0-6.583,3.183-6.583,7.095l-0.003,21.762h-4.19l-0.578-1.063   c-1.089-2.007-3.215-3.253-5.548-3.253c-0.923,0-1.813,0.196-2.685,0.604l-0.73,0.369c-1.466,0.683-2.555,1.913-3.134,3.344h-8.098   c-4.01,0-7.272-3.263-7.272-7.271c0-3.342,2.26-6.241,5.496-7.049c0.79-0.197,1.437-0.762,1.739-1.519   c1.577-3.938,5.172-6.697,9.384-7.199c1.229-0.147,2.172-1.159,2.232-2.395c0.48-9.783,8.532-17.447,18.333-17.447   c7.05,0,13.562,4.123,16.591,10.505c0.299,0.629,0.843,1.108,1.507,1.325c0.664,0.215,1.388,0.148,1.999-0.187   c2.426-1.326,5.181-2.025,7.967-2.025c9.165,0,16.619,7.466,16.619,16.645C91.081,41.791,84.519,48.883,76.14,49.728z"/>
                        </g>
                        </svg>
                        <div class="poplavok" ></div>
                    </a>    
                </div>
            </div>
        </div>
        <div class="wants_text">
            <div class="wants_text_in"></div>
        </div>
    </div>
</div>
<script>
    var text;
    SelectText($('.active_poplavok').attr('space'));
    $('.wants_rot').hover(function() {
        $('.wants_rot').removeClass('active_poplavok');
        $(this).addClass('active_poplavok');
        SelectText($(this).attr('space'));
        $('.wants_text_in').text(text);
    });
    function SelectText(id_text) {
        if (id_text == '1') {
            text = 'Здесь вы можете не только читать интересные и свежие новости, но и сами участвовать в их публикации.';
        } else if (id_text == '2') {
            text = 'Здесь вы можете задать вопрос преподавателю. ';
        } else if (id_text == '3') {
            text = 'Здесь вы можете найти полезный материал и поделится им с другими.';
        } else if (id_text == '4') {
            text = 'Здесь вы можете просматреть статистику успеваемости студентов';
        }
        return text;
    }
    $('.wants_text_in').text(text);
</script>


<div class="frends_info">Друзья кафедры</div>
<div class="frends_kav bord_rasd">
    <div class="table_t">
        <div class="tr_t">
            <div class="td_t">
                <a href="http://www.siemens.com/answers/ru/ru/" class="frends_this frends_simens " title="Официальный сайт Сименс"> </a>
            </div>
            <div class="td_t">
                <a href="http://kgeu.ru/" class="frends_this frends_kgeu" title="Сайт КГЭУ"></a>
            </div>
            <div class="td_t">
                <a href="http://ker-eng.com/" class="frends_this frends_ker" title="Официальный сайт КЭР"></a>
            </div>
        </div>
    </div>
</div>



<!--скрипты-->
<script >
    var codropsEvents = {
<?php
foreach ($activitys as $activity) {
    echo "'" . $activity->mounth . "-" . $activity->day . "-" . $activity->year . "'" . ":" . "'<span>" . $activity->title . '<div class="activities_content">' . $activity->content . '</div>' . "</span>',";
};
?>
    };
</script>

<script type="text/javascript">
    $(function() {

        var transEndEventNames = {
            'WebkitTransition': 'webkitTransitionEnd',
            'MozTransition': 'transitionend',
            'OTransition': 'oTransitionEnd',
            'msTransition': 'MSTransitionEnd',
            'transition': 'transitionend'
        },
        transEndEventName = transEndEventNames[ Modernizr.prefixed('transition') ],
                $wrapper = $('#custom-inner'),
                $calendar = $('#calendar'),
                cal = $calendar.calendario({
            onDayClick: function($el, $contentEl, dateProperties) {

                if ($contentEl.length > 0) {
                    showEvents($contentEl, dateProperties);
                }

            },
            caldata: codropsEvents,
            displayWeekAbbr: true
        }),
                $month = $('#custom-month').html(cal.getMonthName()),
                $year = $('#custom-year').html(cal.getYear());

        $('#custom-next').on('click', function() {
            cal.gotoNextMonth(updateMonthYear);
        });
        $('#custom-prev').on('click', function() {
            cal.gotoPreviousMonth(updateMonthYear);
        });

        function updateMonthYear() {
            $month.html(cal.getMonthName());
            $year.html(cal.getYear());
        }

        // just an example..
        function showEvents($contentEl, dateProperties) {

            hideEvents();

            var $events = $('<div id="custom-content-reveal" class="custom-content-reveal"><h4>' + dateProperties.monthname + ' ' + dateProperties.day + ', ' + dateProperties.year + '</h4></div>'),
                    $close = $('<span class="custom-content-close"></span>').on('click', hideEvents);

            $events.append($contentEl.html(), $close).insertAfter($wrapper);

            setTimeout(function() {
                $events.css('top', '0%');
            }, 25);

        }
        function hideEvents() {

            var $events = $('#custom-content-reveal');
            if ($events.length > 0) {

                $events.css('top', '100%');
                Modernizr.csstransitions ? $events.on(transEndEventName, function() {
                    $(this).remove();
                }) : $events.remove();

            }

        }

    });
</script>

