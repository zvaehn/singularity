<?php snippet('header') ?>

  <main class="main" role="main">

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
  $flickr = c::get('integrations')['flickr'];

  $frob = isset($_GET['frob']) ? $_GET['frob'] : false;

  if ($frob) {
    $token = $flickr->auth_getToken($frob);

    $page->update(array(
      'AccessToken' => $token['token']['_content']
    ));

    go('integrations');
  }
  else {
    echo "An error occured";
  }
}
?>

</main>

<?php snippet('footer') ?>
