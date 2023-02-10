<?php
require "link.php";

if (mysqli_connect_error()) {
    die("<script>console.log('There is a problem with mysql connection')</script>");
}
if (isset($_POST['user_uid_comment'])) {
    

    $data = array();
    date_default_timezone_set("Asia/Calcutta");
    $date_now = date("r");
    $from_ip = $_SERVER['REMOTE_ADDR'];
    $from_browser = $_SERVER['HTTP_USER_AGENT'];
    $video_uid_comment = mysqli_real_escape_string($con, $_POST['video_uid_comment']);
    $user_uid_comment = mysqli_real_escape_string($con, $_POST['user_uid_comment']);
    $editorComment = $_POST['editorComment'];
    function guidv4($data)
    {
        assert(strlen($data) == 16);

        $data[6] = chr(ord($data[6]) && 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) && 0x3f | 0x80); // set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
    $comment_uid = guidv4(openssl_random_pseudo_bytes(16));
  
               /*  $tag_name = mysqli_real_escape_string($con, $_POST['tag_name']);
                $query2 = "SELECT * from tags where tag_name ='" . $tag_name . "'";
                $result2 = mysqli_query($con, $query2);
                $row = mysqli_fetch_array($result2); 
                if(mysqli_num_rows($result2) > 0){
                    $data['status'] = 501;
                    $data['success'] = "Tag Already exist";
                    echo json_encode($data);
                }
                else{   */       
            
                $query = "INSERT INTO `post_comments`(`comment_uid`,`user_uid`, `video_uuid`,`comment`,`status`,`from_ip`,`from_browser`,`created_at`) VALUES ('$comment_uid','$user_uid_comment','$video_uid_comment','$editorComment','active','$from_ip','$from_browser','$date_now')";

                  
                if (mysqli_query($con, $query) ) {

                    $data['status'] = 201;
                    $data['success'] = "save";
                    echo json_encode($data);
                } else {
                    $data['status'] = 301;
                    $data['error'] = 'Error';
                    echo json_encode($data);
                }
         
            /* } */
        
     
  
 
   

    
   
       


}