<a href="<?= $img['link'] ?>" target="_blank">
  <figure class="img-wrapper inline-content">
    <img class="unveil"
      src="<?= $placeholder ?>"
      data-src="<?= $img['images']['standard_resolution']['url'] ?>"
      height="<?= $img['images']['standard_resolution']['height'] ?>px"
      width="<?= $img['images']['standard_resolution']['width'] ?>px">
    <noscript>
      <img src="<?= $img['images']['standard_resolution']['url'] ?>"
        height="<?= $img['images']['standard_resolution']['height'] ?>px"
        width="<?= $img['images']['standard_resolution']['width'] ?>px">
    </noscript>
    <figcaption>
      <div class="alignment">
        <?php if($img['caption']['text']): ?>
          <h3 class="js-fittext"><?= $img['caption']['text'] ?></h3>
        <?php endif; ?>
        <p class="metadata">
          <span><?= $img['likes']['count'] ?> likes</span>
          <span><?= strftime('%d.%m.%Y', $timestamp) ?></span>
        </p>
      </div>
    </figcaption>
  </figure>
</a>
