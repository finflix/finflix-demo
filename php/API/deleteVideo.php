<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if(!empty($_POST['id'])){
	// $link= new mysqli("localhost","finflix","finflix","finflix");
	$link= new mysqli("localhost","finflix","finflix","finflix");;
    $client = 'https://';
    $web = 'https://finflix.finstreet.in/videoPlayer.php'; 
    $VideoDetails = '/videodetails';
	if($link->connect_error){
		die("connection Failed" .$link->connect_error);
	}
    $video_uuid = mysqli_real_escape_string($link, $_POST['id']);
    $query = "DELETE FROM `video_info` WHERE `video_info`.`video_uuid` = '$video_uuid'";
    $result = mysqli_query($link, $query);
    if($result){
        $data['status'] = 201;
        $data['message']= 'Video Deleted Successfully';
        echo json_encode($data);
    }
    else{
        $data['status'] = 601;
        $data['message']= 'somthing went wrong';
        echo json_encode($data);
    }
}
else{
    $data['status'] = 601;
    $data['message']= 'somthing went wrong';
    echo json_encode($data);
}
?>