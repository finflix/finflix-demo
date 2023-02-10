<?php

require_once 'link.php';
if(isset($_POST['email'])){
    $data = array();  
    $from_ip = $_SERVER['REMOTE_ADDR'];
    $from_browser = $_SERVER['HTTP_USER_AGENT'];
    date_default_timezone_set("Asia/Calcutta");
    $date_now = date("r");
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $setPass = mysqli_real_escape_string($con, $_POST['setPass']);
    $password = mysqli_real_escape_string($con, $_POST['password']) ;
    $hashed_password = hash("sha512", $password);

    $result = mysqli_query($con, "SELECT * FROM `users` WHERE `email` = '$email'");
    if (mysqli_num_rows($result) == 0 ) { 
        $data['status'] = 301;
        $data['error'] = 'Invalid Registered Email or Phone No.';
        echo json_encode($data);
    } else{

        if($setPass == 1){
            // $query = "UPDATE `signup-details` SET `password` = '$hashed_password', `time` = '$date_now', `from_ip` = '$from_ip', `from_browser` = '$from_browser' WHERE `email` = '$email' AND `phone` = '$phone'";
                $query = "UPDATE `users` SET `password` = '$hashed_password',`name` = '$name' WHERE `email` = '$email'";

                // echo $query;
                
                if($result = mysqli_query($con, $query))
                {  
                    $data['success'] = 'Profile update successfully';
                    $data['status'] = 201;
                    echo json_encode($data);
                }  
                else  
                {  
                    $data['status'] = 601;
                    $data['error'] = $con -> error;
                    echo json_encode($data);
                }

        }else{
                // $query = "UPDATE `signup-details` SET `password` = '$hashed_password', `time` = '$date_now', `from_ip` = '$from_ip', `from_browser` = '$from_browser' WHERE `email` = '$email' AND `phone` = '$phone'";
                $query = "UPDATE `users` SET `name` = '$name' WHERE `email` = '$email'";

                // echo $query;

                if($result = mysqli_query($con, $query))
                {  
                    $data['success'] = 'Profile update successfully';
                    $data['status'] = 201;
                    echo json_encode($data);
                }  
                else  
                {  
                    $data['status'] = 601;
                    $data['error'] = $con -> error;
                    echo json_encode($data);
                }
        }
        
    }
}
?>