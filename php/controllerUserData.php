<?php 
session_start();
require "link.php";
$username = "";
$name = "";
$errors = array();

//if user signup button
if(isset($_GET['signup'])){
    $name = mysqli_real_escape_string($con, $_GET['name']);
    $username = mysqli_real_escape_string($con, $_GET['username']);
    $metamask_address = mysqli_real_escape_string($con, $_GET['metamask_address']);
    
    $username_check = "SELECT * FROM user_login WHERE `username` = '$username'";
    $res = mysqli_query($con, $username_check);
    if(mysqli_num_rows($res) > 0){
        $errors['username'] = "Username that you have entered is already exist!";
    }
    if(count($errors) === 0){
        // $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $username_status = "verified";
        $account_status = "active";

        $from_ip = $_SERVER['REMOTE_ADDR'];
        $from_browser = $_SERVER['HTTP_USER_AGENT'];
        date_default_timezone_set("Asia/Kolkata");
        $created_at = date("20y-m-d");

        function guidv4($data)
        {
            assert(strlen($data) == 16);

            $data[6] = chr(ord($data[6]) && 0x0f | 0x40); // set version to 0100
            $data[8] = chr(ord($data[8]) && 0x3f | 0x80); // set bits 6-7 to 10

            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        }

        $user_uid = guidv4(openssl_random_pseudo_bytes(16));
        $meta_uid = guidv4(openssl_random_pseudo_bytes(16));
        /* ------------------------------ new code add ------------------------------ */
            $metamask_check = "SELECT * FROM user_login WHERE `metamask_address` = '$metamask_address' AND `email_status` = 'verified'";
            $res_metamask = mysqli_query($con, $metamask_check);
        /* ------------------------------ new code end ------------------------------ */
            if(mysqli_num_rows($res_metamask) > 0){
                $query_delete = "DELETE FROM `user_login` WHERE `metamask_address` = '$metamask_address' AND `email_status` = 'verified' ";
                mysqli_query($con, $query_delete);
            }
            $insert_data = "INSERT INTO user_login (user_uid,metamask_address,first_time_login, name, username, email, code, email_status, account_status, from_ip, from_browser, created_at)values('$user_uid','$metamask_address','true', '$name', '$username', '$username', '0', '$username_status', '$account_status', '$from_ip', '$from_browser', '$created_at')";
            $data_check = mysqli_query($con, $insert_data);

            if(strpos($metamask_address, '0x') !== false){
            $query = "INSERT INTO `metamask_details`(`meta_uid`, `user_uid`,`metamask_address`,`eth_metamask_address`,`meta_status`)
            VALUES ('$meta_uid','$user_uid','$metamask_address','$metamask_address','active')";      
            $data_check2 =  (mysqli_query($con, $query));
            if($data_check && $data_check2){
                    $info = "We've sent a verification code to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['name'] = $name;
                    $_SESSION['username'] = $username;
                    $_SESSION['header_show'] = $metamask_address;
                    $_SESSION['metamask_address'] = $metamask_address;
                    header('Location: ./');
                    exit();
            }else{
                $errors['db-error'] = "Failed while inserting data into database!";
            }
            }else{
            $query = "INSERT INTO `metamask_details`(`meta_uid`, `user_uid`,`metamask_address`,`neo_address`,`meta_status`)
            VALUES ('$meta_uid','$user_uid','$metamask_address','$metamask_address','active')";      
            $data_check2 =  (mysqli_query($con, $query));
            if($data_check && $data_check2){
                    $info = "We've sent a verification code to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['name'] = $name;
                    $_SESSION['username'] = $username;
                    $_SESSION['header_show'] = $metamask_address;
                    $_SESSION['metamask_address'] = $metamask_address;
                    header('Location: ./');
                    exit();
            }else{
                $errors['db-error'] = "Failed while inserting data into database!";
            }
            }
    }

}
    //if user click verification code submit button
    if(isset($_POST['check'])){
        $userAddress = $_SESSION['userAddress'];
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM user_login WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $username = $fetch_data['username'];
            $code = 0;
            $username_status = 'verified';
            $account_status = 'active';
            $update_otp = "UPDATE user_login SET code = $code, email_status = '$username_status', account_status = '$account_status',first_time_login = 'true' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            echo $update_res;
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['username'] = $username;
                header('Location: ./');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click login button
    if(isset($_POST['login'])){
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $check_email = "SELECT * FROM user_login WHERE username = '$username'";
        $res = mysqli_query($con, $check_email);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['password'];
            if(password_verify($password, $fetch_pass)){
                $_SESSION['username'] = $username;
                $username_status = $fetch['email_status'];
                $account_status = $fetch['account_status'];
                if($username_status == 'verified' && $account_status == 'active'){
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;
                        if(isset($_SERVER['HTTP_REFERER'])) {
                            header('Location: '.$_SERVER['HTTP_REFERER']);  
                        } else {
                            header('Location: ./');  
                        }
                        //echo "<script>history.go(-1);</script>";
                }else{
                    $info = "It's look like you haven't still verify your email - $email";
                    $_SESSION['info'] = $info;
                    header('Location: user-otp');
                }
            }else{
                $errors['username'] = "Incorrect email or password!";
            }
        }else{
            $errors['username'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
        }
    }

    //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $check_email = "SELECT * FROM user_login WHERE username='$username'";
        $run_sql = mysqli_query($con, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE user_login SET code = $code WHERE username = '$username'";
            $run_query =  mysqli_query($con, $insert_code);
            if($run_query){
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: skg8028@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "We've sent a passwrod reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['username'] = $username;
                    header('Location: reset-code');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['username'] = "This email address does not exist!";
        }
    }

    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM user_login WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $username = $fetch_data['username'];
            $_SESSION['username'] = $username;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('Location: new-password');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $username = $_SESSION['username']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE user_login SET code = $code, password = '$encpass' WHERE username = '$username'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    
   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: login-user-mm');
    }

    function custom_number_format($n, $precision = 2) {
        if ($n < 1000) {
            // Anything less than a thousand
            $n_format = number_format($n);
        } else if ($n < 1000000) {
            // Anything less than a million
            $n_format = number_format($n / 1000, $precision, ".", "") + 0 . 'K';
        } else if ($n < 1000000000) {
            // Anything less than a billion
            $n_format = number_format($n / 1000000, $precision, ".", "") + 0 . 'M';
        } else {
            // At least a billion
            $n_format = number_format($n / 1000000000, $precision, ".", "") + 0 . 'B';
        }
    
        return $n_format;
    }
