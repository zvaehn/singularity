<?php
$root_dir = realpath(dirname(__FILE__) . '/../../');
$url      = (isset($_GET['url']) ? $_GET['url'] : false);
$filename = md5($url);
$cachedir = $root_dir . '/cache/';
$tmpdir   = $root_dir . '/tmp/';

if($url) {
  preg_match("/\b(\.jpg|\.JPG|\.png|\.PNG|\.gif|\.GIF)\b/", $url, $type);

  if(isset($type[0])) {
    $type = strtolower(str_replace(".", "", $type[0]));
    echo $type;
    echo $tmpdir . $filename;

    file_put_contents($tmpdir . $filename . '.' . $type, file_get_contents($url));

    if($type == "jpg") {
      // file_get_contents()
    }
    else {
      // error img
    }

    if($img === FALSE ){
    	header("Location: /struktur/img/spacer.gif");
      exit;
    }

    # Cache Control setzen und ausliefern
    $offset = 48 * 60 * 60;

    header('Pragma: public');
    header('Cache-Control: max-age='.$offset);
    header('Expires: '. gmdate('D, d M Y H:i:s \G\M\T', time() + $offset));
    header('Content-Type: image/jpeg');

    echo $img;
  }
}
else {
  // error img
}
?>
