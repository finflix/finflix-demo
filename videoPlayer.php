<?php
session_start();
include 'php/link.php';
$user_address = '';
$video_uuid_new = '';
if (isset($_SESSION['userAddress'])) {
    $user_address = $_SESSION['userAddress'];
} else {
    $user_address = '';
}

$showYoutube = 'none';
$showPaid = 'none';
$p_id = '';
$subtitles = '';
$src180 = '';
$src270 = '';
$src360 = '';
$src540 = '';
$src720 = '';
$course = '';
$event_name = '';
$video_url = '';
$module_name = '';
$user_type = '';
$user_row_address = '';
$video_like = '';
$video_dislike = '';
$video_views = '';
$user_address_new = '';
$post_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (isset($_GET['course']) && isset($_GET['module'])) {
    $course = $_GET['course'];
    $module = $_GET['module'];

    $result2 = mysqli_query(
        $con,
        "SELECT * FROM `video_info` WHERE `video_uuid` = '$course' AND `module_uuid` = '$module'"
    );
    if (mysqli_num_rows($result2) > 0) {
        while ($row = mysqli_fetch_assoc($result2)) {
            $showYoutube = 'none';
            $showPaid = 'block';
            $course_ID = $row['video_id'];
            $subtitles = '';
            $title = $row['name'];
            $date = $row['from_time'];
            $date = substr($date, 0, -15);
            $video_uuid_new = $row['video_uuid'];
            $desc = $row['video_desc'];
            $module_name = $row['module'];
            $thumbnail2 = $row['thumbnail_ipfs'];
            $video_url = $row['video_uid'];
            $user_type = $row['user_type'];
            $user_row_address = $row['user_address'];
            $video_like = number_format_short($row['video_like']);
            $video_dislike = number_format_short($row['video_dislike']);
            $video_views = number_format_short($row['video_views']);
            $user_address_new = $row['user_address'];
            $is_croudfunded = $row['is_croudfunded'];;
            $crowd_min_amount = $row['minimum_pay'];
            $project_address = $row['project_address'];
            $project_creator = $row['project_creator'];
            $minimum_pay = $row['minimum_pay'];
            $target_amount = $row['target_amount'];
            $amount_in = $row['amount_in'];
            $project_uri_link = $row['project_uri_link'];
        }
    } else {
        header('Location: courses');
    }
} else {
    header('Location: courses');
}

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
$user_like_status = false;
$video_current_status = '';
$is_user_exits = mysqli_query($con, "SELECT * FROM `video_like_dislike_info` WHERE `video_id` = '$video_uuid_new' AND `user_id` = '$user_address_new'");

if (mysqli_num_rows($is_user_exits) != 0) {
    $user_like_status = true;
    while ($row = mysqli_fetch_assoc($is_user_exits)) {
        $video_current_status = $row['video_status'];
    }
} else {
    $user_like_status = false;
}
// croud funding data get start 
$crowd_query_1 = "SELECT `video_uuid`, sum(pay_amount) as total_pay,`project_address` FROM `crowd_fund` WHERE `video_uuid`='$video_uuid_new' GROUP BY `video_uuid`,`project_address` ORDER by total_pay DESC;";

$crowd_run_1 = mysqli_query($con, $crowd_query_1);
if (mysqli_num_rows($crowd_run_1) > 0) {
    $crowd_query_result = mysqli_fetch_assoc($crowd_run_1);
    $crowd_query_video_uuid = $crowd_query_result['video_uuid'];
    $crowd_query_total_pay = $crowd_query_result['total_pay'];
    $crowd_query_project_address = $crowd_query_result['project_address'];
} else {
    $crowd_query_video_uuid = '';
    $crowd_query_total_pay = 0;
    $crowd_query_project_address = '';
}
$total_contributor = '';
$user_uid_new = '';
$get_view_query_2 = "SELECT count(distinct user_address) as total_contributor FROM crowd_fund WHERE `video_uuid`='$video_uuid_new';";
$result_view_2 = mysqli_query($con, $get_view_query_2);
if (mysqli_num_rows($result_view_2) > 0) {
    while ($row_view_2 = mysqli_fetch_array($result_view_2)) {
        $total_contributor = $row_view_2['total_contributor'];
    }
}
$total_view_in_sec = '';
$get_view_query_3 = "SELECT * FROM `user_login` WHERE `metamask_address`='$user_address';";
$result_view_3 = mysqli_query($con, $get_view_query_3);
if (mysqli_num_rows($result_view_3) > 0) {
    while ($row_view_3 = mysqli_fetch_array($result_view_3)) {
        $user_uid_new = $row_view_3['user_uid'];
        $total_view_in_sec = $row_view_3['total_time_spend_sec'];
    }
}

$user_uid = $user_uid_new;
$user_uid2 = $user_uid;
// croud funding data get end

$total_time_to_reward = mysqli_query($con, "SELECT * FROM `site_extra_setting` WHERE 1");
$total_time_to_reward_in_hr = 0;
if (mysqli_num_rows($total_time_to_reward) != 0) {
    $user_like_status = true;
    while ($row = mysqli_fetch_assoc($total_time_to_reward)) {
        $total_time_to_reward_in_hr = $row['total_time_to_reward_in_hr'];
    }
} else {
    $total_time_to_reward_in_hr = 0;
}

?>
<!doctype html>
<html lang="en-US">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Finflix | Crypto Education Platform</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- required meta tags essential for seo and link sharing -->

    <!-- Enter a proper description for the page in the meta description tag -->
    <meta name="description" content="India's 1st Crypto Education Platform ,Watch anywhere. Cancel anytime.">

    <!-- Enter a keywords for the page in tag -->
    <meta name="Keywords" content="Finflix Crypto Education Platform,Watch anywhere. Cancel anytime,Crypto Education">

    <!-- Enter Page title -->
    <meta property="og:title" content="Finflix | Crypto Education Platform" />

    <!-- Enter Page URL -->
    <meta property="og:url" content="https://finflix.finstreet.in/" />

    <!-- Enter page description -->
    <meta property="og:description" content="India's 1st Crypto Education Platform ,Watch anywhere. Cancel anytime.">

    <!-- Enter Logo image URL for example : http://cryptonite.Finflix.in/images/cryptonitepost.png -->
    <meta property="og:image" itemprop="image" content="https://finflix.finstreet.in/<?php echo $img_link2; ?>fin-logo.jpg" />
    <meta property="og:image:secure_url" itemprop="image" content="https://finflix.finstreet.in/<?php echo $img_link2; ?>fin-logo.jpg" />
    <meta property="og:image:width" content="269">
    <meta property="og:image:height" content="67">
    <meta property="og:type" content="website" />

    <!-- Favicon location for example :  images/cropped-Fin-270x270.jpg -->
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />

    <!-- Enter Page Specific CSS here. Please make sure all the CSS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Typography CSS -->
    <link rel="stylesheet" href="css/typography.css">
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Responsive -->
    <link rel="stylesheet" href="css/responsive.css" />
    <link href="https://vjs.zencdn.net/7.7.5/video-js.css" rel="stylesheet" />
    <link href="libs/videojs-resolution-switcher.css" rel="stylesheet">
    <link rel='stylesheet' href='css/success.css'>
    <link rel="stylesheet" href="css/extra-setting.css">
    <link href="assets/toastr/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/newLoader.css">
    <link rel="stylesheet" href="assets/css/croudFundingUI.css">
    <link rel="stylesheet" href="assets/css/slider_panel.css">
    <link rel="stylesheet" href="assets/css/circle_progress_bar.css">
    <link rel="stylesheet" href="Vendor/css/socialSharing.css">
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-53J6JBV');
    </script>
    <!-- End Google Tag Manager -->
</head>
<style>
    .setvideoSize,
    .setvideoSize2 {
        height: 100vh !important;
    }

    .vjs-control-bar {
        font-size: 1rem;
    }

    .back_button {
        z-index: 888;
        position: absolute;
        padding: 1.5rem;
    }

    .back_button i {
        font-size: 3.2rem;
        color: #fff;
    }

    @media screen and (min-width: 0) and (max-width: 480px) {
        .back_button i {
            font-size: 2.2rem;
        }

        .vjs-control-bar {
            font-size: inherit;
        }

        .vjs-icon-next-item:before {
            font-size: 1.2rem !important;
        }
    }

    @media screen and (max-width: 480px) {

        .setvideoSize,
        .setvideoSize2 {
            height: 70vh !important;
        }
    }

    @media screen and (min-width: 480px) and (max-width: 991px) {
        .back_button i {
            font-size: 2.5rem;
        }

        .vjs-control-bar {
            font-size: 0.7rem;
        }

        .vjs-resolution-button {
            font-size: 1rem;
        }

        .vjs-icon-next-item:before {
            font-size: 1.5rem !important;
        }

        .setvideoSize,
        .setvideoSize2 {
            height: 80vh !important;
        }
    }

    @media screen and (min-width: 991px) and (max-width: 1200px) {
        .back_button i {
            font-size: 2.8rem;
        }

        .vjs-resolution-button {
            font-size: 1.2rem;
        }

        .vjs-control-bar {
            font-size: 0.8rem;
        }

        .vjs-resolution-button {
            font-size: 1.5rem !important;
        }

        .vjs-icon-next-item:before {
            font-size: 1.6rem !important;
        }

        .setvideoSize,
        .setvideoSize2 {
            height: 90vh !important;
        }
    }

    .vjs-icon-next-item:before {
        font-size: 1.8rem;
    }

    .gap-2 {
        gap: 0.9rem !important;
    }

    .btn-light:hover {
        color: #fff !important;
        background: #103375bd !important;
        border-color: #103375bd;
    }

    .form-control {
        border-color: #424241 !important;
    }

    .modal-header {
        border-bottom: 1px solid #424241 !important;
    }


    .modal.right_modal {
        position: fixed;
        z-index: 99999;
    }

    .modal.right_modal .modal-dialog {
        position: fixed;
        margin: auto;
        width: 32%;
        height: 100%;
        -webkit-transform: translate3d(0%, 0, 0);
        -ms-transform: translate3d(0%, 0, 0);
        -o-transform: translate3d(0%, 0, 0);
        transform: translate3d(0%, 0, 0);
    }

    .modal-dialog {
        /* max-width: 100%; */
        margin: 1.75rem auto;
        border-radius: 15px 0 0 15px;
    }

    .modal.right_modal .modal-content {
        /*overflow-y: auto;
    overflow-x: hidden;*/
        height: 100vh !important;
    }

    .modal.right_modal .modal-body {
        padding: 15px 15px 30px;
    }

    .modal-backdrop {
        display: none;
    }

    /*Right*/
    .modal.right_modal.fade .modal-dialog {
        right: -50%;
        -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
        -o-transition: opacity 0.3s linear, right 0.3s ease-out;
        transition: opacity 0.3s linear, right 0.3s ease-out;
    }

    .modal.right_modal.fade.show .modal-dialog {
        right: 0;
        box-shadow: 0px 0px 19px rgba(0, 0, 0, .5);
    }

    /* ----- MODAL STYLE ----- */
    .modal-content {
        border: none;
        border-radius: 15px 0 0 15px;
    }

    .modal-header {
        padding: 10px 15px;
        border-bottom-color: var(--gray-color);
        background: var(--primary-color) !important;
        border-radius: 15px 0 0 0;
    }

    .modal_outer .modal-body {
        /*height:90%;*/
        overflow-y: auto;
        overflow-x: hidden;
        height: 91vh;
        background: var(--primary-color);
        border-radius: 0 0 0 15px;
    }

    .close-modal {
        color: var(--gray-color);
        transition: transform .25s, opacity .25s;
    }

    .close-modal:hover {
        color: var(--gray-color);
        opacity: 1;
        transform: rotate(90deg);
    }

    .close-modal:focus {
        color: var(--gray-color);
        opacity: 1;
        transform: rotate(90deg);
    }

    .open-button {
        background-color: #555;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        opacity: 0.8;
        position: fixed;

        width: 280px;
    }

    /* The popup form - hidden by default */
    .form-popup {
        display: none;
        position: absolute;
        bottom: 250;
        right: 15px;
        z-index: 6000;
    }

    /* Add styles to the form container */
    .form-container {
        z-index: 3;
        position: absolute;
        top: 50%;
        left: 50%;
        width: 40em;
        height: 28em;
        border-radius: 30px;
        margin-top: 0em;
        /*set to a negative number 1/2 of your height*/
        margin-left: 15em;
        /*set to a negative number 1/2 of your width*/
        background-color: #edecec;
    }

    /* Full-width input fields */
    .form-container input[type=number],
    .form-container input[type=password] {
        width: 70%;
        padding: 10px;
        margin: 5px 0 18px 0;
        border: 2px solid black;
        border-radius: 12px;
        background: #f1f1f1;
    }

    /* When the inputs get focus, do something */
    .form-container input[type=number]:focus,
    .form-container input[type=password]:focus {
        background-color: #ddd;
        outline: none;
    }

    /* Set a style for the submit/login button */
    .form-container .btn {
        background-color: #04AA6D;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        width: 60%;
        margin-bottom: 10px;
        opacity: 0.8;
    }

    /* Add a red background color to the cancel button */
    .form-container .cancel {
        background-color: red;
    }

    /* Add some hover effects to buttons */
    .form-container .btn:hover,
    .open-button:hover {
        opacity: 1;
    }


    @media (max-width: 991px) {
        .modal.right_modal {
            position: fixed;
            z-index: 99999;
        }

        .modal.right_modal .modal-dialog {
            position: fixed;
            margin: auto;
            width: 100%;
            height: 80%;
            -webkit-transform: translate3d(0%, 0, 0);
            -ms-transform: translate3d(0%, 0, 0);
            -o-transform: translate3d(0%, 0, 0);
            transform: translate3d(0%, 0, 0);
        }

        .modal-dialog {
            /* max-width: 100%; */
            margin: 1.75rem auto;
            border-radius: 10px;
            border-radius: 15px 15px 0 0;
        }

        .modal.right_modal .modal-content {
            /*overflow-y: auto;
        overflow-x: hidden;*/
            height: 80vh !important;
        }

        .modal.right_modal .modal-body {
            padding: 15px 15px 30px;
        }

        .modal-backdrop {
            display: none;
        }

        /*Right*/
        .modal.right_modal.fade .modal-dialog {
            bottom: -50%;
            -webkit-transition: opacity 0.3s linear, bottom 0.3s ease-out;
            -moz-transition: opacity 0.3s linear, bottom 0.3s ease-out;
            -o-transition: opacity 0.3s linear, bottom 0.3s ease-out;
            transition: opacity 0.3s linear, bottom 0.3s ease-out;
        }

        .modal.right_modal.fade.show .modal-dialog {
            bottom: 0;
            box-shadow: 0px 0px 19px rgba(0, 0, 0, .5);
        }

        /* ----- MODAL STYLE ----- */
        .modal-content {
            border: none;
            border-radius: 15px 15px 0 0;

        }

        .modal-header {
            padding: 10px 15px;
            border-bottom-color: var(--gray-color);
            background-color: var(--primary-color);
            border-radius: 15px 15px 0 0;

        }

        .modal_outer .modal-body {
            /*height:90%;*/
            overflow-y: auto;
            overflow-x: hidden;

        }

        .form-popup {
            display: none;
            position: absolute;
            bottom: 250;
            right: 15px;
            z-index: 6000;
        }

        .form-container {
            z-index: 3;
            position: initial;
            top: 50%;
            left: 50%;
            width: 40em;
            height: 28em;

            margin-top: 0em;
            /*set to a negative number 1/2 of your height*/
            margin-left: 15em;
            /*set to a negative number 1/2 of your width*/
            background-color: #edecec;
        }

        /* Full-width input fields */
        .form-container input[type=number],
        .form-container input[type=password] {
            width: 70%;
            padding: 10px;
            margin: 5px 0 18px 0;
            border: 2px solid black;
            border-radius: 12px;
            background: #f1f1f1;
        }

        /* When the inputs get focus, do something */
        .form-container input[type=number]:focus,
        .form-container input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Set a style for the submit/login button */
        .form-container .btn {
            background-color: #04AA6D;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 70%;
            margin-bottom: 10px;
            opacity: 0.8;
        }

        /* Add a red background color to the cancel button */
        .form-container .cancel {
            background-color: red;
        }

        /* Add some hover effects to buttons */
        .form-container .btn:hover,
        .open-button:hover {
            opacity: 1;
        }
    }

    /* @media (max-width: 770px) {
    .form-container {
  z-index: 3;
  position:initial;
    top: 50%;
    left: 50%;
    width:40em;
    height:22em;
    
    margin-top: 0em; /*set to a negative number 1/2 of your height
    margin-left: 15em; /*set to a negative number 1/2 of your width
  background-color: white;
} 


}*/
    @media (max-width: 590px) {
        .form-container {
            z-index: 3;
            position: initial;
            top: 50%;
            left: 50%;
            width: 25em;
            height: 28em;

            margin-top: 0em;
            /*set to a negative number 1/2 of your height*/
            margin-left: 15em;
            /*set to a negative number 1/2 of your width*/
            background-color: #edecec;
        }

    }

    #editorComment {
        background: var(--accent-color);
        color: var(--accent-hover-color);
        border: none;
        border-radius: 15px;
        border: 1px solid var(--accent-hover-color) !important;

        /*  overflow-y: auto;
    height: 300px; */
    }

    #editorSubcomment {
        background: var(--accent-color);
        color: var(--accent-hover-color);
        border: none;
        border-radius: 15px;
        border: 1px solid var(--accent-hover-color) !important;

        /*  overflow-y: auto;
    height: 300px; */
    }

    .ql-editor {
        padding: 10px 20px !important;
        height: 60px !important;
    }

    #editorComment:focus {
        background: var(--accent-color);
        color: var(--accent-hover-color);
    }

    #editorSubcomment:focus {
        background: var(--accent-color);
        color: var(--accent-hover-color);
    }

    .ql-editor::placeholder {
        color: var(--accent-hover-color) !important;
    }

    .ql-snow {
        background: var(--bg-color);
        border: 1px solid var(--primary-color) !important;
        color: var(--text-color);
        border-radius: 15px;
        margin-bottom: 5px;
    }

    .ql-stroke {
        stroke: var(--text-color) !important;

    }

    .ql-fill {
        fill: var(--text-color) !important;

    }

    .comment-paragraph canvas {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 1px dashed var(--gray-color);
        padding: 2px;
    }

    .comment-paragraph img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 1px dashed var(--gray-color);
        padding: 2px;
    }

    .comment-paragraph .author-link {
        color: var(--text-color);
        text-decoration: none;
    }

    .subcomment-paragraph {
        border-left: 3px solid var(--gray-color-50);
    }

    .subcomment-paragraph canvas {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 1px dashed var(--gray-color);
        padding: 2px;
    }

    .subcomment-paragraph img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 1px dashed var(--gray-color);
        padding: 2px;
    }

    .subcomment-paragraph .author-link {
        color: var(--text-color);
        text-decoration: none;
    }



    #header-setting-style {
        margin-bottom: 3rem !important;
    }

    tbody {
        display: table-caption;
        height: 13rem;
        /* Just for the demo          */
        overflow-y: auto;
        /* Trigger vertical scroll    */
        overflow-x: hidden;
        /* Hide the horizontal scroll */
    }

    .theme-4-main-image {
        width: 15%;
        object-fit: cover;
    }

    .post-content-theme-4 {
        text-align: left;
    }

    .post-content-theme-4 img {
        width: 60%;
        height: 100%;
    }

    @media screen and (min-width: 992px) {
        .heading-right {
            border-right: 5px solid var(--text-color);
            color: var(--text-color);
            padding-right: 20px;
        }
    }

    .post-content img {
        width: 75%;
        height: auto;
    }

    @media screen and (max-width: 991px) {
        .post-content img {
            width: 100%;
            height: auto;
        }

        .heading-right {
            border-left: 5px solid var(--text-color);
            color: var(--text-color);
            padding-left: 20px;
        }

        .theme-4-main-image {
            width: 100% !important;
        }

        .post-content-theme-4 img {
            width: 100% !important;
            height: 100%;
        }
    }

    .topRanker {
        color: rgb(0, 125, 255);
    }

    .transition-error {
        transition: all 1s ease-in-out;
    }

    .content-panel h1 {
        font-size: 2.5rem !important;
        color: #212529 !important;
        background: transparent !important;
        -webkit-text-fill-color: #212529 !important;
        letter-spacing: inherit !important;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .gap-3 {
        gap: 0.4rem;
        justify-content: center;
        align-items: center;
        display: flex;
    }

    @media screen and (max-width: 768px) {
        .like-panel span i {
            font-size: 1rem;
            cursor: pointer;
        }

        .gap-2 {
            gap: 0.4rem !important;
        }
    }
</style>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-53J6JBV" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>

    <!-- new loader start -->
    <div class="new-loader-wrapper" style="display:none">
        <div>
            <div class="loadingio-spinner-blocks-6z64s4i6x4q">
                <div class="ldio-orclk6era8b">
                    <div style='left:38px;top:38px;animation-delay:0s'></div>
                    <div style='left:80px;top:38px;animation-delay:0.125s'></div>
                    <div style='left:122px;top:38px;animation-delay:0.25s'></div>
                    <div style='left:38px;top:80px;animation-delay:0.875s'></div>
                    <div style='left:122px;top:80px;animation-delay:0.375s'></div>
                    <div style='left:38px;top:122px;animation-delay:0.75s'></div>
                    <div style='left:80px;top:122px;animation-delay:0.625s'></div>
                    <div style='left:122px;top:122px;animation-delay:0.5s'></div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <h2>Please Wait ...</h2>
            <p>Don't refresh the page.<br>Data will be lost if you leave the page.</p>
        </div>
    </div>
    <!-- new loader end -->
    <input type="hidden" id="user_uid" value="<?php echo $user_uid_new ?? null; ?>">
    <input type="hidden" name="total_view_sec" value="<?= $total_view_in_sec ?>" id="total_view_in_sec">
    <!-- Banner Start -->
    <?php if (isset($_GET['course'])) { ?>
        <input type="hidden" name="videoUId" id="videoUId" value="<?= $video_uuid_new ?>">
        <input type="hidden" name="chooseChain" id="chooseChain">
        <input type="hidden" name="userAddress" id="userAddress" value="<?= $user_address ?>">
        <input type="hidden" name="target_amount" id="target_amount" value="<?= $target_amount ?>">
        <input type="hidden" name="amount_in" id="amount_in" value="<?= $amount_in ?>">
        <input type="hidden" name="crowd_query_total_pay" id="crowd_query_total_pay" value="<?= $crowd_query_total_pay ?>">
        <input type="hidden" name="postUId" id="postUId" value="<?= $video_uuid_new ?>">

        <div class="video-container setvideoSize" style="overflow: hidden !important;">
            <!-- ------------------------- dynamic load iframe here start-------------------------- -->
            <div class="videopart">
                <div class="container-fluid p-0 setvideoSize2" id="videoheight" style="width:100%;display:<?php echo $showPaid; ?>">
                    <a href="./courses" class="back_button" style="z-index: 888;position:absolute;padding:1.5rem;">
                        <i class="ri-arrow-left-line"></i>
                    </a>
                    <video id="myvideo" class="video-js vjs-default-skin vjs-big-play-centered" controls data-setup='{"playbackRates": [1, 1.2, 1.5,1.7,2,4]}' style="height:100%;width:100%;">
                        <source id="myvideo540" src='<?php echo $video_url; ?>' label='540p' res='540' type="video/mp4" />
                        <source id="myvideo360" src='<?php echo $video_url; ?>' label='360p' res='360' type="video/mp4" />
                        <source id="myvideo180" src='<?php echo $video_url; ?>' label='180p' res='180' type="video/mp4" />
                        <source id="myvideo270" src='<?php echo $video_url; ?>' label='270p' res='270' type="video/mp4" />
                        <source id="myvideo720" src='<?php echo $video_url; ?>' label='720p' res='720' type="video/mp4" />
                        <source id="myvideo2160" src='<?php echo $video_url; ?>' label='4k' res='2160' type="video/mp4" />
                    </video>
                    <!-- <div class="next_button" style="z-index: 888;position:absolute;padding:1.5rem;margin-top:-85px;right:1rem;display:none;">
                        <a style="padding: 0.5rem 1rem;" class="btn btn-hover" id="setNextEpisode">Next Video</a>
                    </div> -->
                </div>
            </div>
        </div>
        <!-- MainContent -->
        <div class="main-content movi">
            <section class="movie-detail container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="trending-info g-border">
                            <h1 class="trending-text big-title text-uppercase mt-0"><?php echo $title; ?></h1>
                            <!-- <ul class="p-0 list-inline d-flex align-items-center movie-content">
                           <li class="text-white">Action</li>
                           <li class="text-white">Drama</li>
                           <li class="text-white">Thriller</li>
                        </ul> -->
                            <div class="d-flex justify-content-start align-items-center gap-2 mb-4">
                                <div class="d-flex justify-content-center align-items-center gap-2 like-panel">
                                    <span class="d-flex justify-content-center align-items-center gap-2">
                                        <?php
                                        if ($user_like_status && $video_current_status === 'like') {
                                        ?>
                                            <i class="fa fa-thumbs-up" onclick="like_me('<?= $video_uuid_new ?>','<?= $user_address ?>',true)"></i>
                                        <?php
                                        } else {
                                        ?>
                                            <i class="fa fa-thumbs-o-up" onclick="like_me('<?= $video_uuid_new ?>','<?= $user_address ?>',true)"></i>
                                        <?php
                                        }
                                        ?>
                                        <span class="likeclass" id="likeData"><?= $video_like ?></span></span>
                                    <span>
                                        <div class="pipe-style">|</div>
                                    </span>
                                    <span class="d-flex justify-content-center align-items-center gap-2">
                                        <?php
                                        if ($user_like_status && $video_current_status === 'dislike') {
                                        ?>
                                            <i class="fa fa-thumbs-down" onclick="like_me('<?= $video_uuid_new ?>','<?= $user_address ?>',false)"></i>
                                        <?php
                                        } else {
                                        ?>
                                            <i class="fa fa-thumbs-o-down" onclick="like_me('<?= $video_uuid_new ?>','<?= $user_address ?>',false)"></i>
                                        <?php
                                        }
                                        ?>
                                        <span class="likeclass" id="dislikeData"><?= $video_dislike ?></span>
                                    </span>
                                </div>
                                <div class="d-flex justify-content-center align-items-center gap-2 like-panel py-3" onclick="openShareModel()" style="cursor: pointer;">
                                    <span class="d-flex justify-content-center align-items-center gap-2">
                                        <i class="fa fa-share"></i><span class="likeclass">Share</span>
                                    </span>
                                </div>
                                <div class="d-flex justify-content-center align-items-center gap-2 like-panel py-3 cursor-pointer" data-bs-toggle="modal" data-bs-target="#commentRightModal">
                                    <span class="d-flex justify-content-center align-items-center gap-2">
                                        <i class="fa fa-comment"></i><span class="likeclass">Comment</span>
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center text-white text-detail">
                                <span class="badge badge-secondary p-3 ml-2"><span id="videoViews"><?= $video_views ?></span> views</span>
                                <span class="ml-3">3h 15m</span>
                                <span class="trending-year"><?php echo $date; ?></span>
                            </div>
                            <div class="d-flex align-items-center series mb-4">
                                <a href="javascript:void();"><img src='<?= $thumbnail2 ?>' class="img-fluid img-responsive" alt="" style="height:72px;object-fit:cover;"></a>
                                <span class="text-gold ml-3">#2 <?= $module_name ?></span>
                            </div>
                            <!-- slider panel start -->
                            <?php
                            if ($is_croudfunded === 'true') {
                            ?>
                                <div class="news blue">
                                    <span class="hellotext">Recent Investor</span>
                                    <span class="text1 hellotext">
                                        <div class="Marquee">
                                            <div class="Marquee-content">
                                                <?php
                                                $get_Allview_query_2 = "SELECT * FROM `crowd_fund` WHERE `video_uuid`='$video_uuid_new' order BY id DESC limit 10";
                                                $result_Allview_2 = mysqli_query($con, $get_Allview_query_2);
                                                if (mysqli_num_rows($result_Allview_2) > 0) {
                                                    $ii = 1;
                                                    while ($row_Allview_2 = mysqli_fetch_array($result_Allview_2)) {
                                                        $userAddressView = $row_Allview_2['user_address'];
                                                        $get_Allview_query_1 = "SELECT * FROM `user_login` WHERE `metamask_address` = '$userAddressView'";
                                                        $result_Allview_1 = mysqli_query($con, $get_Allview_query_1);

                                                        $show_userName = '';
                                                        $show_userAddress = substr($userAddressView, 0, 4) . '...' . substr($userAddressView, -4);
                                                        $pay_amount_new = $row_Allview_2['pay_amount'];
                                                        $amount_in_new = $row_Allview_2['pay_amount_in'];

                                                        if (mysqli_num_rows($result_Allview_1) > 0) {
                                                            while ($row_Allview_1 = mysqli_fetch_array($result_Allview_1)) {
                                                                $show_userName = $row_Allview_1['name'];
                                                            }
                                                        } else {
                                                            $show_userName =  $row_Allview_2['user_address'];
                                                            $show_userName = substr($show_userName, 0, 5) . '...' . substr($show_userName, -5);
                                                        }
                                                ?>
                                                        <div class="Marquee-tag"><a class="viewModal-Wrapper" href="https://goerli.etherscan.io/address/<?= $row_Allview_2['user_address'] ?>" target="_blank">
                                                                <div class="viewModal-Wrapper-inner">
                                                                    <div class="viewModal-inner-in">
                                                                        <div class="viewModal-img-wrapper d-flex">
                                                                            <span class="d-flex">
                                                                                <div class="viewModal-img-inner">
                                                                                    <div class="viewModal-img-inner-in">
                                                                                        <span class="img-setting-wrapper">
                                                                                            <span class="img-setting-wrapper-in">
                                                                                                <img class="img-setting-wrapper-in-img" alt="" aria-hidden="true" src="data:image/svg+xml,%3csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20version=%271.1%27%20width=%2728%27%20height=%2728%27/%3e">
                                                                                            </span>
                                                                                            <!-- user image start new-->
                                                                                            <?php
                                                                                            $coming_user_address = $row_Allview_2['user_address'];
                                                                                            $query_follow = "SELECT * FROM `user_login` Where `metamask_address` = '$coming_user_address'";
                                                                                            $result_follow = mysqli_query($con, $query_follow);
                                                                                            if (mysqli_num_rows($result_follow) > 0) {
                                                                                                while ($row_follow = mysqli_fetch_assoc($result_follow)) {
                                                                                                    $profile_img_user = $row_follow['profile'];
                                                                                                    $profile_user_uid_user = $row_follow['user_uid'];
                                                                                                    $profile_name_user = $row_follow['name'];
                                                                                                    $profile_username_user = $row_follow['username'];
                                                                                                    if ($profile_img_user == '') {
                                                                                                        echo '<canvas class="avatar-image img-fluid rounded-circle img-setting-wrapper-in-img2" title="' . $profile_name_user . '" width="20" height="20" data-userid="' . $coming_user_address . '"></canvas>';
                                                                                                    } else {
                                                                                                        echo '<img src="uploads/profile/' . $profile_img_user . '" alt="" class="img-setting-wrapper-in-img2" width="20" height="20" loading="lazy">';
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                            <!-- user image end new-->
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </span>
                                                                        </div>
                                                                        <div class="viewModal-username text-truncate" style="width:7.5rem;">
                                                                            <?= $show_userName ?></div>
                                                                        <div class="viewModal-address-wrapper" style="color: #dee2e6;background: rgb(0 0 0 / 50%);">
                                                                            <div class="viewModal-address"><?= $show_userAddress ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="viewModal-inner-rank ml-3 <?php echo $ii <= 3 ? 'topRanker' : '' ?>">
                                                                        <?= $pay_amount_new ?>&nbsp;<?= $amount_in_new ?>
                                                                    </div>
                                                                </div>
                                                            </a></div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                            <?php
                            }
                            ?>
                            <!-- slider panel end -->
                            <?php
                            if ($is_croudfunded === 'false') {
                            ?>
                                <!-- tipping system start -->
                                <?php if (!isset($donate_eth_address)) {
                                    echo '<button class="fw-bold mt-3 btn btn-hover px-5 py-2 mb-4 w-auto" onClick="login()"><img src="images/metamask-fox.svg"><span class="ms-2">Donate<span class="d-lg-none"> with MetaMask</span></span></button>';
                                } else {
                                    echo '<button class="fw-bold mt-3 btn btn-hover px-5 py-2 mb-4 w-auto" data-bs-toggle="modal" data-bs-target="#metamaskDonateModal"><img src="images/metamask-fox.svg"><span class="mx-2">Donate<span class="d-lg-none">with MetaMask </span></span></button>'; ?>
                                <?php
                                }
                            } else if ($is_croudfunded === 'true') { ?>
                                <!-- tipping system end -->
                                <!-- crowdfunding UI start -->
                                <div class="row">
                                    <div class="col-lg-7 col-md-12">
                                        <div class="crowdfunding-area-setting my-3">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-setting" role="progressbar" style="width: 25%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                    <span id="span_percentage_view">0</span>%
                                                </div>
                                            </div>
                                            <div class="row my-3">
                                                <div class="col-3">
                                                    <div class="d-flex justify-content-center align-items-center fundDetailsData">
                                                        <div class="d-flex flex-column">
                                                            <div class="first_text flex-lg-row flex-column"><span id="crowd_query_total_pay_view">0,000</span>&nbsp;<span class="amount_in_view">ETH</span></div>
                                                            <div class="little_text">Raised</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3" style="border-right: 1px solid #7a7a7a;">
                                                    <div class="d-flex justify-content-center align-items-center fundDetailsData">
                                                        <div class="d-flex flex-column">
                                                            <div class="first_text" style="cursor: pointer;" onclick="viewContribution()"><?= $total_contributor ?></div>
                                                            <div class="little_text">Unique Investors</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="d-flex justify-content-center align-items-center fundDetailsData">
                                                        <div class="d-flex flex-column">
                                                            <div class="second_text"><span id="target_amount_view">0,000</span>&nbsp;<span id="amount_in_view" class="amount_in_view">ETH</span></span>
                                                            </div>
                                                            <div class="little_text">Target</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="d-flex justify-content-center align-items-center fundDetailsData">
                                                        <div class="d-flex flex-column">
                                                            <div class="second_text"><span id="percentage_view">0</span>%</span>
                                                            </div>
                                                            <div class="little_text"> Collected</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if ($amount_in === 'ETH') {
                                ?>
                                    <div class="d-flex form-row align-items-center row mb-1">
                                        <div class="col-md-12">
                                            <h6 class="text-danger transition-error" style="font-size:12px;font-weight:800;display:none;" id="show_input_required_error_eth">Error:&nbsp; min
                                                contribution required.</h6>
                                            <h6 class="text-danger transition-error" style="font-size:12px;font-weight:800;display:none;" id="show_input_amount_error_eth">Error:&nbsp; amount
                                                should
                                                not be less than min contribution.</h6>
                                            <h6 class="mt-4 mb-2" style="font-size:12px;font-weight:800;color:#707070;">
                                                * Min
                                                Contribution &nbsp;<span style="color:var(--gray-color);"><?= $crowd_min_amount ?>&nbsp;<?= $amount_in ?></span>
                                            </h6>
                                        </div>
                                        <div class="row mb-4 w-100">
                                            <div class="col-lg-6 col-md-12 d-flex justify-content-center gap-2">
                                                <div class="col-lg-6 col-md-12">
                                                    <label class="sr-only" for="min_donation_in_eth">Min
                                                        Donation</label>
                                                    <div class="input-group mb-2">
                                                        <input type="number" class="form-control" id="min_donation_in_eth" placeholder="Contribution" min="0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">ETH</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <button type="button" class="stories-top-panel-div-second-anchor btn btn-hover" style="width:100%;height:2.7rem;" onclick="startProjectFunding('<?= $crowd_min_amount ?>', '<?= $project_address ?>');">Contribute</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php } else if ($amount_in === 'MATIC') { ?>
                                    <div class="d-flex form-row align-items-center row mb-1">
                                        <div class="col-md-12">
                                            <h6 class="text-danger transition-error" style="font-size:12px;font-weight:800;display:none;" id="show_input_required_error_matic">Error:&nbsp;
                                                min
                                                contribution required.</h6>
                                            <h6 class="text-danger transition-error" style="font-size:12px;font-weight:800;display:none;" id="show_input_amount_error_matic">Error:&nbsp;
                                                amount should
                                                not be less than min contribution.</h6>
                                            <h6 class="mt-4 mb-2" style="font-size:12px;font-weight:800;color:#707070;">
                                                * Min
                                                Contribution &nbsp;<span style="color:var(--gray-color);"><?= $crowd_min_amount ?>&nbsp;<?= $amount_in ?></span>
                                            </h6>
                                        </div>
                                        <div class="row mb-4 w-100">
                                            <div class="col-lg-6 col-md-12 d-flex justify-content-center gap-2 flex-lg-row flex-column">
                                                <div class="col-lg-6 col-md-12">
                                                    <label class="sr-only" for="min_donation_in_matic">Min
                                                        Donation</label>
                                                    <div class="input-group mb-2">
                                                        <input type="number" class="form-control" id="min_donation_in_matic" placeholder="Contribution" min="0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">MATIC</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <button type="button" class="stories-top-panel-div-second-anchor btn btn-hover" style="width:100%;height:2.7rem;" onclick="startProjectFundingMatic('<?= $crowd_min_amount ?>', '<?= $project_address ?>');">Contribute</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } else if ($amount_in === 'BNB') { ?>
                                    <div class="d-flex form-row align-items-center row mb-1">
                                        <div class="col-md-12">
                                            <h6 class="text-danger transition-error" style="font-size:12px;font-weight:800;display:none;" id="show_input_required_error_bnb">Error:&nbsp;
                                                min
                                                contribution required.</h6>
                                            <h6 class="text-danger transition-error" style="font-size:12px;font-weight:800;display:none;" id="show_input_amount_error_bnb">Error:&nbsp;
                                                amount should
                                                not be less than min contribution.</h6>
                                            <h6 class="mt-4 mb-2" style="font-size:12px;font-weight:800;color:#707070;">
                                                * Min
                                                Contribution &nbsp;<span style="color:var(--gray-color);"><?= $crowd_min_amount ?>&nbsp;<?= $amount_in ?></span>
                                            </h6>
                                        </div>
                                        <div class="row mb-4 w-100">
                                            <div class="col-lg-6 col-md-12 d-flex justify-content-center gap-2">
                                                <div class="col-lg-6 col-md-12">
                                                    <label class="sr-only" for="min_donation_in_bnb">Min
                                                        Donation</label>
                                                    <div class="input-group mb-2">
                                                        <input type="number" class="form-control" id="min_donation_in_bnb" placeholder="Contribution" min="0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">BNB</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <button type="button" class="stories-top-panel-div-second-anchor btn btn-hover" style="width:100%;height:2.7rem;" onclick="startProjectFundingBnb('<?= $crowd_min_amount ?>', '<?= $project_address ?>');">Contribute</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } else {  ?>
                                    <button type="button" class="stories-top-panel-div-second-anchor" style="width:100%;height:2.7rem;">Wait ...</button>
                            <?php }
                            } else {
                            }
                            ?>
                            <!-- crowdfunding UI end -->
                            <p class="trending-dec w-100 mb-0"><?php echo $desc; ?></p>
                        </div>
                    </div>
                </div>
            </section>
            <section id="iq-favorites" class="s-margin">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 overflow-hidden">
                            <div class="iq-main-header d-flex align-items-center justify-content-between">
                                <h4 class="main-title"><a href="movie-category.html">More Episodes</a></h4>
                            </div>
                            <div class="favorites-contens">
                                <ul class="list-inline favorites-slider row p-0 mb-0 favorites-slider-new">
                                    <?php
                                    $query = "SELECT * FROM `video_info` WHERE `module`='$module_name' limit 10";
                                    $result = mysqli_query($con, $query);
                                    if (mysqli_num_rows($result) > 0) {
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {

                                            $thumbnail = $row['thumbnail_ipfs'];
                                            $video_id = $row['video_uuid'];
                                            $chapter_part = $row['video_id'];
                                            $chapter_name = $row['name'];
                                            $chapter_id = $row['video_id'];
                                            $module_name = $row['module'];
                                            $video_uuid = $row['video_uuid'];
                                            $module_id = $row['module_uuid'];
                                    ?>
                                            <li class="slide-item">
                                                <a href="videoPlayer.php?course=<?= $video_uuid ?>&module=<?= $module_id ?>">
                                                    <div class="block-images position-relative">
                                                        <div class="img-box my-img-container">
                                                            <img src="<?= $thumbnail ?>" class="img-fluid" alt="">
                                                        </div>
                                                        <div class="block-description">
                                                            <h6><?= $chapter_name ?></h6>
                                                            <div class="movie-time d-flex align-items-center my-2">
                                                                <div class="badge badge-secondary p-1 mr-2"><?= $module_name ?>
                                                                </div>
                                                                <span class="text-white"><?= $i ?></span>
                                                            </div>
                                                            <div class="hover-buttons">
                                                                <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_id ?>" class="btn btn-hover"><i class="fa fa-play mr-1" aria-hidden="true"></i>
                                                                    Play Now</a>
                                                            </div>
                                                        </div>
                                                        <div class="block-social-info">
                                                            <ul class="list-inline p-0 m-0 music-play-lists">
                                                                <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                                                <li onclick="myVid2('<?= $video_uuid ?>','<?= $user_address ?>')">
                                                                    <span><i class="ri-heart-fill"></i></span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                    <?php $i = $i + 1;
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    <?php } else {
        header('Location: index');
    } ?>
    <footer class="setFooter">
        <div class="container-fluid">
            <div class="block-space">
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="f-link list-unstyled mb-0">
                            <li><a href="privacy">Privacy</a></li>
                            <li><a href="contact">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <ul class="f-link list-unstyled mb-0">
                            <li><a href="/">Home</a></li>
                            <li><a href="./courses">Videos</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-12 r-mt-15">
                        <div class="d-flex">
                            <a href="#" class="s-icon">
                                <i class="ri-facebook-fill"></i>
                            </a>
                            <a href="#" class="s-icon">
                                <i class="ri-skype-fill"></i>
                            </a>
                            <a href="#" class="s-icon">
                                <i class="ri-linkedin-fill"></i>
                            </a>
                            <a href="#" class="s-icon">
                                <i class="ri-whatsapp-fill"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright py-2">
            <div class="container-fluid">
                <p class="mb-0 text-center font-size-14 text-body">Finflix - 2022 All Rights Reserved</p>
            </div>
        </div>
    </footer>
    <!-- Modal -->
    <div class="modal fade shadow-lg" id="metamaskDonateModal" tabindex="-1" aria-labelledby="metamaskDonateModalLabel" aria-hidden="true" style="background:rgba(0,0,0, .5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content mx-2 setModalStyle" style="background:#222222;">
                <div class="modal-header d-flex justify-content-between align-items-center" style="color:var(--text-color)">
                    <h5 class="modal-title" id="metamaskDonateModalLabel">Donate to Creater</h5>
                    <button type="button" class="close-modal btn p-0 m-0 px-2 btn btn-hover" data-bs-dismiss="modal" aria-label="Close"><i class="ri-2x ri-close-fill"></i></button>
                </div>
                <div class="modal-body" style="background:var(--primary-color);border-radius:0 0 15px 15px;">
                    <?php
                    $metafrom = $user_address;
                    if ($user_type === 'admin') {
                        $metato = $donate_eth_address;
                    } elseif ($user_type === 'user') {
                        $metato = $user_row_address;
                    } else {
                        $metato = $donate_eth_address;
                    }
                    ?>
                    <div class="row g-3 mb-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="my-2" for=" amount" style="color:var(--text-color);">Select network chain
                                    to
                                    donate
                                    in</label>
                                <select class="form-control story-input p-2 currencyField" onchange="selectChain()" id="selectNetworkChain">
                                    <option value="">Select chain</option>
                                    <option value="ethereum">ETH</option>
                                    <!-- <option value="binancecoin">BNB</option>
                                        <option value="celo">CELO</option>
                                        <option value="fantom">FTM</option>
                                        <option value="avalanche-2">AVAX</option>
                                        <option value="klay-token">KLAY</option> -->
                                    <option value="matic-network">MATIC</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3" id="donateArea" style="display:none;">
                        <div class=" col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="amount" style="color:var(--text-color);">Amount (in dollar)</label>
                                <input type="number" required min="0" oninput="validity.valid||(value='');" class="form-control story-input p-2 currencyField" class="currencyField" name="usd" id="dollar_amount" required />
                                <input type="hidden" class="metato" id="metato" value="<?php echo $metato; ?>">
                                <input type="hidden" class="metafrom" id="metafrom" value="<?php echo $metafrom; ?>">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="price" style="color:var(--text-color);">Amount (in
                                    <span id="price_lable">celo</span>)</label>
                                <input type="number" required min="0" oninput="validity.valid||(value='');" class="form-control story-input p-2 currencyField" class="currencyField" id="price" name="eth" required />
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-light px-2 py-1 btn-hover" style="border-radius:20px;" id="dollar1" class="dollar_click">$1</button>
                                <button class="btn btn-light px-2 py-1 btn-hover" style="border-radius:20px;" id="dollar2" class="dollar_click">$2</button>
                                <button class="btn btn-light px-2 py-1 btn-hover" style="border-radius:20px;" id="dollar5" class="dollar_click">$5</button>
                                <button class="btn btn-light px-2 py-1 btn-hover" style="border-radius:20px;" id="dollar10" class="dollar_click">$10</button>
                                <button class="btn btn-light px-2 py-1 btn-hover" style="border-radius:20px;" id="dollar20" class="dollar_click">$20</button>
                                <button class="btn btn-light px-2 py-1 btn-hover" style="border-radius:20px;" id="dollar50" class="dollar_click">$50</button>
                                <button class="btn btn-light px-2 py-1 btn-hover" style="border-radius:20px;" id="dollar100" class="dollar_click">$100</button>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="d-flex justify-content-center align-items-center mt-3 mb-2">
                                <button class="btn button-primary tip-button btn-hover px-5">Donate</button>
                            </div>
                            <div class="message text-muted"></div>
                        </div>
                    </div>
                    <small style="font-size:12px;">
                        <b>Note:</b>&nbsp;Your selected network must be add in your metamask,to add network chain in
                        your
                        metamask
                        you
                        can visit on <a href="https://chainlist.org/" target="_blank">chainlist</a>.
                    </small>
                </div>
            </div>
        </div>
    </div>
    <!-- ------------------------------ success model ----------------------------- */ -->
    <div class="modal fade shadow-lg" id="metamaskSuccessModal" tabindex="-1" aria-labelledby="metamaskSuccessModalLabel" aria-hidden="true" style="background:rgba(0,0,0, .5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content mx-2 setModalStyle" style="background:#222222;">
                <div class="modal-body">
                    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Source+Sans+Pro" rel="stylesheet">
                    <div class=content>
                        <div class="wrapper-1">
                            <div class="wrapper-2" style="display:none" id="transation_successfull_msg">
                                <h1>Thank you !</h1>
                                <p>Thanks for donation</p>
                                <p>Transation id : <a id="transationLinkStyle" target="_blank" href="#"><span id="transationLink">xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</span></a>
                                </p>
                                <button class="go-home" onclick="closeSuccessModel()" style="cursor: pointer;">
                                    Close
                                </button>
                            </div>
                            <div class="wrapper-2" style="display:none" id="transation_failed_msg">
                                <h1>Sorry !</h1>
                                <p>Somthing went wrong</p>
                                <p>Try after some time... Thank you.</p>
                                <button class="go-home" onclick="closeSuccessModel()" style="cursor: pointer;">
                                    Close
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MainContent End-->
    <!-- inverstor show modal start -->
    <!-- contribute user modal start -->
    <div class="modal fade" id="viewContributeModal" tabindex="-1" aria-labelledby="viewContributeModalLabel" aria-hidden="true" style="background:#6e6e6e7a;">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content" style="border-radius:15px;background: #141414;">
                <div class="modal-header d-flex justify-content-between align-items-center" style="padding:15px;border-color:#e5e5e5;">
                    <span data-bs-dismiss="modal" class="modal-title" aria-label="Close" style="cursor:pointer;font-weight:800;color:#e9ecef">Close</span>
                    <span class="modal-title" aria-label="Close" style="font-weight:800;color:#3f4458;">
                        <?php
                        $get_view_query_2 = "SELECT count(distinct user_address) as total_contributor FROM crowd_fund WHERE `video_uuid`='$video_uuid_new';";
                        $result_view_2 = mysqli_query($con, $get_view_query_2);
                        if (mysqli_num_rows($result_view_2) > 0) {
                            while ($row_view_2 = mysqli_fetch_array($result_view_2)) {
                        ?>
                                <span><?= $row_view_2['total_contributor'] ?></span><?php }
                                                                            } ?>&nbsp;Contributor</span>
                    <?php
                    if ($amount_in === 'ETH') {
                    ?>
                        <span class="modal-title" aria-label="Close" style="cursor:pointer;font-weight:800;color: rgb(0, 125, 255);" onclick="startProjectFunding('<?= $crowd_min_amount ?>', '<?= $project_address ?>');">Contribute</span>
                    <?php } else if ($amount_in === 'MATIC') { ?>
                        <span class="modal-title" aria-label="Close" style="cursor:pointer;font-weight:800;color: rgb(0, 125, 255);" onclick="startProjectFundingMatic('<?= $crowd_min_amount ?>', '<?= $project_address ?>');">Contribute</span>
                    <?php
                    } else if ($amount_in === 'BNB') { ?>
                        <span class="modal-title" aria-label="Close" style="cursor:pointer;font-weight:800;color: rgb(0, 125, 255);" onclick="startProjectFundingBnb('<?= $crowd_min_amount ?>', '<?= $project_address ?>');">Contribute</span>
                    <?php
                    } else {  ?>
                        <span class="modal-title" aria-label="Close" style="cursor:pointer;font-weight:800;color: rgb(0, 125, 255);">Wait ...</span>
                    <?php }
                    ?>
                </div>
                <div class="modal-body">
                    <div class="viewModal-container">
                        <?php
                        $get_Allview_query_2 = "SELECT user_address, video_uuid, sum(pay_amount) as total_pay,project_address FROM crowd_fund WHERE `video_uuid`='$video_uuid_new' GROUP BY user_address, video_uuid,project_address ORDER by total_pay DESC;";
                        $result_Allview_2 = mysqli_query($con, $get_Allview_query_2);
                        if (mysqli_num_rows($result_Allview_2) > 0) {
                            $ii = 1;
                            while ($row_Allview_2 = mysqli_fetch_array($result_Allview_2)) {

                                $userAddressView = $row_Allview_2['user_address'];
                                $get_Allview_query_1 = "SELECT * FROM `user_login` WHERE `metamask_address` = '$userAddressView'";
                                $result_Allview_1 = mysqli_query($con, $get_Allview_query_1);

                                $show_userName = '';
                                $show_userAddress = substr($userAddressView, 0, 4) . '...' . substr($userAddressView, -4);

                                if (mysqli_num_rows($result_Allview_1) > 0) {
                                    while ($row_Allview_1 = mysqli_fetch_array($result_Allview_1)) {
                                        $show_userName = $row_Allview_1['name'];
                                    }
                                } else {
                                    $show_userName =  $row_Allview_2['user_address'];
                                    $show_userName = substr($show_userName, 0, 5) . '...' . substr($show_userName, -5);
                                }
                        ?>
                                <a class="viewModal-Wrapper" href="https://goerli.etherscan.io/address/<?= $row_Allview_2['user_address'] ?>" target="_blank">
                                    <div class="viewModal-Wrapper-inner">
                                        <div class="viewModal-inner-in">
                                            <div class="viewModal-img-wrapper d-flex">
                                                <span class="d-flex">
                                                    <div class="viewModal-img-inner">
                                                        <div class="viewModal-img-inner-in">
                                                            <span class="img-setting-wrapper">
                                                                <span class="img-setting-wrapper-in">
                                                                    <img class="img-setting-wrapper-in-img" alt="" aria-hidden="true" src="data:image/svg+xml,%3csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20version=%271.1%27%20width=%2728%27%20height=%2728%27/%3e">
                                                                </span>
                                                                <!-- user image start new-->
                                                                <?php
                                                                $coming_user_address = $row_Allview_2['user_address'];
                                                                $query_follow = "SELECT * FROM `user_login` Where `metamask_address` = '$coming_user_address'";
                                                                $result_follow = mysqli_query($con, $query_follow);
                                                                if (mysqli_num_rows($result_follow) > 0) {
                                                                    while ($row_follow = mysqli_fetch_assoc($result_follow)) {
                                                                        $profile_img_user = $row_follow['profile'];
                                                                        $profile_user_uid_user = $row_follow['user_uid'];
                                                                        $profile_name_user = $row_follow['name'];
                                                                        $profile_username_user = $row_follow['username'];
                                                                        if ($profile_img_user == '') {
                                                                            echo '<canvas class="avatar-image img-fluid rounded-circle img-setting-wrapper-in-img2" title="' . $profile_name_user . '" width="20" height="20" data-userid="' . $coming_user_address . '"></canvas>';
                                                                        } else {
                                                                            echo '<img src="uploads/profile/' . $profile_img_user . '" alt="" class="img-setting-wrapper-in-img2" width="20" height="20" loading="lazy">';
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                                <!-- user image end new-->
                                                            </span>
                                                        </div>
                                                    </div>
                                                </span>
                                            </div>
                                            <div class="viewModal-username text-truncate" style="width:7.5rem;">
                                                <?= $show_userName ?></div>
                                            <div class="viewModal-address-wrapper" style="background: rgb(0 0 0 / 44%);color: rgb(139 138 137);">
                                                <div class="viewModal-address" style="color:#d1d0cf;"><?= $show_userAddress ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="viewModal-inner-rank <?php echo $ii <= 3 ? 'topRanker' : '' ?>">#<?= $ii ?>
                                        </div>
                                    </div>
                                </a>
                        <?php $ii = $ii + 1;
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contribute user modal end -->
    <!-- right modal -->
    <div class="modal modal_outer right_modal fade" id="commentRightModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <?php
            $query = "SELECT `post_comments`.*,`user_login`.`username`, `user_login`.`name`, `user_login`.`profile` FROM `post_comments` INNER JOIN `user_login` ON `post_comments`.`user_uid`=`user_login`.`user_uid` WHERE `post_comments`.`video_uuid`='$video_uuid' ORDER BY `post_comments`.`comment_id` DESC";
            $result = mysqli_query($con, $query);

            ?>
            <div class="modal-content" style="background: #191919;">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase fw-bold" style="color:var(--text-color)">Comments
                        (<?php echo mysqli_num_rows($result); ?>)</h5>
                    <button type="button" class="close-modal btn" data-bs-dismiss="modal" aria-label="Close" style="background: none;"><i class="fa fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <input type="hidden" id="video_uuid_comment" value="<?php echo $video_uuid_new; ?>">
                        <input type="hidden" id="user_uid_comment" value="<?php echo $user_uid_new ?? null; ?>">
                        <!-- <div id="editorComment">
                        </div> -->
                        <textarea class="form-control" id="editorComment" rows="4" placeholder="Comment" style="background: #21262e;"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <?php
                        if (!isset($_SESSION['username'])) {
                            echo '<button class="btn button-primary-2 btn btn-hover"  onClick="login()">Respond</button>';
                        } else {
                            echo '<button class="btn button-primary-2 btn btn-hover" id="submitComments">Respond</button>';
                        }
                        ?>
                    </div>
                    <hr>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <div class="comment-paragraph">
                                <div class="d-flex justify-content-start gap-3">
                                    <?php
                                    if ($row['profile'] == '') {
                                        echo '<div class="profile new-profile-setting"><a href="' . $row['username'] . '"><canvas class="avatar-image img-fluid rounded-circle" title="' . $row['name'] . '" width="40" height="40"></canvas></a></div>';
                                    } else {
                                        echo '<div class="profile new-profile-setting"><a href="' . $row['username'] . '"><img src="uploads/profile/' . $row['profile'] . '" alt="" class="img-fluid rounded-circle"></a></div>';
                                    }
                                    ?>
                                    <div class="author-name ms-2">
                                        <a href="" class="author-link mb-0">
                                            <h6 class="fw-bold mb-0" style="font-size:14px;"><?php echo $row['name']; ?></h6>
                                        </a>
                                        <span class="text-muted" style="font-size:12px;"><?php echo date('M j, Y', strtotime($row['created_at'])); ?></span>
                                    </div>
                                </div>
                                <p class="show-read-more small" style="color:var(--gray-color);">
                                    <?php echo strip_tags($row['comment']); ?></p>

                                <?php
                                $comment_uid = $row['comment_uid'];

                                $query2 = "SELECT `post_subcomments`.*,`user_login`.`username`, `user_login`.`name`, `user_login`.`profile` FROM `post_subcomments` INNER JOIN `user_login` ON `post_subcomments`.`user_uid`=`user_login`.`user_uid` WHERE `post_subcomments`.`video_uuid`='$video_uuid' AND `post_subcomments`.`comment_uid`='$comment_uid' ORDER BY `post_subcomments`.`subcomment_id` DESC";
                                $result2 = mysqli_query($con, $query2);
                                ?>
                                <div class="d-flex justify-content-between mb-3">
                                    <div><button class="btn bg-transparent p-0" style="color:var(--text-color);" data-bs-toggle="collapse" data-bs-target="#collapseAllReply<?php echo $row['comment_id']; ?>" aria-expanded="false" aria-controls="collapseAllReply<?php echo $row['comment_id']; ?>"><?php if (mysqli_num_rows($result2) > -1) {
                                                                                                                                                                                                                                                                                                            echo mysqli_num_rows($result2) . ' replies';
                                                                                                                                                                                                                                                                                                        }; ?></button>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center" style="gap: 0.5rem;">
                                        <button class="btn bg-transparent p-0 text-success" style="color:var(--text-color);" data-bs-toggle="collapse" data-bs-target="#collapseReplyForm<?php echo $row['comment_id']; ?>" aria-expanded="false" aria-controls="collapseReplyForm<?php echo $row['comment_id']; ?>">Reply</button>
                                        <?php
                                        if ($row['user_uid'] == $user_uid2) {
                                            echo '<button class="btn bg-transparent p-0 text-danger" onClick="delcomment(\'' . $user_uid . '\',\'' . $comment_uid . '\')">Delete</button>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="subcomment-paragraph ms-5 ps-2">
                                    <div class="collapse my-2" id="collapseReplyForm<?php echo $row['comment_id']; ?>">
                                        <div class="">
                                            <form method="post" action="php/addSubcomments.php" target="_self">
                                                <div class="form-group mb-2">
                                                    <!-- <div id="editorSubcomment">
                                            </div> -->
                                                    <input type="hidden" id="video_uuid_subcomment" name="video_uuid" class="video_uuid_subcomment" value="<?php echo $video_uuid; ?>">
                                                    <input type="hidden" id="user_uid_subcomment" name="user_uid" class="user_uid_subcomment" value="<?php echo $user_uid ?? null; ?>">
                                                    <input type="hidden" id="comment_uid" class="comment_uid" name="comment_uid" value="<?php echo $comment_uid; ?>">
                                                    <input type="hidden" id="comment_uid" class="comment_uid" name="comment_uid" value="<?php echo $comment_uid; ?>">
                                                    <input type="hidden" id="page_url" class="page_url" name="page_url" value="<?php echo $post_link; ?>">
                                                    <textarea class="form-control" id="editorSubcomment" name="subcomment" class="editorSubcomment" rows="4" placeholder="Reply Comment" required style="background: #21262e;"></textarea>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <?php
                                                    if (!isset($_SESSION['username'])) {
                                                        echo '<button class="btn button-primary-2 btn btn-hover"  onClick="login()">Respond</button>';
                                                    } else {
                                                        echo '<button type="submit" name="submitSubcomments" class="btn button-primary-2 submitSubcomments btn-hover" id="submitSubcomments" >Respond</button>';
                                                    }
                                                    ?>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse" id="collapseAllReply<?php echo $row['comment_id']; ?>">
                                    <?php
                                    if (mysqli_num_rows($result2) > 0) {
                                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                    ?>
                                            <div class="subcomment-paragraph ms-5 ps-2">

                                                <div class="d-flex justify-content-start gap-3">
                                                    <?php
                                                    if ($row2['profile'] == '') {
                                                        echo '<div class="profile"><a href="' . $row2['username'] . '"><canvas class="avatar-image img-fluid rounded-circle" title="' . $row2['name'] . '" width="40" height="40"></canvas></a></div>';
                                                    } else {
                                                        echo '<div class="profile"><a href="' . $row2['username'] . '"><img src="uploads/profile/' . $row2['profile'] . '" alt="" class="img-fluid rounded-circle"></a></div>';
                                                    }
                                                    ?>
                                                    <div class="author-name ms-2">
                                                        <a href="" class="author-link mb-0">
                                                            <h6 class="fw-bold mb-0" style="font-size:14px;">
                                                                <?php echo $row2['name']; ?></h6>
                                                        </a>
                                                        <span class="text-muted" style="font-size:12px;"><?php echo date('M j, Y', strtotime($row2['created_at'])); ?></span>
                                                    </div>
                                                </div>
                                                <p class="show-read-more small" style="color:var(--gray-color);">
                                                    <?php echo strip_tags($row2['subcomment']); ?></p>
                                                <?php
                                                $subcomment_uid = $row2['subcomment_uid'];

                                                ?>

                                                <div class="d-flex justify-content-end mb-3">
                                                    <?php
                                                    if ($row2['user_uid'] == $user_uid2) {


                                                        echo '<button class="btn bg-transparent p-0 text-danger" onClick="subdelcomment(\'' . $user_uid . '\',\'' . $subcomment_uid . '\')">Delete</button>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                    <?php  }
                                    } ?>
                                </div>
                                <hr>

                            </div>
                    <?php }
                    } ?>

                </div><!-- modal-body -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div>
    <!-- inverstor show modal end -->

    <!-- share model start -->
    <div class="modal fade" id="viewShareModal" tabindex="-1" aria-labelledby="viewShareModalLabel" aria-hidden="true" style="background:#6e6e6e7a;">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content" style="border-radius:15px;background: #141414;">
                <div class="modal-header d-flex justify-content-between align-items-center" style="padding:15px;border-color:#e5e5e5;">
                    <span data-bs-dismiss="modal" class="modal-title" aria-label="Close" style="cursor:pointer;font-weight:800;color:#e9ecef">Close</span>
                    <span class="modal-title" aria-label="Close" style="font-weight:800;color:#3f4458;">
                </div>
                <div class="modal-body">
                    <div id="Demo2" class="d-flex align-items-center justify-content-center my-4"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- share model end -->
    <!-- back-to-top -->
    <div id="back-to-top">
        <a class="top" href="#top" id="top"> <i class="fa fa-angle-up"></i> </a>
    </div>
    <!-- back-to-top End -->

    <!-- jQuery, Popper JS -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script type="text/javascript" src="js/bootstrap.bundle.min.js">
    </script>
    <!-- Slick JS -->
    <script src="js/slick.min.js"></script>
    <!-- owl carousel Js -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- select2 Js -->
    <script src="js/select2.min.js"></script>
    <!-- Magnific Popup-->
    <script src="js/jquery.magnific-popup.min.js"></script>
    <!-- Slick Animation-->
    <script src="js/slick-animation.min.js"></script>
    <script src="https://vjs.zencdn.net/7.7.5/video.js"></script>
    <script src="libs/videojs-resolution-switcher.js"></script>
    <!-- Custom JS-->
    <script src="js/custom.js"></script>
    <script src="js/Youtube.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/web3modal@1.9.7/dist/index.js"></script>
    <script type="text/javascript" src="https://unpkg.com/@walletconnect/web3-provider@1.7.8/dist/umd/index.min.js">
    </script>
    <script src="./frontend/web3-login.js?v=009">
    </script>
    <script src="./frontend/web3-modal.js?v=001"></script>
    <script type="text/javascript" src="https://test.pinkpaper.xyz/assets/avatar/jquery.letterpic.min.js"></script>
    <script src="https://aloycwl.github.io/js/cdn/ipfs-api.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/near-api-js@0.41.0/dist/near-api-js.min.js"></script>
    <script src="assets/toastr/toastr.min.js"></script>
    <script src="contract/projectFunding.js"></script>
    <script src="contract/contract.js"></script>
    <script src="contract/matic/maticProjectFunding.js"></script>
    <script src="contract/matic/maticContract.js"></script>
    <!-- bnb -->
    <script src="contract/bnb/bnbProjectFunding.js"></script>
    <script src="contract/bnb/bnbContract.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script type="text/javascript" src="https://www.jqueryscript.net/demo/jQuery-Circular-Progress-Bar-With-Text-Counter/scripts/plugin.js">
    </script>
    <script src="Vendor/js/socialSharing.js"></script>
    <script>
        $(document).ready(function() {
            var progress_circle = $(".my-progress-bar").gmpc({
                line_width: 18,
                color: "#0ff",
                starting_position: 50,
                percent: 0,
                percentage: true,
            }).gmpc('animate', 85, 3000);
        });
    </script>
    <script>
        $(".avatar-image").letterpic({
            colors: [
                "#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e", "#16a085", "#27ae60", "#2980b9",
                "#8e44ad", "#2c3e50",
                "#f1c40f", "#e67e22", "#e74c3c", "#ecf0f1", "#95a5a6", "#f39c12", "#d35400", "#c0392b",
                "#bdc3c7", "#7f8c8d"
            ],
            font: 'Inter'
        });

        function viewContribution() {
            $('#viewContributeModal').modal('show');
        };
        $(document).ready(function() {

            // desk video resolution
            videojs('myvideo', {
                controls: true,
                // muted: true,
                // width: 1000,
                plugins: {
                    videoJsResolutionSwitcher: {
                        ui: true,
                        default: 360,
                        dynamicLabel: true,
                        // default: 360, // Default resolution [{Number}, 'low', 'high'],
                        // dynamicLabel: true // Display dynamic labels or gear symbol
                    }
                }
            }, function() {
                var player = this;
                window.player = player;
                player.on('resolutionchange', function() {
                    console.info('Source changed to %s', player.src())
                });

            });
            // videojs('myvideo').videoJsResolutionSwitcher();
            videojs('myvideo').videoJsResolutionSwitcher({
                default: 360,
                dynamicLabel: true
            });
            //auto play next video functionality start
            var video = videojs('myvideo').ready(function() {
                var send_course_id = '';
                var send_module_id = '';
                var send_chapter_part = '';
                var player = this;

                //get parameters from url
                var getParams = function(url) {
                    var params = {};
                    var parser = document.createElement('a');
                    parser.href = url;
                    var query = parser.search.substring(1);
                    var vars = query.split('&');
                    for (var i = 0; i < vars.length; i++) {
                        var pair = vars[i].split('=');
                        params[pair[0]] = decodeURIComponent(pair[1]);
                    }
                    return params;
                };
                var params = getParams(window.location.href);
                // console.log(params);
                var course_id = params.course;
                var module_id = params.module;
                check(course_id, module_id);

                function check(course_id, module_id) {
                    $.ajax({
                        type: 'POST',
                        url: 'php/getNextVideo.php',
                        dataType: "json",
                        'async': false,
                        data: {
                            "course_id": course_id,
                            "module_id": module_id,
                        },
                        success: function(data) {
                            // console.log(data);
                            if (data.status == '201') {
                                send_course_id = data.course_id;
                                send_module_id = data.module_id;
                                $("#setNextEpisode").attr("href",
                                    `videoPlayer?course=${data.course_id}&module=${data.module_id}`
                                );
                            } else if (data.status == '601') {
                                //last video of the playlists.
                            } else if (data.status == '602') {
                                //you are selected last video in url .
                            } else {
                                alert('Check Your Internet Connection');
                            }
                        }
                    });
                }
                $('.vjs-resolution-button').addClass('vjs-icon-cog');
                if ($(window).width() < 480) {
                    $('.vjs-resolution-button').css('font-size', '1rem');
                    $('.vjs-picture-in-picture-control').remove();
                    $('.vjs-playback-rate').remove();
                } else if ($(window).width() < 991) {
                    $('.vjs-resolution-button').css('font-size', '1.2rem');
                } else {
                    $('.vjs-resolution-button').css('font-size', '1.5rem');
                }

                // trigger when 10 sec remaining
                var oneTime = 0;
                player.on('timeupdate', function(event) {
                    // Save object in case you want to manipulate it more without calling the DOM
                    $this = $(this);
                    if ((this.currentTime()) > (this.duration() - 10)) {
                        if (oneTime == 0) {
                            console.log('video is going ended');
                            $('.vjs-control-bar').remove();
                            $('.next_button').css('display', 'block');
                        }
                        oneTime = oneTime + 1;
                    }

                });
                //next button strat
                var d1 = document.getElementsByClassName('vjs-play-control');
                // console.log(d1[1]);
                d1[0].insertAdjacentHTML('afterend',
                    '<button class="vjs-icon-next-item vjs-control vjs-button vjs-playing" type="button" title="Next" aria-disabled="false" id="aarya" style="cursor:pointer;" onclick="next();"><span aria-hidden="true" class="vjs-icon-placeholder"></span></button>'
                );
                $('#aarya').click(function() {
                    window.location =
                        `videoPlayer?course=${send_course_id}&module=${send_module_id}&chapter=${send_chapter_part}`;
                });
                //next button end
            });

        });

        function myVid2(video_id, user_id) {
            if (user_id == '') {
                userLoginOut();
            } else {
                $.ajax({
                    type: 'POST',
                    url: 'php/addFavouritePaid',
                    'async': false,
                    dataType: "json",
                    data: {
                        "video_id": video_id,
                        "user_id": user_id,
                    },
                    success: function(data) {
                        if (data.status == '201') {
                            window.location.href = `./favourite?user=${user_id}`;
                        } else if (data.status == '501') {
                            alert("already in Your Favourite List");
                        } else {
                            alert('try again after some time');
                        }
                    }
                });
            }
        }

        function closeSuccessModel() {
            $('#metamaskSuccessModal').modal('hide');
        }


        $(document).on('show.bs.modal', '.modal', function(event) {
            var zIndex = 99999 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass(
                    'modal-stack');
            }, 0);
        });
    </script>


    <script>
        $(document).ready(function() {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "1000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            var dollar_amount = $("#dollar_amount").val();
            var ethereum_amount = $("#price").val();
            $("#dollar1").click(function() {
                $("#dollar_amount").val(1);
            });
            $("#dollar2").click(function() {
                $("#dollar_amount").val(2);
            });
            $("#dollar5").click(function() {
                $("#dollar_amount").val(5);
            });
            $("#dollar10").click(function() {
                $("#dollar_amount").val(10);
            });
            $("#dollar20").click(function() {
                $("#dollar_amount").val(20);
            });
            $("#dollar50").click(function() {
                $("#dollar_amount").val(50);
            });
            $("#dollar100").click(function() {
                $("#dollar_amount").val(100);
            });

            var ADDRESS = document.getElementById('metato')
            var MY_ADDRESS = ADDRESS.value
            var tipButton = document.querySelector('.tip-button')

            tipButton.addEventListener('click', async function() {
                let chainSelect = $('#selectNetworkChain').val();
                if (window.ethereum.networkVersion && chainSelect) {
                    abcnew(chainSelect);
                }
                if (typeof ethereum === 'undefined') {
                    return renderMessage(
                        '<div>You need to install <a href=“https://metmask.io“>MetaMask </a> to use this feature.  <a href=“https://metmask.io“>https://metamask.io</a></div>'
                    )
                }

                const accounts = await ethereum.request({
                    method: 'eth_requestAccounts'
                })

                if (typeof window.ethereum !== 'undefined') {
                    console.log('MetaMask is installed!');
                }
                ethereum.request({
                    method: 'eth_requestAccounts'
                });

                var user_address = accounts[0]
                var valueinitial = document.getElementById('price')
                var value = valueinitial.value
                let web3 = new Web3(Web3.givenProvider || "ws://localhost:8545");
                var ab = web3.utils.numberToHex(web3.utils.toWei(value));
                /* ----------------------------- new code start ----------------------------- */
                const video_uuid = $('#videoUId').val();

                /* ------------------------------ new code end ------------------------------ */
                console.log(ab)
                console.log(user_address)
                console.log(MY_ADDRESS)


                try {
                    console.log('in try')
                    const transactionHash = await ethereum.request({
                        method: 'eth_sendTransaction',
                        params: [{
                            'to': MY_ADDRESS,
                            'from': user_address,
                            'value': ab,
                        }, ],
                    })
                    // Handle the result
                    console.log("Hash = ", transactionHash);
                    if (window.ethereum.networkVersion) {
                        console.log('in if')
                        const currentChainId = window.ethereum.networkVersion;
                        uploadDonate(video_uuid, user_address, MY_ADDRESS, value, transactionHash,
                            currentChainId)
                    }
                } catch (error) {
                    console.error(error)
                }

                /* ---------------------- transation success code start --------------------- */
                function uploadDonate(video_uuid, user_address, MY_ADDRESS, value, transactionHash,
                    currentChainId) {
                    console.log(video_uuid, user_address, MY_ADDRESS, value, transactionHash,
                        currentChainId);
                    $.ajax({
                        url: "php/uploadDonate.php",
                        method: "POST",
                        dataType: "json",
                        data: {
                            video_uuid: video_uuid,
                            from_address: user_address,
                            to_address: MY_ADDRESS,
                            eth_price: value,
                            transation_hash: transactionHash,
                            current_chain_id: currentChainId
                        },
                        success: function(data) {
                            if (data.status == 201) {
                                console.log(data.success);
                                $('#transation_successfull_msg').css('display',
                                    'block');
                                $('#transation_failed_msg').css('display', 'none');
                                $("#transationLinkStyle").attr("href",
                                    `${data.transaction_url}`
                                );
                                $("#transationLink").text(data.transaction_hash);
                                $('#metamaskDonateModal').modal('hide');
                                $('#metamaskSuccessModal').modal('show');
                            } else if (data.status == 301) {
                                $('#transation_successfull_msg').css('display', 'none');
                                $('#transation_failed_msg').css('display', 'block');
                                console.log(data.error);
                            } else {}
                        }
                    });
                }
                /* ----------------------- transation success code end ---------------------- */
            })

            function renderMessage(message) {
                var messageEl = document.querySelector('.message')
                messageEl.innerHTML = message
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            var dollar_amount = $("#dollar_amount").val();
            var ethereum_amount = $("#price").val();
            $("#dollar1").click(function() {
                $("#dollar_amount").val(1);
                var chain = $('#selectNetworkChain').val();
                console.log(chain)
                let convFrom;
                if ($(this).prop("name") == "usd") {
                    convFrom = "usd";
                    convTo = "eth";
                } else {
                    convFrom = "eth";
                    convTo = "usd";
                }
                $.getJSON(`https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=${chain}`,

                    function(data) {
                        // var origAmount = parseFloat($("input[name='" + convFrom + "']").val());
                        var origAmount = 1;
                        var exchangeRate = parseFloat(data[0].current_price);
                        let amount;
                        console.log(origAmount)
                        console.log(convFrom)
                        console.log(convTo)
                        console.log(exchangeRate)
                        if (convFrom == "usd")
                            amount = parseFloat(origAmount * exchangeRate);
                        else
                            amount = parseFloat(origAmount / exchangeRate);
                        $("input[name='" + "eth" + "']").val(amount.toFixed(5));
                        console.log(amount)
                        if (convFrom == "usd")
                            price.innerHTML = amount
                        else
                            dollar_amount.innerHTML = amount
                    });
            });
            $("#dollar2").click(function() {
                $("#dollar_amount").val(2);
                var chain = $('#selectNetworkChain').val();
                let convFrom;
                if ($(this).prop("name") == "usd") {
                    convFrom = "usd";
                    convTo = "eth";
                } else {
                    convFrom = "eth";
                    convTo = "usd";
                }
                $.getJSON(`https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=${chain}`,

                    function(data) {
                        // var origAmount = parseFloat($("input[name='" + convFrom + "']").val());
                        var origAmount = 2;
                        var exchangeRate = parseFloat(data[0].current_price);
                        let amount;
                        console.log(origAmount)
                        console.log(convFrom)
                        console.log(convTo)
                        console.log(exchangeRate)
                        if (convFrom == "usd")
                            amount = parseFloat(origAmount * exchangeRate);
                        else
                            amount = parseFloat(origAmount / exchangeRate);
                        $("input[name='" + "eth" + "']").val(amount.toFixed(5));
                        console.log(amount)
                        if (convFrom == "usd")
                            price.innerHTML = amount
                        else
                            dollar_amount.innerHTML = amount
                    });
            });
            $("#dollar5").click(function() {
                $("#dollar_amount").val(5);
                var chain = $('#selectNetworkChain').val();
                let convFrom;
                if ($(this).prop("name") == "usd") {
                    convFrom = "usd";
                    convTo = "eth";
                } else {
                    convFrom = "eth";
                    convTo = "usd";
                }
                $.getJSON(`https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=${chain}`,

                    function(data) {
                        // var origAmount = parseFloat($("input[name='" + convFrom + "']").val());
                        var origAmount = 5;
                        var exchangeRate = parseFloat(data[0].current_price);
                        let amount;
                        console.log(origAmount)
                        console.log(convFrom)
                        console.log(convTo)
                        console.log(exchangeRate)
                        if (convFrom == "usd")
                            amount = parseFloat(origAmount * exchangeRate);
                        else
                            amount = parseFloat(origAmount / exchangeRate);
                        $("input[name='" + "eth" + "']").val(amount.toFixed(5));
                        console.log(amount)
                        if (convFrom == "usd")
                            price.innerHTML = amount
                        else
                            dollar_amount.innerHTML = amount
                    });
            });
            $("#dollar10").click(function() {
                $("#dollar_amount").val(10);
                var chain = $('#selectNetworkChain').val();
                let convFrom;
                if ($(this).prop("name") == "usd") {
                    convFrom = "usd";
                    convTo = "eth";
                } else {
                    convFrom = "eth";
                    convTo = "usd";
                }
                $.getJSON(`https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=${chain}`,

                    function(data) {
                        // var origAmount = parseFloat($("input[name='" + convFrom + "']").val());
                        var origAmount = 10;
                        var exchangeRate = parseFloat(data[0].current_price);
                        let amount;
                        console.log(origAmount)
                        console.log(convFrom)
                        console.log(convTo)
                        console.log(exchangeRate)
                        if (convFrom == "usd")
                            amount = parseFloat(origAmount * exchangeRate);
                        else
                            amount = parseFloat(origAmount / exchangeRate);
                        $("input[name='" + "eth" + "']").val(amount.toFixed(5));
                        console.log(amount)
                        if (convFrom == "usd")
                            price.innerHTML = amount
                        else
                            dollar_amount.innerHTML = amount
                    });
            });
            $("#dollar20").click(function() {
                $("#dollar_amount").val(20);
                var chain = $('#selectNetworkChain').val();
                let convFrom;
                if ($(this).prop("name") == "usd") {
                    convFrom = "usd";
                    convTo = "eth";
                } else {
                    convFrom = "eth";
                    convTo = "usd";
                }
                $.getJSON(`https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=${chain}`,

                    function(data) {
                        // var origAmount = parseFloat($("input[name='" + convFrom + "']").val());
                        var origAmount = 20;
                        var exchangeRate = parseFloat(data[0].current_price);
                        let amount;
                        console.log(origAmount)
                        console.log(convFrom)
                        console.log(convTo)
                        console.log(exchangeRate)
                        if (convFrom == "usd")
                            amount = parseFloat(origAmount * exchangeRate);
                        else
                            amount = parseFloat(origAmount / exchangeRate);
                        $("input[name='" + "eth" + "']").val(amount.toFixed(5));
                        console.log(amount)
                        if (convFrom == "usd")
                            price.innerHTML = amountabcnew
                        else
                            dollar_amount.innerHTML = amount
                    });
            });
            $("#dollar50").click(function() {
                $("#dollar_amount").val(50);
                var chain = $('#selectNetworkChain').val();
                let convFrom;
                if ($(this).prop("name") == "usd") {
                    convFrom = "usd";
                    convTo = "eth";
                } else {
                    convFrom = "eth";
                    convTo = "usd";
                }
                $.getJSON(`https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=${chain}`,

                    function(data) {
                        // var origAmount = parseFloat($("input[name='" + convFrom + "']").val());
                        var origAmount = 50;
                        var exchangeRate = parseFloat(data[0].current_price);
                        let amount;
                        console.log(origAmount)
                        console.log(convFrom)
                        console.log(convTo)
                        console.log(exchangeRate)
                        if (convFrom == "usd")
                            amount = parseFloat(origAmount * exchangeRate);
                        else
                            amount = parseFloat(origAmount / exchangeRate);
                        $("input[name='" + "eth" + "']").val(amount.toFixed(5));
                        console.log(amount)
                        if (convFrom == "usd")
                            price.innerHTML = amount
                        else
                            dollar_amount.innerHTML = amount
                    });
            });
            $("#dollar100").click(function() {
                $("#dollar_amount").val(100);
                var chain = $('#selectNetworkChain').val();
                let convFrom;
                if ($(this).prop("name") == "usd") {
                    convFrom = "usd";
                    convTo = "eth";
                } else {
                    convFrom = "eth";
                    convTo = "usd";
                }
                $.getJSON(`https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=${chain}`,

                    function(data) {
                        // var origAmount = parseFloat($("input[name='" + convFrom + "']").val());
                        var origAmount = 100;
                        var exchangeRate = parseFloat(data[0].current_price);
                        let amount;
                        console.log(origAmount)
                        console.log(convFrom)
                        console.log(convTo)
                        console.log(exchangeRate)
                        if (convFrom == "usd")
                            amount = parseFloat(origAmount * exchangeRate);
                        else
                            amount = parseFloat(origAmount / exchangeRate);
                        $("input[name='" + "eth" + "']").val(amount.toFixed(5));
                        console.log(amount)
                        if (convFrom == "usd")
                            price.innerHTML = amount
                        else
                            dollar_amount.innerHTML = amount
                    });
            });
        });
    </script>



    <script>
        $(".currencyField").keypress(function() { //input[name='calc']
            let convFrom;
            var chain = $('#selectNetworkChain').val();
            if ($(this).prop("name") == "usd") {
                convFrom = "usd";
                convTo = "eth";
            } else {
                convFrom = "eth";
                convTo = "usd";
            }
            $.getJSON(`https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=${chain}`,

                function(data) {
                    var origAmount = parseFloat($("input[name='" + convFrom + "']").val());
                    var exchangeRate = parseFloat(data[0].current_price);
                    let amount;
                    // console.log(origAmount)
                    // console.log(convFrom)
                    // console.log(convTo)
                    // console.log(exchangeRate)
                    if (convFrom == "eth")
                        amount = parseFloat(origAmount * exchangeRate);
                    else
                        amount = parseFloat(origAmount / exchangeRate);
                    $("input[name='" + convTo + "']").val(amount.toFixed(5));
                    console.log(amount)
                    if (convFrom == "usd")
                        price.innerHTML = amount
                    else
                        dollar_amount.innerHTML = amount
                });
        });

        function uploadIpfs(videoUId, ipfs_link) {
            $.ajax({
                url: "php/uploadIpfs.php",
                method: "POST",
                dataType: "json",
                data: {
                    videoUId: videoUId,
                    ipfs_url: ipfs_link,
                },
                success: function(data) {
                    if (data.status == 201) {
                        console.log(data.success);
                    } else if (data.status == 301) {
                        console.log(data.error);
                    } else {}
                }
            });
        }


        function selectChain() {
            var chain = $('#selectNetworkChain').val();
            $('#dollar_amount').val('');
            $('#price').val('');
            if (chain || (chain !== '')) {
                $('#donateArea').css('display', 'flex');
            } else {
                $('#donateArea').css('display', 'none');
            }
            if (window.ethereum.networkVersion && chain) {
                console.log(window.ethereum.networkVersion, chain);
                abcnew(chain);
            }

        }



        /* ------------------------ switch network code start ----------------------- */
        async function abcnew(chainValue) {
            var chainId = "1" // Ethereum Testnet
            var HexchainId = "0x1"; // Hex Ethereum Testnet
            var coinSymble = 'ETH';

            if (chainValue === "ethereum") {
                chainId = "1"; // Ethereum Testnet
                HexchainId = "0x1"; // Hex Ethereum Testnet
                coinSymble = 'ETH';
            } else if (chainValue === "binancecoin") {
                chainId = "97"; // BNB Testnet
                HexchainId = "0x61"; // Hex BNB Testnet
                coinSymble = 'BNB';
            } else if (chainValue === "celo") {
                chainId = "44787"; // CELO Testnet
                HexchainId = "0xAEF3"; // Hex CELO Testnet
                coinSymble = 'CELO';
            } else if (chainValue === "fantom") {
                chainId = "4002"; // FANTOM Testnet
                HexchainId = "0xFA2"; // Hex FANTOM Testnet
                coinSymble = 'FTM';
            } else if (chainValue === "avalanche-2") {
                chainId = "43113"; // AVAX Testnet
                HexchainId = "0xA869"; // Hex AVAX Testnet
                coinSymble = 'AVAX';
            } else if (chainValue === "klay-token") {
                chainId = "1001"; // KLAY Testnet
                HexchainId = "0x3E9"; // Hex KLAY Testnet
                coinSymble = 'KLAY';
            } else if (chainValue === "matic-network") {
                chainId = "137"; // MATIC Testnet
                HexchainId = "0x89"; // Hex MATIC Testnet
                coinSymble = 'MATIC';
            } else {
                chainId = "1"; // Ethereum Testnet
                HexchainId = "0x1"; // Hex Ethereum Testnet
                coinSymble = 'ETH';
            }
            $('#price_lable').text(coinSymble);
            if (window.ethereum.networkVersion !== chainId) {
                try {
                    await window.ethereum.request({
                        method: 'wallet_switchEthereumChain',
                        params: [{
                            chainId: HexchainId,
                        }],
                    });
                } catch (err) {
                    console.log(err);
                }
            }
        }
        /* ------------------------ switch network code end ----------------------- */

        // video like functionality start
        function like_me(video_uid, user_uid, like_status) {
            if (user_uid === '') {
                userLoginOut();
            } else {
                $.ajax({
                    url: "php/addLikeDislike.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        video_uid: video_uid,
                        user_uid: user_uid,
                        like_status: like_status,
                    },
                    success: function(data) {
                        if (data.status == 201) {
                            setLikeData(video_uid);
                        } else if (data.status == 301) {
                            console.log(data.error);
                        } else {}
                    }
                });
            }
        }

        function setLikeData(video_uid) {
            $.ajax({
                url: "php/fetchLikeDislike.php",
                method: "POST",
                dataType: "json",
                data: {
                    video_uid: video_uid,
                },
                success: function(data) {
                    if (data.status == 201) {
                        console.log(data);
                        $('#likeData').html(data.like);
                        $('#dislikeData').html(data.dislike);
                        $('#videoViews').html(data.views);
                    } else if (data.status == 301) {
                        console.log(data.error);
                    } else {}
                }
            });
        }

        function setViewData(video_uid) {
            $.ajax({
                url: "php/setVideoView.php",
                method: "POST",
                dataType: "json",
                data: {
                    video_uid: video_uid,
                },
                success: function(data) {
                    if (data.status == 201) {
                        console.log(data);
                    } else if (data.status == 301) {
                        console.log(data.error);
                    } else {}
                }
            });
        }

        const video_new_id = $('#videoUId').val();
        setLikeData(video_new_id);
        setViewData(video_new_id);
        // video like functionality end


        // crowdfunding start data 
        async function startProjectFunding(crowd_min_amount, ProjectAddress) {
            const user_donation_amount = $('#min_donation_in_eth').val();
            if (parseFloat(user_donation_amount) > 0) {
                if (parseFloat(user_donation_amount) >= parseFloat(crowd_min_amount)) {
                    if (window.ethereum) {
                        if ((window.ethereum.networkVersion) !== '1') {
                            changeNetwork('1');
                        } else {
                            $('#viewContributeModal').modal('hide');
                            $(".new-loader-wrapper").removeClass("d-none");
                            $(".new-loader-wrapper").addClass("d-flex");
                            console.log("This is DAppp Environment");
                            var accounts = await ethereum.request({
                                method: 'eth_requestAccounts'
                            });
                            var currentaddress = accounts[0];
                            web3 = new Web3(window.ethereum);

                            myProjectContract = new web3.eth.Contract(projectFunding, ProjectAddress);

                            await myProjectContract.methods.contribute().send({
                                from: currentaddress,
                                value: web3.utils.toWei(user_donation_amount.toString(), 'ether')
                            }).then((res) => {
                                console.log(res);
                                var formData = new FormData();
                                const video_uuid = $('#postUId').val();
                                const user_address = res.from;
                                const pay_amount = user_donation_amount;
                                const pay_amount_in = $('#amount_in').val();
                                const project_address = ProjectAddress;
                                const transactionHash = res.transactionHash;

                                formData.append('project_address', project_address);
                                formData.append('video_uuid', video_uuid);
                                formData.append('user_address', user_address);
                                formData.append('pay_amount', pay_amount);
                                formData.append('pay_amount_in', pay_amount_in);
                                formData.append('transactionHash', transactionHash);

                                $.ajax({
                                    url: 'php/crowd_funding.php',
                                    type: "POST",
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    data: formData,
                                    success: function() {
                                        toastr["success"]("Contribution added successfully");
                                        $(".new-loader-wrapper").addClass("d-none");
                                        window.location.reload();
                                    }
                                });

                            }).catch((err) => {
                                $(".new-loader-wrapper").addClass("d-none");
                                console.log(err);
                            });
                        }
                        $('#show_input_amount_error_eth').css('display', 'none');
                        $('#show_input_required_error_eth').css('display', 'none');
                    } else {
                        $(".new-loader-wrapper").addClass("d-none");
                        console.log("Please connect with metamask");
                    }
                } else {
                    $('#show_input_required_error_eth').css('display', 'none');
                    $('#show_input_amount_error_eth').css('display', 'block');
                }
            } else {
                $('#show_input_required_error_eth').css('display', 'block');
                $('#show_input_amount_error_eth').css('display', 'none');
            }
        }

        async function startProjectFundingMatic(crowd_min_amount, ProjectAddress) {
            const user_donation_amount = $('#min_donation_in_matic').val();
            if (parseFloat(user_donation_amount) > 0) {
                if (parseFloat(user_donation_amount) >= parseFloat(crowd_min_amount)) {
                    if (window.ethereum) {
                        if ((window.ethereum.networkVersion) !== '137') {
                            changeNetwork('89');
                        } else {
                            $('#viewContributeModal').modal('hide');
                            $(".new-loader-wrapper").removeClass("d-none");
                            $(".new-loader-wrapper").addClass("d-flex");
                            console.log("This is DAppp Environment");
                            var accounts = await ethereum.request({
                                method: 'eth_requestAccounts'
                            });
                            var currentaddress = accounts[0];
                            web3 = new Web3(window.ethereum);
                            myProjectContract = new web3.eth.Contract(maticProjectFunding, ProjectAddress);
                            await myProjectContract.methods.contribute().send({
                                from: currentaddress,
                                value: web3.utils.toWei(user_donation_amount.toString(), 'ether')
                            }).then((res) => {
                                console.log(res);
                                var formData = new FormData();
                                const video_uuid = $('#postUId').val();
                                const user_address = res.from;
                                const pay_amount = user_donation_amount;
                                const pay_amount_in = $('#amount_in').val();
                                const project_address = ProjectAddress;
                                const transactionHash = res.transactionHash;

                                formData.append('project_address', project_address);
                                formData.append('video_uuid', video_uuid);
                                formData.append('user_address', user_address);
                                formData.append('pay_amount', pay_amount);
                                formData.append('pay_amount_in', pay_amount_in);
                                formData.append('transactionHash', transactionHash);

                                $.ajax({
                                    url: 'php/crowd_funding.php',
                                    type: "POST",
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    data: formData,
                                    success: function() {
                                        toastr["success"]("Contribution added successfully");
                                        $(".new-loader-wrapper").addClass("d-none");
                                        window.location.reload();
                                    }
                                });

                            }).catch((err) => {
                                $(".new-loader-wrapper").addClass("d-none");
                                console.log(err);
                            });
                        }
                        $('#show_input_amount_error_matic').css('display', 'none');
                        $('#show_input_required_error_matic').css('display', 'none');
                    } else {
                        $(".new-loader-wrapper").addClass("d-none");
                        console.log("Please connect with metamask");
                    }
                } else {
                    $('#show_input_required_error_matic').css('display', 'none');
                    $('#show_input_amount_error_matic').css('display', 'block');
                }
            } else {
                $('#show_input_required_error_matic').css('display', 'block');
                $('#show_input_amount_error_matic').css('display', 'none');
            }
        }

        async function startProjectFundingBnb(crowd_min_amount, ProjectAddress) {
            const user_donation_amount = $('#min_donation_in_bnb').val();
            if (parseFloat(user_donation_amount) > 0) {
                if (parseFloat(user_donation_amount) >= parseFloat(crowd_min_amount)) {
                    if (window.ethereum) {
                        if ((window.ethereum.networkVersion) !== '97') {
                            changeNetwork('61');
                        } else {
                            $('#viewContributeModal').modal('hide');
                            $(".new-loader-wrapper").removeClass("d-none");
                            $(".new-loader-wrapper").addClass("d-flex");
                            console.log("This is DAppp Environment");
                            var accounts = await ethereum.request({
                                method: 'eth_requestAccounts'
                            });
                            var currentaddress = accounts[0];
                            web3 = new Web3(window.ethereum);
                            myProjectContract = new web3.eth.Contract(bnbProjectFunding, ProjectAddress);
                            await myProjectContract.methods.contribute().send({
                                from: currentaddress,
                                value: web3.utils.toWei(user_donation_amount.toString(), 'ether')
                            }).then((res) => {
                                console.log(res);
                                var formData = new FormData();
                                const video_uuid = $('#postUId').val();
                                const user_address = res.from;
                                const pay_amount = user_donation_amount;
                                const pay_amount_in = $('#amount_in').val();
                                const project_address = ProjectAddress;
                                const transactionHash = res.transactionHash;

                                formData.append('project_address', project_address);
                                formData.append('video_uuid', video_uuid);
                                formData.append('user_address', user_address);
                                formData.append('pay_amount', pay_amount);
                                formData.append('pay_amount_in', pay_amount_in);
                                formData.append('transactionHash', transactionHash);

                                $.ajax({
                                    url: 'php/crowd_funding.php',
                                    type: "POST",
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    data: formData,
                                    success: function() {
                                        toastr["success"]("Contribution added successfully");
                                        $(".new-loader-wrapper").addClass("d-none");
                                        window.location.reload();
                                    }
                                });

                            }).catch((err) => {
                                $(".new-loader-wrapper").addClass("d-none");
                                console.log(err);
                            });
                        }
                        $('#show_input_amount_error_bnb').css('display', 'none');
                        $('#show_input_required_error_bnb').css('display', 'none');
                    } else {
                        $(".new-loader-wrapper").addClass("d-none");
                        console.log("Please connect with metamask");
                    }
                } else {
                    $('#show_input_required_error_bnb').css('display', 'none');
                    $('#show_input_amount_error_bnb').css('display', 'block');
                }
            } else {
                $('#show_input_required_error_bnb').css('display', 'block');
                $('#show_input_amount_error_bnb').css('display', 'none');
            }
        }

        const number = $('#target_amount').val();
        const amount_in_view = $('#amount_in').val();
        const crowd_query_total_pay = $('#crowd_query_total_pay').val();
        console.log(crowd_query_total_pay, number)
        const percentage_pay = parseFloat(((parseFloat(crowd_query_total_pay) * 100) / parseFloat(number)).toFixed(2));
        console.log(percentage_pay);
        $('#span_percentage_view').text(percentage_pay);
        $('#percentage_view').text(percentage_pay);
        $('.progress-bar').css('width', `${percentage_pay}%`);

        const convertNumber = (number.toLocaleString('en-IN', {
            maximumFractionDigits: 3,
        }));

        const crowd_query_total_pay_view = ((parseFloat(crowd_query_total_pay).toFixed(5)).toLocaleString('en-IN', {
            maximumFractionDigits: 3,
        }));
        console.log(crowd_query_total_pay_view)
        $('.progress-bar').attr('aria-valuenow', percentage_pay)
        $('#crowd_query_total_pay_view').text(crowd_query_total_pay_view);
        $('#target_amount_view').text(convertNumber);
        $('.amount_in_view').text(amount_in_view);

        async function changeNetwork(chainId) {
            console.log(window.ethereum.networkVersion);
            if (window.ethereum.networkVersion !== chainId) {
                try {
                    await window.ethereum.request({
                        method: 'wallet_switchEthereumChain',
                        params: [{
                            chainId: `0x${chainId}`
                        }],
                    });
                } catch (err) {
                    console.log(err);
                }
            }
        }
        // crowdfunding end data

        $(function() {
            $('#viewContributeModal').css('display', 'block');
            $(".avatar-image").letterpic({
                colors: [
                    "#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e", "#16a085", "#27ae60",
                    "#2980b9",
                    "#8e44ad", "#2c3e50",
                    "#f1c40f", "#e67e22", "#e74c3c", "#ecf0f1", "#95a5a6", "#f39c12", "#d35400",
                    "#c0392b",
                    "#bdc3c7", "#7f8c8d"
                ],
                font: 'Inter'
            });
        });

        $(document).ready(function() {
            $('#viewContributeModal').css('display', 'none');
        });

        $(document).ready(function() {
            $('#submitComments').on('click', function(e) {
                e.preventDefault();
                var error = "";
                var formData = new FormData();

                if ($('#editorComment').val() == "") {
                    $('#editorComment').css('cssText', 'border-color: red !important');
                    error = error + 'editorComment';
                } else {
                    formData.append('editorComment', $('#editorComment').val());
                }

                formData.append('video_uid_comment', $('#video_uuid_comment').val());
                formData.append('user_uid_comment', $('#user_uid_comment').val());


                if (error == "") {
                    //console.log(formData);
                    $.ajax({
                        url: "php/addComments.php",
                        type: "POST",
                        dataType: "json",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,

                        success: function(data) {
                            //console.log(data);
                            if (data.status == 201) {

                                window.location.reload();
                                //toastr["success"]("Comment Added");


                            } else if (data.status == 501) {

                                //swal("Tag already exist");

                            } else if (data.status == 301) {
                                //console.log(data.error);
                                //swal("error");

                            }
                        }
                    });
                } else {

                }
            });
        });
    </script>
    <script>
        function delcomment(user_uid, comment_uid) {
            $.ajax({
                url: "php/deletecomment.php",
                method: "POST",
                dataType: "json",
                data: {
                    user_uid: user_uid,
                    comment_uid: comment_uid
                },
                success: function(data) {
                    if (data.status == 201) {
                        window.location.reload();
                    } else if (data.status == 301) {
                        console.log(data.error);
                    } else {
                        //     swal("problem with query");
                    }
                }
            });
        }
    </script>
    <script>
        function subdelcomment(user_uid, subcomment_uid) {
            $.ajax({
                url: "php/deletesubcomment.php",
                method: "POST",
                dataType: "json",
                data: {
                    user_uid: user_uid,
                    subcomment_uid: subcomment_uid
                },
                success: function(data) {
                    if (data.status == 201) {
                        window.location.reload();
                    } else if (data.status == 301) {
                        console.log(data.error);
                    } else {
                        //     swal("problem with query");
                    }
                }
            });
        }

        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        }

        var oldTime = 0.00;
        setInterval(() => {
            const videoId = document.querySelector("video");
            const dbData = Math.round(parseFloat($('#total_view_in_sec').val()));
            const newTime = Math.round(parseFloat(videoId.currentTime));
            const user_uid = $('#user_uid').val();
            var prev = Math.round(parseFloat(getCookie('time')));
            const is_cookies = $.cookie('time');
            if (is_cookies || is_cookies !== undefined || is_cookies !== null) {
                if (prev < dbData) {
                    prev = dbData;
                } else {
                    prev = prev;
                }
            } else {
                prev = dbData;
            }

            if (oldTime < newTime) {
                if (prev) {
                    const resultdate = prev + (10);
                    document.cookie = `time=${resultdate}; expires=Tue, 19 Jan 2038 04:14:07 GMT`;
                    $.ajax({
                        url: "php/dashboardData/setTimeSpendData.php",
                        method: "POST",
                        dataType: "json",
                        data: {
                            user_uid: user_uid,
                            view_in_sec: resultdate
                        },
                        success: function(data) {
                            if (data.status == 201) {
                                console.log(data.status);
                            } else if (data.status == 301) {
                                console.log(data.error);
                            } else {
                                //     swal("problem with query");
                            }
                        }
                    });
                } else {
                    const resultdate = newTime;
                    document.cookie = `time=${resultdate}; expires=Tue, 19 Jan 2038 04:14:07 GMT`;
                }
                console.log(newTime);
                oldTime = newTime;
            }
        }, 10000);
    </script>
    <script>
        $('#Demo2').socialSharingPlugin({
            url: window.location.href,
            title: $('meta[property="og:title"]').attr('content'),
            description: $('meta[property="og:description"]').attr('content'),
            img: $('meta[property="og:image"]').attr('content'),
            responsive: false,
            mobilePosition: 'left',
            enable: ['copy', 'facebook', 'twitter', 'pinterest', 'linkedin', 'reddit', 'stumbleupon', 'pocket', 'email', 'whatsapp']
        });

        function openShareModel() {
            $('#viewShareModal').modal('show');
        }
    </script>
</body>

</html>
<?php
?>b