<?php snippet('header') ?>

  <main class="main" role="main">
    <div class="container">
      <div class="blogposts">

        <?php
        $posts = $page->children()->visible()->sortBy('date')->flip()->paginate(5);

        if($posts->count()) {
          foreach ($posts as $key => $post) {
          ?>
            <?= snippet('integrations/post', array(
              'post' => $post,
              'trim' => true
            )); ?>
          <?php
          }
        }
        ?>
      </div>

      <div class="row">
        <nav class="pagination">

          <div class="prev-col">
            <?php
            if($posts->pagination()->hasPrevPage()) {
              ?><a class="prev" href="<?= $posts->pagination()->prevPageURL() ?>">&lsaquo; zurück</a><?php
            }
            else {
              ?><span class="prev -disabled" href="<?= $posts->pagination()->prevPageURL() ?>">&lsaquo; zurück</span><?php
            }
            ?>
          </div>

          <div class="middle-col">
            <?= $posts->pagination()->page() ?> von <?= $posts->pagination()->pages() ?>
          </div>

          <div class="next-col">
            <?php
            if($posts->pagination()->hasNextPage()) {
              ?><a class="next" href="<?= $posts->pagination()->nextPageURL() ?>">weiter &rsaquo;</a><?php
            }
            else {
              ?><span class="next -disabled" href="<?= $posts->pagination()->nextPageURL() ?>">weiter &rsaquo;</span><?php
            }
            ?>
          </div>

        </nav>
      </div>

    </div>
  </main>

<?php snippet('footer') ?>
