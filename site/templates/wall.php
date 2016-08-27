<?php snippet('header') ?>

<main class="main" role="main">
  <section class="js-infinity-wall">

  <?php
    $walldata = $page->getCache();

    // if cache is not available or outdated, rebuild it
    if(!$walldata || $page->Cacheenabled()->value() != "true") {
      // unset($walldata);
      $walldata = array();

      $page->update(array('touched' => time()));

      echo "<p>rebuilding cache...</p>";

      // -----------------------------------------------------
      // Flickr integration
      $flickrPage = page('integrations/flickr');

      if($flickrPage->isVisibleOnWall()->value()) {
        $flickr = c::get('integrations')['flickr'];

        // Check if flickr is enabled and valid
        if($flickrPage->accessToken()) {
          // https://www.flickr.com/services/api/flickr.photos.getSizes.html
          // supported extras: https://www.flickr.com/services/api/flickr.photos.search.html
          $photos = $flickr->people_getPhotos("me", array('extras' => 'date_upload,url_sq,url_t,url_s,url_q,url_m,url_n,url_z,url_c,url_l,url_o'));

          if(!$flickr->getErrorMsg()) {
            if($photos['photos']['total'] > 0) {
              foreach ($photos['photos']['photo'] as $key => $photo) {
                if($photo['ispublic'] != "1") continue;

                // create urls: https://www.flickr.com/services/api/misc.urls.html
                // $imgUrl = "https://farm".$photo['farm'].".staticflickr.com/".$photo['server']."/".$photo['id']."_".$photo['secret'];

                array_push($walldata, array(
                  'type' => 'flickr',
                  'time' => $photo['dateupload'],
                  'data' => $photo
                ));
              }
            }
          }
        }
      }

      // ----------------------------------------------------
      // Instagram integration
      $instagramPage = page('integrations/instagram');

      if($instagramPage->isVisibleOnWall()->value()) {
        $instagram = c::get('integrations')['instagram'];

        // Check if instagram is enabled and valid
        if($instagramPage->accessToken()) {
          $instagram->setAccessToken($instagramPage->accessToken()->value());
          $media = $instagram->getUserMedia('self', 20);

          // remember: get back to more then 20 posts...
          foreach ($media->data as $key => $item) {
            /*echo "<pre>";
            print_r($item);
            echo "</pre>";*/

            array_push($walldata, array(
              'type' => 'instagram',
              'time' => $item->created_time,
              'data' => json_decode(json_encode($item), true)
            ));
          }
        }
      }

      if(!$page->setCache($walldata)) {
        echo "unable to write cache.<br>";
      }
    }

    // Add non-cached blog Posts
    $posts = page('posts');

    if($posts->Arevisibleonwall()->bool()) {
      foreach ($posts->children() as $key => $post) {
        array_push($walldata, array(
          'type' => 'post',
          'time' => $post->date(),
          'data' => $post
        ));
      }
    }

    // Sort by timestamp
    usort($walldata, function($a, $b) {
      return $a['time'] < $b['time'];
    });

    /*echo "<pre>";
    print_r($walldata);
    echo "</pre>";*/

    // Blog Posts
    foreach ($walldata as $key => $post) {
      switch($post['type']) {
        // regular blogpost
        case 'post':
          snippet('integrations/post', array('post' => $post));
          break;

        // flickr post
        case 'flickr':
          snippet('integrations/flickr', array('img' => $post['data']));
          break;

        // instagram post
        case 'instagram':
          snippet('integrations/instagram', array('post' => $post));
          break;
      }

      echo "<hr>";
    }
  ?>
  </section>
</main>
<?php snippet('footer') ?>
