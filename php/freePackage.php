<?php

require_once 'link.php';

if(isset($_POST['type']) == 'free-package'){

    $data = array();  

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $package = mysqli_real_escape_string($con, $_POST['package']);

    $query = "UPDATE `users` SET `package` = '$package' WHERE `users`.`email` = '$email'";
    
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