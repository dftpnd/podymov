<?php
end($breadcrambs);
$laste_id = key($breadcrambs);
?>

<?php if (empty($breadcrambs)): ?>
  <a href="/files/ViewProfile?id=<?php echo $user->prof->id; ?>" async="async" class="classic">
    <?php echo MyHelper::getUsername($user->prof->id, true, $user, false); ?>
  </a>
  ->
  <a href="/files/files?id=<?php echo $user->id; ?>" async="async" class="classic">
    C:
  </a>
  <span>/</span>
<?php else: ?>
  <a href="/files/ViewProfile?id=<?php echo $user->prof->id; ?>" async="async" class="classic">
    <?php echo MyHelper::getUsername($user->prof->id, true, $user, false); ?>
  </a>
  ->
  <a href="/files/files?id=<?php echo $user->id; ?>" async="async" class="classic">
    C:
  </a>
  <span>/</span>
  <?php foreach ($breadcrambs as $id => $name) : ?>
    <?php if ($id == $laste_id): ?>
      <span><?php echo htmlspecialchars($name); ?></span>
    <?php else: ?>
      <span onclick="getOpenFolder(<?php echo $id; ?>)" class="classic"><?php echo htmlspecialchars($name); ?></span>
      <span>/</span>
    <?php endif; ?>
  <?php endforeach; ?>
<?php endif; ?>