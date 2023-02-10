<?php
session_start();
require_once 'link.php';

if(isset($_POST['video_id'])){

    $data = array();  
    $from_ip = $_SERVER['REMOTE_ADDR'];
    $from_browser = $_SERVER['HTTP_USER_AGENT'];
    date_default_timezone_set("Asia/Calcutta");
    $date_now = date("r");
    function guidv4($data)
    {
        assert(strlen($data) == 16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    $favourite_video_uuid = guidv4(openssl_random_pseudo_bytes(16));

    $video_id = mysqli_real_escape_string($con, $_POST['video_id']);
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
        
    $result2 = mysqli_query($con, "SELECT * FROM `favourite_videos` WHERE `user_id` = '$user_id' AND `video_info_id` = '$video_id'");
    
    if (mysqli_num_rows($result2) !=0 ) {
        $data['status'] = 501;
        echo json_encode($data);
    }else{
        $id = 0;
        $result = mysqli_query($con, "SELECT max(favourite_video_id) FROM `favourite_videos`");
        while ($row = mysqli_fetch_array($result)) {
            $id = $row[0];  
        }
        $id = $id + 1;    
        $query = "INSERT INTO `favourite_videos`(`favourite_video_id`, `favourite_video_uuid`, `user_id`, `video_info_id`, `from_ip`, `from_browser`, `from_time`) VALUES ('$id','$favourite_video_uuid','$user_id','$video_id','$from_ip','$from_browser','$date_now')";
        
        if($result1 = mysqli_query($con, $query)) { 
            $data['status'] = 201;
            echo json_encode($data);
    
        }else{  
            $data['status'] = 601;
            echo json_encode($data);
        }   
    }
}
?>