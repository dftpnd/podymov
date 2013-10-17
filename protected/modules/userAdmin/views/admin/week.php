<h3>Определине первой учебной недели как четной (*) на этот учебный год</h3>
<form method="post" >
    <div class="semestr_week">
        <h3>Для первого семестра</h3>

        <input type="text" class="calendar" id="1_sem_week" value="" name="semestr_week[1]"/>
        <p class="hinr">Выберите тут день, когда началась первая учебная неделя, она обозначится как нечетная, дальше же все недели проставятся автоматически</p>
    </div>
    <div class="semestr_week">
        <h3>Для второго семестра</h3>
        <input type="text" class="calendar"  id="2_sem_week" value="" name="semestr_week[2]" />
        <p class="hinr">Выберите тут день, когда началась первая учебная неделя, она обозначится как нечетная, дальше же все недели проставятся автоматически</p>
    </div>
    <input type="submit" value="Сохранить" />
</form>
<script>
    $(function() {  
        $.datepicker.setDefaults(
        $.extend($.datepicker.regional["ru"] = {
            closeText: 'Закрыть',
            prevText: '',
            nextText: '',
            currentText: 'Сегодня',
            monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
                'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
            monthNamesShort: ['Январь','Февраль','Март','Апрель','Май','Июнь',
                'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
            dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
            dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
            dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
            dateFormat: 'dd.mm.yy', 
            firstDay: 1,
            changeMonth:false,
            changeYear:false,
            isRTL: false,      
            numberOfMonths: 1,
            showTimepicker:false,
            showButtonPanel:false,
            showAnim:'fadeIn'
        } ));
        $("#1_sem_week").datepicker();
        $("#2_sem_week").datepicker();
    });
   
</script>