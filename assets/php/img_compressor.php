<?php
$root_dir     = realpath(dirname(__FILE__) . '/../../');
$url          = (isset($_GET['url']) ? $_GET['url'] : false);
$filename     = md5($url);
$folder       = substr($filename, 0, 1);
$cachedir     = $root_dir . '/cache/' . $folder . '/';
$tmpdir       = $root_dir . '/tmp/' . $folder . '/';
$errorfile    = $root_dir . '/assets/images/img_not_found_2.jpg';
$quality      = 50;
$cacheoffset  = 48 * 60 * 60;
// $isvalidurl   = preg_match('/(http(s?):)|([/|.|\w|\s])*\.(?:jpg|gif|png|JPG)/', $url);
$isvalidurl   = true;

// Create the cache dirs
@mkdir($cachedir, "777");
@mkdir($tmpdir, "777");

try {
  if($isvalidurl) {
    preg_match("/\b(\.jpg|\.JPG|\.png|\.PNG|\.gif|\.GIF)\b/", $url, $type);

    if(isset($type[0])) {
      $type      = strtolower(str_replace(".", "", $type[0]));
      $tmpfile   = $tmpdir   . $filename . '.' . $type;
      $cachefile = $cachedir . $filename . '.' . $type;

      // Is the file alerady cached?
      if(!file_exists($cachefile)) {
        if(file_put_contents($tmpfile, file_get_contents($url))) {
          if($type == "jpg") {
            $img = imageCreateFromJpeg($tmpfile);

            imagejpeg($img, $cachefile, $quality);
          }
          else {
            throw new Exception("Mimetype not supported yet.");
          }
          /*else if($type == "png") {
            $img = imageCreateFromPng($tmpfile);
            imagepng($img, $cachefile, 8);
          }*/
        }
        else {
          echo("Unable to create tmpfile: " . $tmpfile);
        }

        // Delete tempfile
        unlink($tmpfile);
      }

      if(file_exists($cachefile) && is_readable($cachefile)) {
        header('Pragma: public');
        header('Cache-Control: max-age='.$cacheoffset);
        header('Expires: '. gmdate('D, d M Y H:i:s \G\M\T', time() + $cacheoffset));
        header('Content-Type: image/jpeg');

        echo file_get_contents($cachefile);
      }
    }
  }
}
catch (Exception $e) {
  error_log($e);
}

// Invalid Image ressource
header('Content-Type: image/jpeg');
echo file_get_contents($errorfile);
?>
