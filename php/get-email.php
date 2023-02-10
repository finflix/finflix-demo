<?php

require_once 'link.php';

if(isset($_POST['email'])){

    $data = array();  
    $from_ip = $_SERVER['REMOTE_ADDR'];
    $from_browser = $_SERVER['HTTP_USER_AGENT'];
    date_default_timezone_set("Asia/Calcutta");
    $date_now = date("r");

    $email = mysqli_real_escape_string($con, $_POST['email']) ;

    $query = mysqli_query($con, "SELECT * FROM `users` WHERE `email` = '$email'");
    
    if (mysqli_num_rows($query) !=0 ) {
        while ($row = mysqli_fetch_array($query)) {
            $data['id'] = $row['id'];  
            $data['name'] = $row['name'];
            $data['email'] = $row['email'];
            $data['image'] = $row['image'];
            $data['package'] = $row['package'];
        }
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