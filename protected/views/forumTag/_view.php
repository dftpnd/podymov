<?php if (isset($data->forum->id)): ?>
<?php
//rating
    $znak_plus = '';
    $type = ObjectRating::NEW_FORUM;
    $plus = ObjectRating::PLUS;
    $minus = ObjectRating::MINUS;
    $forum_id = $data->forum->id;
    if (!Yii::app()->user->isGuest) {
        $text_script_plus = "ObjectRating($type, $forum_id ,$plus)";
        $text_script_minus = "ObjectRating($type, $forum_id ,$minus)";
        $div_title_plus = 'Нравится';
        $div_title_minus = 'Не нравится';
    } else {
        $text_script_plus = '';
        $text_script_minus = '';
        $div_title_plus = $div_title_minus = 'Голосовать могут только зарегистрированные пользователи.';
    }

    if (!is_null($data->forum->rating)) {
        $state = $data->forum->rating;
        if ($state > 0) {
            $class = 'poloj';
            $znak_plus = '+';
        } else if ($state < 0) {
            $class = 'otr';
        } else {
            $class = 'null';
        }
    } else {
        $state = '0';
        $class = 'null';
    }

//avater
    $my_picter = Yii::app()->createAbsoluteUrl('i/avatar.png');
    if (!is_null($data->forum->user->prof->file_id)) {
        $file_name = $data->forum->user->prof->uploadedfiles->name;
        $my_picter = Yii::app()->createAbsoluteUrl('uploads/avatar/avatar_' . $file_name);
    }
//data
    $m = date('m', $data->forum->created);
    $j = date('j', $data->forum->created);
    $y = date('Y', $data->forum->created);


    ?>

    <div class="forum" id="f_<?php echo $data->forum->id; ?>">
        <div class="forum_date">
            <?php echo $j . ' ' . MyHelper::getRusMonth($m) . ' ' . $y; ?>
        </div>
        <?php if ((!Yii::app()->user->isGuest) && (Yii::app()->user->id == $data->forum->user_id)): ?>
            <div class="manage_panel">
                <div class="edit_forum" onclick="openUpdateForum(<?php echo $data->forum->id; ?>)">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                         id="Your_Icon" x="0px" y="0px" width="25px" height="20px" fill="#999" viewBox="0 0 100 100"
                         enable-background="new 0 0 100 100" xml:space="preserve">
                <polygon points="15.081,64.633 37.24,86.144 79.92,42.182 57.762,20.678 "/>
                        <polygon points="31.516,92.047 9.356,70.535 0,100.869 "/>
                        <path d="M0,100.869"/>
                        <polygon points="77.841,0 63.5,14.768 85.659,36.279 100,21.504 "/>
            </svg>
                </div>
                <div class="delete_forum" onclick="forumDelete(<?php echo $data->forum->id; ?>)">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                         id="Icon"
                         x="0px" y="0px" width="20px" height="20px" viewBox="0 0 100 100"
                         enable-background="new 0 0 100 100"
                         xml:space="preserve">
                <g>
                    <path fill="#999"
                          d="M88.184,81.468c1.167,1.167,1.167,3.075,0,4.242l-2.475,2.475c-1.167,1.167-3.076,1.167-4.242,0   l-69.65-69.65c-1.167-1.167-1.167-3.076,0-4.242l2.476-2.476c1.167-1.167,3.076-1.167,4.242,0L88.184,81.468z"/>
                </g>
                        <g>
                            <path fill="#999"
                                  d="M18.532,88.184c-1.167,1.166-3.076,1.166-4.242,0l-2.475-2.475c-1.167-1.166-1.167-3.076,0-4.242   l69.65-69.651c1.167-1.167,3.075-1.167,4.242,0l2.476,2.476c1.166,1.167,1.166,3.076,0,4.242L18.532,88.184z"/>
                        </g>
            </svg>
                </div>
                <div class="anchor"></div>
            </div>
        <?php endif; ?>
        <div class="forum_grid">
            <div class="forum_grid_info">
                <div class="forum_grid_block">

                    <?php echo CHtml::link("<img  src='$my_picter' />", Yii::app()->urlManager->createUrl('/user/ViewProfile', array('id' => $data->forum->user->prof->id)), array('async' => 'async', 'class' => 'circle_picter')); ?>
                    <a async="async" class="classic"
                       href="/user/ViewProfile"><?php echo MyHelper::getUsername($data->forum->user_id) ?></a>


                </div>
            </div>
            <div class="forum_grid_content">
                <div class="forum_grid_block">
                    <h1><a async="async" href='/forum/view?id=<?php echo $data->forum->id ?>'
                           class="classic"
                           title="<?php echo $data->forum->title; ?>"><?php echo $data->forum->title; ?></a></h1>

                    <div class="forum_content_text">
                        <?php echo MyHelper::makeClickableLinks($data->forum->content); ?>
                    </div>
                    <div class="infopanel" id="inf_<?php echo $data->forum->id; ?>">
                        <div class="table_t">
                            <div class="tr_t">
                                <div class="td_t">
                                    <div class="prosmotr"
                                         title="Просмотры обсуждения"><?php echo $data->forum->view; ?></div>
                                </div>
                                <div class="td_t">
                                    <div class="comments" title="Читать комментарии">
                                        <a href="/forum/view?id=<?php echo $data->forum->id; ?>#comments"><?php echo MyHelper::commentCount($data->forum->id); ?></a>
                                    </div>
                                </div>
                                <div class="td_t">
                                    <div class="voting">
                                    <span class="plus" title="<?php echo $div_title_plus; ?>"
                                          onclick="<?php echo $text_script_plus; ?>"></span>

                                        <div class="mark">
                                        <span class="score  <?php echo $class; ?>" title="">
                                            <?php echo $znak_plus . $state; ?>
                                        </span>
                                        </div>
                                    <span class="minus" title="<?php echo $div_title_minus; ?>"
                                          onclick="<?php echo $text_script_minus; ?>"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="anchor"></div>
        <div class="forum_content_tags">
            <?php $tegs = MyHelper::forumTag($data->forum->id); ?>
            <?php if (!empty($tegs)): ?>
                <?php foreach ($tegs as $tag): ?>
                    <?php if (isset($tag->tag)): ?>
                        <a async="async" class="tag_<?php echo $tag->tag->id; ?>"
                           href="/forum/index?tag_id=<?php echo $tag->tag->id; ?>">#<?php echo $tag->tag->name; ?></a>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>