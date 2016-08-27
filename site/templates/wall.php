<?php snippet('header') ?>

  <main class="main" role="main">

  <?php
    $data = $page->getCache();

    // if cache is not available or outdated, rebuild it
    if(!$data) {
      unset($data);
      $data = array();

      echo "rebuilding cache...<br>";

      $page->update(array('touched' => time()));

      $instagramPage = page('integrations/instagram');

      if($instagramPage->isVisibleOnWall()->value()) {
        $instagram = c::get('integrations')['instagram'];

        // Check if instagram is enabled and valid
        if($instagramPage->accessToken()) {
          $instagram->setAccessToken($instagramPage->accessToken()->value());
          $media = $instagram->getUserMedia('self', 10);

          // Update the cache
          $data['instagram'] = json_decode(json_encode($media->data), true);
        }
      }

      /*echo "<pre>";
      print_r($data);
      echo "</pre>";*/

      $page->setCache($data);
    }

    foreach ($data['instagram'] as $entry) {
      echo "<img src=\"{$entry['images']['thumbnail']['url']}\">";
    }
  ?>

  </main>

<?php snippet('footer') ?>
