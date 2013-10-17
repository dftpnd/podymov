<div class="disclamer">
  Внимание! «<?php echo MyHelper::getUsername(FALSE, FALSE, $profile, TRUE) ?>», не регистрировался в системе.<br/>
  Данный профайл ни как не связан с настоящим человеком, а создан лишь для просмотра статистики всей группы.<br/>
  Любые совпадения - считать случайностью.
</div>

<div class="pr">
  <div class="name_page">
    <?php echo MyHelper::getUsername(FALSE, FALSE, $profile, TRUE) ?>
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
            <?php if (isset($profile->mean)) echo $profile->mean ?>
          </span>
        </div>
        <div class="anchor"></div>
        <div class="anchor"></div>
      </div>
      <div class="td_t">


        <div class="resume__emptyblock" >
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

    </div>

  </div>



