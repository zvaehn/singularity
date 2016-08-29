<a href="<?= "https://www.flickr.com/photos/". $img['owner'] ."/". $img['id'] ."" ?>" target="_blank">
  <figure class="img-wrapper inline-content">
    <img class='unveil'
      src="<?= $placeholder ?>"
      data-src="<?= $img['url_m'] ?>"
      height="<?= $img['height_m'] ?>"
      width="<?= $img['width_m'] ?>">
    <noscript>
      <img src="<?= $img['url_m'] ?>"
        height="<?= $img['height_m'] ?>"
        width="<?= $img['width_m'] ?>">
    </noscript>
    <figcaption>
      <div class="alignment">
        <?php if($img['title']): ?>
          <h3 class="js-fittext"><?= $img['title'] ?></h3>
        <?php endif; ?>
        <p class="metadata">
          <span><?= $img['views'] ?> views</span>
          <span><?= strftime('%d.%m.%Y', $timestamp) ?></span>
        </p>
      </div>
    </figcaption>
  </figure>
</a>
