<article id="mission">
    <div class="article_wrapper oen_post">
        <div class="centrator">
            <a href="/site/index" class="go_home">&larr; На главную</a>
        </div>
        <h2>
            <span>
            <?php echo $post->title; ?>
            </span>

            <div class=""></div>
        </h2>

        <div class="centrator">
            <div class="publikation">
                <div class='text_classic'>
                    <?php echo $post->content; ?>
                </div>
                <div class="publikation_panel">
                    <?php if (!empty($post->pdf_file)): ?>
                        <a class="panel_icon pdf_icon" href="/site/file/<?php echo $post->pdf_file; ?>"
                           title="Скачать в .pdf"></a>
                    <?php endif; ?>
                    <?php if (!empty($post->doc_file)): ?>
                        <a class="panel_icon doc_icon" href="/site/file/<?php echo $post->doc_file; ?>"
                           title="Скачать в .doc"></a>
                    <?php endif; ?>


                    <?php if (!empty($post->pdf_file)): ?>
                        <div class="span3 otstup">
                            <a class="btn btn-large btn-block btn-success button_see"
                               title="<?php echo $post->uploded_pdf->orig_name ?>"
                               href="/uploads/<?php echo $post->uploded_pdf->name ?>">Просмотреть
                                в
                                .pdf</a>
                        </div>
                    <?php endif; ?>

                    <div class="anchor"></div>
                </div>
            </div>
        </div>
    </div>
</article>