<?php

// start the session
session_start();

// test:
if (isset($_SESSION)) {
    echo "SET ?";
} else {
    echo "NOT SET ?";
}

$_SESSION = array();
session_destroy();

// redirect to previous page
if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
    $BACK = $_SERVER['HTTP_REFERER'];
    header("location: $BACK");
} else {
    header('location: /project/');
}
// DONE