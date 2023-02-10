<?php

require_once 'link.php';

if(isset($_POST['email'])){

    $data = array();  

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $timestamp = mysqli_real_escape_string($con, $_POST['date']);
    $date = date("m-d-Y", $timestamp);
    $query = "UPDATE `users` SET `charge_date` = '$date' WHERE `users`.`email` = '$email'";

    if($result1 = mysqli_query($con, $query)) {
        $data['status'] = 201;
        echo json_encode($data);
    }else{  
        $data['status'] = 601;
        echo json_encode($data);
    }
}
?>