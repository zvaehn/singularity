<?php snippet('header') ?>

<main class="main" role="main">

<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <h2><?= $page->title() ?></h2>
      <p class="text"><?= $page->text()->kirbytext() ?></p>

      <?php
      $flickr = get_flickr();
      $instagram = get_instagram();

      $available_integrations = $page->children()->visible();

      if($available_integrations->count()) {
        echo "<ul>";

        foreach ($available_integrations as $key => $integration) {
          $intName = strtolower($integration->title());

          if(!isset($$intName)) continue;

          $intObject = $$intName;

          if($intObject) {
            $active = !$integration->accessToken()->empty();

            echo "<li class='auth-list'>";

            switch($intName) {
              case 'instagram':
                $loginUrl = $intObject->getLoginUrl();
                break;

              case 'flickr':
                // $intObject->auth("read");
                // https://www.flickr.com/services/auth/?api_key=4eadfb370eaa8d4ddf8891f9aa2a3d6d&perms=read&api_sig=cb7eaf2e2ee06b985f6339cde59a108b
                $api_sig = md5("87bf81ff6d31cc61" . "api_key" . "4eadfb370eaa8d4ddf8891f9aa2a3d6d" . "perms" . "read");
                $flickr_link = "https://www.flickr.com/services/auth/?api_key=" . "4eadfb370eaa8d4ddf8891f9aa2a3d6d" . "&perms=" . "read" . "&api_sig=". $api_sig;
                $loginUrl = $flickr_link;
                break;
            }

            if($active) {
              echo "<span class='glyphicon glyphicon-ok'></span> ". $integration->title(). " <a href='". $integration->url() ."?action=deauthorize'>deauthorize</a>";
            }
            else {
              echo "<span class='glyphicon glyphicon-remove'></span> ". $integration->title(). " <a href='". $loginUrl ."'>authorise</a>";
            }


            echo "</li>";
          }
        }

        echo "</ul>";
      }
      else {
        echo "No integrations available.";
      }

      ?>
      </div>
    </div>
  </div>
</main>

<?php snippet('footer') ?>
