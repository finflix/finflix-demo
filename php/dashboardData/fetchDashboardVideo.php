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

    $query = "SELECT * FROM `video_info` WHERE `user_address` = '$user_address' order by `video_views` desc limit 7";
    $like_result = mysqli_query($con, $query);
    if (mysqli_num_rows($like_result) != 0) {
        while ($row = mysqli_fetch_array($like_result)) {
            ?>
            <li class="col-sm-6 col-lg-4 col-xl-3 iq-rated-box">
                <div class="iq-card mb-0">
                    <div class="iq-card-body p-0">
                        <div class="iq-thumb">
                            <a href="javascript:void(0)">
                                <img src="<?= $row['thumbnail_ipfs'] ?>" class="img-fluid w-100 img-border-radius" alt="">
                            </a>
                        </div>
                        <div class="iq-feature-list">
                            <h6 class="font-weight-600 mb-0 text-truncate"><?= $row['name'] ?></h6>
                            <p class="mb-0 mt-2"><?= $row['module'] ?></p>
                            <div class="d-flex align-items-center my-2 iq-ltr-direction">
                                <p class="mb-0 mr-2"><i class="lar la-eye mr-1"></i> <?= number_format_short($row['video_views']) ?></p>
                                <p class="mb-0 "><i class="las la-thumbs-up ml-2"></i> <?= number_format_short($row['video_like']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        <?php
        }
    } else {
        $data['status'] = 601;
        echo json_encode($data);
    }
} else {
    $data['status'] = 404;
    echo json_encode($data);
}
?>