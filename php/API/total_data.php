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
    $total_video = mysqli_query($link, "SELECT COUNT(*) FROM `video_info`");
    $total_video = mysqli_fetch_array($total_video);
    $total_video = $total_video[0];
    $total_visitor = mysqli_query($link, "SELECT COUNT(*) FROM `visitor`");
    $total_visitor = mysqli_fetch_array($total_visitor);
    $total_visitor = $total_visitor[0];
    $total_user = mysqli_query($link, "SELECT COUNT(*) FROM `metamask_login`");
    $total_user = mysqli_fetch_array($total_user);
    $total_user = $total_user[0];
    $total_donation = mysqli_query($link, "SELECT COUNT(*) FROM `donate_eth`");
    $total_donation = mysqli_fetch_array($total_donation);
    $total_donation = $total_donation[0];
    $data['total_video'] = $total_video;
    $data['total_visitor'] = $total_visitor;
    $data['total_user'] = $total_user;
    $data['total_donation'] = $total_donation;
    array_push($myArray,$data);
    echo json_encode($myArray);
    mysqli_close($link);
?>
