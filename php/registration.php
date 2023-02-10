<?php

require_once 'link.php';

if(isset($_POST['email'])){

    $data = array();  
    $from_ip = $_SERVER['REMOTE_ADDR'];
    $from_browser = $_SERVER['HTTP_USER_AGENT'];
    date_default_timezone_set("Asia/Calcutta");
    $date_now = date("r");

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $hashed_password = hash("sha512", $password);

    $id = 0;
    $result = mysqli_query($con, "SELECT max(id) FROM `users`");
    while ($row = mysqli_fetch_array($result)) {
        $id = $row[0];  
    }
    $id = $id + 1;

    $query = "INSERT INTO `users`(`id`,`name`,`email`,`phone`,`password`,`image`,`date_now`,`from_ip`,`from_browser`) VALUES ('$id','Gatsby','$email','$phone','$hashed_password','images/user/user.jpg','$date_now','$from_ip','$from_browser')";
    
    if($result1 = mysqli_query($con, $query)) { 
        $data['status'] = 201;
        echo json_encode($data);

    }else{  
        $data['status'] = 601;
        echo json_encode($data);
    }
}else{
    $data['status'] = 701;
    echo json_encode($data);
}
?>