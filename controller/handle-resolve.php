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
    $sql = "SELECT request_by, blood_group,search_status FROM `search` WHERE id=$sid;";
    $search_info_res = mysqli_query($conn, $sql);
    $search_info = mysqli_fetch_array($search_info_res);

    $search_blood_group = $search_info['blood_group'];
    $search_status = $search_info['search_status'];
    $request_by = $search_info['request_by'];

    if ($request_by === $user_id) {
        $_SESSION['solve_err'] = <<<MSG
            <p class="lead m-1">Please Please, Understand <span class="badge bg-danger">You can notate blood to yourself!</span></p>
            MSG;
        header("location: /search.php");
        exit;
    }
    if ($search_status === '1') {
        $_SESSION['solve_err'] = <<<MSG
            <p class="lead m-1">This request is alrady Solved!</p>
            MSG;
        header("location: /search.php");
        exit;
    }
    if ($user_bloog_group != $search_blood_group) {
        $_SESSION['solve_err'] = <<<MSG
            <p class="lead m-1">You clicked on Wrong Request! You can only donate<span class="badge bg-danger"> $user_bloog_group</span>
            but, someone need <span class="badge bg-danger"> $search_blood_group</span> blood!</p>
            MSG;
        header("location: /search.php");
        exit;
    }

    if (!empty($last_donated)) {
        // same query used in handle-donate
        $sql = "SELECT DATEDIFF( '$date_picked','$last_donated') AS days_count;";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $days_count = $row['days_count'];
        if ($days_count < 90) {
            if ($days_count === 0) {
                $days_count = "0";
            }
            $_SESSION['solve_err'] = <<<MSG
            <p class="lead m-1">It's only been <span class="badge bg-warning">3 $days_count </span> days since you donated blood!, Now take some rest </p>
            MSG;
            header("location: /search.php");
            exit;
        }
    }
    // all goood! so resolve now
    $resolve_time = date('d-m-y h:i:s');

    // squery to run
    $sql = "UPDATE `search` SET `search_status` = '1', `resolve_time` = '$resolve_time', `resolve_by` = '$user_id' WHERE id = $sid;";
    if (mysqli_query($conn, $sql)) {
        // now update last donated date of user
        $last_donated = date('d-m-y');
        // query
        $sql = "UPDATE `user` SET `last_donated` = '$last_donated' WHERE id = $user_id;";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['post_msg'] = <<<MSG
            <p class="lead m-1">Thank you for resolving search request!</p>
            MSG;
            header('location: /search.php');
        } else {
            // handle error
        }
        // all-done: back home
    } else {
        // handle error
    }
}
