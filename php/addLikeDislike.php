<?php
session_start();
require_once 'link.php';

if (isset($_POST['video_uid'])) {

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

    $like_video_uuid = guidv4(openssl_random_pseudo_bytes(16));

    $video_uid = mysqli_real_escape_string($con, $_POST['video_uid']);
    $user_uid = mysqli_real_escape_string($con, $_POST['user_uid']);
    $video_status = mysqli_real_escape_string($con, $_POST['like_status']);

    $result2 = mysqli_query($con, "SELECT * FROM `video_like_dislike_info` WHERE `video_id` = '$video_uid' AND `user_id` = '$user_uid'");
    if (mysqli_num_rows($result2) !== 0) {
        if ($video_status === 'true') {
            $like_result = mysqli_query($con, "SELECT * FROM `video_info` WHERE `video_uuid` = '$video_uid'");
            while ($row = mysqli_fetch_array($like_result)) {
                $id = $row['video_id'];
                $video_like = $row['video_like'];
                $video_dislike = $row['video_dislike'];
                $video_current_status = '';
                while ($row_new = mysqli_fetch_array($result2)) {
                    $video_current_status = $row_new['video_status'];
                }
                if ($video_current_status == 'dislike') {
                    $video_dislike = $video_dislike - 1;
                    $video_like = $video_like + 1;
                    $video_current_status = 'like';
                } else {
                    $video_like = $video_like - 1;
                    $delete_like = mysqli_query($con, "DELETE from `video_like_dislike_info` WHERE `video_id` = '$video_uid' AND `user_id` = '$user_uid'");
                    if (mysqli_num_rows($result2) !== 0) {
                        $data['status'] = 201;
                    }
                }

                $query = "UPDATE `video_info` SET `video_like` = '$video_like',`video_dislike` = '$video_dislike' WHERE `video_uuid` = '$video_uid'";
                if ($result = mysqli_query($con, $query)) {
                    $data['status'] = 201;
                    $data['success'] = 'like video info successfully';
                } else {
                    $data['status'] = 601;
                }

                $query_new = "UPDATE `video_like_dislike_info` SET `video_status` = '$video_current_status' WHERE `video_id` = '$video_uid'";
                if ($result = mysqli_query($con, $query_new)) {
                    $data['status2'] = 401;
                    $data['success2'] = 'like status update successfully';
                } else {
                    $data['status'] = 601;
                }
            }
        } else {
            $like_result = mysqli_query($con, "SELECT * FROM `video_info` WHERE `video_uuid` = '$video_uid'");
            while ($row = mysqli_fetch_array($like_result)) {
                $id = $row['video_id'];
                $video_like = $row['video_like'];
                $video_dislike = $row['video_dislike'];
                $video_current_status = '';
                while ($row_new = mysqli_fetch_array($result2)) {
                    $video_current_status = $row_new['video_status'];
                }

                if ($video_current_status == 'like') {
                    $video_like = $video_like - 1;
                    $video_dislike = $video_dislike + 1;
                    $video_current_status = 'dislike';
                    echo $video_current_status;
                } else {
                    $video_dislike = $video_dislike - 1;
                    $delete_like = mysqli_query($con, "DELETE from `video_like_dislike_info` WHERE `video_id` = '$video_uid' AND `user_id` = '$user_uid'");
                    if (mysqli_num_rows($result2) !== 0) {
                        $data['status'] = 201;
                    }
                }


                $query = "UPDATE `video_info` SET `video_like` = '$video_like',`video_dislike` = '$video_dislike' WHERE `video_uuid` = '$video_uid'";
                if ($result = mysqli_query($con, $query)) {
                    $data['status'] = 201;
                    $data['success'] = 'dislike video info successfully';
                } else {
                    $data['status'] = 601;
                }

                $query_new = "UPDATE `video_like_dislike_info` SET `video_status` = '$video_current_status' WHERE `video_id` = '$video_uid'";
                if ($result = mysqli_query($con, $query_new)) {
                    $data['status2'] = 401;
                    $data['success2'] = 'like status update successfully';
                } else {
                    $data['status'] = 601;
                }
            }
        }
    } else {
        if ($video_status === 'true') {
            $like_result = mysqli_query($con, "SELECT * FROM `video_info` WHERE `video_uuid` = '$video_uid'");
            while ($row = mysqli_fetch_array($like_result)) {
                $id = $row['video_id'];
                $video_like = $row['video_like'];
                $video_dislike = $row['video_dislike'];
                $video_current_status = 'like';
                while ($row_new = mysqli_fetch_array($result2)) {
                    $video_current_status = $row_new['video_status'];
                }
                if ($video_current_status === 'dislike') {
                    $video_dislike = $video_dislike - 1;
                    $video_like = $video_like + 1;
                    $video_current_status = 'like';
                } else {
                    $video_like = $video_like + 1;
                    $query = "INSERT INTO `video_like_dislike_info`(`like_uuid`, `video_id`, `user_id`, `from_browser`, `from_ip`, `from_time`, `video_status`) VALUES        ('$like_video_uuid','$video_uid','$user_uid','$from_browser','$from_ip','$date_now','like')";
                    if ($result1 = mysqli_query($con, $query)) {
                        $data['status'] = 201;
                    } else {
                        $data['status'] = 601;
                    }
                }


                $query = "UPDATE `video_info` SET `video_like` = '$video_like',`video_dislike` = '$video_dislike' WHERE `video_uuid` = '$video_uid'";
                if ($result = mysqli_query($con, $query)) {
                    $data['success'] = 'fresh video info update successfully';
                    $data['status'] = 201;
                } else {
                    $data['status'] = 601;
                }

                $query_new = "UPDATE `video_like_dislike_info` SET `video_status` = '$video_current_status' WHERE `video_id` = '$video_uid'";
                if ($result = mysqli_query($con, $query_new)) {
                    $data['success2'] = 'fresh like status update successfully';
                    $data['status2'] = 401;
                } else {
                    $data['status'] = 601;
                }
            }
        } else {
            $like_result = mysqli_query($con, "SELECT * FROM `video_info` WHERE `video_uuid` = '$video_uid'");
            while ($row = mysqli_fetch_array($like_result)) {
                $id = $row['video_id'];
                $video_like = $row['video_like'];
                $video_dislike = $row['video_dislike'];
                $video_current_status = 'dislike';
                while ($row_new = mysqli_fetch_array($result2)) {
                    $video_current_status = $row_new['video_status'];
                }
                if ($video_current_status === 'like') {
                    $video_like = $video_like - 1;
                    $video_dislike = $video_dislike + 1;
                    $video_current_status = 'dislike';
                } else {
                    $video_dislike = $video_dislike + 1;
                    $query = "INSERT INTO `video_like_dislike_info`(`like_uuid`, `video_id`, `user_id`, `from_browser`, `from_ip`, `from_time`, `video_status`) VALUES('$like_video_uuid','$video_uid','$user_uid','$from_browser','$from_ip','$date_now','dislike')";
                    if ($result1 = mysqli_query($con, $query)) {
                        $data['status'] = 201;
                    } else {
                        $data['status'] = 601;
                    }
                }


                $query = "UPDATE `video_info` SET `video_like` = '$video_like',`video_dislike` = '$video_dislike' WHERE `video_uuid` = '$video_uid'";
                if ($result = mysqli_query($con, $query)) {
                    $data['success'] = 'fresh video info update successfully';
                    $data['status'] = 201;
                } else {
                    $data['status'] = 601;
                }

                $query_new = "UPDATE `video_like_dislike_info` SET `video_status` = '$video_current_status' WHERE `video_id` = '$video_uid'";
                if ($result = mysqli_query($con, $query_new)) {
                    $data['success2'] = 'fresh like status update successfully';
                    $data['status2'] = 401;
                } else {
                    $data['status'] = 601;
                }
            }
        }
    }
    echo json_encode($data);
}
