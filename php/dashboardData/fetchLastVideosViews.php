<?php
session_start();
require_once '../link.php';

if (isset($_POST['user_address'])) {
    $data = array();
    $data1 = array();
    $arrayData = array();
    $arrayData1 = array();
    $arrayDataComplete = array();
    $from_ip = $_SERVER['REMOTE_ADDR'];
    $from_browser = $_SERVER['HTTP_USER_AGENT'];
    date_default_timezone_set("Asia/Calcutta");
    $date_now = date("r");
    $user_address = mysqli_real_escape_string($con, $_POST['user_address']);

    $query = "select * from(SELECT * FROM `video_info` WHERE `user_address` = '$user_address' order by `video_id` desc limit 7) var1 order by `video_id` asc";
    $like_result = mysqli_query($con, $query);
    if (mysqli_num_rows($like_result) != 0) {
        while ($row = mysqli_fetch_array($like_result)) {
            $name = $row['name'];
            $name = substr($name, 0, 8).'...';
            $views = $row['video_views'];
            array_push($arrayData,$name);
            array_push($arrayData1,$views);            
        }
        array_push($arrayDataComplete,[$arrayData,$arrayData1]);
        echo json_encode($arrayDataComplete);
    } else {
        $data['status'] = 601;
        echo json_encode($data);
    }
} else {
    $data['status'] = 404;
    echo json_encode($data);
}
