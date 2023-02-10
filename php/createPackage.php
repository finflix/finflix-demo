<?php

require_once 'link.php';

if(isset($_POST['type']) == 'processing'){

    $data = array(); 

    $type = mysqli_real_escape_string($con, $_POST['type']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $query = "UPDATE `users` SET `payment_status` = '$type' WHERE `users`.`email` = '$email'";
    
    if($result1 = mysqli_query($con, $query)) {
        $data['status'] = 201;
        echo json_encode($data);
    }else{  
        $data['status'] = 601;
        echo json_encode($data);
    }
}
?>