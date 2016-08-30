<?php snippet('header') ?>

<main class="main" role="main">

<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <h2><?= $page->title() ?></h2>

      <?php
      $available_integrations = $page->children()->visible();

      if($available_integrations->count()) {
        echo "<ul>";

        foreach ($available_integrations as $key => $integration) {
          $intName = strtolower($integration->title());
          $intObject = c::get('integrations')[$intName];

          if($intObject) {
            $active = !$integration->accessToken()->empty();

            echo "<li>" . $integration->title();

            switch($intName) {
              case 'instagram':
                echo " " . ($active ? "[✓]" : "[<a href='". $intObject->getLoginUrl() ."'>authorise</a>]");
                break;

              case 'flickr':
                // $intObject->auth("read");
                // https://www.flickr.com/services/auth/?api_key=4eadfb370eaa8d4ddf8891f9aa2a3d6d&perms=read&api_sig=cb7eaf2e2ee06b985f6339cde59a108b

                $api_sig = md5("87bf81ff6d31cc61" . "api_key" . "4eadfb370eaa8d4ddf8891f9aa2a3d6d" . "perms" . "read");
                $flickr_link = "https://www.flickr.com/services/auth/?api_key=" . "4eadfb370eaa8d4ddf8891f9aa2a3d6d" . "&perms=" . "read" . "&api_sig=". $api_sig;

                echo " " . ($active ? "[✓]" : "[<a href='".$flickr_link."'>authorise</a>]");
                break;
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
