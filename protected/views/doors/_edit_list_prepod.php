<div class="vk">
    <ul class="predmet_goupview">
        <?php
        $i = "lop";
        foreach ($models as $model) {
            if ($i == 'lop') {
                $i = 'pol';
            } else {
                $i = 'lop';
            }

            echo "<li class='$i' id='$model->id' onclick='chengePrdemet( $(this) )' >";
            echo $model->name;
            echo "<div class='predmet_select'></div>";
            echo "</li>";
        }
        ?>
    </ul>
    <input type="submit" value="Сохранить" onclick="SavePredmetPrepods('$(this)')">
    <div class='anchor'></div>
</div>
<script>
<?php foreach ($prepodpredmets as $value): ?>
        $('#<?php echo $value->predmet_id; ?>').addClass('acupent');
        $('#<?php echo $value->predmet_id; ?>').attr('check','check');
<?php endforeach; ?>
    function SavePredmetPrepods(){
        goSpiner();
        
        
        var predmets_id = new Object;
        var otm_predmets_id = new Object;
            
        $(".predmet_goupview li[check='check']:not(.predmet_goupview li.acupent)").each(function(index) { 
            otm_predmets_id[index] = $(this).attr('id');
        });
            
        $('.predmet_goupview li.acupent').each(function(index) { 
            predmets_id[index] = $(this).attr('id');
        });
            
        $.ajax({
            url: '/library/changepredmets',
            type: 'POST',
            data: {
                "predmets_id":predmets_id,
                "otm_predmets_id":otm_predmets_id
            },
            dataType: 'json',
            success: function(result)
            {
                location.reload();
            }
        }); 
    }
   
</script>