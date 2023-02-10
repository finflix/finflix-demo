<?php
session_start();
require_once '../link.php';

if (isset($_POST['user_uid'])) {

    $data = array();
    $from_ip = $_SERVER['REMOTE_ADDR'];
    $from_browser = $_SERVER['HTTP_USER_AGENT'];
    date_default_timezone_set("Asia/Calcutta");
    $date_now = date("r");

    $user_uid = mysqli_real_escape_string($con, $_POST['user_uid']);
    $view_in_sec = mysqli_real_escape_string($con, $_POST['view_in_sec']);

    $like_result = mysqli_query($con, "SELECT * FROM `user_login` WHERE `user_uid` = '$user_uid'");
    $total_view_sec = 0;
    if (mysqli_num_rows($like_result) != 0) {
        while ($row = mysqli_fetch_array($like_result)) {
            $total_view_sec = $view_in_sec;
        }
    }

    $query = "UPDATE `user_login` SET `total_time_spend_sec` = '$total_view_sec' WHERE `user_uid` = '$user_uid'";
    if ($result = mysqli_query($con, $query)) {
        $data['status'] = 201;
        $data['success'] = 'video view second added successfully';
    } else {
        $data['status'] = 601;
    }

    echo json_encode($data);
}
