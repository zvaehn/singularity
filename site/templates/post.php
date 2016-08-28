<?php snippet('header') ?>

  <main class="main" role="main">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <hr class="spacer">
          
          <div class="blogpost">
            <?= snippet('integrations/post', array('post' => $page)) ?>
          </div>
        </div>
      </div>
    </div>
  </main>

<?php snippet('footer') ?>
