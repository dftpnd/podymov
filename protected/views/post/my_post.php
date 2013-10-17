<div class="slide_menu">
  <ul>
    <li class="active">
      <a href="/post/mypost" async="async" >Мои посты</a>
      <div></div>
    </li>
    <li>
      <a href="/post/create"  >Создать пост</a>
      <div></div>
    </li>
  </ul>
</div>




<div class="anchor"></div>
<div class="table_t reestr">
  <div class="tr_t">
    <div class="td_t">
      <span>
        №
      </span>
      <div></div>
    </div>
    <div class="td_t">
      <span>
        <label >заголовок</label>
      </span>
      <div></div>
    </div>
    <div class="td_t">
      <span>
        <label >дата создания</label>
      </span>
      <div></div>
    </div>
    <div class="td_t">
      <span>
        <label >статус</label>
      </span>
      <div></div>
    </div>
    <div class="td_t">
      <span>
        <label >редактировать</label>
      </span>
      <div></div>
    </div>
    <div class="td_t">
      <span>
        <label >удалить</label>
      </span>
      <div></div>
    </div>

  </div>
  <?php if (!empty($posts)): ?>
    <?php foreach ($posts as $post): ?>
      <div class="tr_t">
        <div class="td_t">
          <?php echo $post->id; ?>
        </div>
        <div class="td_t">
          <a href="/post/<?php echo $post->id; ?>" class="classic" async="async">
            <?php echo $post->title; ?>
          </a>
        </div>
        <div class="td_t">
          <?php echo date('j', $post->create_time); ?>&nbsp;<?php echo MyHelper::getRusMonth((int) date('n', $post->create_time)) ?>&nbsp;<?php echo date('Y', $post->create_time); ?>
        </div>
        <div class="td_t">
          <?php if ($post->status == 1): ?>
            черновик
          <?php elseif ($post->status == 2): ?>
            опубликован
          <?php else: ?>
            в архиве
          <?php endif; ?>
        </div>
        <div class="td_t">
          <a class="classic" href="/post/update/<?php echo $post->id; ?>">редактировать</a>
        </div>
        <div class="td_t">
          <span class="classic_delete" onclick="deleteMyPost(<?php echo $post->id; ?>)" >удалить</span>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>
<script>
  $(document).ready(function(){
    $('.reestr').fixedtableheader(); 
  });
</script>
