<?php snippet('header') ?>

  <main class="main" role="main">

<?php

echo "<pre>";
 echo print_r($site->user());
 echo "</pre>";

$action = isset($_GET['action']) ? $_GET['action'] : false;

if($action == "deauthorize") {
  $page->update(array(
    'AccessToken' => false
  ));

  go('integrations');
}

// Code for instagram auth
if($page->uid() == "instagram") {
  $instagram = get_instagram();

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
  $flickr = get_flickr();

  $frob = isset($_GET['frob']) ? $_GET['frob'] : false;

  if ($frob) {
    $token = $flickr->auth_getToken($frob);

    $page->update(array(
      'AccessToken' => $token['token']['_content']
    ));

    go('integrations');
  }
  else {
    echo $flickr->getErrorMsg();
    echo "An error occured";
  }
}
?>

</main>

<?php snippet('footer') ?>
