<?php
if (isset($_GET['id'])) {
  $get_id = $_GET['id'];
} else {
  $get_id = '0';
}
;
?>

<?php if ($user_author->banned == 1): ?>
  <div class="ban"></div>
<?php endif; ?>
<?php if (!is_null($user_author->laste_enter)): ?>
  <div class="laste_enter">
    <div class="clock">
      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="100%" height="100%" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
      <path d="M50,89.836c-23.389,0-42.418-19.027-42.418-42.417C7.582,24.029,26.611,5,50,5c23.389,0,42.418,19.029,42.418,42.419  C92.418,70.809,73.389,89.836,50,89.836z M50,9.912c-20.681,0-37.506,16.826-37.506,37.508c0,20.681,16.826,37.505,37.506,37.505  s37.507-16.824,37.507-37.505C87.507,26.737,70.681,9.912,50,9.912z"/>
      <path d="M50.001,49.875c-0.141,0-0.283-0.011-0.427-0.037c-1.173-0.206-2.03-1.226-2.03-2.419V29.442c0-1.355,1.1-2.456,2.456-2.456  c1.355,0,2.456,1.1,2.456,2.456v4.003l5.431-14.974c0.464-1.274,1.872-1.937,3.146-1.471c1.274,0.462,1.934,1.871,1.471,3.146  l-10.195,28.11C51.952,49.241,51.019,49.875,50.001,49.875z"/>
      <circle cx="49.999" cy="12.956" r="1.617"/>
      <path d="M50,14.778c-1.006,0-1.823-0.817-1.823-1.823c0-1.005,0.817-1.823,1.823-1.823c1.004,0,1.821,0.817,1.821,1.823  C51.821,13.961,51.004,14.778,50,14.778z M50,11.542c-0.779,0-1.414,0.635-1.414,1.413c0,0.779,0.635,1.414,1.414,1.414  s1.412-0.635,1.412-1.414C51.412,12.177,50.779,11.542,50,11.542z"/>
      <circle cx="34.343" cy="20.301" r="1.47"/>
      <path d="M23.617,30.488c0.703,0.409,0.945,1.305,0.537,2.008c-0.405,0.704-1.305,0.947-2.007,0.538  c-0.703-0.403-0.945-1.305-0.539-2.008C22.016,30.325,22.913,30.085,23.617,30.488z"/>
      <circle cx="15.536" cy="47.42" r="1.618"/>
      <path d="M15.536,49.242c-1.006,0-1.823-0.817-1.823-1.823c0.001-1,0.819-1.819,1.823-1.822c1.006,0,1.823,0.817,1.823,1.822  C17.359,48.425,16.542,49.242,15.536,49.242z M15.536,46.006c-0.777,0.003-1.412,0.636-1.414,1.413c0,0.779,0.635,1.414,1.414,1.414  s1.413-0.635,1.413-1.414C16.949,46.641,16.315,46.006,15.536,46.006z"/>
      <path d="M22.147,61.803c0.705-0.406,1.602-0.167,2.007,0.537c0.408,0.703,0.166,1.602-0.537,2.008  c-0.704,0.406-1.604,0.163-2.008-0.537C21.202,63.104,21.447,62.209,22.147,61.803z"/>
      <path d="M33.07,73.803c0.408-0.706,1.305-0.946,2.008-0.537c0.704,0.403,0.945,1.302,0.538,2.005  c-0.405,0.704-1.307,0.947-2.007,0.537C32.904,75.402,32.667,74.507,33.07,73.803z"/>
      <path d="M48.382,81.884c0-0.896,0.725-1.618,1.618-1.618c0.892-0.003,1.618,0.723,1.618,1.618c0,0.892-0.728,1.618-1.618,1.618  C49.104,83.498,48.385,82.775,48.382,81.884z"/>
      <path d="M50,83.706L50,83.706c-1.002-0.003-1.819-0.82-1.823-1.822c0-1.006,0.817-1.823,1.823-1.823  c1.007,0,1.822,0.817,1.822,1.823C51.822,82.889,51.006,83.706,50,83.706z M50.006,80.47c-0.785,0-1.42,0.635-1.42,1.414  c0.003,0.775,0.637,1.41,1.414,1.413c0.78,0,1.413-0.635,1.413-1.413C51.413,81.104,50.782,80.47,50.006,80.47z"/>
      <path d="M64.385,75.271c-0.408-0.703-0.167-1.602,0.537-2.005c0.702-0.409,1.601-0.169,2.008,0.537  c0.406,0.7,0.163,1.603-0.539,2.005C65.686,76.214,64.791,75.971,64.385,75.271z"/>
      <path d="M76.384,64.348c-0.704-0.406-0.945-1.305-0.537-2.008c0.402-0.704,1.301-0.943,2.006-0.537  c0.704,0.402,0.945,1.308,0.539,2.008C77.98,64.511,77.087,64.751,76.384,64.348z"/>
      <path d="M84.464,49.038c-0.896-0.003-1.618-0.726-1.618-1.618c-0.001-0.892,0.723-1.618,1.618-1.618  c0.893-0.003,1.618,0.726,1.618,1.618C86.077,48.315,85.356,49.034,84.464,49.038z"/>
      <path d="M84.464,49.242L84.464,49.242c-1.006-0.003-1.822-0.822-1.822-1.823c-0.002-0.486,0.188-0.943,0.532-1.287  c0.344-0.345,0.803-0.535,1.29-0.535c1.007,0,1.822,0.817,1.822,1.822C86.282,48.422,85.463,49.239,84.464,49.242z M84.471,46.006  c-0.386,0-0.74,0.147-1.008,0.416c-0.267,0.267-0.412,0.621-0.412,0.998c0,0.777,0.635,1.41,1.413,1.414  c0.775-0.003,1.408-0.638,1.413-1.415C85.877,46.641,85.246,46.006,84.471,46.006z"/>
      <path d="M77.853,33.034c-0.705,0.409-1.604,0.166-2.006-0.538c-0.408-0.7-0.168-1.599,0.537-2.008  c0.701-0.406,1.604-0.163,2.008,0.537C78.795,31.732,78.553,32.627,77.853,33.034z"/>
      <path d="M66.93,21.036c-0.407,0.704-1.308,0.943-2.008,0.537c-0.704-0.403-0.945-1.305-0.537-2.008  c0.404-0.703,1.306-0.943,2.006-0.537C67.095,19.437,67.333,20.333,66.93,21.036z"/>
      </svg>

    </div>
    <div class="ajkll">
      Последний визит <?php echo date('d-m-y G:i', $user_author->laste_enter);?>
    </div>
  </div>
<?php endif; ?>
<div class="carma" title="">
  <div class="table_t">
    <div class="tr_t">
      <div class="td_t">
        <div class="carma_plus">
          <?php
          if (isset($profile->plus)) {
            echo '+' . $profile->plus;
          } else {
            echo "0";
          }
          ?>
        </div>
      </div>
      <div class="td_t">
        <div class="slesh">/</div>
      </div>
      <div class="td_t">
        <div class="carma_minus">
          <?php
          if (isset($profile->minus)) {
            echo '-' . $profile->minus;
          } else {
            echo "0";
          }
          ?>
        </div>
      </div>
    </div>
  </div>


</div>


<div class="pr">
  <div class="name_page">
    <?php echo $profile->name . ' ' . $profile->surname; ?>
  </div>
  <div class="table_t editprofile">
    <div class="tr_t">
      <div class="td_t">

        <div class="lft_b resume__emptyblock">

          <div class="avatar">
            <?php
            $picter = Yii::app()->createAbsoluteUrl('i/avatar.svg');
            if (!empty($profile->file_id)) {
              $file_name = $profile->uploadedfiles->name;
              $picter = Yii::app()->createAbsoluteUrl('uploads/avatar/avatar_' . $file_name);
            }
            ?>
            <img src="<?php echo $picter; ?>" />
          </div>

          <div class="avatar_wind">

          </div>
        </div>
        <div class="anchor"></div>
        <div class="medal">
          <span title="Средний балл успеваемости">
            <?php if (isset($profile->mean)) echo (int)$profile->mean ?>
          </span>
        </div>
        <div class="anchor"></div>
        <a href="/files/files?id=<?php echo $user_author->id ?>"  async="async" class="profile_files" title="Файлы пользователя">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="100px" height="100px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
          <path d="M100,31.806c0-2.07-1.678-3.75-3.75-3.75h-0.323c-0.348-1.711-1.859-3-3.675-3H41.181l-9.803-11.374l-0.019,0.005  c-0.681-0.696-1.628-1.13-2.679-1.13H3.75c-2.071,0-3.749,1.679-3.749,3.75v67.38L0,83.693c0,2.071,1.678,3.75,3.748,3.75H3.75  h16.873h0.002H37.5h0.001H92.25h0.002c2.072,0,3.75-1.679,3.75-3.75v-0.025L100,31.806z M37.5,84.443H20.623H3.748  c-0.389,0-0.709-0.298-0.745-0.679L6.991,31.96C6.997,31.883,7,31.806,7,31.729c0-0.414,0.335-0.75,0.747-0.75h0.721l87.534,0.076  l0,0h0.248c0.39,0,0.711,0.299,0.747,0.679l-0.995,12.907l0,0l-2.993,38.821C93.003,83.539,93,83.616,93,83.693  c0,0.413-0.337,0.75-0.75,0.75H37.5z"/>
          </svg>
        </a>
        <div class="anchor"></div>
        <a href="/user/stats?user_id=<?php echo $user_author->id ?>" async="async" title="Зачетная книжка">
          <div class="record_book"></div>
        </a>
      </div>
      <div class="td_t">
        <?php
        if (
                isset($profile->pthon) ||
                $profile->pthon != '' ||
                $profile->leader != NUll ||
                isset($profile->kontakt_email) ||
                $profile->kontakt_email != '' ||
                isset($profile->website) ||
                $profile->website != '' ||
                isset($profile->kontact) ||
                $profile->kontact != '' ||
                isset($profile->skype) ||
                $profile->skype != ''
        ):
          ?>
          <?php if (!empty($profile->private)): ?>
            <div class="resume__emptyblock">
              <?php echo MyHelper::makeClickableLinks($profile->private); ?>
            </div>
          <?php endif; ?>
          <div class="right_b resume__emptyblock">
            <?php if (Yii::app()->user->getRole() == 'authority'): ?>
<!--              <div class="web_administrator " >Администратор Сайта</div>-->
            <?php endif; ?>
            <?php if ($profile->leader != NUll): ?>
<!--              <div class="web_staroste " >Администратор группы</div>-->
            <?php endif; ?>
            <div class="ldk">
              Группа:
              <?php
              echo CHtml::link($group->name . ' 1-' . $group->inseption->prefix_year, Yii::app()->urlManager->createUrl('/reestr/group', array('id' => $group->id)), array(
                  'class' => 'group classic',
                  'async' => 'async'
              ));
              ?>
            </div>
            <ul class="social_contact">
              <?php if (isset($profile->pthon) && $profile->pthon != ''): ?>
                <li>
                  <label class="social_img thone_c"  title="Контактный телефон">
                    <?php echo $profile->pthon; ?>
                  </label>
                </li>
              <?php endif; ?>
              <?php if (isset($profile->kontakt_email) && $profile->kontakt_email != ''): ?>
                <li>
                  <label class="social_img email_c" title="Контактный адрес эл. почты">
                    <?php echo $profile->kontakt_email; ?>
                  </label>
                </li>
              <?php endif; ?>
              <?php if (isset($profile->website) && $profile->website != ''): ?>
                <li>
                  <label class="social_img web_c" title="Веб сайт">
                    <a href="http://<?php echo $profile->website; ?>" class="classic"><?php echo $profile->website; ?></a>
                  </label>
                </li>
              <?php endif; ?>
              <?php if (isset($profile->kontact) && $profile->kontact != ''): ?>
                <li>
                  <label class="social_img vk_c" title="Вконтакте">
                    <a class="classic" href="<?php echo $profile->kontact; ?>"><?php echo $profile->kontact; ?></a>
                  </label>
                </li>
              <?php endif; ?>
              <?php if (isset($profile->skype) && $profile->skype != ''): ?>
                <li>
                  <label class="social_img skype_c" title="Скайп">
                    <?php echo $profile->skype; ?>
                  </label>
                </li>
              <?php endif; ?>
            </ul>
          </div>
          <div class="resume__emptyblock" >
            <div class="show_statistic" onclick="switchStatisticUser($(this))">Показать статистику успеваемости </div>
            <div class="hide_statistic" onclick="switchStatisticUser($(this))">Скрыть статистику успеваемости</div>

            <div class="user_statistic">
              <?php if (isset($chartData)) : ?>
                <div>Средний балл по семестрам</div>
                <div id="chartdiv" style="width: 600px; height: 300px;"></div>
                <script>
                  var chartData = <?php echo json_encode($chartData); ?>;
                  var graphs = <?php echo json_encode($graphs); ?>;
                  var options = <?php echo json_encode($options); ?>;
                                                                                                                                                                                                                                                                                                                                                                                                          
                  new AmChartsGrap(chartData, graphs, options);
                </script>
              <?php endif; ?>
              <?php if (isset($rating_5) || isset($rating_4) || isset($rating_5)) : ?>
                <div class="summ_stats" >Общая сумма оценок</div>
                <div id="chartdiv_2" style="width: 600px; height: 300px;"></div>
                <script type="text/javascript">
                  var chart;
                  var legend;

                  var chartData = [{
                      country: "Отлично",
                      value: <?php echo $rating_5; ?>
                    }, {
                      country: "Хорошо",
                      value: <?php echo $rating_4; ?>
                    }, {
                      country: "Удовлетворительно",
                      value: <?php echo $rating_3; ?>
                    },];

                  // PIE CHART
                  chart = new AmCharts.AmPieChart();
                  chart.dataProvider = chartData;
                  chart.titleField = "country";
                  chart.valueField = "value";
                  chart.outlineColor = "#FFFFFF";
                  chart.outlineAlpha = 0.8;//толщина разделительной линии
                  chart.outlineThickness = 2;//толщина разделительной линии
                  // this makes the chart 3D
                  chart.depth3D = 15;
                  chart.angle = 30;
                  chart.startDuration = 0;
                  // WRITE
                  chart.write("chartdiv_2");
                </script>

              <?php endif; ?>
            </div>
          </div>

        <?php endif; ?>
      </div>

    </div>
    <div class="tr_t">
      <div class="td_t"></div>
      <div class="td_t">
        <?php if (!is_null(Yii::app()->user->id)) : ?>

          <div class="this_day">
            <div class="write_small_post">
              <div class="table_t ">
                <div class="tr_t">
                  <div class="td_t wsp">
                    <div class="my_p ">
                      <?php
                      $my_picter = Yii::app()->createAbsoluteUrl('i/mini_avatar.png');
                      if (!is_null($athor->file_id)) {
                        $file_name = $athor->uploadedfiles->name;
                        $my_picter = Yii::app()->createAbsoluteUrl('uploads/avatar/mini_' . $file_name);
                      }
                      ?>
                      <?php echo CHtml::link("<img  src='$my_picter' />", Yii::app()->urlManager->createUrl('/user/ViewProfile', array('id' => $profile->id)), array('class' => 'classic')); ?>
                    </div>
                  </div>
                  <div class="td_t">
                    <div class="my_t">
                      <div name="dolghnost"  id='disifen' onchange="validateText($(this))" class="div_textare"  contentEditable="true" ></div>
                      <div class="inp_sub" id="new_obs" onclick="NewSmallPost(<?php echo $type; ?>,<?php echo $profile->id; ?>)">Отправить</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="anchor"></div>
            <div class="small_posts_view">
              <?php
              if (!empty($discussions)) {
                foreach ($discussions as $discussion) {
                  if ($discussion->parent_id == NULL)
                    $this->renderPartial('application.views.user._small_post', array(
                        'discussion' => $discussion,
                        'type' => $type,
                        'plus' => $plus,
                        'minus' => $minus,
                        'profile' => $athor,
                        'hozyin' => $profile
                            )
                    );
                }
              } else {
                echo 'На этой стене нет записей.';
              }
              ?>
            </div>
            <div class="float_signal" const_type="<?php echo $type; ?>"></div>

          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

</div>
<div id="razdel" class="ent-razdel fix_ent_razd" tab="stats" style="display: none;">
  <div class="name_page">
    <?php echo $profile->name . ' ' . $profile->surname; ?>
  </div>
  <div class="stats_box"></div>
</div>


