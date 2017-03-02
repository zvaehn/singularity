<?php
DEFINE("QUALITY", 80);
DEFINE("CACHEOFFSET", 7 * 24 * 60 * 60);
DEFINE("ROOT_DIR", realpath(dirname(__FILE__) . '/../../'));

$errorfile    = ROOT_DIR . '/assets/images/img_not_found_2.jpg';
$rawurl       = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$rawurl       = urldecode($rawurl);

// replacing rules
$url = str_replace('__-0-__', '/', $rawurl);
$url = str_replace('__-1-__', ':', $url);

$parts = explode("__--__", $url); // split the request url from the full img url

$imageUrl = $parts[sizeof($parts)-1];

$filename     = md5($imageUrl . QUALITY);
$folder       = substr($filename, 0, 2);
$cachedir     = ROOT_DIR . '/cache/' . $folder . '/';

try {
  // Create the cache dirs
  @mkdir($cachedir, 0777, true);

  preg_match("/\b(\.jpg|\.JPG|\.png|\.PNG|\.gif|\.GIF)\b/", $imageUrl, $type);

  if(isset($type[0])) {
    $type      = strtolower(str_replace(".", "", $type[0]));
    $tmpfile   = $cachedir   . 'tmp_' . $filename . '.' . $type;
    $cachefile = $cachedir . $filename . '.' . $type;

    // Is the file alerady cached?
    if(!file_exists($cachefile)) {
      $remoteImage = file_get_contents($imageUrl);

      if(!$remoteImage) {
        throw new Exception("Unable to recieve image from remote host: ".$remoteImage);
      }

      // Copy remote image to local drive
      if(file_put_contents($tmpfile, $remoteImage)) {
        if($type == "jpg") {
          $img = imageCreateFromJpeg($tmpfile);

          /*$text_color = imagecolorallocate($img, 255, 0, 0);
          imagestring($img, 6, 50, 50,  'THIS IS A CACHED FILE', $text_color);*/

          imagejpeg($img, $cachefile, QUALITY);

          chmod($cachefile, 0777);
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
        error_log("Unable to create tmpfile: " . $tmpfile);
      }

      // Delete tempfile
      unlink($tmpfile);
    }

    if(file_exists($cachefile) && is_readable($cachefile)) {
      $tstring = gmdate('D, d M Y H:i:s \G\M\T', time() + CACHEOFFSET);
      header('Pragma: public');
      header('Cache-Control: public, max-age='.CACHEOFFSET);
      header('Expires: '. $tstring);
      header('Last-Modified: '.$tstring);
      header('ETag: '.$filename);
      header('Content-Type: image/jpeg');

      echo file_get_contents($cachefile);
      exit();
    }
    else {
      error_log("file does not exist nor writeable");
    }
  }
  else {
    error_log("type not set");
  }
}
catch (Exception $e) {
  error_log($e);
}

// Invalid Image ressource
header('Content-Type: image/jpeg');
echo file_get_contents($errorfile);
?>
