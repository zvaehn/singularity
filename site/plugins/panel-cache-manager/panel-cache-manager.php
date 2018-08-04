<?php

/* Function overview:
- Delete Cache from the live server^
*/

if(!c::get('widgets.cachemanager.enabled')) return;

$kirby->set('widget', 'panel-cache-manager', __DIR__ . '/widgets/panel-cache-manager');
