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
    $video_uuid = mysqli_real_escape_string($link, $_POST['id']);
    $total_eth_donation_on_video = mysqli_query($link, "SELECT SUM(eth_price) FROM `donate_eth` WHERE current_coin_symble = 'ETH' AND video_id ='$video_uuid';");
    $total_matic_donation_on_video = mysqli_query($link, "SELECT SUM(eth_price) FROM `donate_eth` WHERE current_coin_symble = 'MATIC' AND video_id ='$video_uuid';");
    // Eth donation on video
    $total_eth_donation_on_video = mysqli_fetch_array($total_eth_donation_on_video);
    $total_eth_donation_on_video = $total_eth_donation_on_video[0];
    $data['total_eth_donation_on_video'] = number_format($total_eth_donation_on_video, 5);

    // Matic donation on video
    $total_matic_donation_on_video = mysqli_fetch_array($total_matic_donation_on_video);
    $total_matic_donation_on_video = $total_matic_donation_on_video[0];
    $data['total_matic_donation_on_video'] = number_format($total_matic_donation_on_video, 5);
    array_push($myArray,$data);
    echo json_encode($myArray);
    mysqli_close($link);
?>
