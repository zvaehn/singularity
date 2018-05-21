<?php
// include 'lib/phpflickr-master/phpFlickr.php';

$domainShardCounter = 1;

$kirby = kirby();

if(!function_exists("get_compressorUrl")):
function get_compressorUrl($url) {
  $ext = $ext = pathinfo($url, PATHINFO_EXTENSION);
  $filename = sha1($url) . "." . $ext;

  $path = "/assets/imgcache/";
  $domainShards = 3;

  // replacing rules
  $url = str_replace('/', '__-0-__', $url);
  $url = str_replace(':', '__-1-__', $url);

  $encodedUrl = urlencode($url);

  if(c::get('development')) {
    $fullUrl = "//" . $_SERVER['HTTP_HOST'] . $path . '__--__' . $encodedUrl;
  }
  else {
    // $fullUrl = "//" . "static.hiimzvaehn.de" . $path . '__--__' . $encodedUrl;

    global $domainShardCounter;
    $domainShardCounter++;

    if($domainShardCounter > $domainShards) {
      $domainShardCounter = 1;
    }

    $fullUrl = "//" . "static" . $domainShardCounter . ".hiimzvaehn.de" . $path . '__--__' . $encodedUrl;
  }

  return $fullUrl;
}
endif;
