<?php

echo "<div>";
echo "<h2>".$post['data']->title()."</h2>";
echo substr($post['data']->text()->value(), 0, 200)."...";
echo "</div>";

?>
