<?php
session_start();
require_once 'link.php';

if (isset($_POST['video_uid'])) {

    $data = array();
    $from_ip = $_SERVER['REMOTE_ADDR'];
    $from_browser = $_SERVER['HTTP_USER_AGENT'];
    date_default_timezone_set("Asia/Calcutta");
    $date_now = date("r");

    $video_uid = mysqli_real_escape_string($con, $_POST['video_uid']);

    $like_result = mysqli_query($con, "SELECT * FROM `video_info` WHERE `video_uuid` = '$video_uid'");
    $total_view = 0;
    if (mysqli_num_rows($like_result) != 0) {
        while ($row = mysqli_fetch_array($like_result)) {
            $total_view = $row['video_views'] + 1;
        }
    }

    $query = "UPDATE `video_info` SET `video_views` = '$total_view' WHERE `video_uuid` = '$video_uid'";
    if ($result = mysqli_query($con, $query)) {
        $data['status'] = 201;
        $data['success'] = 'video view added successfully';
    } else {
        $data['status'] = 601;
    }

    echo json_encode($data);
}
