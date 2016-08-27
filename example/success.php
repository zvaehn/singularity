<?php
require 'vendor/cosenary/instagram/src/Instagram.php';

use MetzWeb\Instagram\Instagram;

$instagram = new Instagram(array(
  'apiKey'      => '486c159f8f3e4061883bec6e24023465',
  'apiSecret'   => 'beadfe2264e141ba8e27a2dd95c9af2e',
  'apiCallback' => 'http://local.singularity.de/success.php'
));

// receive OAuth code parameter
$code = $_GET['code'];

// check whether the user has granted access
if (isset($code)) {
  // receive OAuth token object
  $data = $instagram->getOAuthToken($code);

  // store user access token
  $instagram->setAccessToken($data);

  $media = $instagram->getUserMedia('self', 100);

  echo "<pre>";
  print_r($media);
  echo "</pre>";

  foreach ($media->data as $entry) {
    echo "<img src=\"{$entry->images->thumbnail->url}\">";
  }
}
else {
  // check whether an error occurred
  if (isset($_GET['error'])) {
      echo 'An error occurred: ' . $_GET['error_description'];
  }
}
