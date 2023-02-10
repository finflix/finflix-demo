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
	
    $query = mysqli_query($link, "SELECT * FROM `donate_eth` WHERE 1");
    
    if (mysqli_num_rows($query) !=0 ) {
        while ($row = mysqli_fetch_array($query)) {
            $data['donate_uid'] = $row['donate_uid'];  
            $data['donate_chain_network'] = $row['donate_chain_network'];
            $data['txn_network_url'] = $row['txn_network_url'];
            $data['user_address_url'] = $row['user_address_url'];
            $data['current_coin_symble'] = $row['current_coin_symble'];
            $data['video_id'] = $row['video_id'];
            $data['from_user_address'] = $row['from_user_address'];
            $data['to_user_address'] = $row['to_user_address'];
            $data['eth_price'] = $row['eth_price'].' '.$data['current_coin_symble'];
            $data['transation_hash'] = $row['transation_hash'];
            $timestamp = strtotime($row['from_time']); 
            $data['date'] = date('d-M-Y', $timestamp);
            $data['txn_link'] = $data['txn_network_url'].$row['transation_hash'];
			array_push($myArray,$data);
        }
        echo json_encode($myArray);
		mysqli_close($link);

    }else{  
        $data['status'] = 601;
        echo json_encode($data);
    }
?>