<?php
session_start();
require_once 'link.php';

if (isset($_POST['video_uid'])) {

    $data = array();
    $from_ip = $_SERVER['REMOTE_ADDR'];
    $from_browser = $_SERVER['HTTP_USER_AGENT'];
    date_default_timezone_set("Asia/Calcutta");
    $date_now = date("r");
    $video_uid = mysqli_real_escape_string($con, $_POST['video_uid']);

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

    $like_result = mysqli_query($con, "SELECT * FROM `video_info` WHERE `video_uuid` = '$video_uid'");
    if (mysqli_num_rows($like_result) != 0) {
        while ($row = mysqli_fetch_array($like_result)) {
            $video_like = $row['video_like'];
            $video_dislike = $row['video_dislike'];
            $video_views = $row['video_views'];
            $data['like'] = number_format_short($video_like);
            $data['dislike'] = number_format_short($video_dislike);
            $data['views'] = number_format_short($video_views);
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
