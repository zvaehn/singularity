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
  'key' => '4eadfb370eaa8d4ddf8891f9aa2a3d6d',
  'secret' => '87bf81ff6d31cc61'
));

c::set('instagram', array(
  'key' => '486c159f8f3e4061883bec6e24023465',
  'secret' => 'beadfe2264e141ba8e27a2dd95c9af2e'
));
