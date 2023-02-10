<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	// $link= new mysqli("localhost","finflix","finflix","finflix");
	$link= new mysqli("localhost","finflix","finflix","finflix");;
	$VideoDetails = '/videodetails';
	if($link->connect_error){
		die("connection Failed" .$link->connect_error);
	}
	$data = array();  
    $userIP = $_SERVER['REMOTE_ADDR'];

	// For main site
	// $http_client_id = $_SERVER['HTTP_CLIENT_IP'];
	// $http_x_forwarded_for = $_SERVER['HTTP_X_FORWARDED_FOR'];
	// $remote_addr = $_SERVER['REMOTE_ADDR'];
	// if(!empty($http_client_id)){
	// 	$userIP = $http_client_id;
	// }else if(!empty($http_x_forwarded_for)){
	// 	$userIP = $http_x_forwarded_for;
	// }else{
	// 	$userIP = $remote_addr;
	// }

    $from_browser = $_SERVER['HTTP_USER_AGENT'];
    date_default_timezone_set("Asia/Calcutta");

	$ifIPExist = "SELECT user_ip FROM `visitor` WHERE `user_ip` = '$userIP' and `date` = CURDATE()";
	$ifIPExistResult = mysqli_query($link, $ifIPExist);
	if(mysqli_num_rows($ifIPExistResult) == 0){
		$query = "INSERT INTO `visitor`(`user_ip`, `date`,`time`,`from_browser`) VALUES ('$userIP', current_timestamp(), current_timestamp(),'$from_browser')";
		if($result1 = mysqli_query($link, $query)) {
			$data['status'] = 201;
			$data['message']= 'IP Data Inserted Successfully';
			echo json_encode($data);
			mysqli_close($link);

		}else{  
			$data['status'] = 601;
			$data['message']= 'somthing went wrong';
			echo json_encode($data);
		} 
	}
	else{
		$data['status'] = 601;
		$data['message']= 'IP Already Exist';
		echo json_encode($data);
	}

	

?>