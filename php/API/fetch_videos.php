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

    function RemoveSpecialChar($str){ 
        $res = str_ireplace( array( '\'', '"',',' , ';', '<', '>',':'), ' ', $str);   
        return $res;
        }
	
    $query = mysqli_query($link, "SELECT * FROM `video_info` WHERE 1");
    
    if (mysqli_num_rows($query) !=0 ) {
        while ($row = mysqli_fetch_array($query)) {
            $data['id'] = $row['video_id'];  
            $data['video_uuid'] = $row['video_uuid'];
            $data['name'] = RemoveSpecialChar($row['name']);
            $data['user_type'] = $row['user_type'];
            $data['video_desc'] = RemoveSpecialChar($row['video_desc']);
            $data['thumbnail_ipfs'] = $row['thumbnail_ipfs'];
            $data['video_uid'] = $row['video_uid'];
            $data['module'] = $row['module'];
            $data['module_uuid'] = $row['module_uuid'];
            $data['date'] = $row['from_time'];
            $data['ProductImage']=$data['thumbnail_ipfs'] . '.ipfs.w3s.link';
            $data['link'] = $web.'?course='.$row['video_uuid'].'&module='.$row['module_uuid'];
            $data['moreDetails'] = $VideoDetails . '/' . $row['video_uuid'];
			array_push($myArray,$data);
        }
        echo json_encode($myArray);
		mysqli_close($link);

    }else{  
        $data['status'] = 601;
        echo json_encode($data);
    }

?>