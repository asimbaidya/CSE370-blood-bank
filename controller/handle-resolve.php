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
// (
//     [search-id] => 12
//     [sblood-group] => AB-
//     [request-id] => 8
//     [resolver-id] => user1@gmail.com
// )
echo '</pre>';



if (isset($_GET['resolver-id']) && !empty($_GET['resolver-id']) && isset($_GET['search-id']) && !empty($_GET['search-id'])) {
    $uid = $_GET['resolver-id'];
    $sid = $_GET['search-id'];
    $bg = $_GET['sblood-group'];
    echo "<h1>$uid will resolve the search $sid by giving $bg if every thign goes well</h1>\n";

    // getting users information
    $sql = "SELECT id,last_donated,blood_group FROM `user` WHERE email = '$uid';";
    $user_info_res = mysqli_query($conn, $sql);
    $user_info = mysqli_fetch_array($user_info_res);

    $user_id = $user_info['id'];
    $last_donated = $user_info['last_donated'];
    $user_bloog_group = $user_info['blood_group'];

    // getting blood_info
    $sql = "SELECT blood_group,search_status FROM `search` WHERE id=$sid;";
    $search_info_res = mysqli_query($conn, $sql);
    $search_info = mysqli_fetch_array($search_info_res);

    $search_blood_group = $search_info['blood_group'];
    $search_status = $search_info['search_status'];

    if (1) {
        $_SESSION['search_err'] = "";
        header("location: /project/search.php");
        exit;
    }
    if (1) {
        $_SESSION['search_err'] = "";
        header("location: /project/search.php");
        exit;
    }
    if (1) {
        $_SESSION['search_err'] = "";
        header("location: /project/search.php");
        exit;
    }
}
