<?php snippet('header') ?>

  <main class="main" role="main">

    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="headline"><?= $page->title() ?></h2>
          <?= $page->text()->kirbytext() ?>
        </div>
      </div>
    </div>
        
  </main>

<?php snippet('footer') ?>
