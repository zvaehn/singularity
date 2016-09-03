<?php
$root_dir     = realpath(dirname(__FILE__) . '/../../');
$url          = (isset($_GET['url']) ? $_GET['url'] : false);
$quality      = 80;
$cacheoffset  = 7 * 24 * 60 * 60;
$filename     = md5($url . $quality);
$folder       = substr($filename, 0, 2);
$cachedir     = $root_dir . '/cache/' . $folder . '/';
$errorfile    = $root_dir . '/assets/images/img_not_found_2.jpg';
$isvalidurl   = true;

// Create the cache dirs
@mkdir($cachedir, 0777, true);
@mkdir($tmpdir, 0777, true);

try {
  if($isvalidurl) {
    preg_match("/\b(\.jpg|\.JPG|\.png|\.PNG|\.gif|\.GIF)\b/", $url, $type);

    if(isset($type[0])) {
      $type      = strtolower(str_replace(".", "", $type[0]));
      $tmpfile   = $cachedir   . 'tmp_' . $filename . '.' . $type;
      $cachefile = $cachedir . $filename . '.' . $type;

      // Is the file alerady cached?
      if(!file_exists($cachefile)) {
        if(file_put_contents($tmpfile, file_get_contents($url))) {
          if($type == "jpg") {
            $img = imageCreateFromJpeg($tmpfile);

            /*$text_color = imagecolorallocate($img, 255, 0, 0);
            imagestring($img, 6, 50, 50,  'THIS IS A CACHED FILE', $text_color);*/

            imagejpeg($img, $cachefile, $quality);

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
        $tstring = gmdate('D, d M Y H:i:s \G\M\T', time() + $cacheoffset);
        header('Pragma: public');
        header('Cache-Control: public, max-age='.$cacheoffset);
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
}
catch (Exception $e) {
  error_log($e);
}

// Invalid Image ressource
header('Content-Type: image/jpeg');
echo file_get_contents($errorfile);
?>
