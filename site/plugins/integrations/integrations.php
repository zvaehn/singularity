<?php
use Flickering\Flickering;
use Flickering\FlickeringServiceProvider;
use MetzWeb\Instagram\Instagram;

DEFINE('ROOT', __DIR__ . '/../../');

require __DIR__ . '/../../../vendor/autoload.php';
require __DIR__ . '/../../../lib/phpflickr-master/phpFlickr.php';

function get_flickr() {
  $flickr = new phpFlickr(
    c::get('flickr')['key'],
    c::get('flickr')['secret']
  );

  $flickrPage = page('integrations/flickr');

  $flickr->setToken($flickrPage->Accesstoken()->value());

  return $flickr;
}

function get_instagram() {
  $instagram = new Instagram(array(
    'apiKey'      => c::get('instagram')['key'],
    'apiSecret'   => c::get('instagram')['secret'],
    'apiCallback' => url::scheme() . '://' . server::get('server_name') . '/integrations/instagram'
  ));

  return $instagram;
}
