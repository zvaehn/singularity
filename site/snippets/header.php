<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta name="HandheldFriendly" content="True">

  <title><?= $site->title()->html() ?> | <?= $page->title() ?></title>
  <meta name="description" content="<?= $site->description()->html() ?>">
  <meta name="keywords" content="<?= $site->keywords()->html() ?>">
  <meta name="referrer" content="origin">
  <link rel="manifest" href="/manifest.json">
  <meta name="theme-color" content="#EE3148">
  <link rel="alternate" type="application/rss+xml" href="<?php echo url('blog/feed') ?>" title="<?= $site->author()->html() ?> - <?= html($pages->find('blog/feed')->title()) ?>" />

  <link rel="apple-touch-icon-precomposed" sizes="57x57" href="apple-touch-icon-57x57.png" />
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="apple-touch-icon-114x114.png" />
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="apple-touch-icon-72x72.png" />
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="apple-touch-icon-144x144.png" />
  <link rel="apple-touch-icon-precomposed" sizes="60x60" href="apple-touch-icon-60x60.png" />
  <link rel="apple-touch-icon-precomposed" sizes="120x120" href="apple-touch-icon-120x120.png" />
  <link rel="apple-touch-icon-precomposed" sizes="76x76" href="apple-touch-icon-76x76.png" />
  <link rel="apple-touch-icon-precomposed" sizes="152x152" href="apple-touch-icon-152x152.png" />
  <link rel="icon" type="image/png" href="favicon-196x196.png" sizes="196x196" />
  <link rel="icon" type="image/png" href="favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
  <link rel="icon" type="image/png" href="favicon-128.png" sizes="128x128" />
  <meta name="application-name" content="&nbsp;"/>
  <meta name="msapplication-TileColor" content="#FFFFFF" />
  <meta name="msapplication-TileImage" content="mstile-144x144.png" />
  <meta name="msapplication-square70x70logo" content="mstile-70x70.png" />
  <meta name="msapplication-square150x150logo" content="mstile-150x150.png" />
  <meta name="msapplication-wide310x150logo" content="mstile-310x150.png" />
  <meta name="msapplication-square310x310logo" content="mstile-310x310.png" />
  <meta http-equiv="CONTENT-LANGUAGE" content="de,en-US">
  <script>var development = false;</script>

  <?php
  // Development mode
  if(c::get('development')) {
    echo css('assets/compiled/style.css');
    echo "<script>development = true;</script>";
  }
  // Live mode
  else {
  ?>
    <meta name="robots" content="index,follow">
    <meta http-equiv="cache-control" content="max-age=30">
    <meta http-equiv="Expires" content="max-age=30">
    <meta http-equiv="expires" content="Wed, 01 Jan 2020 11:11:11 GMT">

  <?php
    echo "<style>";
    echo file_get_contents('assets/compiled/style.min.css');
    echo "</style>";
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
              <li><a href="<?= $site->url() ?>" title="Home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
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
          <a class="avatar" href="<?= $site->url() ?>" title="Home">
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
                <a href="<?= $link->link() ?>" target="<?= ($link->isExternal()->value() == "true") ? '_blank' : '_self' ?>" title="<?= $link->icon()->title() ?>" rel="noopener">
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
