<?php

$thumb  = $img->thumb(array('width' => 500));
$height = $thumb->height();
$width  = $thumb->width();
$url    = get_compressorUrl($thumb->url());
?>

<a href="<?= $url ?>" target="_blank" rel="noopener">
  <figure class="img-wrapper inline-content" data-height="<?= $height ?>" data-width="<?= $width ?>">
    <img class="unveil"
      data-src="<?= $url ?>"
      height="<?= $height ?>"
      width="<?= $width ?>"
      alt="<?= excerpt($img->caption(), 100) ?>">
    <noscript>
      <img src="<?= $url ?>"
        height="<?= $height ?>"
        width="<?= $width ?>">
    </noscript>
    <figcaption>
      <div class="alignment">
        <?php if($img->caption()->isNotEmpty()): ?>
          <h3 class="img-title"><?= excerpt($img->caption(), 100) ?></h3>
        <?php endif; ?>
        <p class="metadata">
          <span><?= strftime('%d.%m.%Y', $timestamp) ?></span>
        </p>
      </div>
    </figcaption>
  </figure>
</a>
