<?php
require_once 'link.php';
if (mysqli_connect_error()) {
	die("<script>console.log('There is a problem with mysql connection')</script>");
}

if (isset($_POST['project_address'])) {
    $data = array(); 
    date_default_timezone_set("Asia/Calcutta");
    $date_now = date("r");
    $from_ip = $_SERVER['REMOTE_ADDR'];
    $from_browser = $_SERVER['HTTP_USER_AGENT'];


    function guidv4($data)
    {
        assert(strlen($data) == 16);

        $data[6] = chr(ord($data[6]) && 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) && 0x3f | 0x80); // set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    $crowd_fund_uuid = guidv4(openssl_random_pseudo_bytes(16));
    $post_uid =  strip_tags($_POST['video_uuid']);
    $user_address =  strip_tags($_POST['user_address']);
    $pay_amount = strip_tags($_POST['pay_amount']);
    $pay_amount_in = strip_tags($_POST['pay_amount_in']);
    $transactionHash = strip_tags($_POST['transactionHash']);
    $project_address = strip_tags($_POST['project_address']);


    $query = "INSERT INTO `crowd_fund`(`crowd_fund_uuid`, `video_uuid`, `user_address`, `pay_amount`, `pay_amount_in`, `txn_hash`, `project_address`, `from_ip`, `from_time`, `from_browser`) VALUES ('$crowd_fund_uuid','$post_uid','$user_address','$pay_amount','$pay_amount_in','$transactionHash','$project_address','$from_ip','$date_now','$from_browser')";

    if (mysqli_query($con, $query) ) {
        $data['status'] = 201;
        $data['success'] = "Contribution added successfully";
        echo json_encode($data);
    } else {
        $data['status'] = 301;
        $data['error'] = 'Error';
        echo json_encode($data);
        }
}
?>