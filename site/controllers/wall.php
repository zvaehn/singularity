<?php

return function($site, $pages, $page) {
  $now = time();
  $cacheDuration = $page->cacheDuration()->int(); // * 60;
  $expireAt = $page->touched()->int() + $cacheDuration;
  $rebuildCache = ($now >= $expireAt) ? true : false;

  /*echo "now: ". $now."<br>";
  echo "cache duration: ".$cacheDuration."s<br>";
  echo "expire at : ".$expireAt."<br>";
  echo "touched at: ".$page->touched()->int()."<br>";

  echo "rebuild: ".$rebuildCache;*/

  return array(
    'rebuildCache' => $rebuildCache,
  );
};
