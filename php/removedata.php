<?php

require_once 'link.php';

if(isset($_POST['email'])){

    $data = array();  
    $from_ip = $_SERVER['REMOTE_ADDR'];
    $from_browser = $_SERVER['HTTP_USER_AGENT'];
    date_default_timezone_set("Asia/Calcutta");
    $date_now = date("r");

    $email = mysqli_real_escape_string($con, $_POST['email']) ;

    $query = mysqli_query($con, "UPDATE `users` SET `razorpay_subscription_id` = '', `payment_status` = '', `razorpay_payment_id` = '',`capture_status` = '', `package` = 'free' WHERE `email` = '$email'");
    
    $data['status'] = 201;
    echo json_encode($data);
}else{  
    $data['status'] = 601;
    echo json_encode($data);
}

?>