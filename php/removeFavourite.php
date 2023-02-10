<?php
session_start();
require_once 'link.php';
if(isset($_POST['user_id'])){

    $data = array();  
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $videoId = mysqli_real_escape_string($con, $_POST['videoId']);  
         
    $query = "DELETE FROM `favourite_videos` WHERE (`user_id`='$user_id' AND `video_info_id`='$videoId')";
    
    if(mysqli_query($con, $query)) { 
        $data['status'] = 201;
        echo json_encode($data);

    }else{  
        $data['status'] = 601;
        echo json_encode($data);
    }
}else{
    $data['status'] = 701;
    echo json_encode($data);
}
?>