<?php

if(panel()->user()->role() == "admin") {
  return array(
    'title' => 'Integrations',
    'options' => array(
      array(
        'text' => 'Edit',
        'icon' => 'pencil',
        'link' => 'pages/integrations/edit'
      ),
    ),
    'html' => function() {

      $flickr = get_flickr();
      $instagram = get_instagram();
      $available_integrations = panel()->page('integrations')->children()->visible();
      $text = "";

      return tpl::load(__DIR__ . DS . 'integrations.html.php', array(
        'available_integrations' => $available_integrations,
        'flickr' => $flickr,
        'instagram' => $instagram,
        'text' => $text
      ));
    }
  );
}
else {
  return false;
}
