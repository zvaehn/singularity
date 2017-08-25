<?php
$height = $img['images']['standard_resolution']['height'];
$width  = $img['images']['standard_resolution']['width'];
$url    = get_compressorUrl($img['images']['standard_resolution']['url']);
?>

<a href="<?= $img['link'] ?>" target="_blank" rel="noopener">
  <figure class="img-wrapper inline-content" data-height="<?= $height ?>" data-width="<?= $width ?>">
    <img class="unveil"
      data-src="<?= $url ?>"
      height="<?= $height ?>px"
      width="<?= $width ?>px">
    <noscript>
      <img src="<?= get_compressorUrl($img['images']['standard_resolution']['url']) ?>"
        height="<?= $height ?>px"
        width="<?= $width ?>px">
    </noscript>
    <figcaption>
      <div class="alignment">
        <?php if(strlen($img['caption']['text'])): ?>
          <h3 class="img-title"><?= excerpt($img['caption']['text'], 100) ?></h3>
        <?php endif; ?>
        <p class="metadata">
          <span><?= $img['likes']['count'] ?> likes</span>
          <span><?= strftime('%d.%m.%Y', $timestamp) ?></span>
        </p>
      </div>
    </figcaption>
  </figure>
</a>
