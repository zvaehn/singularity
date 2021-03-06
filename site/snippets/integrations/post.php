<?php
$trim = isset($trim) ? $trim : false;
?>

<div class="blogpost">
  <h3 class="headline"><a class="-slight" href="<?= $post->url() ?>"><?= $post->title() ?></a></h3>
  <div class="meta">
    <div class="time">
      <span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
      <?= strftime('%d.%m.%Y', $post->date()) ?>
    </div>

    <?php if($post->tags()->isNotEmpty()): ?>
    <div class="tags">
      <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
      <?= str_replace(",", ", ", $post->tags()) ?>
    </div>
    <?php endif; ?>
  </div>

  <div class="text">
    <?php
      if($trim) {
        echo excerpt($post->text()->kirbytext(), 600);
        echo " <a href='". $post->url() ."' class='read-more'>weiterlesen</a>";
      }
      else {
        echo $post->text()->kirbytext();
      }
    ?>
  </div>
</div>
