<?php
// initialize the session
session_start();
include_once('../db/config.php');


if (isset($_POST['submit']) and isset($_GET['useremail'])) {
    $useremail = $_GET['useremail'];

    $required_bg = $_POST['blood-group'];
    $content = $_POST['post-content'];


    // getting users information
    $sql = "SELECT id FROM `user` WHERE email = '$useremail';";
    if ($user_info_res = mysqli_query($conn, $sql)) {
        $user_info = mysqli_fetch_array($user_info_res);

        // unpack
        $user_id = $user_info['id'];

        // generatge
        $request_time = date('d-m-y h:i:s');

        $sql = "INSERT INTO `search` ( `content`, `blood_group`, `search_status`, `request_by`,`request_time`) VALUES ( '$content', '$required_bg', '0', '$user_id', '$request_time');";
        if ($result = mysqli_query($conn, $sql)) {
            $_SESSION['post_msg'] = <<<MSG
            <p class="lead m-1">Your Request for <span class="badge bg-danger"> $required_bg </span> Blood has been posted!! </p>
            MSG;
            header('location: /search.php');
        } else {
            // handle insert error
        }
    } {
        // handle select error
    }
}
