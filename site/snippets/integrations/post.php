<?php
$trim = isset($trim) ? $trim : false;
?>

<div class="blogpost">
  <h2><a href="<?= $post->url() ?>"><?= $post->title()."</a></h2>" ?>
  <span class="subheadline"><?= strftime('%d.%m.%Y', $post->date()) ?></span>
  <span class="tags">
    <?= str_replace(",", ", ", $post->tags()) ?>
  </span>
  <div class="text">
    <?php
      if($trim) {
        echo substr($post->text()->kirbytext(), 0, 200)."...";
      }
      else {
        echo $post->text()->kirbytext();
      }
    ?>
  </div>
</div>
