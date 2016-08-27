<?php

echo "<figure>";
  echo "<img class='js-lazyload' data-original='".$post['data']['images']['standard_resolution']['url']."'>";
  echo "<noscript><img src='".$post['data']['images']['standard_resolution']['url']."'></noscript>";
  echo "<figcaption>". $post['data']['caption']['text'] ."</figcaption>";
echo "</figure>";
