<?php
require_once 'link.php';
if (mysqli_connect_error()) {
    die("<script>console.log('There is a problem with mysql connection')</script>");
}
$data = array();
if (isset($_POST['name'])) {
    date_default_timezone_set("Asia/Calcutta");
    $date_now = date("r");
    $from_ip = $_SERVER['REMOTE_ADDR'];
    $from_browser = $_SERVER['HTTP_USER_AGENT'];
    $VideoDetails = '/videodetails';
    function guidv4($data)
    {
        assert(strlen($data) == 16);

        $data[6] = chr(ord($data[6]) && 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) && 0x3f | 0x80); // set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    $clean_str_name = trim(preg_replace('/\s\s+/', ' ',str_replace("\n", " ", $_POST['name'])));
	$clean_str_desc = trim(preg_replace('/\s\s+/', ' ',str_replace("\n", " ", $_POST['video_desc'])));

    $video_uuid = guidv4(openssl_random_pseudo_bytes(16));
    $name = mysqli_real_escape_string($con, $clean_str_name);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $video_desc = mysqli_real_escape_string($con, $clean_str_desc);
    $thumbnail_ipfs = mysqli_real_escape_string($con, $_POST['thumbnail_ipfs']);
    $video_id = mysqli_real_escape_string($con, $_POST['video_ipfs']);
    $user_address = mysqli_real_escape_string($con, $_POST['user_address']);
    $user_type = mysqli_real_escape_string($con, $_POST['user_type']);
    $moreDetails = $VideoDetails . '/' . $video_uuid;
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


    // croud funding data start
    $is_crowdfunded = strip_tags($_POST['is_crowdfunding']);
    if ($is_crowdfunded === 'true') {
        $project_address = strip_tags($_POST['project_address']);
        $project_creator = strip_tags($_POST['project_creator']);
        $minimum_pay = strip_tags($_POST['minimum_pay']);
        $target_amount = strip_tags($_POST['target_amount']);
        $project_uri_link = strip_tags($_POST['project_uri_link']);
        $amount_in = strip_tags($_POST['amount_in']);
    } else {
        $project_address = '';
        $project_creator = '';
        $minimum_pay = '';
        $target_amount = '';
        $project_uri_link = '';
        $amount_in = '';
    }
    // croud funding data end

    $query = "INSERT INTO `video_info`(`video_uuid`, `user_address`,`user_type`, `name`, `video_desc`, `thumbnail_ipfs`, `video_uid`,`module_uuid`,`module`,`more_details`, `from_time`, `from_browser`, `from_ip`,`is_croudfunded`, `project_address`, `project_creator`, `minimum_pay`, `target_amount`, `amount_in`, `project_uri_link`) VALUES ('$video_uuid','$user_address', '$user_type' ,'$name','$video_desc','$thumbnail_ipfs','$video_id','$category','$categoryName','$moreDetails', '$date_now','$from_browser','$from_ip','$is_crowdfunded','$project_address','$project_creator','$minimum_pay','$target_amount', '$amount_in', '$project_uri_link')";

    if (mysqli_query($con, $query)) {
        $data['status'] = 201;
        $data['success'] = "video uploaded successfully";
        echo json_encode($data);
    } else {
        $data['status'] = 301;
        $data['error'] = 'Error';
        echo json_encode($data);
    }
} else {
    $data['status'] = 404;
    $data['error'] = 'somthing went wrong';
    echo json_encode($data);
}
