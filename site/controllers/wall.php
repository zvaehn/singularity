<?php

// Kirby return function
return function($site, $pages, $page) {

  // Get integrations
  $flickr = get_flickr();
  $instagram = get_instagram();

  $walldata = $page->getCache();

  // if cache is not available or outdated, rebuild it
  if(!$walldata || $page->Cacheenabled()->value() != "true") {
    $walldata = array();
    $page->update(array('touched' => time()));

    if(c::get('development')) {
      error_log("<script type='text/javascript'>console.log('cache rebuild.')</script>");
    }

    // -----------------------------------------------------
    // Flickr integration
    $flickrPage = page('integrations/flickr');

    if($flickrPage->isVisibleOnWall()->value()) {
      // Check if flickr is enabled and valid
      if($flickrPage->accessToken()) {
        // https://www.flickr.com/services/api/flickr.photos.getSizes.html
        // supported extras: https://www.flickr.com/services/api/flickr.photos.search.html
        $photos = $flickr->people_getPhotos("me", array('per_page' => 500, 'extras' => 'date_upload,url_sq,url_t,url_s,url_q,url_m,url_n,url_z,url_c,url_l,url_o,geo,views'));

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
      // Check if instagram is enabled and valid
      if($instagramPage->accessToken()) {
        $instagram->setAccessToken($instagramPage->accessToken()->value());
        $media = $instagram->getUserMedia('self', 20);

        if(property_exists($media, "data")) {
          // TodO: get back to more then 20 posts...
          foreach ($media->data as $key => $item) {
            array_push($walldata, array(
              'type' => 'instagram',
              'time' => $item->created_time,
              'data' => json_decode(json_encode($item), true)
            ));
          }
        }
        else {
          if(c::get('development')) error_log("Instagram request error.");
        }
      }
      else {
        if(c::get('development')) error_log("Instagram accessToken error.");
      }
    }

    if(!$page->setCache($walldata) && c::get('development')) {
      if(c::get('development')) error_log("unable to write cache.");
    }
  }

  // Sort by timestamp
  usort($walldata, function($a, $b) {
    return $a['time'] < $b['time'];
  });

  return array(
    'integrations' => array(
      'flickr' => $flickr,
      'instagram' => $instagram
    ),
    'walldata' => $walldata,
    'wallcount' => count($walldata)
  );
};

?>
