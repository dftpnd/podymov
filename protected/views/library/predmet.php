<h1 class="pontel"><?php echo $model->name ?></h1>
<div class="table_t">
    <div class="tr_t">
        <div class="td_t">
            <div class="prepods_for_predmet resume__emptyblock">
                <h4><?php echo $model->name; ?></h4>
                <?php if ($redact): ?>
                    <form id="submit_text_predmet" method="POST">
                        <textarea class="submit_text_predmet_textarea" name="text">
                            <?php echo $model->text; ?>
                        </textarea>
                        <input type="submit"  value="Сохранить" onclick="submit_text_predmet($(this), <?php echo $model->id; ?>);return false" />
                        <div class="anchor"></div>
                    </form>
                <?php else: ?>
                    <?php echo $model->text; ?>
                <?php endif; ?>


            </div>
        </div>
        <div class="td_t prepods_for_predmet_td" >
            <div class="prepods_for_predmet resume__emptyblock">
                <h4>Преподаватели</h4>
                <?php foreach ($prepods_predmet as $predmet) : ?>
                    <div>
                        <?php
                        echo CHtml::link($predmet->prepod->name . ' ' . $predmet->prepod->surname, Yii::app()->urlManager->createUrl('/user/ViewProfile', array('id' => $predmet->prepod->id)), array(
                            'class' => 'classic',
                            'async' => 'async'
                        ));
                        ?> 
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php if (!Yii::app()->user->isGuest): ?>
    <div class="uploded-predmet">
        <div class="uploded-predmet-but">
            Вы можете загрузить сюда учебные материалы.
            <div id="file-uploader-demo1">		
                <noscript>			
                <p>Включите JavaScript чтобы испльзовать file uploader.</p>
                </noscript>         
            </div>
        </div>
    </div>


    <script>
        var uploader = new qq.FileUploader({
            element: document.getElementById('file-uploader-demo1'),
            multiple: false,
            action: '/library/Upload/<?php echo $model->id; ?>',
            debug: false, 
            onSubmit: function(id, fileName){
                goSpiner();
            },
            onComplete: function(id, fileName, responseText)
            {   
                location.reload();
            }
        });           
    </script>
<?php endif; ?>
<div class="flowpit_1"></div>
<div class="flowpit_2"></div>
<div class="flowpit_3"></div>


<div class="">
    <?php if (!empty($files)): ?>
        <h1>Учебные материалы по предмету</h1>
        <?php foreach ($files as $file) : ?>
            <?php
            $text_script_plus = "ObjectRating($type,$file->id,$plus)";
            $text_script_minus = "ObjectRating($type,$file->id,$minus)";
            $div_title_plus = 'Нравится';
            $div_title_minus = 'Не нравится';
            ?>
            <?php ?>
            <div class="file-box" file_id="<?php echo $file->id; ?>" id="file_id_<?php echo $file->id; ?>">
                <?php if (!Yii::app()->user->isGuest): ?>
                    <?php if ($profile->id == $file->profile->id): ?>
                        <span class="delet_file_library" onclick="delet_file_library($(this))">Удалить</span>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="table_t">
                    <div class="tr_t">
                        <div class="td_t">
                            <?php
                            if (isset($file->profile->uploadedfiles->name)) {
                                $img = Yii::app()->request->baseUrl . '/uploads/avatar/mini_' . $file->profile->uploadedfiles->name;
                            } else {

                                $img = Yii::app()->request->baseUrl . '/i/mini_avatar.png';
                            }
                            ?>
                            <?php
                            echo CHtml::link("<img src='" . $img . "' />", Yii::app()->urlManager->createUrl('/user/ViewProfile', array(
                                        'id' => $file->profile->id
                                    )), array(
                                'class' => 'classic',
                                'async' => 'async'
                            ));
                            ?> 
                            <?php
                            echo CHtml::link($file->profile->name . " " . $file->profile->surname, Yii::app()->urlManager->createUrl('/user/ViewProfile', array('id' => $file->profile->id)), array(
                                'class' => 'classic',
                                'async' => 'async'
                            ));
                            ?> 
                        </div>
                        <div class="td_t">
                            <?php echo CHtml::link("<div class='file_" . $file->uploadedfiles->ext . " uploads_file'></div>", Yii::app()->urlManager->createUrl('/library/downloads', array('id' => $file->id)), array('class' => 'classic')); ?> 
                            <div></div>
        <?php echo CHtml::link($file->uploadedfiles->orig_name, Yii::app()->urlManager->createUrl('/library/downloads', array('id' => $file->id)), array('class' => 'classic')); ?> 
                        </div>
                        <div class="td_t">
        <?php if (!Yii::app()->user->isGuest): ?>
                                <div class="object_rating" id="prepod_file_<?php echo $file->id; ?>">

                                    <div class="object_plus" onclick='<?php echo $text_script_plus; ?>' title="<?php echo $div_title_plus; ?>">
                                    </div>

                                    <?php
                                    $znak_plus = '';
                                    if (!is_null($file->rating)) {
                                        $state = $file->rating;
                                        if ($state > 0) {
                                            $class = 'poloj';
                                            $znak_plus = '+';
                                        } else if ($state < 0) {
                                            $class = 'otr';
                                        } else {
                                            $class = 'null';
                                        }
                                    } else {
                                        $state = '0';
                                        $class = 'null';
                                    }
                                    ?>
                                    <div class="object_state <?php echo $class; ?>">
            <?php echo $znak_plus . $state; ?>
                                    </div>

                                    <div class="object_minus" onclick='<?php echo $text_script_minus; ?>' title="<?php echo $div_title_minus; ?>">
                                    </div>
                                </div>
        <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
<?php endif; ?>
</div>
