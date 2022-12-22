<?php
// initialize the session
session_start();
include_once('../db/config.php');

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header('location: /register.php');
}

// exit if user logged in
if (isset($_SESSION["user_loggedin"]) && $_SESSION["user_loggedin"] === true) {
    header('location: /');
    exit;
}

// exit if admin logged in
if (isset($_SESSION["admin_loggedin"]) && $_SESSION["admin_loggedin"] === true) {
    header('location: /');
    exit;
}


// testing 
// echo "<hr>\n<h1>POST</h1>";
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$sex = $_POST['sex'];
$dob = $_POST['dob'];
$blood_group = $_POST['blood-group'];
$useremail = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm-password']; // verified in frnt-end

// handlling user register
// sql
$sql = "SELECT email FROM user WHERE email = '$useremail';";

if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result)  == 1) {
        // alrady email exist in db
        $_SESSION['register_err'] = "$useremail already registered ";
        header('location:  /register.php');
    } else {
        // query for inserting into db 
        $sql = <<<SQL
INSERT INTO
  `user` (
    `first_name`,
    `last_name`,
    `sex`,
    `date_of_birth`,
    `blood_group`,
    `email`,
    `phone`,
    `password`
  )
VALUES
  (
    '$fname',
    "$lname",
    '$sex',
    '$dob',
    '$blood_group',
    '$useremail',
    '$phone',
    '$password'
  );
SQL;
        // let's attemtp to run query
        if (mysqli_query($conn, $sql)) {
            $_SESSION["user_loggedin"] = true;
            $_SESSION["useremail"] = $useremail;
            $_SESSION['msg'] = "A new account created with $useremail email";
            // echo "New record created successfully";
            // echo '<a href="/">Goto Home</a>';
            header('location:  /');
        } else {
            // if someting explodes, run this line
            $_SESSION['register_err'] = "$sql contain error" . mysqli_error($conn);
            header('location:  /register.php');
        }
    }
    mysqli_close($conn);
} else {
    $_SESSION['register_err'] = "$sql contain error" . mysqli_error($conn);
    header('location:  /register.php');
}

mysqli_close($conn);
