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

    $query = "SELECT sum(cast(`eth_price` as float)) as total_eth_tip FROM `donate_eth` WHERE `to_user_address` = '$user_address' and `current_coin_symble` = 'ETH'";
    $like_result = mysqli_query($con, $query);
    if (mysqli_num_rows($like_result) != 0) {
        while ($row = mysqli_fetch_array($like_result)) {
            $total_eth_tip = $row['total_eth_tip'];
            array_push($arrayData, $total_eth_tip);
        }
    }

    $query2 = "SELECT sum(cast(`eth_price` as float)) as total_matic_tip FROM `donate_eth` WHERE `to_user_address` = '$user_address' and `current_coin_symble` = 'MATIC'";
    $like_result2 = mysqli_query($con, $query2);
    if (mysqli_num_rows($like_result2) != 0) {
        while ($row2 = mysqli_fetch_array($like_result2)) {
            $total_matic_tip = $row2['total_matic_tip'];
            array_push($arrayData, $total_matic_tip);
        }
    }

    $query3 = "SELECT SUM(cast(`pay_amount` as float)) as total_eth_crowd FROM `video_info` inner join `crowd_fund` on video_info.video_uuid = crowd_fund.video_uuid  WHERE (video_info.user_address = '$user_address' and video_info.is_croudfunded = 'true') and (crowd_fund.pay_amount_in='ETH')";
    $like_result3 = mysqli_query($con, $query3);
    if (mysqli_num_rows($like_result3) != 0) {
        while ($row3 = mysqli_fetch_array($like_result3)) {
            $total_eth_crowd = $row3['total_eth_crowd'];
            array_push($arrayData, $total_eth_crowd);
        }
    }

    $query4 = "SELECT SUM(cast(`pay_amount` as float)) as total_matic_crowd FROM `video_info` inner join `crowd_fund` on video_info.video_uuid = crowd_fund.video_uuid  WHERE (video_info.user_address = '$user_address' and video_info.is_croudfunded = 'true') and (crowd_fund.pay_amount_in='MATIC')";
    $like_result4 = mysqli_query($con, $query4);
    if (mysqli_num_rows($like_result4) != 0) {
        while ($row4 = mysqli_fetch_array($like_result4)) {
            $total_matic_crowd = $row4['total_matic_crowd'];
            array_push($arrayData, $total_matic_crowd);
        }
    }
    echo json_encode($arrayData);
} else {
    $data['status'] = 404;
    echo json_encode($data);
}
