<div class="vk">
    <ul class="predmet_goupview">
        <?php
        $i = "lop";
        foreach ($predmets as $value) {
            if ($i == 'lop') {
                $i = 'pol';
            } else {
                $i = 'lop';
            }

            echo "<li class='$i' id='$value->id' onclick='chengePrdemet( $(this) )' >";
            echo $value->name;
            echo "<div class='predmet_select'> </div>";
            echo "</li>";
        }
        ?>
    </ul>
    <div class="save_but_predmet_curs submit_but">Сохранить</div>
    <div class='anchor'></div>
</div>
<script>
    $(document).ready(function () {
        $('.save_but_predmet_curs').click(function(){
            var predmets_id = new Object;
            var otm_predmets_id = new Object;
            var otm_predmets_text = new Object;
            var bhk = '';
            
            $(".predmet_goupview li[check='check']:not(.predmet_goupview li.acupent)").each(function(index) { //
                otm_predmets_id[index] = $(this).attr('id');
                otm_predmets_text[index] = $(this).text();
            });
            
            for(var key in otm_predmets_text){
                var bhk = bhk + otm_predmets_text[key];
            }
            if(bhk==''){
                selectPredmet();
            }else{
                var r=confirm("Вы уверенны что хотите удалить предметы:''"+bhk+"''? Все оценки, заполненные студентами этой группы по этому(этим) предметам(у) будут удалены без возможности востановления")
                if (r==true)
                {
                    selectPredmet();
                }
                
            }
            function selectPredmet(){
                loader.show();
                semestr_id =<?php echo $semestr_id; ?>;
                group = <?php echo $group_id; ?>;
            
            
                $('.predmet_goupview li.acupent').each(function(index) { 
                    predmets_id[index] = $(this).attr('id');
                });
            
                $.ajax({
                    url: '<?php echo $this->CreateUrl('admin/SelectPredmets'); ?>',
                    type: 'POST',
                    data: {
                        "semestr_id":semestr_id,
                        "otm_predmets_id":otm_predmets_id,
                        "predmets_id":predmets_id,
                        "group":group
                    },
                    dataType: 'json',
                    success: function(result)
                    {
                        location.reload();
                    }
                }); 
            }
            
        });
       
        $('.acupent').attr('check','check');
    });
</script>