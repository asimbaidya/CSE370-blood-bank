<?php

// start the session
session_start();

// test:
if (isset($_SESSION)) {
    echo "SET ?";
} else {
    echo "NOT SET ?";
}

$useremail = $_SESSION['useremail'];
$msg = "$useremail has logged out in successfully";

$_SESSION = array();
session_destroy();

session_start();
$_SESSION['msg'] = $msg;

header('location: /');
// DONE
