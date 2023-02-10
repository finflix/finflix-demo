<?php
session_start();
require_once '../link.php';

if (isset($_POST['user_address'])) {
    $data = array();
    $arrayData = array();
    $from_ip = $_SERVER['REMOTE_ADDR'];
    $from_browser = $_SERVER['HTTP_USER_AGENT'];
    date_default_timezone_set("Asia/Calcutta");
    $date_now = date("r");
    $user_address = mysqli_real_escape_string($con, $_POST['user_address']);

    function number_format_short($n, $precision = 1)
    {
        if ($n < 900) {
            // 0 - 900
            $n_format = number_format($n, $precision);
            $suffix = '';
        } else if ($n < 900000) {
            // 0.9k-850k
            $n_format = number_format($n / 1000, $precision);
            $suffix = 'K';
        } else if ($n < 900000000) {
            // 0.9m-850m
            $n_format = number_format($n / 1000000, $precision);
            $suffix = 'M';
        } else if ($n < 900000000000) {
            // 0.9b-850b
            $n_format = number_format($n / 1000000000, $precision);
            $suffix = 'B';
        } else {
            // 0.9t+
            $n_format = number_format($n / 1000000000000, $precision);
            $suffix = 'T';
        }
        // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
        // Intentionally does not affect partials, eg "1.50" -> "1.50"
        if ($precision > 0) {
            $dotzero = '.' . str_repeat('0', $precision);
            $n_format = str_replace($dotzero, '', $n_format);
        }
        return $n_format . $suffix;
    }

    $query = "SELECT SUM(`video_views`) as total_views, SUM(`video_like`) as total_likes, SUM(`video_dislike`) as total_dislikes ,count(`video_uuid`) as total_videos FROM `video_info` WHERE `user_address` = '$user_address'";
    $like_result = mysqli_query($con, $query);
    if (mysqli_num_rows($like_result) != 0) {
        while ($row = mysqli_fetch_array($like_result)) {
            $total_views = number_format_short($row['total_views']);
            $total_likes = number_format_short($row['total_likes']);
            $total_dislikes = number_format_short($row['total_dislikes']);
            $data['total_likes'] = $total_likes;
            $data['total_dislikes'] = $total_dislikes;
            $data['total_views'] = $total_views;
            $data['total_videos'] = number_format_short($row['total_videos']);
            $data['pie_likes'] = $row['total_likes'];
            $data['pie_dislikes'] = $row['total_dislikes'];
            $data['pie_views'] = $row['total_views'];
            $data['pie_videos'] = $row['total_videos'];
            $data['status'] = 201;
            echo json_encode($data);
        }
    } else {
        $data['status'] = 601;
        echo json_encode($data);
    }
} else {
    $data['status'] = 404;
    echo json_encode($data);
}
