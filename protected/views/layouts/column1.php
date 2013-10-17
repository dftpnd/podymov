<?php $this->beginContent('/layouts/main'); ?>
    <div class="container">

        <div id="content" class="">
            <?php echo $this->my_breadcrumb; ?>

            <?php echo $content; ?>
        </div>
        <!-- content -->
    </div>
<?php $this->endContent(); ?>