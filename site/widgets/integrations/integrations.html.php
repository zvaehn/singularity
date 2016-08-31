<style>
.auth-list {
  list-style: none;
}

.integration-action.-disabled {
  color: #999;
}

.integration-action.-disabled:hover {
  cursor: not-allowed;
}

.option-list {
  color: #999;
  font-size: 11px;
}

.option-list li {
  list-style: none;
  display: inline-block;
  margin-right: 5px;
}

</style>


<div class="dashboard-box">

<?php
if(!isset($_SESSION)) session_start();

$household = panel()->page('household');

if(!$household->token()->value() || !isset($_SESSION['singularityToken'])) {
  $newToken = md5(rand(0, time()));

  $household->update(array('token' => $newToken));
  $_SESSION['singularityToken'] = $newToken;
}

echo $text;

if($available_integrations->count()) {
  echo "<ul class='dashboard-items'>";

  foreach ($available_integrations as $key => $integration) {
    $intName = strtolower($integration->title());

    if(!isset($$intName)) continue;

    $intObject = $$intName;

    if($intObject) {
      $active = !$integration->accessToken()->empty();

      echo "<li class='dashboard-item'>";

      switch($intName) {
        case 'instagram':
          $loginUrl = $intObject->getLoginUrl();
          break;

        case 'flickr':
          // $intObject->auth("read");
          // https://www.flickr.com/services/auth/?api_key=4eadfb370eaa8d4ddf8891f9aa2a3d6d&perms=read&api_sig=cb7eaf2e2ee06b985f6339cde59a108b
          $api_sig = md5("87bf81ff6d31cc61" . "api_key" . "4eadfb370eaa8d4ddf8891f9aa2a3d6d" . "perms" . "read");
          $flickr_link = "https://www.flickr.com/services/auth/?api_key=" . "4eadfb370eaa8d4ddf8891f9aa2a3d6d" . "&perms=" . "read" . "&api_sig=". $api_sig;
          $loginUrl = $flickr_link;
          break;
      }

      // Build URL
      // $panelUrlAppendix = "&integrationName=". $intName ."&panelToken=". $_SESSION['singularityToken'];
      $panelUrlAppendix = "";
      $loginUrl = $loginUrl . $panelUrlAppendix;
        ?>
        <figure>
          <a href="<?= $loginUrl ?>" class="integration-action <?= !$active ? '' : '-disabled' ?>" title="Authorize Application">
            <span class="dashboard-item-icon dashboard-item-icon-with-border"><i class="icon fa fa-link"></i></span>
          </a>

          <a href="<?= $integration->url() ?>?action=deauthorize<?= $panelUrlAppendix ?> " class="integration-action <?= $active ? '' : '-disabled' ?>" title="Deauthorize Application">
            <span class="dashboard-item-icon dashboard-item-icon-with-border"><i class="icon fa fa-chain-broken"></i></span>
          </a>

          <figcaption class="dashboard-item-text"><?= $integration->title() ?></figcaption>
        </figure>
      </li>
      <?php
    }
  }
  ?>
  </ul>
</div>
<ul class="option-list"
  <li><i class="icon fa fa-link"></i> = authorize</li>
  <li><i class="icon fa fa-chain-broken"></i> = deauthorize</li>
</ul>
<?php
}
else {
  echo "No integrations available.";
}
