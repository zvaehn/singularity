<?php snippet('header') ?>

  <main class="main" role="main">
    <div class="container">
      <div class="row">
        <div class="blogposts">
          <?= snippet('integrations/post', array('post' => $page)) ?>
        </div>

        <div class="js-blog-affix affix-top">
          <div class="blognavigation">
            <?= snippet('blog-sitenav') ?>
          </div>
        </div>
      </div>
    </div>
  </main>

<?php snippet('footer') ?>
