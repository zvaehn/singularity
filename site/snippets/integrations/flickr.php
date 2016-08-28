<a href="<?= "https://www.flickr.com/photos/". $img['owner'] ."/". $img['id'] ."" ?>" target="_blank">
  <figure class="img-wrapper inline-content">
    <img class='unveil'
      src="<?= $placeholder ?>"
      data-src="<?= $img['url_m'] ?>"
      height="<?= $img['height_m'] ?>"
      width="<?= $img['width_m'] ?>">
    <noscript>
      <img src="<?= $img['urm_m'] ?>"
        height="<?= $img['height_m'] ?>"
        width="<?= $img['width_m'] ?>">
    </noscript>
    <figcaption>
      <h3 class="js-fittext"><?= $img['title'] ?></h3>
      <?= $img['views'] ?> views <br>
      <?= strftime('%d.%m.%Y', $timestamp) ?>
    </figcaption>
  </figure>
</a>
