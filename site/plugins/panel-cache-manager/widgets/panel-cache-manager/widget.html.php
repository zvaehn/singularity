<?php
// http://{domain}/assets/plugins/{pluginName}/{optionalSubfolder}/{filename}
$assetsURL = $kirby->urls()->assets() . "/plugins/panel-cache-manager";
?>

<link rel="stylesheet" href="<?= url($assetsURL . "/css/styles.css") ?>">
<script src="<?= url($assetsURL . "/js/script.js") ?>"></script>

<ul class="nav nav-list sidebar-list">
  <li>
    <span>Directory</span>
    <small class="marginalia shiv shiv-left shiv-white" title="<?= $tmplvars['cacheDirectory'] ?>">
      ...
      <?php
      $pathcrumbs = explode("/", $tmplvars['cacheDirectory']);
      $length = count($pathcrumbs);
      $displayCrumbs = 3;
      for ($i = $length - $displayCrumbs; $i < $length; $i++) {
        echo $pathcrumbs[$i] . "/";
      }
      ?>
    </small>
  </li>
  <li>
    <span>Newest File</span>
    <small class="marginalia shiv shiv-left shiv-white">
      <?php
      if($tmplvars['timestampNewestFile']) {
        echo date ("d.m.Y H:i:s (e)", $tmplvars['timestampNewestFile']);
      }
      else {
        echo "-";
      }
      ?>
    </small>
  </li>
  <li>
    <span>Oldest File</span>
    <small class="marginalia shiv shiv-left shiv-white">
      <?php
      if($tmplvars['timestampOldestFile']) {
        echo date ("d.m.Y H:i:s (e)", $tmplvars['timestampOldestFile']);
      }
      else {
        echo "-";
      }
      ?>
    </small>
  </li>
  <li>
    <span>Cache Size</span>
    <small class="marginalia shiv shiv-left shiv-white">
      <?= $tmplvars['cachedSize'] ?>
    </small>
  </li>
  <li>
    <span>Cached Pages</span>
    <small class="marginalia shiv shiv-left shiv-white">
      <?= $tmplvars['cachedFilesCounter'] ?>
    </small>
  </li>
</ul>
