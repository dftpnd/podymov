<?php
if (isset($_GET['sect'])) {
  $sect = $_GET['sect'];
} else {
  $sect = 'monday';
}
?>



<?php if (Yii::app()->user->hasFlash('commentSubmitted')): ?>
  <script>
    $(function(){
      text = "<?php echo Yii::app()->user->getFlash('commentSubmitted'); ?>";
      noticeOpen(text,"1");
    });
  </script>
<?php endif; ?>


<h1>Создание расписания</h1>
<div class="slide_menu">
  <ul class="">
    <li tab="monday">
      Понедельник
      <div></div>
    </li>
    <li tab="tuesday">
      Вторник
      <div></div>
    </li>
    <li tab="wednesday">
      Среда
      <div></div>
    </li>
    <li tab="whursday">
      Четверг
      <div></div>
    </li>
    <li tab="friday">
      Пятница
      <div></div>
    </li>
    <li tab="saturday">
      Суббота
      <div></div>
    </li>
  </ul>
</div>





<div class="this_day">

  <?php foreach ($wekdays as $wekday_id => $wekday_value) : ?>
    <?php foreach ($wekday_value as $wekday_tab => $schedule) : ?>

      <div id="razdel<?php echo $wekday_id; ?>" class="ent-razdel fix_ent_razd" tab="<?php echo $wekday_tab ?>" style="display: none;">
        <div class="days">
          <form id="day_<?php echo $wekday_tab ?>" method="post">
            <input type="hidden" name="day_id" value="<?php echo $wekday_id ?>">
            <?php if (!empty($schedule)) : ?>
              <div class="table_t sost_day_<?php echo $wekday_id ?>">
                <div class="tr_t">
                  <div class="td_t">Пара</div>
                  <div class="td_t">Предмет</div>
                  <div class="td_t">По каким неделям</div>
                  <div class="td_t">Тип пары</div>
                  <div class="td_t">Время</div>
                  <div class="td_t">Аудитория</div>
                  <div class="td_t">&nbsp;</div>
                </div>
                <?php foreach ($schedule as $schedule_value) : ?>    
                  <?php
                  $this->renderPartial('application.views.user._tr_schedule', array(
                      'schedule' => $schedule_value,
                      'data' => $data,
                      'data2' => $data2,
                      'data3' => $data3,
                      'type_pair' => $type_pair,
                      'time_pair' => $time_pair,
                      'wekday_id' => $wekday_id
                          )
                  )
                  ?>

                <?php endforeach; ?>
              </div>
              <div class="anchor"></div>
              <div class="mach_linger">
                <input type="submit" value="Сохранить" />
                <div class="inp_sub" onclick="createPredmeDuy(<?php echo $wekday_id ?>)">Добавить пару</div>
              </div>
              <div class="anchor"></div>

            <?php else: ?>
              <div class="table_t sost_day_<?php echo $wekday_id ?>">
                <div class="tr_t">
                  <div class="td_t">Пара</div>
                  <div class="td_t">Предмет</div>
                  <div class="td_t">По каким неделям</div>
                  <div class="td_t">Тип пары</div>
                  <div class="td_t">Время</div>
                  <div class="td_t">Аудитория</div>
                  <div class="td_t">&nbsp;</div>
                </div>
              </div>
              <div class="anchor"></div>
              <div class="mach_linger">
                <input type="submit" value="Сохранить" />
                <div class="inp_sub" onclick="createPredmeDuy(<?php echo $wekday_id ?>)">Добавить пару</div>
              </div>
              <div class="anchor"></div>
            <?php endif; ?>
          </form>
        </div>
      </div>
    <?php endforeach; ?>

  <?php endforeach; ?>

</div>

<script>
  $(function(){
    $("select.select_week").change(function () {
      alert($(this).attr('value'));
    })
    $('.slide_menu ul li[tab="<?php echo $sect ?>"]').addClass('active');
    openTab('<?php echo $sect ?>');
        
    var url = '/user/editschedule';
        
    if("addEventListener" in window) { 
        
      window.addEventListener('popstate', function(e){
        if(e.state != undefined)
          openTab(e.state);
      }, false);

    } else if ("attachEvent" in window) { 
      // выполнится для IE8 и ниже 
      window.attachEvent('popstate', function(e){
        if(e.state != undefined)
          openTab(e.state);
      }, false); 
    } 
  
    function strpos (haystack, needle, offset) {
      var i = (haystack + '').indexOf(needle, (offset || 0));
      return i === -1 ? false : i;
    }
      $(".slide_menu").on("click", "li", function () {
      var tab = $(this).attr('tab');
      history.pushState(tab, '', url+'?sect='+tab );            
      openTab(tab);
    });


      $(".slide_menu").on("click", "li", function () {
            
      $('.slide_menu ul li').removeClass('active'); 
      $(this).addClass('active');
    });
  });
</script>