<?php snippet('header') ?>

<main class="main" role="main">

    <div class="container">
      <div class="row">
        <div class="js-infinity-wall grid">
          <div class="grid-sizer col-xs-3"></div>
          <?php
          $imgPlaceholder = url('assets/images/placeholder.jpg');
          $lastType = ""; // stores the last item type. Needed for post spacer css class

          // Loop all Wall Items
          foreach ($walldata as $key => $post) {
            switch($post['type']) {
              // regular blogpost
              case 'post': ?>
                <div class='grid-item col-xs-12' id="grid-id-<?= $key ?>">
                  <div class="grid-item-content has-spacer blogpost <?= ($lastType == 'post') ? 'is-proximate' : '' ?>">
                    <?= snippet('integrations/post', array(
                      'post' => $post['data'],
                      'trim' => true
                    )); ?>
                  </div>
                </div>
                <?php
                $lastType = 'post';
                break;

              // flickr post
              case 'flickr': ?>
                <div class='grid-item col-xs-12 col-sm-6 col-md-3' id="grid-id-<?= $key ?>">
                  <div class="grid-item-content">
                    <?= snippet('integrations/flickr', array(
                      'img' => $post['data'],
                      'timestamp' => $post['time'],
                      'placeholder' => $imgPlaceholder
                    )); ?>
                  </div>
                </div>
                <?php
                $lastType = 'flickr';
                break;

              // instagram post
              case 'instagram':
                ?>
                <div class='grid-item col-xs-12 col-sm-6 col-md-3' id="grid-id-<?= $key ?>">
                  <div class="grid-item-content">
                    <?= snippet('integrations/instagram', array(
                      'img' => $post['data'],
                      'timestamp' => $post['time'],
                      'placeholder' => $imgPlaceholder
                    )); ?>
                  </div>
                </div>
                <?php
                $lastType = 'instagram';
                break;
            }
          }
        ?>
        </div>
      </div>

      <div class="wallmeta">
        You saw <?= $wallcount ?> items on <?= $site->author() ?>'s wall.
      </div>
    </div>
  </div>
</main>
<?php snippet('footer') ?>
