<?php
$kirby = kirby();

use Flickering\Flickering;
use Flickering\FlickeringServiceProvider;
use MetzWeb\Instagram\Instagram;

// require 'vendor/cosenary/instagram/src/Instagram.php';
require 'vendor/autoload.php';

require 'lib/phpflickr-master/phpFlickr.php';

/*$container = FlickeringServiceProvider::make();
$flickr = new Flickering($container);
$flickr->handshake("4eadfb370eaa8d4ddf8891f9aa2a3d6d", "87bf81ff6d31cc61");
*/
$flickr = new phpFlickr("4eadfb370eaa8d4ddf8891f9aa2a3d6d", "87bf81ff6d31cc61");
// $recent = $f->photos_getRecent();
// $recnt = $f->people_getPublicPhotos();

// var_dump($recent);

/*foreach ($recent['photo'] as $photo) {
    $owner = $f->people_getInfo($photo['owner']);
    echo "<a href='http://www.flickr.com/photos/" . $photo['owner'] . "/" . $photo['id'] . "/'>";
    echo $photo['title'];
    echo "</a> Owner: ";
    echo "<a href='http://www.flickr.com/people/" . $photo['owner'] . "/'>";
    echo $owner['username'];
    echo "</a><br>";
}*/

$instagram = new Instagram(array(
  'apiKey'      => '486c159f8f3e4061883bec6e24023465',
  'apiSecret'   => 'beadfe2264e141ba8e27a2dd95c9af2e',
  'apiCallback' => 'http://local.singularity.de/integrations/instagram'
));

c::set('integrations', array(
  'instagram' => $instagram,
  'flickr' => $flickr,
));
