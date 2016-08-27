<?php
DEFINE('CACHEDIR', kirby()->roots()->cache(). DS . 'wall');
DEFINE('CACHEFILE', 'wall.json');

class WallPage extends Page {

  private $cachefile = CACHEDIR . DS . CACHEFILE;

  function cacheNeedsRebuild() {
    // CACHE REBUILD
    $now = time();
    $cacheDuration = $this->cacheDuration()->int() * 60;
    $expireAt = $this->touched()->int() + $cacheDuration;
    $rebuildCache = ($now >= $expireAt) ? true : false;

    if(false) {
      echo "now: ". $now."<br>";
      echo "cache duration: ".$cacheDuration."s<br>";
      echo "touched at: ".$this->touched()->int()."<br>";
      echo "expire at : ".$expireAt."<br>";
      echo "rebuild: ".$rebuildCache."<br>";
      echo "final return val: ".$rebuildCache . " " . !$this->cacheAvailable()."<br>";
      echo "<br>";
    }

    echo "<p style='position: fixed; top: 5px; left: 5px; font-size: 12px;'>next cache refresh: ". gmdate("H:i:s", ($expireAt - $now))."</p>";

    return $rebuildCache || !$this->cacheAvailable();
  }

  function cacheAvailable() {
    return is_readable($this->cachefile);
  }

  function getCache() {
    if(!$this->cacheAvailable() || $this->cacheNeedsRebuild()) return false;

    // GET CACHE DATA
    @mkdir(CACHEDIR, true);
    @$rawCache = file_get_contents(CACHEDIR . DS . CACHEFILE);

    if(!$rawCache) {
      return false;
    }
    else {
      return json_decode($rawCache, true);
    }
  }

  function setCache($data) {
    $json = json_encode($data);
    return file_put_contents($this->cachefile, $json);
  }
}
