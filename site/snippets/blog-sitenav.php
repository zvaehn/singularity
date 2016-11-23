
<?php

$posts = $pages->get('blog')->children()->visible()->sortBy('date')->flip()->limit(10);
?>

<h2 class="headline"><?= $pages->get('blog')->overview() ?></h2>
<?php
if($posts->count()) {
  ?>
  <ul class="list">
  <?php
  foreach ($posts as $key => $post) {
    ?>
    <li>
      <div class="list-style-item">
        <i class="glyphicon glyphicon-bookmark"></i>
      </div>
      <div class="item">
        <a href="<?= $post->url() ?>" title="<?= $post->title() ?>" class="link">
          <?= excerpt($post->title(), 40) ?>
        </a>
        <span class="meta"><?= strftime('%d.%m.%Y', $post->date()) ?></span>
      </div>
    </li>
  <?php
  }
  ?>
  </ul>
  <?php
}
?>
