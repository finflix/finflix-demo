<?php

require_once 'link.php';

if(isset($_POST['type']) == 'update'){

    $data = array();  

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $razorpay_payment_id = mysqli_real_escape_string($con, $_POST['razorpay_payment_id']);
    $razorpay_subscription_id = mysqli_real_escape_string($con, $_POST['razorpay_subscription_id']);
    $capture_status = mysqli_real_escape_string($con, $_POST['capture_status']);

    $query = "UPDATE `users` SET `payment_status` = 'payment received', `razorpay_payment_id` = '$razorpay_payment_id', `razorpay_subscription_id` = '$razorpay_subscription_id', `capture_status` = '$capture_status', `package` = 'paid' WHERE `users`.`email` = '$email'";

    if($result1 = mysqli_query($con, $query)) {
        $data['status'] = 201;
        session_start();
        $_SESSION['user']=$email;
        echo json_encode($data);
    }else{  
        $data['status'] = 601;
        echo json_encode($data);
    }
}
?>