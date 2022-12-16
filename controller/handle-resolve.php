<?php

echo "<hr>\n<h1>get</h1>";
echo '<pre>';
print_r($_GET);
echo '</pre>';


if (isset($_GET['sid']) && isset($_GET['uid'])) {
    $sid = $_GET['sid'];
    $uid = $_GET['uid'];
    echo "<h1>$uid will resolve the search $sid</h1>\n";
}
