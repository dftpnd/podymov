<?php
$data->prosmotr += 1;
$data->update(false);
?>

<div class="post">
    <div class="title">
        <?php echo CHtml::link(CHtml::encode($data->title), $data->url, array('async' => 'async')); ?>
    </div>
    <div class="content">
        <?php
        $this->beginWidget('CMarkdown', array('purifyOutput' => true));
        echo $data->content;
        $this->endWidget();
        ?>
        <?php
        if ($data->show_foto != 2) {
            echo CHtml::link('Посмотреть все фотографии', Yii::app()->urlManager->createUrl('post/scrapbook', array('post_id' => $data->id)), array(
                'class' => 'scrap',
                'async' => 'async'
            ));
        }
        ?>
        <div class="anchor"></div>
    </div>
    <div class="anchor"></div>
    <div class='infopanel' id="inf_<?php echo $data->id; ?>" >
        <div class="table_t">
            <div class="tr_t">
                <div class="td_t">
                    <div class="prosmotr" title="Просмотры статьи">
                        <?php
                        if (is_null($data->prosmotr)) {
                            echo '0';
                        } else {
                            echo $data->prosmotr;
                        }
                        ?>
                    </div>
                </div>
                <div class="td_t">
                    <div class="author">

                        <?php
                        echo CHtml::link($data->profile->name . ' ' . $data->profile->surname, Yii::app()->urlManager->createUrl('/user/ViewProfile', array('id' => $data->profile->id)), array(
                            'class' => 'classic',
                            'title' => 'Автор текста',
                            'async' => 'async',
                        ));
                        ?>
                    </div>
                </div>
                <div class="td_t">
                    <div class="date_state">
                        <?php echo Utils::time($data->create_time); ?>
                    </div>
                </div>
                <div class="td_t">
                    <?php
                    if ($gost_or_user == 'user') {
                        $text_script_plus = "ObjectRating($type_1, $data->id,$plus_1)";
                        $text_script_minus = "ObjectRating($type_1, $data->id,$minus_1)";
                        $div_title_plus = 'Нравится';
                        $div_title_minus = 'Не нравится';
                    } else if ($gost_or_user == 'gost') {
                        $text_script_plus = '';
                        $text_script_minus = '';
                        $div_title_plus = $div_title_minus = 'Голосовать могут только зарегистрированные пользователи.';
                    }
                    ?>
                    <div class="voting ">
                        <span class="plus" title="<?php echo $div_title_plus; ?>" onclick="<?php echo $text_script_plus; ?>"></span>
                        <div class="mark">
                            <?php
                            $znak_plus = '';

                            if (!is_null($data->rating)) {
                                $state = $data->rating;
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
                            ?>
                            <span class="score  <?php echo $class; ?>" title="">
                                <?php echo $znak_plus . $state; ?>
                            </span>
                        </div>
                        <span class="minus" title="<?php echo $div_title_minus; ?>" onclick="<?php echo $text_script_minus; ?>" ></span>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="anchor"></div>
</div>


