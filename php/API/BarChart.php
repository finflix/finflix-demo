<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	// // $link= new mysqli("localhost","finflix","finflix","finflix");
	$link= new mysqli("localhost","finflix","finflix","finflix");;
    $client = 'https://';
    $web = 'https://finflix.finstreet.in/videoPlayer.php'; 
    $VideoDetails = '/videodetails';
	if($link->connect_error){
		die("connection Failed" . $link->connect_error);
	}
	$data = array();
	$myArray = array();
	
    $date_query =  mysqli_query($link, "SELECT DISTINCT from_time FROM `donate_eth` ORDER BY `from_time` DESC;");
    $length = mysqli_num_rows($date_query);
    if($length != 0){
        $count = 0;
        while($row1 = mysqli_fetch_assoc($date_query)){
            if($count < 7 && $count < $length){
                $date= $row1['from_time'];
                $query = mysqli_query($link, "SELECT SUM(eth_price) FROM `donate_eth` WHERE current_coin_symble = 'MATIC' and from_time='$date';");
                $row = mysqli_fetch_array($query);
                $query1 = mysqli_query($link, "SELECT SUM(eth_price) FROM `donate_eth` WHERE current_coin_symble = 'ETH' and from_time='$date';");
                $row1 = mysqli_fetch_array($query1);
                $data['date'] = $date;
                $data['count_eth'] = number_format($row1[0], 6);
                $data['count_matic'] = $row[0] == null ? 0 : number_format($row[0], 6);
                $count++;
                array_push($myArray,$data);
            }
            else{
                break;
            }
        }
        echo json_encode($myArray);
        mysqli_close($link);
    }
    else{
        $data['status'] = 601;
        echo json_encode($data);
    }
