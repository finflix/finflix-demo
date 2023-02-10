<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
if(!empty($_POST['name']) && !empty($_POST['video_desc']) && !empty($_POST['thumbnail_ipfs']) && !empty($_POST['video_uid']) && !empty($_POST['category'])) {
	// $link= new mysqli("localhost","finflix","finflix","finflix");
	$link= new mysqli("localhost","finflix","finflix","finflix");;
	if($link->connect_error){
		die("connection Failed" .$link->connect_error);
	}
	$data = array();  
    $from_ip = $_SERVER['REMOTE_ADDR'];
    $from_browser = $_SERVER['HTTP_USER_AGENT'];
    date_default_timezone_set("Asia/Calcutta");
    $date_now = date('Y-m-d');
	function guidv4($data)
    {
        assert(strlen($data) == 16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    $video_uuid = mysqli_real_escape_string($link, $_POST['video_uuid']);
	$name = mysqli_real_escape_string($link, $_POST['name']);
	$category = mysqli_real_escape_string($link, $_POST['category']);
	$video_desc = mysqli_real_escape_string($link, $_POST['video_desc']);
	$thumbnail_ipfs = mysqli_real_escape_string($link, $_POST['thumbnail_ipfs']);
	$video_id = mysqli_real_escape_string($link, $_POST['video_uid']);
	$user_address = mysqli_real_escape_string($link, $_POST['user_address']);
	$user_type = mysqli_real_escape_string($link, $_POST['user_type']);
	$categoryName = '';
	if($category == '927f0965-6eed-462c-bfa0-79867c9f9448'){
		$categoryName='Explainers';
	}else if($category == 'fd3d24bd-8764-494e-9ade-40911b8e11a1'){
		$categoryName='Tutorials';
	}else if($category == '5dae4ba7-933a-40a9-8866-49ee971ccf87'){
		$categoryName='Review';
	}else if($category == '5822014a-02af-41c4-8564-0ec4ceba8db6'){
		$categoryName='News';
	}else if($category == '0f01d804-648d-42a7-ab11-bdc373f4b7bd'){
		$categoryName='Others';
	}else{
		$categoryName = '';
	}

    $query = "UPDATE `video_info` SET `video_uuid` = '$video_uuid', `user_address` = '$user_address', `user_type` = '$user_type', `name` =  '$name', `video_desc` = '$video_desc', `thumbnail_ipfs` = '$thumbnail_ipfs', `video_uid` = '$video_id', `module_uuid` = '$category', `module` = '$categoryName', `from_time` = '$date_now', `from_browser` = '$from_browser', `from_ip` = '$from_ip' WHERE `video_info`.`video_uuid` = '$video_uuid' and `video_info`.`user_type` = '$user_type'";

	if($result1 = mysqli_query($link, $query)) { 
		$data['status'] = 201;
		$data['message']= 'Data Update Successfully';
		echo json_encode($data);
		mysqli_close($link);

	}else{  
		$data['status'] = 601;
		$data['message']= 'somthing went wrong';
		echo json_encode($data);
	} 
}else{
	$data['status'] = 404;
	$data['message']= 'somthing went wrong';
	echo json_encode($data);
	}
?>
