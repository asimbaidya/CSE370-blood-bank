<?php
// initialize the session
session_start();
include_once('../db/config.php');


echo "<hr>\n<h1>get</h1>";
echo '<pre>';
print_r($_GET);
echo '</pre>';

echo "<hr>\n<h1>get</h1>";
echo '<pre>';
print_r($_POST);
echo '</pre>';
