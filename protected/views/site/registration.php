<?php if (Yii::app()->user->hasFlash('bad_vk_vhod_1')): ?>
    <script>
        $(function(){
            text = "<?php echo Yii::app()->user->getFlash('bad_vk_vhod_1'); ?>";
            noticeOpen(text,"3");
        });
    </script>
<?php endif; ?>
<div class="shag">
    <div>Шаг:</div>
    <ul>
        <li class="active">
            <span>1</span>
        </li>
        <li>
            <span>2</span>
        </li>
        <li>
            <span>3</span>
        </li>
    </ul>
</div>
<div id='hippodrome'>
    <div class='step0'>
        <h1>Попался!</h1>
        <div class='table_t congratulation'>
            <div class='tr_t'>
                <div class='td_t'>
                    <div class='spy0'></div>
                </div>
                <div class='td_t'>
                    Система предоставляет возможность для регистрации, только студентам КГЭУ кафедры АТПП или преподавателям.<br />
                    Если вы не являетесеь таковыми, просим вас не пытаться зарегистрироваться.<br />
                    Спасибо, за понимание Администрация  <a href='http://atpp.16mb.com/' class="classic">Cайта</a>.<br />
                    <br />
                    <span  class="classic" onclick="retryReg()" >Попробовать еще раз</span> &darr;
                </div>
            </div>
        </div>
    </div>
    <div class='step1'>
        <h1>3 вопроса, а вдруг вы шпион?</h1>
        <div class='table_t congratulation'>
            <div class='tr_t'>
                <div class='td_t'>
                    <div class='spy'></div>
                </div>
                <form id ="test_spy" >
                    <div class='td_t'>
                        <input type="hidden" value='Защита от дурака, гордись от тебя не помогла'>
                        <span class='queston'><div>1</div>На каких этажах, в копусе "В" находятся буфеты?</span><br />
                        <ul class="apple" >
                            <li>
                                <input type='checkbox' id='stol_1' name="category[raz]" value='1' /><label for="stol_1" >1</label>
                            </li>
                            <li>
                                <input type='checkbox' id='stol_2' name="category[dva]" value='2' /><label for="stol_2" >2</label>
                            </li>
                            <li>
                                <input type='checkbox' id='stol_3' name="category[tri]"  value='3' /><label for="stol_3" >3</label>
                            </li>
                            <li>
                                <input type='checkbox' id='stol_4' name="category[chet]" value='4' /><label for="stol_4" >4</label>
                            </li>
                            <li>
                                <input type='checkbox' id='stol_5' name="category[pyt]" value='5' /><label for="stol_5" >5</label>
                            </li>
                            <li>
                                <input type='checkbox' id='stol_6' name="category[shet]" value='6' /><label for="stol_6" >6</label>
                            </li>
                            <li>
                                <input type='checkbox' id='stol_7' name="category[sem]" value='7' /><label for="stol_7" >7</label>
                            </li>
                        </ul>

                        <div class='bopl'></div>
                        <span class='queston'><div>2</div>На каком этаже, в копусе "В" находится библиотека?</span>
                        <ul class="apple" >
                            <li>
                                <input type='radio' name="ee" value='1' id='bible_1' /><label  for="bible_1" >1</label>
                            </li>
                            <li>
                                <input type='radio' name="ee" value='2'  id='bible_2'  /><label  for="bible_2"  >2</label>
                            </li>
                            <li>
                                <input type='radio' name="ee" value='3' id='bible_3'  /><label  for="bible_3" >3</label>
                            </li>
                            <li>
                                <input type='radio' name="ee" value='4' id='bible_4'  /><label  for="bible_4" >4</label>
                            </li>
                            <li>
                                <input type='radio' name="ee" value='5' id='bible_5'  /><label  for="bible_5" >5</label>
                            </li>
                            <li>
                                <input type='radio' name="ee" value='6' id='bible_6'  /><label  for="bible_6" >6</label>
                            </li>
                            <li>
                                <input type='radio' name="ee" value='7' id='bible_7'  /><label  for="bible_7" >7</label>
                            </li>
                        </ul>

                        <div class='bopl'></div>
                        <span class='queston'><div>3</div>На каком этаже, находится деканат ИТЭ?</span>

                        <ul class="apple" >
                            <li>
                                <input type='radio' name="ww" value='1' id='dek_1' /><label for='dek_1' >1</label>
                            </li>
                            <li>
                                <input type='radio' name="ww" value='2' id='dek_2'  /><label for='dek_2' >2</label>
                            </li>
                            <li>
                                <input type='radio' name="ww" value='3' id='dek_3'  /><label for='dek_3' >3</label>
                            </li>
                            <li>
                                <input type='radio' name="ww" value='4' id='dek_4'  /><label for='dek_4' >4</label>
                            </li>
                            <li>
                                <input type='radio' name="ww" value='5'  id='dek_5' /><label for='dek_5' >5</label>
                            </li>
                            <li>
                                <input type='radio' name="ww" value='6'  id='dek_6' /><label for='dek_6' >6</label>
                            </li>
                            <li>
                                <input type='radio' name="ww" value='7'  id='dek_7' /><label for='dek_7' >7</label>
                            </li>
                        </ul>

                        <div class="inp_sub" onclick='contineRegistration()' >Продолжить</div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class='step2'>
        <!--структурный див-->
    </div>
    <div class='step3'>
        <!--структурный див-->
    </div>
    <div class='step4'>
        <!--структурный див-->
    </div>

</div>