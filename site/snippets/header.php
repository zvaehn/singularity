<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta name="HandheldFriendly" content="True">

  <title><?= $site->title()->html() ?> | <?= $site->author()->html() ?></title>
  <meta name="description" content="<?= $site->description()->html() ?>">
  <meta name="keywords" content="<?= $site->keywords()->html() ?>">
  <meta name="referrer" content="origin">
  <link rel="alternate" type="application/rss+xml" title="<? $site->author()->html() ?>" href="<?= $_SERVER['SERVER_NAME'] ?>/rss/">
  <link rel="icon" type="image/png" href="assets/images/favicon.png">

  <?php
  if(!c::get('development')):
  ?>
  <meta name="robots" content="index,follow">
  <meta http-equiv="cache-control" content="max-age=30">
  <meta http-equiv="Expires" content="max-age=30">
  <meta http-equiv="expires" content="Wed, 01 Jan 2020 11:11:11 GMT">
  <?php
  endif;
  ?>

  <meta http-equiv="CONTENT-LANGUAGE" content="en-US,de">

  <?php
  if(c::get('development')) {
    echo css('assets/compiled/style.css');
  }
  else {
    echo "<style>";
    echo file_get_contents('assets/compiled/style.min.css');
    echo "</style>";
  }

  if(!c::get('development') && $site->analytics()->value()) {
    ?>    
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', '<?= $site->analytics()->value() ?>', 'auto');
      ga('send', 'pageview');

    </script>
    <?php
  }
  ?>
</head>
<body>

  <header class="header" role="banner">
    <div class="container">
      <div class="row">
        <div class="nav-col">
          <nav class="navigation" role="navigation">
            <ul class="menu-items">
              <li><a href="<?= $site->url() ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
              <?php
              foreach ($site->pages()->visible() as $key => $page) {
              ?>
                <li><a href="<?= $page->url() ?>" alt="<?= $page->title() ?>"><?= $page->title() ?></a></li>
              <?php
              }
              ?>
            </ul>
          </nav>
        </div>
      </div>

      <div class="row">
        <div class="avatar-col">
          <a class="avatar" href="<?= url() ?>">
            <?php
            $avatar = $site->image($site->Avatar());
            $thumb = thumb($avatar , array('width' => 300, 'crop' => true));
            ?>
            <img class="img-rounded" src="<?= get_compressorUrl($thumb->url()) ?>" alt="<?= $avatar->title() ?>" />
          </a>
        </div>
        <div class="meta-col">
          <h1 class="headline"><?= $site->author() ?></h2>
          <p><?= $site->description() ?></p>

          <?php
          $links = page('links');
          $links = $links->children()->visible();
          if($links->count()):
          ?>
            <ul class="social-link-list">
            <?php
            foreach ($links as $link): ?>
              <li>
                <a href="<?= $link->link() ?>" target="<?= ($link->isExternal()->value() == "true") ? '_blank' : '_self' ?>">
                  <?php
                  $image = $link->image($link->icon());
                  ?>
                  <img class="link-icon svg" src="<?= $image->url() ?>" alt="<?= $link->icon()->title() ?>">
                </a>
              </li>
            <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </header>
