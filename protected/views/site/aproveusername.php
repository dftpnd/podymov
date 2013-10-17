<div class="this_vhod"></div>
<script>
    $(function(){
        PokazVhod();
        function PokazVhod(){
            $('.this_vhod').animate({
                top: '10px'
            },1000, '', callback);
        }
        function callback(){
            $('.this_vhod').animate({
                top: '40px'
            },1000, '', PokazVhod);
        }
        
        
        
        

    })
</script>
<h1>Поздравляем!</h1>
<div class='table_t congratulation'>
    <div class='tr_t'>
        <div class='td_t'>
            <div class='poklon'></div>
        </div>
        <div class='td_t'>
            Вы успешно зарегистрировались в системе!<br />
            Теперь вы можете зайти на сайт!
        </div>
    </div>
</div>