<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	// $link= new mysqli("localhost","finflix","finflix","finflix");
	$link= new mysqli("localhost","finflix","finflix","finflix");;
	if($link->connect_error){
		die("connection Failed" .$link->connect_error);
	}
	$data = array();
	$myArray = array();
	
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $hash_password = "0x" . hash('sha256', "Bolt") . hash('sha256', $password) . hash('sha256', 'FinFlix');

    $query = mysqli_query($link, "SELECT * FROM `dual_auth` WHERE `username` = '$username' AND `password` = '$hash_password'");

    if (mysqli_num_rows($query) !=0 ) {
        $data['status'] = 200;
        $data['userExists'] = true;
        $data['message'] = "Login Successful";
        echo json_encode($data);
		mysqli_close($link);

    }else{  
        $data['status'] = 404;
        $data['userExists'] = false;
        $data['message'] = "Invalid Credentials";
        echo json_encode($data);
    }

?>