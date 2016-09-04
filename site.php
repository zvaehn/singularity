<?php
$kirby = kirby();

require 'lib/phpflickr-master/phpFlickr.php';

function get_compressorUrl($url) {
  return "//" . $_SERVER['HTTP_HOST'] . "/assets/php/img_compressor.php?url=" . $url;
}
