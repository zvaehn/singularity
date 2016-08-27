<?php

// Code for instagram auth
if($page->uid() == "instagram") {
  $instagram = c::get('integrations')['instagram'];

  $code = isset($_GET['code']) ? $_GET['code'] : false;

  if ($code) {
    $data = $instagram->getOAuthToken($code);
    $instagram->setAccessToken($data);

    $page->update(array(
      'AccessToken' => $instagram->getAccessToken()
    ));

    go('integrations');
  }
  else {
    if (isset($_GET['error'])) {
      echo 'An error occurred: ' . $_GET['error_description'];
    }
  }
}

// Code for instagram auth
if($page->uid() == "flickr") {
  
}
?>
