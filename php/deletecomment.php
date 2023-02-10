<?php
require_once 'link.php';
if (mysqli_connect_error()) {
    die("<script>console.log('There is a problem with mysql connection')</script>");
}
if (isset($_POST['comment_uid'])) {
    
    $data = array();
    
    $comment_uid = mysqli_real_escape_string($con, $_POST['comment_uid']);

    $query = "DELETE FROM `post_comments` WHERE `comment_uid` = '$comment_uid' ";

    if (mysqli_query($con, $query) ) {
        $data['status'] = 201;
        $data['success'] = "comment deleted";
        echo json_encode($data);
    } else {
        $data['status'] = 301;
        $data['error'] = 'Error';
        echo json_encode($data);
    }
}



?>