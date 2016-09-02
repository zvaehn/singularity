<?php snippet('header') ?>

  <main class="main" role="main">
    <div class="container">
      <div class="row">

        <div class="col-xs-12">
          <h2 class="headline"><?= $page->title() ?></h2>
        </div>

        <?php
        $posts = $page->children()->visible()->sortBy('date')->flip()->paginate(10);
        // $posts = $posts->sortBy('date', 'desc');

        if($posts->count()) {
          foreach ($posts as $key => $post) {
          ?>
            <div class="col-xs-12">
              <hr class="spacer">
            </div>

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
        <?php if($posts->pagination()->hasPages()): ?>
        <nav class="pagination">

          <div class="prev-col">
            <?php if($posts->pagination()->hasPrevPage()): ?>
            <a class="prev" href="<?= $posts->pagination()->prevPageURL() ?>">&lsaquo; previous page</a>
            <?php endif ?>
          </div>

          <div class="next-col">
            <?php if($posts->pagination()->hasNextPage()): ?>
            <a class="next" href="<?= $posts->pagination()->nextPageURL() ?>">next page &rsaquo;</a>
            <?php endif ?>
          </div>

        </nav>
        <?php endif ?>
      </div>
    </div>
  </main>

<?php snippet('footer') ?>
