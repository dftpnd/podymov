<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/spizdel.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin.css" />
              <script  type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin.js" ></script>

        <title>АТПП</title>
    </head>
    <script>
        $(document).ready(function() {
            $('.open_enter').click(function() {
                $(".pop_up").show();
                $(".bg_new").show();
            });
            $(".close").click(function() {
                $(".pop_up").hide();
                $(".bg_new").hide();
            });
        });
    </script>
    <body>
        <div id="ajax_loader">
            <div></div>
        </div>
        <div class="door"  >
            <div class="door_box_1">
                <div class="my_cont">
                    <div class="big_but close_door"></div>
                    <div class="kamen"><div class="zakrytb" onclick='closeDoor()'>Закрыть</div>
                        <div class="insert_here">
                        </div>
                    </div>
                </div>
            </div>
            <div class='door_box_2 close_door'></div>
        </div>
        <div class="universe">
            <div id="" class="wrapper">
                <div id="header" class="true clearfix">
                    <div class="container clearfix">
                        <?php $this->renderPartial('application.modules.userAdmin.views.layouts._menu', array('current_item' => 'about')) ?>
                    </div>
                </div>


                <div class="content">
                    <?php echo $content; ?>
                </div>
            </div>
        </div>
    </body>
</html>


