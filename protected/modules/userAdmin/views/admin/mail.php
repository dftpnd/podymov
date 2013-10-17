<h1>Реестр принятых писем от пользователей</h1>
<?php
if (count($letters) == 0) {
    echo '<div class="letter_no">Нам еще никто ни разу не писал</div>';
}
foreach ($letters as $message) {
    echo '<div class="message" id="top_id' . $message->id . '" ><div class="delete_message" id="' . $message->id . '">Удалить</div><div class="time_create">' . date('Y-m-d H:i', $message->create_time) . '</div><div class="id_letter">#' . $message->id . '</div><div class="name"><span>Имя :</span>' . $message->name . '</div><div class="mail"><span>Эл.Почта:</span>' . $message->email . '</div><div class="body"><span>Сообщение:</span>' . $message->body . '</div></div>';
}
?>
<script>
    $(document).ready(function() {
        $('.delete_message').click(function() {
            var id_leter = $(this).attr('id');
            
            var a = confirm('Вы действительно хотите удалить сообщение #'+id_leter); 
            if(a)
                $.ajax({
                    url: '<?php echo $this->CreateUrl('site/maildelete'); ?>',
                    type: 'POST',
                    data: {
                        "messege_id":id_leter
                    },
                dataType: 'json',
                success: function(messege_id_after)
                {
                    if (messege_id_after != null)
                    {
                        $('#top_id'+id_leter+'').hide();
                    }
                    else{
                        alert('По неизвестной нам причине, удаление не произошло. Сообщите Грязнову Максиму');
                    }

                }
            });
            else{
                return false;
            }
            
        });
            
    });
</script>
