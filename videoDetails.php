<?php
session_start();
require_once('php/link.php');
$user_address = '';
if (isset($_SESSION['userAddress'])) {
    $user_address = $_SESSION['userAddress'];
} else {
    $user_address = '';
}

if (isset($_SESSION['userAddress'])) {
    $metamask_address = $_SESSION['userAddress'];
    $username = '';

    if (isset($_SESSION['$username'])) {
        $username = $_SESSION['$username'];
    }

    $sql = "SELECT * FROM user_login  WHERE metamask_address = '$metamask_address'";
    $run_Sql = mysqli_query($con, $sql);
    if ($run_Sql) {
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        if (!empty($fetch_info)) {
            $first_time_login = $fetch_info['first_time_login'];
            if ($first_time_login !== 'true') {
                header("Location: signup-user");
            } else {
                $_SESSION['username'] = $fetch_info['username'];
                $username = $_SESSION['username'];
            }
        } else {
            session_unset();
            session_destroy();
            header("location:index");
        }
    }
}
$video_uuid = '';
$video_uuid_new = '';
$total_unique_contributor = '';
if (isset($_GET['course']) && isset($_GET['module'])) {
    $course = $_GET['course'];
    $module = $_GET['module'];

    $result2 = mysqli_query($con, "SELECT * FROM `video_info` WHERE `video_uuid` = '$course' AND `module_uuid` = '$module'");
    if (mysqli_num_rows($result2) > 0) {
        while ($row = mysqli_fetch_assoc($result2)) {
            $thumbnail = $row['thumbnail_ipfs'];
            $video_id = $row['video_uid'];
            $thumbnail_id = $row['thumbnail_ipfs'];
            $video_ipfs = $row['video_uid'];
            $video_uuid = $row['video_uuid'];
            $chapter_part = $row['video_id'];
            $chapter_name = $row['name'];
            $chapter_id = $row['video_id'];
            $module_name = $row['module'];
            $chapter_desc = $row['video_desc'];
            $video_uuid = $row['video_uuid'];
            $module_id = $row['module_uuid'];
            $date = $row['from_time'];

            $is_crowdfunded = $row['is_croudfunded'];;
            $crowd_min_amount = $row['minimum_pay'];
            $project_address = $row['project_address'];
            $project_creator = $row['project_creator'];
            $minimum_pay = $row['minimum_pay'];
            $target_amount = $row['target_amount'];
            $amount_in = $row['amount_in'];
            $project_uri_link = $row['project_uri_link'];
            $project_uri = $row['project_uri_link'];
            $created_at = $row['from_time'];
        }
    } else {
        header("Location: courses");
    }
} else {
    header("Location: courses");
}

$video_uuid_new = $video_uuid;

// croud funding data get start 
$crowd_query_1 = "SELECT `video_uuid`, sum(pay_amount) as total_pay,`project_address` FROM `crowd_fund` WHERE `video_uuid`='$video_uuid' GROUP BY `video_uuid`,`project_address` ORDER by total_pay DESC;";

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
// croud funding data get end
$get_view_query_new = "SELECT count(distinct user_address) as total_contributor FROM crowd_fund WHERE `video_uuid`='$video_uuid_new';";
$result_view_new = mysqli_query($con, $get_view_query_new);
if (mysqli_num_rows($result_view_new) > 0) {
    while ($row_view_new = mysqli_fetch_array($result_view_new)) {
        $total_unique_contributor = $row_view_new['total_contributor'];
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
    <meta property="og:image" itemprop="image" content="https://finflix.finstreet.in/<?php echo $img_link2 ?>fin-logo.jpg" />
    <meta property="og:image:secure_url" itemprop="image" content="https://finflix.finstreet.in/<?php echo $img_link2 ?>fin-logo.jpg" />
    <meta property="og:image:width" content="269">
    <meta property="og:image:height" content="67">
    <meta property="og:type" content="website" />

    <!-- Favicon location for example :  images/cropped-Fin-270x270.jpg -->
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />

    <!-- Enter Page Specific CSS here. Please make sure all the CSS  -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Typography CSS -->
    <link rel="stylesheet" href="css/typography.css">
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Responsive -->
    <link rel="stylesheet" href="css/responsive.css" />
    <link rel="stylesheet" href="css/mobileDrawer.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="css/extra-setting.css">
    <link rel="stylesheet" href="assets/css/croudFundingUI.css">
    <link rel="stylesheet" href="assets/css/circle_progress_bar.css">
    <style>
        .icon {
            display: block;
            font-size: 5rem;
            color: #fff;
        }

        .icon:hover {
            color: #fff;
        }

        .drop-zone {
            max-width: 100%;
            height: 200px;
            padding: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-family: "Quicksand", sans-serif;
            font-weight: 500;
            font-size: 20px;
            cursor: pointer;
            color: #cccccc;
            border: 2px dashed #ccc;
            border-radius: 10px;
        }

        .drop-zone--over {
            border-style: solid;
        }

        .drop-zone__input {
            display: none;
        }

        .drop-zone__thumb {
            width: 100%;
            height: 100%;
            border-radius: 10px;
            overflow: hidden;
            background-color: #cccccc;
            background-size: cover;
            position: relative;
        }

        .drop-zone__thumb::after {
            content: attr(data-label);
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 5px 0;
            color: #ffffff;
            background: rgba(0, 0, 0, 0.75);
            font-size: 14px;
            text-align: center;
        }

        input {
            border: 1px solid #009578;
            border-radius: 5px;
            padding: 5px;
            background-color: #cccccc;
        }

        .btn {
            position: relative;
            padding: 8px 16px;
            background: rgb(0 98 204);
            border: none;
            outline: none;
            border-radius: 2px;
            cursor: pointer;
        }

        .btn:active {
            background: rgb(0 98 204);
        }

        .button__text {
            color: #ffffff;
            transition: all 0.2s;
        }

        .button--loading .button__text {
            visibility: hidden;
            opacity: 0;
        }

        .button--loading::after {
            content: "";
            position: absolute;
            width: 26px;
            height: 26px;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            border: 4px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: button-loading-spinner 1s ease infinite;
        }

        .swal-modal {
            background-color: #222 !important;
        }

        .swal-modal .swal-title,
        .swal-modal .swal-text {
            color: #ccc !important;
        }

        .swal-icon--success__hide-corners,
        .swal-icon--success:after,
        .swal-icon--success:before {
            background-color: #222 !important;
        }

        @keyframes button-loading-spinner {
            from {
                transform: rotate(0turn);
            }

            to {
                transform: rotate(1turn);
            }
        }

        .pointer-event-none {
            pointer-events: none;
        }

        .pointer {
            cursor: not-allowed;
        }

        .padding-data {
            padding-top: 7rem;
        }

        .button {
            color: #000;
            border: none;
            padding: 10px 30px;
            border-radius: 5px;
            cursor: pointer;
        }

        .button:hover {
            color: #ccc;
        }

        a:not([href]):not([tabindex]) {
            color: #000;
        }

        .table thead th {
            vertical-align: top;

        }

        .truncate-text {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            width: 50px;
        }

        .card2 {
            width: 50%;
        }

        .table-container {
            overflow-x: auto;
        }

        @media screen and (max-width: 991px) {
            .container {
                display: flex;
                flex-direction: column;
            }

            .card {
                width: 100%;
            }

            .card2 {
                width: 100%;
            }

            .form-container {
                width: 100% !important;
            }
        }

        @media screen and (max-width: 576px) {
            .container {
                display: flex;
                flex-direction: column;
            }

            .card {
                width: 100%;
            }

            .card2 {
                width: 100%;
            }

            .form-container {
                width: 100% !important;
            }
        }

        .progress-bar {
            display: flex;
            position: relative;
            bottom: 0;
            left: 0;
            width: 0;
            height: 100%;
            border-radius: inherit;
            background-color: #007bff;
        }

        .target-view-wrapper {
            display: flex;
            justify-content: space-between;
        }

        p {
            color: #aaa;
            margin-top: 5px;
        }

        .get-view-wrapper {
            margin-bottom: 0.08rem;
        }

        .target-view-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 0.55rem;
        }
    </style>
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

</body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-53J6JBV" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- loader Start -->
<div id="loading">
    <div id="loading-center">
    </div>
</div>
<input type="hidden" name="total_time_to_reward_in_hr" value="<?= $total_time_to_reward_in_hr ?>" id="total_time_to_reward_in_hr">
<input type="hidden" name="total_view_in_sec" value="<?= $total_view_in_sec ?>" id="total_view_in_sec">
<!-- loader END -->
<?php
$user_img = '#';
?>
<!-- Header -->
<!-- desktop header -->
<input type="hidden" id="user_address" name="user_address" value="<?php echo $user_address; ?>">
<input type="hidden" name="projectAddress" id="projectAddress" value="<?= $project_address ?>">
<input type="hidden" name="postUId" id="postUId" value="<?= $post_uid ?>">
<input type="hidden" name="target_amount" id="target_amount" value="<?= $target_amount ?>">
<input type="hidden" name="amount_in" id="amount_in" value="<?= $amount_in ?>">
<input type="hidden" name="crowd_query_total_pay" id="crowd_query_total_pay" value="<?= $crowd_query_total_pay ?>">
<div class="d-none d-lg-block">
    <header id="main-header2">
        <div class="main-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <nav class="navbar navbar-expand-lg navbar-light p-0">
                            <a href="#" class="navbar-toggler c-toggler" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <div class="navbar-toggler-icon" data-toggle="collapse">
                                    <span class="navbar-menu-icon navbar-menu-icon--top"></span>
                                    <span class="navbar-menu-icon navbar-menu-icon--middle"></span>
                                    <span class="navbar-menu-icon navbar-menu-icon--bottom"></span>
                                </div>
                            </a>
                            <a class="navbar-brand" href="./index"> <img class="img-fluid logo" src="images/logo.png" alt="Finflix" /> </a>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <div class="menu-main-menu-container">
                                    <ul id="top-menu" class="navbar-nav ml-auto">
                                        <li class="menu-item">
                                            <a href="./index">Home</a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="./courses">Videos</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mobile-more-menu">
                                <a href="javascript:void(0);" class="more-toggle" id="dropdownMenuButton" data-toggle="more-toggle" aria-haspopup="true" aria-expanded="false">
                                    <i class="ri-more-line"></i>
                                </a>
                                <div class="more-menu" aria-labelledby="dropdownMenuButton">
                                    <div class="navbar-right position-relative">
                                        <ul class="d-flex align-items-center justify-content-end list-inline m-0">
                                            <li>
                                                <a href="#" class="search-toggle">
                                                    <i class="ri-search-line"></i>
                                                </a>
                                                <div class="search-box iq-search-bar">
                                                    <form action="search" class="searchbox" method="get">
                                                        <div class="form-group position-relative">
                                                            <input type="text" class="text search-input font-size-12" placeholder="type here to search..." name="query">
                                                            <i class="search-link ri-search-line"></i>
                                                        </div>
                                                    </form>
                                                </div>
                                            </li>
                                            <?php
                                            if ($user_address !== null && $user_address !== '') {
                                            ?>
                                                <li>
                                                    <a href="#" class="iq-user-dropdown search-toggle d-flex align-items-center">
                                                        <img src="./images/user.png" class="img-fluid avatar-40 rounded-circle" alt="user">
                                                    </a>
                                                    <div class="iq-sub-dropdown iq-user-dropdown">
                                                        <div class="iq-card shadow-none m-0">
                                                            <div class="iq-card-body p-0 pl-3 pr-3">
                                                                ri-settings-4-line <a href="userDashboard" class="iq-sub-card setting-dropdown">
                                                                    <div class="media align-items-center">
                                                                        <div class="right-icon">
                                                                            <i class="ri-user-2-line text-primary"></i>
                                                                        </div>
                                                                        <div class="media-body ml-3">
                                                                            <h6 class="mb-0 ">
                                                                                <?php echo $username ?>
                                                                            </h6>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <a href="./upload" class="iq-sub-card setting-dropdown">
                                                                    <div class="media align-items-center">
                                                                        <div class="right-icon">
                                                                            <i class="ri-file-upload-line text-primary"></i>
                                                                        </div>
                                                                        <div class="media-body ml-3">
                                                                            <h6 class="mb-0 ">Upload Video</h6>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <a href="./userVideosList" class="iq-sub-card setting-dropdown">
                                                                    <div class="media align-items-center">
                                                                        <div class="right-icon">
                                                                            <i class="ri-file-list-line text-primary"></i>
                                                                        </div>
                                                                        <div class="media-body ml-3">
                                                                            <h6 class="mb-0 ">My Videos</h6>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <a href="./favourite" class="iq-sub-card setting-dropdown">
                                                                    <div class="media align-items-center">
                                                                        <div class="right-icon">
                                                                            <i class="ri-settings-4-line text-primary"></i>
                                                                        </div>
                                                                        <div class="media-body ml-3">
                                                                            <h6 class="mb-0 ">My Favourite</h6>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <a href="logout" class="iq-sub-card setting-dropdown">
                                                                    <div class="media align-items-center">
                                                                        <div class="right-icon">
                                                                            <i class="ri-logout-circle-line text-primary"></i>
                                                                        </div>
                                                                        <div class="media-body ml-3">
                                                                            <h6 class="mb-0">Logout</h6>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php } else { ?>
                                                <li>
                                                    <div class="hover-buttons">
                                                        <a href="javascript:void(0)" class="btn btn-hover buttonText" style="font-size:1rem;" onclick="userLoginOut()">Sign In</a>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="navbar-right menu-right">
                                <ul class="d-flex align-items-center list-inline m-0 d-flex gap-16">
                                    <?php
                                    if ($user_address !== null && $user_address !== '') {
                                    ?>
                                        <li class="nav-item nav-icon">
                                            <div class="my-progress-bar"></div>
                                        </li>
                                    <?php } ?>
                                    <li class="nav-item nav-icon">
                                        <a href="#" class="search-toggle device-search">
                                            <i class="ri-search-line"></i>
                                        </a>
                                        <div class="search-box iq-search-bar d-search">
                                            <form action="search" class="searchbox" method="get">
                                                <div class="form-group position-relative">
                                                    <input type="text" class="text search-input font-size-12" placeholder="type here to search..." name="query">
                                                    <i class="search-link ri-search-line"></i>
                                                </div>
                                            </form>
                                        </div>
                                    </li>
                                    <?php
                                    if ($user_address !== null && $user_address !== '') {
                                    ?>
                                        <li class="nav-item nav-icon">
                                            <a href="#" class="iq-user-dropdown search-toggle p-0 d-flex align-items-center" data-toggle="search-toggle">
                                                <img src="./images/user.png" class="img-fluid avatar-40 rounded-circle" alt="user">
                                            </a>
                                            <div class="iq-sub-dropdown iq-user-dropdown">
                                                <div class="iq-card shadow-none m-0">
                                                    <div class="iq-card-body p-0 pl-3 pr-3">
                                                        <a href="userDashboard" class="iq-sub-card setting-dropdown">
                                                            <div class="media align-items-center">
                                                                <div class="right-icon">
                                                                    <i class="ri-user-2-line text-primary"></i>
                                                                </div>
                                                                <div class="media-body ml-3">
                                                                    <h6 class="mb-0 ">
                                                                        <?php echo $username ?>
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="./upload" class="iq-sub-card setting-dropdown">
                                                            <div class="media align-items-center">
                                                                <div class="right-icon">
                                                                    <i class="ri-file-upload-line text-primary"></i>
                                                                </div>
                                                                <div class="media-body ml-3">
                                                                    <h6 class="mb-0 ">Upload Video</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="./userVideosList" class="iq-sub-card setting-dropdown">
                                                            <div class="media align-items-center">
                                                                <div class="right-icon">
                                                                    <i class="ri-file-list-line text-primary"></i>
                                                                </div>
                                                                <div class="media-body ml-3">
                                                                    <h6 class="mb-0 ">My Videos</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="./favourite" class="iq-sub-card setting-dropdown">
                                                            <div class="media align-items-center">
                                                                <div class="right-icon">
                                                                    <i class="ri-settings-4-line text-primary"></i>
                                                                </div>
                                                                <div class="media-body ml-3">
                                                                    <h6 class="mb-0 ">My Favourite</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="logout" class="iq-sub-card setting-dropdown">
                                                            <div class="media align-items-center">
                                                                <div class="right-icon">
                                                                    <i class="ri-logout-circle-line text-primary"></i>
                                                                </div>
                                                                <div class="media-body ml-3">
                                                                    <h6 class="mb-0 ">Logout</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php } else { ?>
                                        <li>
                                            <div class="hover-buttons">
                                                <a href="javascript:void(0)" class="btn btn-hover buttonText" style="font-size:1rem;" onclick="userLoginOut()">Sign In</a>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </nav>
                        <div class="nav-overlay"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
<!-- desktop header end -->
<!-- mobile header start -->
<div class="d-lg-none position-relative">
    <header id="main-header" class="menu-sticky">
        <div class="main-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <nav class="navbar navbar-expand-lg navbar-light p-0">
                            <a class="navbar-brand" href="./index"> <img class="img-fluid logo" src="images/logo.png" alt="Finflix" / style="width:120px;"> </a>
                            <div class="mobile-more-menu">
                                <div class="more-menus" aria-labelledby="dropdownMenuButton">
                                    <div class="navbar-right position-relative">
                                        <ul class="d-flex align-items-center justify-content-end list-inline m-0">
                                            <li>
                                                <a href="#" class="search-toggle">
                                                    <i class="ri-search-line"></i>
                                                </a>
                                                <div class="search-box iq-search-bar">
                                                    <form action="search" class="searchbox" method="get">
                                                        <div class="form-group position-relative">
                                                            <input type="text" class="text search-input font-size-12" placeholder="type here to search..." name="query">
                                                            <i class="search-link ri-search-line"></i>
                                                        </div>
                                                    </form>
                                                </div>
                                            </li>
                                            <?php
                                            if ($user_address !== null && $user_address !== '') {
                                            ?>
                                                <li>
                                                    <a href="#" class="iq-user-dropdown search-toggle d-flex align-items-center">
                                                        <img src="./images/user.png" class="img-fluid avatar-40 rounded-circle" alt="user">
                                                    </a>
                                                    <div class="iq-sub-dropdown iq-user-dropdown">
                                                        <div class="iq-card shadow-none m-0">
                                                            <div class="iq-card-body p-0 pl-3 pr-3">
                                                                <a href="userDashboard" class="iq-sub-card setting-dropdown">
                                                                    <div class="media align-items-center">
                                                                        <div class="right-icon">
                                                                            <i class="ri-user-2-line text-primary"></i>
                                                                        </div>
                                                                        <div class="media-body ml-3">
                                                                            <h6 class="mb-0 ">
                                                                                <?php echo substr($user_address, 0, 5) ?>...<?php echo substr($user_address, -5) ?>
                                                                            </h6>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <a href="./upload" class="iq-sub-card setting-dropdown">
                                                                    <div class="media align-items-center">
                                                                        <div class="right-icon">
                                                                            <i class="ri-file-upload-line text-primary"></i>
                                                                        </div>
                                                                        <div class="media-body ml-3">
                                                                            <h6 class="mb-0 ">Upload Video</h6>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <a href="./userVideosList" class="iq-sub-card setting-dropdown">
                                                                    <div class="media align-items-center">
                                                                        <div class="right-icon">
                                                                            <i class="ri-file-list-line text-primary"></i>
                                                                        </div>
                                                                        <div class="media-body ml-3">
                                                                            <h6 class="mb-0 ">My Videos</h6>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <a href="./favourite" class="iq-sub-card setting-dropdown">
                                                                    <div class="media align-items-center">
                                                                        <div class="right-icon">
                                                                            <i class="ri-settings-4-line text-primary"></i>
                                                                        </div>
                                                                        <div class="media-body ml-3">
                                                                            <h6 class="mb-0 ">My Favourite</h6>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <a href="logout" class="iq-sub-card setting-dropdown">
                                                                    <div class="media align-items-center">
                                                                        <div class="right-icon">
                                                                            <i class="ri-logout-circle-line text-primary"></i>
                                                                        </div>
                                                                        <div class="media-body ml-3">
                                                                            <h6 class="mb-0">Logout</h6>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php } else { ?>
                                                <li>
                                                    <div class="hover-buttons">
                                                        <a href="javascript:void(0)" class="btn btn-hover buttonText" style="font-size:1rem;" onclick="userLoginOut()">Sign In</a>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="navbar-right menu-right">
                                <ul class="d-flex align-items-center list-inline m-0">
                                    <li class="nav-item nav-icon">
                                        <a href="#" class="search-toggle device-search">
                                            <i class="ri-search-line"></i>
                                        </a>
                                        <div class="search-box iq-search-bar d-search">
                                            <form action="search" class="searchbox" method="get">
                                                <div class="form-group position-relative">
                                                    <input type="text" class="text search-input font-size-12" placeholder="type here to search..." name="query">
                                                    <i class="search-link ri-search-line"></i>
                                                </div>
                                            </form>
                                        </div>
                                    </li>
                                    <?php
                                    if ($user_address !== null && $user_address !== '') {
                                    ?>
                                        <li class="nav-item nav-icon">
                                            <a href="#" class="iq-user-dropdown search-toggle p-0 d-flex align-items-center" data-toggle="search-toggle">
                                                <img src="./images/user.png" class="img-fluid avatar-40 rounded-circle" alt="user">
                                            </a>
                                            <div class="iq-sub-dropdown iq-user-dropdown">
                                                <div class="iq-card shadow-none m-0">
                                                    <div class="iq-card-body p-0 pl-3 pr-3">
                                                        <a href="userDashboard" class="iq-sub-card setting-dropdown">
                                                            <div class="media align-items-center">
                                                                <div class="right-icon">
                                                                    <i class="ri-user-2-line text-primary"></i>
                                                                </div>
                                                                <div class="media-body ml-3">
                                                                    <h6 class="mb-0 ">
                                                                        <?php echo substr($user_address, 0, 5) ?>...<?php echo substr($user_address, -5) ?>
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="./upload" class="iq-sub-card setting-dropdown">
                                                            <div class="media align-items-center">
                                                                <div class="right-icon">
                                                                    <i class="ri-file-upload-line text-primary"></i>
                                                                </div>
                                                                <div class="media-body ml-3">
                                                                    <h6 class="mb-0 ">Upload Video</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="./userVideosList" class="iq-sub-card setting-dropdown">
                                                            <div class="media align-items-center">
                                                                <div class="right-icon">
                                                                    <i class="ri-file-list-line text-primary"></i>
                                                                </div>
                                                                <div class="media-body ml-3">
                                                                    <h6 class="mb-0 ">My Videos</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="./favourite" class="iq-sub-card setting-dropdown">
                                                            <div class="media align-items-center">
                                                                <div class="right-icon">
                                                                    <i class="ri-user-2-line text-primary"></i>
                                                                </div>
                                                                <div class="media-body ml-3">
                                                                    <h6 class="mb-0 ">My Favourite</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="logout" class="iq-sub-card setting-dropdown">
                                                            <div class="media align-items-center">
                                                                <div class="right-icon">
                                                                    <i class="ri-logout-circle-line text-primary"></i>
                                                                </div>
                                                                <div class="media-body ml-3">
                                                                    <h6 class="mb-0 ">Logout</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php } else { ?>
                                        <li>
                                            <div class="hover-buttons">
                                                <a href="javascript:void(0)" class="btn btn-hover buttonText" style="font-size:1rem;" onclick="userLoginOut()">Sign In</a>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </nav>
                        <div class="nav-overlay"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- bottom fix start-->
    <div class="bottom-nav">
        <div class="bottom-nav-item" id="home">
            <div class="bottom-nav-link">
                <i class="ri-home-4-line"></i>
                <span>Home</span>
            </div>
        </div>
        <div class="bottom-nav-item" id="courses">
            <div class="bottom-nav-link">
                <i class="ri-book-open-line"></i>
                <span>Videos</span>
            </div>
        </div>
    </div>
    <!-- bottom fix end-->
</div>
<!-- mobile header end -->
<!-- Header End -->
<!-- Body Start -->
<?php
if ($user_address == null || $user_address == '') {
?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        swal({
            title: "Please Login in first!",
            text: "Please login in first to access this page.",
            icon: "warning",
            button: 'Ok',
            dangerMode: true,
        }).then((value) => {
            window.location.href = "/";
        })
    </script>
<?php } else { ?>
    <div class="container main-content padding-data">
        <div class="row">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <h3 class="text-center">Video Details</h3>
            </div>
        </div>
        <div class="container p-lg-5 p-md-4 p-sm-3 d-flex justify-content-center align-item-center" style="margin-top: 30px; box-shadow:10px 10px 60px 40px rgb(72 89 171 / 18%); gap:2rem;">
            <div class="p-3 d-flex align-item-center border form-container card bg-dark w-75" style="width: auto;">
                <img class="card-img-top" style="padding: 0.3rem;" src="<?= $thumbnail_id ?>" alt="Card image cap">
                <div class="mt-5 mb-3">
                    <h5 class="card-title" style="font-size: 1.4rem;">Name of the Video</h5>
                    <p class="card-text"><?php echo $chapter_name ?></p>
                </div>
                <div class="my-3">
                    <h5 class="card-title" style="font-size: 1.4rem;">Description</h5>
                    <p class="card-text"><?php echo $chapter_desc ?></p>
                </div>
                <div class="my-3">
                    <h5 class="card-title" style="font-size: 1.4rem;">Category</h5>
                    <p class="card-text"><?php echo $module_name ?></p>
                </div>
                <div class="my-3">
                    <h5 class="card-title" style="font-size: 1.4rem;">Date of Upload</h5>
                    <p class="card-text"><?php echo $date ?></p>
                </div>
            </div>
            <div class="card2">
                <div class="btn-conatiner d-flex justify-content-around">
                    <a style="text-decoration: none;" class="button btn-success" href="videoPlayer.php?course=<?= $video_uuid ?>&module=<?= $module_id ?>">Play</a>
                    <a style="text-decoration: none;" class="button btn-warning" href="editVideo.php?course=<?= $video_uuid ?>&module=<?= $module_id ?>">Edit</a>
                    <a class="button btn-danger" style="text-decoration: none;" id="deleteVideo_<?php echo $chapter_part ?>" onclick="return deleteVideo()">Delete
                        <input type="hidden" name="video_uuid" id="video_uuid" value="<?= $video_uuid ?>">
                    </a>
                </div>
                <?php
                if ($is_crowdfunded === 'false') {
                ?>
                    <!-- tipping details start -->
                    <div class="tipping-details my-5 p-4 shadow" style="background:#201f1f">
                        <?php
                        $total_eth_donation_on_video = mysqli_query($con, "SELECT SUM(eth_price) FROM `donate_eth` WHERE current_coin_symble = 'ETH' AND video_id ='$video_uuid';");
                        $total_matic_donation_on_video = mysqli_query($con, "SELECT SUM(eth_price) FROM `donate_eth` WHERE current_coin_symble = 'MATIC' AND video_id ='$video_uuid';");
                        // Eth donation on video
                        $total_eth_donation_on_video = mysqli_fetch_array($total_eth_donation_on_video);
                        $total_eth_donation_on_video = number_format($total_eth_donation_on_video[0], 5);
                        // Matic donation on video
                        $total_matic_donation_on_video = mysqli_fetch_array($total_matic_donation_on_video);
                        $total_matic_donation_on_video = number_format($total_matic_donation_on_video[0], 5);
                        ?>
                        <div>
                            <h5 class="my-1">Total Tipping in ETH</h5>
                            <p><?php echo $total_eth_donation_on_video ?> ETH</p>
                        </div>
                        <div>
                            <h5 class="my-1">Total Tipping in MATIC</h5>
                            <p><?php echo $total_matic_donation_on_video ?> MATIC</p>
                        </div>
                    </div>
                    <div class="contributors my-2">
                        <h5 class="my-1" style="font-size: 1.5rem;">Top Contributors</h5>
                        <div class="table-container">
                            <table class="table table-striped my-4">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" style="width: fit-content;">Sender</th>
                                        <th scope="col" style="width: fit-content;">Amount</th>
                                        <th scope="col" style="width: fit-content;">Transaction Link</th>
                                        <th scope="col" style="width: fit-content;">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($con, "SELECT * FROM `donate_eth` WHERE `video_id` = '$video_uuid' ORDER BY eth_price DESC LIMIT 5;");

                                    if (mysqli_num_rows($query) != 0) {
                                        while ($row = mysqli_fetch_array($query)) {
                                            $from_user_address = $row['from_user_address'];
                                            $eth_price = $row['eth_price'] . ' ' . $row['current_coin_symble'];
                                            $date = $row['from_time'];
                                            $txn_link = $row['txn_network_url'] . $row['transation_hash'];
                                    ?>
                                            <tr>
                                                <th class="truncate-text"><?php echo substr($from_user_address, 0, 8) . "..." ?></th>
                                                <td class="truncate-text"><?php echo $eth_price ?></td>
                                                <td class="truncate-text"><a href="<?= $txn_link ?>" alt="data"><?php echo substr($txn_link, 0, 20) . '...' ?></a></td>
                                                <td class="truncate-text"><?php echo $date ?></td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <!-- tipping details end -->
                <?php } else if ($is_crowdfunded === 'true') {
                ?>
                    <!-- crowdfunding area start -->
                    <div class="col-lg-12 col-md-12 col-sm-12 mt-5 mt-lg-0" style="color:var(--text-color)">
                        <div class="my-3 mt-4 d-flex justify-content-between align-items-center">
                            <h4 class="mb-2 text-secondary">Crowdfunding Details:</h4>
                            <h6 class="mb-2" style="cursor: pointer;color:#007bff;font-weight: bold;font-size: 14px;" onclick="viewContribution()">View list</h6>
                        </div>

                        <div class="sidebar-item">
                            <div class="make-me-sticky">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="story-right-card shadow py-1 mb-3 px-3" style="background: #1c1c1c;">
                                            <div class="d-grid mt-3 mb-1">
                                                <div class="progress-panel">
                                                    <div class="get-view-wrapper" style="font-size: 0.9rem;font-weight: 800;"><span id="crowd_query_total_pay_view">0,000</span>&nbsp;<?= $amount_in ?>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar d-inline" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"><span id="span_percentage_view">0</span>%</div>
                                                    </div>
                                                    <div class="target-view-wrapper">
                                                        <div style="font-size: 0.9rem;">
                                                            <span style="font-weight: 800;">
                                                                <span id="percentage_view">0</span>%</span>&nbsp;Collected
                                                        </div>
                                                        <div style="font-size: 0.9rem;"><span style="font-size: 0.9rem;font-weight: 800;"><span id="target_amount_view">0,000</span>&nbsp;<span id="amount_in_view">ETH</span></span>&nbsp;Target
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="story-right-card shadow py-3 mb-3 px-3" style="background: #1c1c1c;">
                                            <div class="d-flex justify-content-center align-items-start flex-column my-2">
                                                <div>
                                                    <h6 style="font-weight:800">Project UID</h6>
                                                    <p style="font-size:0.9rem;word-break:break-all;">
                                                        <?= $video_uuid ?></p>
                                                </div>
                                                <div>
                                                    <h6 style="font-weight:800;">Funding Address</h6>
                                                    <p style="font-size:0.9rem;word-break:break-all;">
                                                        <?= $project_address ?></p>
                                                </div>
                                                <div>
                                                    <h6 style="font-weight:800">Created by</h6>
                                                    <p style="font-size:0.9rem;word-break:break-all;">
                                                        <?= $project_creator ?></p>
                                                </div>
                                                <div>
                                                    <h6 style="font-weight:800">Fund Details</h6>
                                                    <p style="font-size:0.9rem;word-break:break-all;" class="d-flex justify-content-start flex-column">
                                                        <span style="font-size:0.9rem;word-break:break-all;"><span style="font-weight:600">Minimum Pay
                                                                :</span>&nbsp;<span><?= $minimum_pay ?></span>&nbsp;<?= $amount_in ?></span>
                                                        <span style="font-size:0.9rem;word-break:break-all;"><span style="font-weight:600">Target Amount
                                                                :</span>&nbsp;<span><?= $target_amount ?></span>&nbsp;<?= $amount_in ?></span>
                                                    </p>
                                                </div>
                                                <div>
                                                    <h6 style="font-weight:800">Project URI</h6>
                                                    <p style="font-size:0.9rem;word-break:break-all;"><a href="<?= $project_uri ?>" target="_blank" style="text-decoration: none;color: inherit;"><?= $project_uri ?></a>
                                                    </p>
                                                </div>
                                                <div>
                                                    <h6 style="font-weight:800">Created On</h6>
                                                    <p style="font-size:0.9rem;word-break:break-all;">
                                                        <?= explode(' +0530', $created_at)[0] ?></p>
                                                </div>
                                                <div>
                                                    <h6 style="font-weight:800">Total Contributor</h6>
                                                    <p style="font-size:0.9rem;word-break:break-all;">
                                                        <?= $total_unique_contributor ?> Contributor</p>
                                                </div>
                                                <div>
                                                    <h6 style="font-weight:800">Total Recieved Amount</h6>
                                                    <p style="font-size:0.9rem;word-break:break-all;"><span id="recieved_eth">0.00</span>&nbsp;<?= $amount_in ?>
                                                    </p>
                                                </div>
                                                <div>
                                                    <h6 style="font-weight:800">Withdrawable Amount</h6>
                                                    <p style="font-size:0.9rem;word-break:break-all;"><span id="withdrawal_eth">0.00</span>&nbsp;<?= $amount_in ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="w-100">
                                                <?php
                                                $get_view_query_2 = "SELECT count(distinct user_address) as total_contributor FROM crowd_fund WHERE `video_uuid`='$video_uuid';";
                                                $result_view_2 = mysqli_query($con, $get_view_query_2);
                                                if (mysqli_num_rows($result_view_2) > 0) {
                                                    while ($row_view_2 = mysqli_fetch_array($result_view_2)) {
                                                        if ($row_view_2['total_contributor'] > 0) {
                                                ?>
                                                            <?php
                                                            if ($amount_in === 'ETH') {
                                                            ?>
                                                                <button type="button" class="user-profile-follow-button w-100 py-2 btn btn-hover" id="withdraw-button">Withdraw
                                                                    Amount</button>
                                                            <?php } else if ($amount_in === 'MATIC') { ?>
                                                                <button type="button" class="user-profile-follow-button w-100 py-2 btn btn-hover" id="withdraw-button-matic">Withdraw
                                                                    Amount</button>
                                                            <?php } else if ($amount_in === 'BNB') { ?>
                                                                <button type="button" class="user-profile-follow-button w-100 py-2 btn btn-hover" id="withdraw-button-bnb">Withdraw
                                                                    Amount</button>
                                                            <?php } else {  ?>
                                                                <button type="button" class="user-profile-follow-button w-100 py-2 btn btn-hover">Wait
                                                                    ...</button>
                                                            <?php } ?>
                                                        <?php } else {
                                                        ?>
                                                            <h6 class="bg-warning text-center text-dark py-2">No fund
                                                                available to
                                                                withdraw !</h6>
                                                <?php
                                                        }
                                                    }
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- crowdfunding area end -->
                <?php } else {
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Video upload from end -->
    <footer class="setFooter mt-5">
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
                            <li><a href="./index">Home</a></li>
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
<?php } ?>
<!-- MainContent End-->
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
                                            <div class="viewModal-address" style="color:#d1d0cf;"><?= $show_userAddress ?></div>
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
<!-- back-to-top -->
<div id="back-to-top">
    <a class="top" href="#top" id="top"> <i class="fa fa-angle-up"></i> </a>
</div>
<!-- jQuery, Popper JS -->
<script src="js/jquery-3.4.1.min.js"></script>

<!-- SweetAlert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="js/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="js/bootstrap.min.js"></script>

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
<!-- Custom JS-->
<script src="js/custom.js"></script>
<!-- <script src="js/main.js"></script> -->
<!-- <script src="js/moreVideo.js"></script> -->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/web3modal@1.9.7/dist/index.js"></script>
<script type="text/javascript" src="https://unpkg.com/@walletconnect/web3-provider@1.7.8/dist/umd/index.min.js">
</script>
<script src="./frontend/web3-login.js?v=009">
</script>
<script src="./frontend/web3-modal.js?v=001"></script>
<script type="text/javascript" src="https://test.pinkpaper.xyz/assets/avatar/jquery.letterpic.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/near-api-js@0.41.0/dist/near-api-js.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.7.1-rc.0/web3.min.js"></script>
<script src="contract/projectFunding.js"></script>
<script src="contract/contract.js"></script>

<script src="contract/matic/maticProjectFunding.js"></script>
<script src="contract/matic/maticContract.js"></script>

<script src="contract/bnb/bnbProjectFunding.js"></script>
<script src="contract/bnb/bnbContract.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="https://www.jqueryscript.net/demo/jQuery-Circular-Progress-Bar-With-Text-Counter/scripts/plugin.js"></script>
<script src="assets/js/jquery.peekabar.js"></script>
<script>
    $(document).ready(function() {
        const is_cookies = $.cookie('time');
        const total_set_watch_in_hr = parseFloat($('#total_time_to_reward_in_hr').val());
        const total_get_watch_in_sec = parseFloat($('#total_view_in_sec').val());
        const time_percentage = parseInt((total_get_watch_in_sec / (total_set_watch_in_hr * 60 * 60)) * 100);
        if (time_percentage > 100) {
            time_percentage = 100;
        }
        var progress_circle = $(".my-progress-bar").gmpc({
            line_width: 18,
            color: "#0ff",
            starting_position: 50,
            percent: 0,
            percentage: true,
        }).gmpc('animate', time_percentage, 3000);
    });
</script>
<script>
    function viewContribution() {
        $('#viewContributeModal').modal('show');
    };

    $(".avatar-image").letterpic({
        colors: [
            "#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e", "#16a085", "#27ae60", "#2980b9",
            "#8e44ad", "#2c3e50",
            "#f1c40f", "#e67e22", "#e74c3c", "#ecf0f1", "#95a5a6", "#f39c12", "#d35400", "#c0392b",
            "#bdc3c7", "#7f8c8d"
        ],
        font: 'Inter'
    });

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

    $('document').ready(function() {
        $('#viewContributeModal').css('display', 'none');
    });

    function deleteVideo() {
        let videoId = $('#video_uuid').val();
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this video!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: 'php/API/deleteVideo.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: videoId
                        }
                    }).done(function(data) {
                        if (data.status == 201) {
                            swal("Your Video has been deleted Successfully!", {
                                icon: "success",
                            }).then((value) => {
                                location.reload();
                            });
                        } else {
                            swal({
                                title: "Error",
                                text: "Something went wrong, please try again later",
                                icon: "error",
                                button: "Ok",
                            });
                        }
                    }).fail(function(err) {
                        console.log(err);
                    });
                } else {
                    swal({
                        title: "Your Video is safe!",
                        icon: "success",
                        button: "Ok",
                    });
                }
            });
    }

    const number = $('#target_amount').val();
    const amount_in_view = $('#amount_in').val();
    const crowd_query_total_pay = $('#crowd_query_total_pay').val();

    const percentage_pay = parseFloat(((parseFloat(crowd_query_total_pay) * 100) / parseFloat(number)).toFixed(2));

    $('#span_percentage_view').text(percentage_pay);
    $('#percentage_view').text(percentage_pay);
    $('.progress-bar').css('width', `${percentage_pay}%`);

    const convertNumber = (number.toLocaleString('en-IN', {
        maximumFractionDigits: 3,
    }));

    const crowd_query_total_pay_view = ((parseFloat(crowd_query_total_pay).toFixed(5)).toLocaleString('en-IN', {
        maximumFractionDigits: 3,
    }));

    $('.progress-bar').attr('aria-valuenow', percentage_pay)
    $('#crowd_query_total_pay_view').text(crowd_query_total_pay_view);
    $('#target_amount_view').text(convertNumber);
    $('#amount_in_view').text(amount_in_view);

    const projectAddress = $('#projectAddress').val();

    $(document).ready(function() {
        $('#withdraw-button').click(async function() {
            if (window.ethereum) {
                if ((window.ethereum.networkVersion) !== '1') {
                    changeNetwork('1');
                } else {
                    $(".new-loader-wrapper").removeClass("d-none");
                    $(".new-loader-wrapper").addClass("d-flex");
                    console.log("This is DAppp Environment");
                    var accounts = await ethereum.request({
                        method: 'eth_requestAccounts'
                    });
                    var currentaddress = accounts[0];
                    web3 = new Web3(window.ethereum);

                    myProjectContract = new web3.eth.Contract(projectFunding, projectAddress);

                    await myProjectContract.methods.withdraw().send({
                        from: currentaddress
                    }).then((res) => {
                        var formData = new FormData();
                        const post_uid = $('#postUId').val();
                        const user_address = res.from;
                        const project_address = projectAddress;
                        const transactionHash = res.transactionHash;
                        const withdraw_amount = $('#crowd_query_total_pay').val();
                        const amount_in = $('#amount_in').val();

                        formData.append('project_address', project_address);
                        formData.append('post_uid', post_uid);
                        formData.append('user_address', user_address);
                        formData.append('transactionHash', transactionHash);
                        formData.append('withdraw_amount', withdraw_amount);
                        formData.append('pay_amount_in', amount_in);

                        $.ajax({
                            url: 'php/withdraw_fund.php',
                            type: "POST",
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: formData,
                            success: function() {
                                toastr["success"](
                                    "Withdrawal successfully");
                                $(".new-loader-wrapper").addClass("d-none");
                                window.location.replace("stories");
                            }
                        });

                    }).catch((err) => {
                        $(".new-loader-wrapper").addClass("d-none");
                        console.log(err);
                    });
                }
            } else {
                $(".new-loader-wrapper").addClass("d-none");
                console.log("Please connect with metamask");
            }
        });

        $('#withdraw-button-matic').click(async function() {
            if (window.ethereum) {
                if ((window.ethereum.networkVersion) !== '137') {
                    changeNetwork('89');
                } else {
                    $(".new-loader-wrapper").removeClass("d-none");
                    $(".new-loader-wrapper").addClass("d-flex");
                    console.log("This is DAppp Environment");
                    var accounts = await ethereum.request({
                        method: 'eth_requestAccounts'
                    });
                    var currentaddress = accounts[0];
                    web3 = new Web3(window.ethereum);

                    myProjectContract = new web3.eth.Contract(maticProjectFunding, projectAddress);

                    await myProjectContract.methods.withdraw().send({
                        from: currentaddress
                    }).then((res) => {
                        var formData = new FormData();
                        const post_uid = $('#postUId').val();
                        const user_address = res.from;
                        const project_address = projectAddress;
                        const transactionHash = res.transactionHash;
                        const withdraw_amount = $('#crowd_query_total_pay').val();
                        const amount_in = $('#amount_in').val();

                        formData.append('project_address', project_address);
                        formData.append('post_uid', post_uid);
                        formData.append('user_address', user_address);
                        formData.append('transactionHash', transactionHash);
                        formData.append('withdraw_amount', withdraw_amount);
                        formData.append('pay_amount_in', amount_in);

                        $.ajax({
                            url: 'php/withdraw_fund.php',
                            type: "POST",
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: formData,
                            success: function() {
                                toastr["success"](
                                    "Withdrawal successfully");
                                $(".new-loader-wrapper").addClass("d-none");
                                window.location.replace("stories");
                            }
                        });

                    }).catch((err) => {
                        $(".new-loader-wrapper").addClass("d-none");
                        console.log(err);
                    });
                }
            } else {
                $(".new-loader-wrapper").addClass("d-none");
                console.log("Please connect with metamask");
            }
        });

        $('#withdraw-button-bnb').click(async function() {
            if (window.ethereum) {
                if ((window.ethereum.networkVersion) !== '97') {
                    changeNetwork('61');
                } else {
                    $(".new-loader-wrapper").removeClass("d-none");
                    $(".new-loader-wrapper").addClass("d-flex");
                    console.log("This is DAppp Environment");
                    var accounts = await ethereum.request({
                        method: 'eth_requestAccounts'
                    });
                    var currentaddress = accounts[0];
                    web3 = new Web3(window.ethereum);

                    myProjectContract = new web3.eth.Contract(bnbProjectFunding, projectAddress);

                    await myProjectContract.methods.withdraw().send({
                        from: currentaddress
                    }).then((res) => {
                        var formData = new FormData();
                        const post_uid = $('#postUId').val();
                        const user_address = res.from;
                        const project_address = projectAddress;
                        const transactionHash = res.transactionHash;
                        const withdraw_amount = $('#crowd_query_total_pay').val();
                        const amount_in = $('#amount_in').val();

                        formData.append('project_address', project_address);
                        formData.append('post_uid', post_uid);
                        formData.append('user_address', user_address);
                        formData.append('transactionHash', transactionHash);
                        formData.append('withdraw_amount', withdraw_amount);
                        formData.append('pay_amount_in', amount_in);

                        $.ajax({
                            url: 'php/withdraw_fund.php',
                            type: "POST",
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: formData,
                            success: function() {
                                toastr["success"](
                                    "Withdrawal successfully");
                                $(".new-loader-wrapper").addClass("d-none");
                                window.location.replace("stories");
                            }
                        });

                    }).catch((err) => {
                        $(".new-loader-wrapper").addClass("d-none");
                        console.log(err);
                    });
                }
            } else {
                $(".new-loader-wrapper").addClass("d-none");
                console.log("Please connect with metamask");
            }
        });

        async function getBalance() {
            if (window.ethereum) {
                console.log("Chandan This is DAppp Environment");
                var accounts = await ethereum.request({
                    method: 'eth_requestAccounts'
                });
                var currentaddress = accounts[0];
                web3 = new Web3(window.ethereum);
                myProjectContract = new web3.eth.Contract(projectFunding, projectAddress);
                await myProjectContract.methods.getProjectData().call().then((res) => {
                    const total_get_fund = res[5];
                    const total_withdrawal_eth = res[4];
                    const withdrawalEth = web3.utils.fromWei(total_withdrawal_eth.toString(),
                        'ether');
                    $('#withdrawal_eth').text(withdrawalEth);
                    const recievedEth = web3.utils.fromWei(total_get_fund.toString(), 'ether');
                    $('#recieved_eth').text(recievedEth);
                }).catch((err) => {
                    console.log(err);
                });
            } else {
                console.log("Please connect with metamask");
            }
        }

        async function getBalanceMatic() {
            if (window.ethereum) {
                console.log("Chandan This is DAppp Environment");
                var accounts = await ethereum.request({
                    method: 'eth_requestAccounts'
                });
                var currentaddress = accounts[0];
                web3 = new Web3(window.ethereum);
                myProjectContract = new web3.eth.Contract(maticProjectFunding, projectAddress);
                await myProjectContract.methods.getProjectData().call().then((res) => {
                    const total_get_fund = res[5];
                    const total_withdrawal_eth = res[4];
                    const withdrawalEth = web3.utils.fromWei(total_withdrawal_eth.toString(),
                        'ether');
                    $('#withdrawal_eth').text(withdrawalEth);
                    const recievedEth = web3.utils.fromWei(total_get_fund.toString(), 'ether');
                    $('#recieved_eth').text(recievedEth);
                }).catch((err) => {
                    console.log(err);
                });
            } else {
                console.log("Please connect with metamask");
            }
        }

        async function getBalanceBnb() {
            if (window.ethereum) {
                console.log("Chandan This is DAppp Environment");
                var accounts = await ethereum.request({
                    method: 'eth_requestAccounts'
                });
                var currentaddress = accounts[0];
                web3 = new Web3(window.ethereum);
                myProjectContract = new web3.eth.Contract(bnbProjectFunding, projectAddress);
                await myProjectContract.methods.getProjectData().call().then((res) => {
                    const total_get_fund = res[5];
                    const total_withdrawal_eth = res[4];
                    const withdrawalEth = web3.utils.fromWei(total_withdrawal_eth.toString(),
                        'ether');
                    $('#withdrawal_eth').text(withdrawalEth);
                    const recievedEth = web3.utils.fromWei(total_get_fund.toString(), 'ether');
                    $('#recieved_eth').text(recievedEth);
                }).catch((err) => {
                    console.log(err);
                });
            } else {
                console.log("Please connect with metamask");
            }
        }
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

        if ($('#amount_in').val() === 'ETH') {
            getBalance();
        } else if ($('#amount_in').val() === 'MATIC') {
            getBalanceMatic();
        } else if ($('#amount_in').val() === 'BNB') {
            getBalanceBnb();
        } else {
            console.log('Something went wrong');
        }
    });
</script>
<script>
    var customBar = new $.peekABar({
        backgroundColor: '#17a2b8',
        padding: '1em',
        cssClass: 'custom-bar',
        html: '<div class="d-flex justify-content-between align-items-center"><span><b class="text-dark blink_me">Learn with Earn</b>&nbsp;Spend minimum 10 hour to watching our videos, After that a special gift waiting for you !&nbsp;</span><span class="peekbar-close fa fa-close btn-custom-hide" aria-hidden="true"></span></div>',
        animation: {
            type: 'slide',
            duration: 'slow'
        },
        cssClass: null,
        opacity: '1',
        position: 'top',
        closeOnClick: false
    });

    $('.btn-custom-hide').click(function() {
        customBar.hide();
    });

    var is_modal_show = sessionStorage.getItem('alreadyShow');

    if (is_modal_show !== 'alredy shown') {
        customBar.show()
        sessionStorage.setItem('alreadyShow', 'alredy shown');
    } else {
        customBar.hide();
    }
</script>
</body>

</html>