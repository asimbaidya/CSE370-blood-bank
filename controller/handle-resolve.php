<?php
// initialize the session
session_start();
include_once('../db/config.php');

//  convert binary value to char
if (isset($_GET['sblood-group'])) {
    $bg = hex2bin($_GET['sblood-group']);
    $_GET['sblood-group'] = $bg;
}

echo "<hr>\n<h1>get</h1>";
echo '<pre>';
print_r($_GET);
echo '</pre>';


if (isset($_GET['resolver-id']) && !empty($_GET['resolver-id']) && isset($_GET['search-id']) && !empty($_GET['search-id'])) {
    $uid = $_GET['resolver-id'];
    $sid = $_GET['search-id'];
    $bg = $_GET['sblood-group'];
    echo "<h1>$uid will resolve the search $sid by giving $bg if every thign goes well</h1>\n";
}
