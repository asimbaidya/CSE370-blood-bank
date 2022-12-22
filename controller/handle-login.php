<?php
// initialize the session
session_start();
include_once('../db/config.php');

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header('location: /login.php');
}

// exit if user logged in
if (isset($_SESSION["user_loggedin"]) && $_SESSION["user_loggedin"] === true) {
    // redirect to previous page
    header('location: /');
    exit;
}

// exit if admin logged in
if (isset($_SESSION["admin_loggedin"]) && $_SESSION["admin_loggedin"] === true) {
    header('location: /');
    exit;
}

// // testing 
// echo "<hr>\n<h1>POST</h1>";
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

// init error in session
$useremail = $_POST['email'];
$password = $_POST['password'];

if (isset($_POST['admin'])) {
    // handlling admin login
    // sql
    $sql = "SELECT email,password FROM admin WHERE email = '$useremail';";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result)  == 1) {
            $row = mysqli_fetch_row($result);
            $mail = $row[0];
            $pass = $row[1];
            if ($pass == $password) {
                $_SESSION["admin_loggedin"] = true;
                $_SESSION["useremail"] = $useremail;
                $_SESSION['msg'] = "$useremail has logged in successfully as a Admin!";
                // redirect to previous page
                header('location: /');
            } else {
                $_SESSION['login_err'] = "️Admin Password Does NOT MATCH!";
                header('location:  /login.php');
            }
        } else {
            $_SESSION['login_err'] = "$useremail does not have admin privilege";
            header('location:  /login.php');
        }
    }
} else {
    // handlling user login
    // sql
    $sql = "SELECT email,password FROM user WHERE email = '$useremail';";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result)  == 1) {
            $row = mysqli_fetch_row($result);
            $mail = $row[0];
            $pass = $row[1];
            if ($pass == $password) {
                $_SESSION["user_loggedin"] = true;
                $_SESSION["useremail"] = $useremail;
                $_SESSION['msg'] = "$useremail has logged in successfully";
                header('location: /');
            } else {
                $_SESSION['login_err'] = "Password Does not match!";
                header('location:  /login.php');
            }
        } else {
            $_SESSION['login_err'] = "$useremail does not have a account";
            header('location:  /login.php');
        }
    }
}
