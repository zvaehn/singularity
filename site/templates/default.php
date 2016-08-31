<?php snippet('header') ?>

  <main class="main" role="main">

    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <?php
          if($page->uid() == "error" || $page->isVisible()) { ?>
            <h2 class="headline"><?= $page->title() ?></h2>
            <?= $page->text()->kirbytext() ?>
          <?php
          }
          else {
            go('error');
          }
          ?>
        </div>
      </div>
    </div>

  </main>

<?php snippet('footer') ?>
