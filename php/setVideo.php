<?php
session_start();
require_once 'link.php';

if(isset($_POST['video_id'])){

    $data = array();  
    $from_ip = $_SERVER['REMOTE_ADDR'];
    $from_browser = $_SERVER['HTTP_USER_AGENT'];
    date_default_timezone_set("Asia/Calcutta");
    $date_now = date("r");   
    $video_id = mysqli_real_escape_string($con, $_POST['video_id']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $desc = mysqli_real_escape_string($con, $_POST['desc']);
    $published_date = mysqli_real_escape_string($con, $_POST['published_date']);
    $playlist_id = mysqli_real_escape_string($con, $_POST['playlist_id']);
    $img_standard = mysqli_real_escape_string($con, $_POST['img_standard']);
    $img_maxres = mysqli_real_escape_string($con, $_POST['img_maxres']);    
        $id = 0;
        $result = mysqli_query($con, "SELECT max(`s.no`) FROM `video_list`");
        while ($row = mysqli_fetch_array($result)) {
            $id = $row[0];  
        }
        $id = $id + 1;
    
        $query = "INSERT INTO `video_list`(`s.no`, `video_id`, `playlist`, `title`, `description`, `img_standard`, `img_maxres`, `published_at`) VALUES ('$id','$video_id','$playlist_id','$title','$desc','$img_standard','$img_maxres','$published_date')";
        echo $query;
        if($result1 = mysqli_query($con, $query)) { 
            $data['status'] = 201;
            echo json_encode($data);
    
        }else{  
            $data['status'] = 601;
            echo json_encode($data);
        }   
    }
?>