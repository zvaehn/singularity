<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <title><?= $site->title()->html() ?> | <?= $site->author()->html() ?></title>
  <meta name="description" content="<?= $site->description()->html() ?>">
  <meta name="keywords" content="<?= $site->keywords()->html() ?>">

  <?= css('assets/css/style.css') ?>
</head>
<body>

  <header class="header" role="banner">
    <div class="container">
      <div class="row">
        <div class="nav-col">
          <nav class="navigation" role="navigation">
            <ul class="menu-items">
              <li><a href="<?= $site->url() ?>" alt="home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
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
            <img class="img-rounded" src="<?= $thumb->url() ?>" alt="<?= $avatar->title() ?>" />
          </a>
        </div>
        <div class="meta-col">
          <h2><?= $site->author() ?></h2>
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
                  <img class="link-icon" src="<?= $image->url() ?>" alt="<?= $link->icon()->title() ?>">
                </a>
              </li>
            <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </header>
