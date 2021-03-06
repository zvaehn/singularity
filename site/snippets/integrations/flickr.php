<a href="<?= "https://www.flickr.com/photos/". $img['owner'] ."/". $img['id'] ."" ?>" target="_blank" rel="noopener">
  <figure class="img-wrapper inline-content" data-height="<?= $img['height_m'] ?>" data-width="<?= $img['width_m'] ?>">
    <img class='unveil'
      data-src="<?= get_compressorUrl($img['url_m']) ?>"
      height="<?= $img['height_m'] ?>"
      width="<?= $img['width_m'] ?>"
      alt="<?= $img['title'] ?>">
    <noscript>
      <img src="<?= get_compressorUrl($img['url_m']) ?>"
        height="<?= $img['height_m'] ?>"
        width="<?= $img['width_m'] ?>"
        alt="<?= $img['title'] ?>">
    </noscript>
    <figcaption>
      <div class="alignment">
        <?php if(strlen($img['title'])): ?>
          <h3 class="img-title"><?= excerpt($img['title'], 100) ?></h3>
        <?php endif; ?>
        <p class="metadata">
          <span><?= $img['views'] ?> views</span>
          <span><?= strftime('%d.%m.%Y', $timestamp) ?></span>
        </p>
      </div>
    </figcaption>
  </figure>
</a>
