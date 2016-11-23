<?php snippet('header') ?>

<?php
$posts = $pages->get('blog')->children()->visible()->sortBy('date')->flip()->paginate(5);
?>

  <main class="main" role="main">
    <div class="container">

      <div class="row">
        <div class="blogposts">
          <h2 class="headline"><?= $pages->get('blog')->recentPosts() ?></h2>
          <?php

          if($posts->count()) {
            foreach ($posts as $key => $post) {
              echo snippet('integrations/post', array(
                'post' => $post,
                'trim' => true
              ));
            }
          }

          ?>
        </div>

        <div class="js-blog-affix affix-top">
          <div class="blognavigation">
            <?= snippet('blog-sitenav') ?>
          </div>
        </div>
      </div>

      <div class="row">
        <nav class="pagination">

          <div class="prev-col">
            <?php
            if($posts->pagination()->hasPrevPage()) {
              ?><a class="prev" href="<?= $posts->pagination()->prevPageURL() ?>">&lsaquo; <?= $page->nav_prev() ?></a><?php
            }
            else {
              ?><span class="prev -disabled" href="<?= $posts->pagination()->prevPageURL() ?>">&lsaquo; <?= $page->nav_prev() ?></span><?php
            }
            ?>
          </div>

          <div class="middle-col">
            <?= $posts->pagination()->page() ?> von <?= $posts->pagination()->pages() ?>
          </div>

          <div class="next-col">
            <?php
            if($posts->pagination()->hasNextPage()) {
              ?><a class="next" href="<?= $posts->pagination()->nextPageURL() ?>"><?= $page->nav_next() ?> &rsaquo;</a><?php
            }
            else {
              ?><span class="next -disabled" href="<?= $posts->pagination()->nextPageURL() ?>"><?= $page->nav_next() ?> &rsaquo;</span><?php
            }
            ?>
          </div>

        </nav>
      </div>

    </div>
  </main>

<?php snippet('footer') ?>
