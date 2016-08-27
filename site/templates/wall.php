<?php snippet('header') ?>

  <main class="main" role="main">

  <?php

    // Flickering::handshake($apiKey, $apiSecret);
    // Flickering::handshake();    //Using the config file


    $walldata = $page->getCache();

    // if cache is not available or outdated, rebuild it
    if(!$walldata) {
      // unset($walldata);
      $walldata = array();

      $page->update(array('touched' => time()));

      echo "rebuilding cache...<br>";

      // Blog Posts
      $posts = page('posts')->children();

      foreach ($posts as $key => $post) {
        array_push($walldata, array(
          'type' => 'post',
          'time' => $post->date(),
          'data' => $post
        ));
      }

      // Flickr integration
      /*$flickrresponse = file_get_contents("https://api.flickr.com/services/feeds/photos_public.gne?id=96557486@N05&format=json");
      $flickrdata = str_replace('jsonFlickrFeed(', '', $flickrresponse);
      $flickrdata = substr($flickrdata, 0, strlen($flickrdata) -1); //strip out last paren
      $flickr = json_decode($flickrdata, true); // stdClass object

      echo "<pre>";
      print_r($flickr);
      echo "</pre>";

      foreach ($flickr['items'] as $key => $item) {
        array_push($walldata, array(
          'type' => 'flickr',
          'time' => strtotime($item['published']),
          'data' => json_decode(json_encode($item), true)
        ));
      }*/

      // Flickr integration
      $flickrPage = page('integrations/flickr');

      if($flickrPage->isVisibleOnWall()->value()) {
        $flickr = c::get('integrations')['flickr'];

        // Check if flickr is enabled and valid
        if($flickrPage->accessToken()) {
          // var_dump($flickr->people_getInfo("96557486@N05"));
          // https://www.flickr.com/services/api/flickr.photos.getSizes.html
          // supported extras: https://www.flickr.com/services/api/flickr.photos.search.html
          $photos = $flickr->people_getPhotos("me", array('extras' => 'date_upload'));

          if(!$flickr->getErrorMsg()) {
            if($photos['photos']['total'] > 0) {
              foreach ($photos['photos']['photo'] as $key => $photo) {
                if($photo['ispublic'] != "1") continue;

                // create urls: https://www.flickr.com/services/api/misc.urls.html
                $imgUrl = "https://farm".$photo['farm'].".staticflickr.com/".$photo['server']."/".$photo['id']."_".$photo['secret']."_h.jpg";
                $photo['img_url'] = $imgUrl;

                /*echo "<pre>";
                print_r($photo);
                echo "</pre>";*/

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

      $page->setCache($walldata);
    }

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
          echo "<div>";
          echo "<h2>".$post['data']->title()."</h2>";
          echo substr($post['data']->text()->value(), 0, 200)."...";
          echo "</div>";
          break;

        // flickr post
        case 'flickr':
          echo "<figure>";
            echo "<img src='".$post['data']['img_url'] ."'>";
            echo "<caption>". $post['data']['title'] ."</caption>";
          echo "</figure>";
          break;

        // instagram post
        case 'instagram':
          echo "<figure>";
            echo "<img src='".$post['data']['images']['thumbnail']['url']."'>";
            echo "<caption>". $post['data']['caption']['text'] ."</caption>";
          echo "</figure>";
          break;
      }

      echo "<hr>";
    }
  ?>

  </main>

<?php snippet('footer') ?>
