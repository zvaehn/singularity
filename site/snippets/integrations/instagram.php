<a href="<?= $img['link'] ?>" target="_blank">
  <figure class="img-wrapper inline-content">
    <img class="unveil"
      src="<?= $placeholder ?>"
      data-src="<?= $img['images']['standard_resolution']['url'] ?>"
      height="<?= $img['images']['standard_resolution']['height'] ?>"
      width="<?= $img['images']['standard_resolution']['width'] ?>">
    <noscript>
      <img src="<?= $img['images']['standard_resolution']['url'] ?>"
        height="<?= $img['images']['standard_resolution']['height'] ?>"
        width="<?= $img['images']['standard_resolution']['width'] ?>">
    </noscript>
    <figcaption>
      <h3 class="js-fittext"><?= $img['caption']['text'] ?></h2>
      <?= $img['likes']['count'] ?> likes <br><?= strftime('%d.%m.%Y', $timestamp) ?>
    </figcaption>
  </figure>
</a>
