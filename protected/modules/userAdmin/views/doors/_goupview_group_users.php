<div class="vk">
    <h1>Список студентов группы</h1>
    <?php
    if (!isset($profile) || !is_null($profile)) {
        echo '<div class="table_t">';
        echo "<div class='tr_t'>";
        echo "<div class='td_t'>Имя студента</div>";
        echo "<div class='td_t'>";
        echo "Назначит администратора группы";
        echo "</div>";
        echo "<div class='td_t'>";
        echo "Удалить из группы";
        echo "</div>";
        echo "</div>";
        foreach ($profile as $value) {



            echo "<div class='tr_t'>";
            echo "<div class='td_t'>";
            if ($value->name == '') {
                echo '<a href="#">Пользователь еще не указал имя</a>';
            } else {
                echo CHtml::link($value->name . " " . $value->surname, Yii::app()->urlManager->createUrl('/user/ViewProfile', array('id' => $value->user_id)));
            }
            echo "</div>";

            echo "<div class='td_t'>";
            $activ = '';
            if ($value->leader == '1') {
                $activ = 'stars';
            }
            echo "<div class='lider_star $activ' profile_id='$value->id' ></div>";
            echo "</div>";
            echo "<div class='td_t'>";
            echo "<span user_id='$value->user_id' class='deleta_group_user' >Удалить</span>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo 'Группа пуста';
    }
    ?>
</div>
<script>
    $(function(){
        $('.lider_star').click(function(){
            loader.show();
            id = $(this).attr('profile_id');
            
            if($(this).hasClass("stars")){
                $(this).removeClass('stars');
                $.ajax({
                    url:'/userAdmin/admin/DeleteGroupLeader',
                    type: 'POST',
                    dataType: 'json',
                    data:({
                        'id':id
                    }),
                    success: function(data){
                        groupList($('.maine_group').attr('group_id'));
                    }
                }); 
            }else{
                $(this).addClass('stars');
                $.ajax({
                    url:'/userAdmin/admin/GetGroupLeader',
                    type: 'POST',
                    dataType: 'json',
                    data:({
                        'id':id
                    }),
                    success: function(data){
                        groupList($('.maine_group').attr('group_id'));
                    }
                }); 
            }
        })
        
       
    })
</script>