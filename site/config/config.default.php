<?php

/*

---------------------------------------
License Setup
---------------------------------------

Please add your license key, which you've received
via email after purchasing Kirby on http://getkirby.com/buy

It is not permitted to run a public website without a
valid license key. Please read the End User License Agreement
for more information: http://getkirby.com/license

*/

c::set('license', 'put your license key here');
c::set('development', true);

if(c::get('development')) {
  c::set('debug', true);
}
else {
  c::set('debug', false);
  c::set('panel.install', false);
}

/*

---------------------------------------
Kirby Configuration
---------------------------------------

By default you don't have to configure anything to
make Kirby work. For more fine-grained configuration
of the system, please check out http://getkirby.com/docs/advanced/options

*/

/*
---------------------------------------
Integration API Setup
---------------------------------------
*/
c::set('flickr', array(
  'key' => 'YOURAPIKEY',
  'secret' => 'YOURAPISECRET'
));

c::set('instagram', array(
  'key' => 'YOURAPIKEY',
  'secret' => 'YOURAPISECRET'
));
