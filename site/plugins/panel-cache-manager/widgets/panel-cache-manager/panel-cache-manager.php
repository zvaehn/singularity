<?php

namespace KirbyCacheManagerWidget;

use c;
use tpl;

date_default_timezone_set('Europe/Berlin');

$tmplvars = array(
  'cacheDirectory' => '',
  'cachedFilesCounter' => 0,
  'cachedSize' => 0,
  'timestampOldestFile' => false,
  'timestampNewestFile' => false,
);

$cmd = param('panel-cache-manager-cmd', false);

$cwd = getcwd();

$customCacheDir = c::get('widgets.cachemanager.cachedir');

if($customCacheDir && is_dir($customCacheDir)) {
  $cacheDir = $customCacheDir;
}
else {
  $cacheDir = kirby()->roots()->cache();
}

chdir($cacheDir);

$cacheFiles = glob('./*');

$cacheFilesCount = count($cacheFiles);
$tmplvars['cachedFilesCounter'] = $cacheFilesCount;
$tmplvars['cacheDirectory'] = $cacheDir;

$cachesize = 0;
foreach ($cacheFiles as $file) {
  if(is_file($file)) {
    $cachesize += filesize($file);
  }
}

$tmplvars['cachedSize'] = format_size($cachesize);


// Get oldest Cache File
if($cacheFilesCount) {
  array_multisort(array_map('filemtime', $cacheFiles), SORT_NUMERIC, SORT_ASC, $cacheFiles);
  $tmplvars['timestampOldestFile'] = filemtime($cacheFiles[0]);

  $tmplvars['timestampNewestFile'] = fileatime($cacheFiles[count($cacheFiles)-1]);
}
else {
  $tmplvars['timestampOldestFile'] = false;
  $tmplvars['timestampNewestFile'] = false;
}

// -------------------------
// Delete Cache
if($cmd == 'delete-cache') {
  if($cacheFilesCount > 0) {
    $filedeletionCounter = 0;
    $filedeletionError = false;

    foreach($cacheFiles as $file) {
      if(is_file($file)) {
        // delete file and incrase filedeletionCounter if succeeded
        if(unlink($file)) {
          $filedeletionCounter++;
        }
      }
    }

    panel()->notify($filedeletionCounter . ' of ' . $cacheFilesCount . ' files were deleted.');
  }
  else {
    panel()->alert('The cache is already empty.');
  }
}

// Change back the directory
chdir($cwd);

if($cmd) {
  panel()->redirect('/');
}

// Return the Dashboard-Widget-Markup
return array(
  'title' => 'Cache Manager',
  'html' => function() use ($tmplvars) {
    return tpl::load(__DIR__ . DS . 'widget.html.php', array(
      'kirby' => kirby(),
      'tmplvars' => $tmplvars
    ));
  },
  'options' => array(
    array(
      'text' => 'Purge',
      'icon' => 'trash',
      'link' => url('panel/panel-cache-manager-cmd:delete-cache')
    )
  ),
);


function format_size($size) {
  $mod = 1024;
  $units = explode(' ','Byte Kb Mb Gb Tb Pb');
  for ($i = 0; $size > $mod; $i++) {
    $size /= $mod;
  }
  return round($size, 2) . ' ' . $units[$i];
}
