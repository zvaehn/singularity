<?php
$kirby = kirby();

require 'lib/phpflickr-master/phpFlickr.php';

function get_compressorUrl($url) {
  $ext = $ext = pathinfo($url, PATHINFO_EXTENSION);
  $filename = sha1($url) . "." . $ext;
  $path = "/assets/imgcache/";

  // replacing rules
  $url = str_replace('/', '__-0-__', $url);
  $url = str_replace(':', '__-1-__', $url);
  
  $encodedUrl = urlencode($url);

  $fullUrl = "//" . $_SERVER['HTTP_HOST'] . $path . '__--__' . $encodedUrl;

  return $fullUrl;
}
