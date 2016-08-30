<?php
/*use Flickering\Flickering;
use Flickering\FlickeringServiceProvider;
use MetzWeb\Instagram\Instagram;

require 'vendor/autoload.php';
require 'lib/phpflickr-master/phpFlickr.php';

$domain = server::get('server_name');

$flickr = new phpFlickr(
  c::get('flickr')['key'],
  c::get('flickr')['secret']
);

$instagram = new Instagram(array(
  'apiKey'      => c::get('instagram.key'),
  'apiSecret'   => c::get('instagram.secret'),
  'apiCallback' => url::scheme() . '://' . $domain . '/integrations/instagram'
));

// Pass integrations
c::set('integrations', array(
  'instagram' => $instagram,
  'flickr' => $flickr,
));
*/

$kirby = kirby();
