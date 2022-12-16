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

header('location: /project/');

// DONE