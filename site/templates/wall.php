<?php snippet('header') ?>

  <main class="main" role="main">

  <?php
    if($rebuildCache) {
      echo "rebuilding cache...<br>";

      $page->update(array('touched' => time()));

      $instagram = c::get('integrations')['instagram'];
      $instagramPage = page('integrations/instagram');

      if($instagramPage->accessToken() && $instagramPage->isVisibleOnWall()->bool()) {
        $instagram->setAccessToken($instagramPage->accessToken()->value());

        $media = $instagram->getUserMedia('self', 10);

        foreach ($media->data as $entry) {
          echo "<img src=\"{$entry->images->thumbnail->url}\">";
        }
      }
    }
    else {
      echo "cache up to date";
    }
  ?>

  </main>

<?php snippet('footer') ?>
