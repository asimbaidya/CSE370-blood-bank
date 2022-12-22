<?php
// initialize the session
session_start();
include_once('../db/config.php');

if (isset($_POST['submit']) and isset($_GET['useremail'])) {
    $date_picked = $_POST['date-picked'];
    $useremail = $_GET['useremail'];
    // now query user info
    $sql = "SELECT id,blood_group,last_donated FROM user WHERE email = '$useremail';";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result)  == 1) {
            $row = mysqli_fetch_array($result);
            // unpack values
            $id = $row['id'];
            $blood_group = $row['blood_group'];
            $last_donated = $row['last_donated'];
            //
            if (!empty($last_donated)) {
                $sql = "SELECT DATEDIFF( '$date_picked','$last_donated') AS days_count;";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
                $days_count = $row['days_count'];
                if ($days_count < 90) {
                    $_SESSION['donate_err'] = "It's only been $days_count days you donated blood!, Now take some rest ";
                    header("location: /donate.php");
                    exit;
                }
            }
            // all good, insert into db
            $sql = "INSERT INTO `blood_bag` ( `blood_group`, `date_collected`, `available`, `donar_id`, `blood_bank_name`) VALUES ( '$blood_group', '$date_picked', '1', '$id', 'Blood Bank Name');";
            if (mysqli_query($conn, $sql)) {
                // donated, so update last donate on users table
                $sql = "UPDATE `user` SET `last_donated` = '$date_picked' WHERE id = $id;";
                // all-done: back home
                header('location: /'); // uc
                if (mysqli_query($conn, $sql)) {
                    // hanlde the erro
                }
            } else {
                // handle,  could not insert into blood bag
            }
        } else {
        }
    } else {
        // handle select user error
    }
} else {
    // handle not enough value error
}
