
<figure class="img-wrapper">
  <img class='js-lazyload'
    data-original="<?= $img['url_l'] ?>"
    height="<?= $img['height_l'] ?>"
    width="<?= $img['width_l'] ?>">
  <noscript>
    <img src="<?= $img['url_l'] ?>"
      height="<?= $img['height_l'] ?>"
      width="<?= $img['width_l'] ?>">
  </noscript>
  <figcaption>
    <?= $img['title'] ?><br>
  </figcaption>
</figure>