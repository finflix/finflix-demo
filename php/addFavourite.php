<?php
session_start();
require_once 'link.php';

if(isset($_POST['videoId'])){

    $data = array();  
    $from_ip = $_SERVER['REMOTE_ADDR'];
    $from_browser = $_SERVER['HTTP_USER_AGENT'];
    date_default_timezone_set("Asia/Calcutta");
    // $date_now = date("r");
    // $date_now = date('Y-m-d H:i:s'); 
     $date_now = date('D, d M Y h:i:sa');
    $email=$_SESSION['user'];
    $videoId = mysqli_real_escape_string($con, $_POST['videoId']);
    $videoTitle = mysqli_real_escape_string($con, $_POST['videoTitle']);
    $videoDescription = mysqli_real_escape_string($con, $_POST['videoDescription']);
    $videoPublishDate = mysqli_real_escape_string($con, $_POST['videoPublishDate']);
    $videoThumbnail = mysqli_real_escape_string($con, $_POST['videoThumbnail']);
    $p_id = mysqli_real_escape_string($con, $_POST['p_id']);     
    $result2 = mysqli_query($con, "SELECT * FROM `favourite_videos` WHERE `email_id` = '$email' AND `data-key` = '$videoId' ");
    
    if (mysqli_num_rows($result2) !=0 ) {
        $data['status'] = 501;
        echo json_encode($data);
    }else{
        $id = 0;
        $result = mysqli_query($con, "SELECT max(favourite_videos_id) FROM `favourite_videos`");
        while ($row = mysqli_fetch_array($result)) {
            $id = $row[0];  
        }
        $id = $id + 1;
    
        $query = "INSERT INTO `favourite_videos`(`favourite_videos_id`, `email_id`, `data-key`, `title`, `description`, `published_at`, `thumbnail`,`playlist_id`, `time`, `from_ip`, `from_browser`) VALUES ('$id','$email','$videoId','$videoTitle','$videoDescription','$videoPublishDate','$videoThumbnail','$p_id','$date_now','$from_ip','$from_browser')";
        
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