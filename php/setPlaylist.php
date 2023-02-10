<?php
session_start();
require_once 'link.php';

if(isset($_POST['playlist_id'])){

    $data = array();  
    $from_ip = $_SERVER['REMOTE_ADDR'];
    $from_browser = $_SERVER['HTTP_USER_AGENT'];
    date_default_timezone_set("Asia/Calcutta");
    $date_now = date("r");   
    $playlist_id = mysqli_real_escape_string($con, $_POST['playlist_id']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $published_date = mysqli_real_escape_string($con, $_POST['published_date']);
    $img_standard = mysqli_real_escape_string($con, $_POST['img_standard']);
    $img_maxres = mysqli_real_escape_string($con, $_POST['img_maxres']);    
        $id = 0;
        $result = mysqli_query($con, "SELECT max(`s.no`) FROM `playlist_list`");
        while ($row = mysqli_fetch_array($result)) {
            $id = $row[0];  
        }
        $id = $id + 1;
    
        $query = "INSERT IGNORE INTO `playlist_list` (`s.no`,`playlist_id`, `title`, `published_at`, `img_standard`, `img_max_res`) VALUES ('$id','$playlist_id','$title','$published_date','$img_standard','$img_maxres')";
        
        if($result1 = mysqli_query($con, $query)) { 
            $data['status'] = 201;
            echo json_encode($data);
    
        }else{  
            $data['status'] = 601;
            echo json_encode($data);
        }   
    }
?>