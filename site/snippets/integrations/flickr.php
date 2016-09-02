<a href="<?= "https://www.flickr.com/photos/". $img['owner'] ."/". $img['id'] ."" ?>" target="_blank">
  <figure class="img-wrapper inline-content">
    <img class='unveil'
      src="<?= get_compressorUrl($placeholder) ?>"
      data-src="<?= get_compressorUrl($img['url_m']) ?>"
      height="<?= $img['height_m'] ?>px"
      width="<?= $img['width_m'] ?>px">
    <noscript>
      <img src="<?= get_compressorUrl($img['url_m']) ?>"
        height="<?= $img['height_m'] ?>px"
        width="<?= $img['width_m'] ?>px">
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
