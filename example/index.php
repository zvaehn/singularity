<?php
require 'vendor/cosenary/instagram/src/Instagram.php';

use MetzWeb\Instagram\Instagram;

$instagram = new Instagram(array(
  'apiKey'      => '486c159f8f3e4061883bec6e24023465',
  'apiSecret'   => 'beadfe2264e141ba8e27a2dd95c9af2e',
  'apiCallback' => 'http://local.singularity.de/success.php'
));

?>
<a href="<?= $instagram->getLoginUrl() ?>">Login with Instagram</a>
