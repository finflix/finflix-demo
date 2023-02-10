<?php

require_once 'link.php';

if(isset($_POST['email'])){

    $data = array();  

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $hashed_password = hash("sha512", $password);

    $result = mysqli_query($con, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$hashed_password' ");
    
    if (mysqli_num_rows($result) !=0 ) {
        $row=mysqli_fetch_array($result);
        
        if($row['package'] == ""){
            $data['status'] = 201;
            echo json_encode($data);
        }else{
            $data['status'] = 202;
            $data['package'] = $row['package'];
            session_start();
            $_SESSION['user']=$email;
            echo json_encode($data);
        }

    }else{  
        $data['status'] = 601;
        echo json_encode($data);
    }
}else{
    $data['status'] = 701;
    echo json_encode($data);
}
?>
