<?php snippet('header') ?>

  <main class="main" role="main">
    <div class="container">
      <div class="row">
        <?php
        $posts = $page->children()->visible();
        $posts = $posts->sortBy('date', 'desc');

        if($posts->count()) {
          foreach ($posts as $key => $post) {
          ?>
            <div class="col-xs-12">
              <hr class="spacer">
            </div>
            
            <div class="col-xs-12">
              <?= snippet('integrations/post', array(
                'post' => $post,
                'trim' => true
              )); ?>
            </div>
          <?php
          }
        }
        ?>
      </div>
    </div>
  </main>

<?php snippet('footer') ?>
