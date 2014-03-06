<script src="//static-v2.crocodoc.com/core/docviewer.js"></script>
<script
    src="//crocodoc.com/webservice/document.js?session=<?php echo $sessionKey ?>"></script>


<div class="article_wrapper oen_post">
    <a href="/site/index" class="go_home">&larr; На главную</a>


    <div class="publikation">


        <div class="abstraction">
            <div class="toolbar">
                <!--zoom-->
                <div class="zoom-btns">
                    <button class="zoom-out">-</button>
                    <button class="zoom-in">+</button>
                </div>

                <!--page navigation-->
                <div class="page-nav">
                    <button class="prev">◀</button>
                    <span class="label">Page <span class="num">1</span>/<span class="numpages">1</span></span>
                    <button class="next">▶</button>
                </div>
            </div>
            <div id="DocViewer"></div>
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

<style>
    footer {
        display: none;
    }
</style>