<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	// $link= new mysqli("localhost","finflix","finflix","finflix");
	$link= new mysqli("localhost","finflix","finflix","finflix");;
    $client = 'https://';
    $web = 'https://finflix.finstreet.in/videoPlayer.php'; 
    $VideoDetails = '/videodetails';
	if($link->connect_error){
		die("connection Failed" .$link->connect_error);
	}
	$data = array();
	$myArray = array();
	
    $date_query =  mysqli_query($link, "SELECT DISTINCT `date` FROM `visitor` ORDER BY `date` DESC;");
    $length = mysqli_num_rows($date_query);
    if($length != 0){
        $count = 0;
        while($row1 = mysqli_fetch_assoc($date_query)){
            if($count < 7 && $count < $length){
                $date= $row1['date'];
                $query = mysqli_query($link, "SELECT COUNT(*) FROM `visitor` WHERE `date` = '$date'");
                $row = mysqli_fetch_array($query);
                $data['date'] = $date;
                $data['count'] = $row[0];
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
