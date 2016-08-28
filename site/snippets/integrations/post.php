
<div>
  <h2><a href="<?= $post->url() ?>"><?= $post->title()."</a></h2>" ?>
  <span class="subheadline"><?= strftime('%d.%m.%Y', $post->date()) ?></span>
  <span class="tags">
    <?= str_replace(",", ", ", $post->tags()) ?>
  </span>
  <p class="text">
    <?= substr($post->text()->value(), 0, 200)."..."; ?>
  </p>
</div>
