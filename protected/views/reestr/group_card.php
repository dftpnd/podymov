<?php
if (isset($_GET['sect'])) {
    $se = $_GET['sect'];
} else {
    $se = 'staff_group';
}
?>

<script type="text/javascript">
    $(document).ready(function() {
        
        $('.slide_menu ul li[tab="<?php echo $se ?>"]').addClass('active');
        openTab('<?php echo $se ?>');
        
        var url = '/reestr/group/<?php echo $group->id ?>';
        
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

        //$('.slide_menu ul li').click(function(){
        $(".slide_menu").on("click", "li", function () {
            var tab = $(this).attr('tab');
            openTab(tab);
            history.pushState(tab, '', url+'?sect='+tab );            
        });


        $(".slide_menu").on("click", "li", function () {
            $('.slide_menu ul li').removeClass('active'); 
            $(this).addClass('active');
        });
    });
        
</script>

<div class="slide_menu">
    <ul>
        <li class='' id="card_menu_2" razdel="1" tab="staff_group" >
            Состав группы
            <div></div>
        </li>
        <li class='' id="card_menu_3" razdel="2" tab="items_group" >
            Предметы группы
            <div></div>
        </li>
        <li class='' id="card_menu_3" razdel="2" tab="schedule_group" >
            Расписание группы
            <div></div>
        </li>
    </ul>
</div>
<div class="anchor"></div>

<div id="razdel1" class="ent-razdel" tab="staff_group" style="display: none;">
    <?php echo $this->renderPartial('students', array('models' => $profiles), true); ?>
</div>
<div id="razdel2" class="ent-razdel" tab="items_group" style="display: none;">
    <div class="stats_box"></div>
</div>
<div id="razdel3" class="ent-razdel"  tab="schedule_group" style="display: none;">
    <?php
    $this->renderPartial('application.views.user.new_schedule', array(
        'wekdays' => $wekdays,
        'data' => $data,
        'data2' => $data2,
        'data3' => $data3,
        'type_pair' => $type_pair,
        'time_pair' => $time_pair,
        'semestr' => $semestr,
        'we' => $we
            )
    )
    ?>
    <div class="stats_box_2"></div>
</div>
<script>
    $(function(){
        uploadPredmetGroup(<?php echo $group->id ?>);
    });
</script>