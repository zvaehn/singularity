<?php snippet('header') ?>

  <main class="main" role="main">
    <div class="container">

    <?php
    $household = page('household');
    $token = $household->token()->value();
    $integrationName = $household->tmp_integration_name()->value();

    $action = isset($_GET['action']) ? $_GET['action'] : false;

    if(!isset($_SESSION)) session_start();

    if($_SESSION['singularityToken'] != $token) {
      echo "<h2 class='headline'>Auth error</h2>";
      echo "<p class='text'>You are not authorized to perform this action.</p>";
    }
    else {

      if($action == "deauthorize") {
        $page->update(array(
          'AccessToken' => false
        ));

        go('panel');
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

          go('panel');
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

          go('panel');
        }
        else {
          echo $flickr->getErrorMsg();
          echo "An error occured";
        }
      }
    }
    ?>
  </div>
</main>

<?php snippet('footer') ?>
