<?php if (Yii::app()->user->hasFlash('bad_vk_vhod_2')): ?>
    <script>
        $(function(){
            text = "<?php echo Yii::app()->user->getFlash('bad_vk_vhod_2'); ?>";
            noticeOpen(text,"1");
        });
    </script>
<?php endif; ?>
<?php if (Yii::app()->user->hasFlash('bad_vk_reg')): ?>
    <script>
        $(function(){
            text = "<?php echo Yii::app()->user->getFlash('bad_vk_reg'); ?>";
            noticeOpen(text,"1");
        });
    </script>
<?php endif; ?>
<?php if (Yii::app()->user->hasFlash('user_is_isset')): ?>
    <script>
        $(function(){
            text = "<?php echo Yii::app()->user->getFlash('user_is_isset'); ?>";
            noticeOpen(text,"1");
        });
    </script>
<?php endif; ?>