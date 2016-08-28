<figure class="img-wrapper">
  <img class='js-lazyload'
    data-original="<?= $img['images']['standard_resolution']['url'] ?>"
    height="<?= $img['images']['standard_resolution']['height'] ?>"
    width="<?= $img['images']['standard_resolution']['width'] ?>">
  <noscript>
    <img src="<?= $img['images']['standard_resolution']['url'] ?>"
      height="<?= $img['images']['standard_resolution']['height'] ?>"
      width="<?= $img['images']['standard_resolution']['width'] ?>">
  </noscript>
  <figcaption>
    <?= $img['caption']['text'] ?>
  </figcaption>
</figure>
