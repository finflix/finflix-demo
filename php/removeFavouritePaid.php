<?php
session_start();
require_once 'link.php';
if(isset($_POST['user'])){

    $data = array();  
    $user = mysqli_real_escape_string($con, $_POST['user']);
    $course_id = mysqli_real_escape_string($con, $_POST['course']); 
    $module_id = mysqli_real_escape_string($con, $_POST['module']);
    $chapter_part = mysqli_real_escape_string($con, $_POST['chapter']);

         
    $query = "DELETE FROM `favourite_videos` WHERE (`email_id`='$user' AND ((`course_id` = '$course_id' AND `module_id` = $module_id ) AND `chapter_part` = $chapter_part))";
    
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