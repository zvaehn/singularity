<?php snippet('header') ?>

  <main class="main" role="main">

  <h2><?= $page->title() ?></h2>

  <?php
  $available_integrations = $page->children()->visible();

  if($available_integrations) {
    echo "<ul>";

    foreach ($available_integrations as $key => $integration) {
      $intObject = c::get('integrations')[strtolower($integration->title())];

      if($intObject) {
        $active = !$integration->accessToken()->empty();

        echo "<li>" . $integration->title();
        echo " " . ($active ? "[✓]" : "[<a href='". $intObject->getLoginUrl() ."'>authorise</a>]");
        echo "</li>";
      }
    }

    echo "</ul>";
  }
  else {
    echo "No integrations available.";
  }

  ?>

  <a href="<?= $instagram->getLoginUrl() ?>">Login with Instagram</a>
  </main>

<?php snippet('footer') ?>
