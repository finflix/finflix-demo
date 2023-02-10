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
	
    $query = mysqli_query($link, "SELECT * FROM `metamask_login` WHERE 1");
    
    if (mysqli_num_rows($query) !=0 ) {
        while ($row = mysqli_fetch_array($query)) {
            $data['id'] = $row['ID'];  
            $data['address'] = $row['address'];
            $timestamp = strtotime($row['created']); 
            $data['date'] = date('d-M-Y', $timestamp);
			array_push($myArray,$data);
        }
        echo json_encode($myArray);
		mysqli_close($link);

    }else{  
        $data['status'] = 601;
        echo json_encode($data);
    }

?>