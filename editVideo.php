<?php
session_start();
require_once('php/link.php');
$user_address = '';
if (isset($_SESSION['userAddress'])) {
    $user_address = $_SESSION['userAddress'];
} else {
    $user_address = '';
}

if (isset($_GET['course']) && isset($_GET['module']) && $user_address != '' && $user_address != null) {
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
        }
    } else {
        header("Location: courses");
    }
} else {
    header("Location: courses");
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
    <link rel="stylesheet" href="assets/css/circle_progress_bar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        .icon {
            display: block;
            font-size: 5rem;
            color: #fff;
        }

        .icon:hover {
            color: #fff;
        }

        .btn-container {
            width: 30%;
            margin: 10px auto;
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
            font: bold 20px "Quicksand", san-serif;
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
<input type="hidden" id="in-thumbnail" name="in-thumbnail" value="<?= $thumbnail_id ?>">
<input type="hidden" id="in-video" name="in-video" value="<?= $video_ipfs ?>">
<input type="hidden" id="video_uuid" name="video_uuid" value="<?= $video_uuid ?>">

<!-- Header -->
<!-- desktop header -->
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

<!-- Edit Video form start -->
<div class="container main-content padding-data">
    <div class="row">
        <div class="col-12 mt-5 d-flex justify-content-center align-items-center">
            <h3 class="text-center">Edit Video</h3>
        </div>
    </div>
    <div class="row d-flex justify-content-center align-items-center mt-5 py-4 px-3" style="box-shadow:10px 10px 60px 40px rgb(72 89 171 / 18%)">
        <div class="col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center align-items-center">
            <img src="images/upload-bro.svg" style="background: #464646;box-shadow: 0 0 10px 0 rgb(236 230 230 / 20%);border-radius:1rem;" class="img img-responsive">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center align-items-center">
            <form action="" class="p-3 d-flex align-item-center border form-container" style="margin-bottom: 4rem;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="select">Select an option</label>
                                <select class="form-control" id="select" required>
                                    <option>Choose video category</option>
                                    <?php
                                    if ($module_name === "Explainers") {
                                    ?>
                                        <option value="927f0965-6eed-462c-bfa0-79867c9f9448" selected>Explainers</option>
                                        <option value="fd3d24bd-8764-494e-9ade-40911b8e11a1">Tutorials</option>
                                        <option value="5dae4ba7-933a-40a9-8866-49ee971ccf87">Review</option>
                                        <option value="5822014a-02af-41c4-8564-0ec4ceba8db6">News</option>
                                        <option value="0f01d804-648d-42a7-ab11-bdc373f4b7bd">Others</option>
                                    <?php
                                    } else if ($module_name === "Tutorials") {
                                    ?>
                                        <option value="927f0965-6eed-462c-bfa0-79867c9f9448">Explainers</option>
                                        <option value="fd3d24bd-8764-494e-9ade-40911b8e11a1" selected>Tutorials</option>
                                        <option value="5dae4ba7-933a-40a9-8866-49ee971ccf87">Review</option>
                                        <option value="5822014a-02af-41c4-8564-0ec4ceba8db6">News</option>
                                        <option value="0f01d804-648d-42a7-ab11-bdc373f4b7bd">Others</option>
                                    <?php
                                    } else if ($module_name === "Review") {
                                    ?>
                                        <option value="927f0965-6eed-462c-bfa0-79867c9f9448">Explainers</option>
                                        <option value="fd3d24bd-8764-494e-9ade-40911b8e11a1">Tutorials</option>
                                        <option value="5dae4ba7-933a-40a9-8866-49ee971ccf87" selected>Review</option>
                                        <option value="5822014a-02af-41c4-8564-0ec4ceba8db6">News</option>
                                        <option value="0f01d804-648d-42a7-ab11-bdc373f4b7bd">Others</option>
                                    <?php
                                    } else if ($module_name === "News") {
                                    ?>
                                        <option value="927f0965-6eed-462c-bfa0-79867c9f9448">Explainers</option>
                                        <option value="fd3d24bd-8764-494e-9ade-40911b8e11a1">Tutorials</option>
                                        <option value="5dae4ba7-933a-40a9-8866-49ee971ccf87">Review</option>
                                        <option value="5822014a-02af-41c4-8564-0ec4ceba8db6" selected>News</option>
                                        <option value="0f01d804-648d-42a7-ab11-bdc373f4b7bd">Others</option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="927f0965-6eed-462c-bfa0-79867c9f9448">Explainers</option>
                                        <option value="fd3d24bd-8764-494e-9ade-40911b8e11a1">Tutorials</option>
                                        <option value="5dae4ba7-933a-40a9-8866-49ee971ccf87">Review</option>
                                        <option value="5822014a-02af-41c4-8564-0ec4ceba8db6">News</option>
                                        <option value="0f01d804-648d-42a7-ab11-bdc373f4b7bd" selected>Others</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" value="<?= $chapter_name ?>" class="form-control" id="title" name="title" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" required rows="2"><?= $chapter_desc ?></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="thumbnail">Thumbnail</label>
                                <div class="drop-zone">
                                    <span hidden class="drop-zone__prompt"><i class="fa-solid fa-cloud-arrow-up icon"></i><br>Drop thumbnail here or click to upload</span>
                                    <input hidden type="file" name="thumbnail" id="thumbnail" class="drop-zone__input" required accept="image/*">
                                    <div class="drop-zone__thumb" style="background-image: url(<?= $thumbnail ?>);" data-label="<?= $chapter_name . ".jpg" ?>"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="video">Video</label>
                                <div class="drop-zone">
                                    <span class="drop-zone__prompt" hidden><i class="fa-solid fa-cloud-arrow-up icon"></i><br>Drop video here or click to upload</span>
                                    <input hidden type="file" name="video" id="video" class="drop-zone__input" required accept="video/*">
                                    <div class="drop-zone__thumb" data-label="<?= $chapter_name . ".mp4" ?>"></div>
                                </div>
                                <span class="text-warning my-1" style="font-size:12px;"><i class="fa fa-info-circle" aria-hidden="true"></i> Video size
                                    should be less than 100 mb</span>
                            </div>
                        </div>
                        <div class="btn-container">
                            <!-- <button type="button" id="uploadBtn" class="btn btn-primary" >Upload</button> -->
                            <button type="button" class="btn btn-primary w-100 d-flex justify-content-center align-items-center" id="uploadBtn" onclick="updateVideo()">
                                <span>UPDATE</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Video form end -->
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
<!-- MainContent End-->
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
    document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
        const dropZoneElement = inputElement.closest(".drop-zone");

        dropZoneElement.addEventListener("click", (e) => {
            inputElement.click();
        });

        inputElement.addEventListener("change", (e) => {
            if (inputElement.files.length) {
                updateThumbnail(dropZoneElement, inputElement.files[0]);
            }
        });

        dropZoneElement.addEventListener("dragover", (e) => {
            e.preventDefault();
            dropZoneElement.classList.add("drop-zone--over");
        });

        ["dragleave", "dragend"].forEach((type) => {
            dropZoneElement.addEventListener(type, (e) => {
                dropZoneElement.classList.remove("drop-zone--over");
            });
        });

        dropZoneElement.addEventListener("drop", (e) => {
            e.preventDefault();

            if (e.dataTransfer.files.length) {
                inputElement.files = e.dataTransfer.files;
                updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
            }

            dropZoneElement.classList.remove("drop-zone--over");
        });
    });

    /**
     * Updates the thumbnail on a drop zone element.
     *
     * @param {HTMLElement} dropZoneElement
     * @param {File} file
     */
    function updateThumbnail(dropZoneElement, file) {
        let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

        // First time - remove the prompt
        if (dropZoneElement.querySelector(".drop-zone__prompt")) {
            dropZoneElement.querySelector(".drop-zone__prompt").remove();
        }

        // First time - there is no thumbnail element, so lets create it
        if (!thumbnailElement) {
            thumbnailElement = document.createElement("div");
            thumbnailElement.classList.add("drop-zone__thumb");
            dropZoneElement.appendChild(thumbnailElement);
        }

        thumbnailElement.dataset.label = file.name;

        // Show thumbnail for image files
        if (file.type.startsWith("image/")) {
            const reader = new FileReader();

            reader.readAsDataURL(file);
            reader.onload = () => {
                thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
            };
        } else {
            thumbnailElement.style.backgroundImage = null;
        }
    }
</script>
<script>
    const client = 'https://';
    const web3storage = ".ipfs.w3s.link";
    var thumbnail_cid = "";
    var video_cid = "";

    function updateVideo() {
        var user_address = $('#user_address').val();
        var title = $('#title').val();
        var description = $('#description').val();
        var thumbnail = $('#thumbnail').val();
        var category = $('#select').val();
        var video = $('#video').val();
        var user_type = "user";
        var video_uuid = $('#video_uuid').val();
        if (thumbnail === "") {
            thumbnail = $('#in-thumbnail').val();
        }
        if (video === "") {
            video = $('#in-video').val();
        }

        if (title == "" || description == "" || thumbnail == "" || video == "" || category == "") {
            swal({
                title: "Warning",
                text: "Please fill all the fields!",
                icon: "warning",
                button: "Ok",
            });
        } else {
            $("#title").css("pointer-events", "none");
            $("#description").css("pointer-events", "none");
            $("#select").css("pointer-events", "none");
            $(".drop-zone").css("pointer-events", "none");
            $(".form-group").css("cursor", "not-allowed");
            $('#uploadBtn').attr('disabled', true);
            $('#uploadBtn').css("cursor", "not-allowed");
            const btn = document.querySelector(".btn");
            btn.classList.add("button--loading");
            const vv = (document.querySelector('#video'));
            var tt = (document.querySelector("#thumbnail"));
            if (tt.files[0] !== undefined && vv.files[0] !== undefined) {
                var form = new FormData();
                form.append("file", vv.files[0], (vv.files[0]).name);
                var form1 = new FormData();
                form1.append("file", tt.files[0], (tt.files[0]).name);
                var settings1 = {
                    "url": "https://api.web3.storage/upload",
                    "method": "POST",
                    "timeout": 0,
                    "headers": {
                        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJkaWQ6ZXRocjoweDU2NDhlNzIyRTYyQmQ2MDA1MDdmM0YyOTI0Q0ExNjExMUE2QWUyMTUiLCJpc3MiOiJ3ZWIzLXN0b3JhZ2UiLCJpYXQiOjE2NjM4NDM3MTEzNTUsIm5hbWUiOiJmaW5mbGl4LXdlYnNpdGUifQ.KI2sRUCt97cEUug7iMp_qIubBqa8FpHjJhMmRSEgMws"

                    },
                    "processData": false,
                    "mimeType": "multipart/form-data",
                    "contentType": false,
                    "data": form1
                };
                $.ajax(settings1).done(function(response) {
                    thumbnail_cid = JSON.parse(response).cid;
                    if (video_cid != "" && thumbnail_cid != "") {
                        $.ajax({
                            type: 'POST',
                            url: 'php/API/update_video.php',
                            dataType: "json",
                            data: {
                                "video_uuid": video_uuid,
                                "name": title,
                                "category": category,
                                "video_desc": description,
                                "thumbnail_ipfs": client + thumbnail_cid + web3storage,
                                "video_uid": client + video_cid + web3storage,
                                "user_address": user_address,
                                "user_type": user_type
                            },
                        }).done(function(response) {
                            if (response.status == 201) {
                                btn.classList.remove("button--loading");
                                swal("Video Updated Successfully!", {
                                    icon: "success",
                                }).then((value) => {
                                    window.location.href = `/userVideosList`;
                                });
                            } else {
                                btn.classList.remove("button--loading");
                                swal({
                                    title: "Error",
                                    text: "Something went wrong, please try again later",
                                    icon: "error",
                                    button: "Ok",
                                });
                            }
                        }).fail(function(response) {
                            btn.classList.remove("button--loading");
                            swal({
                                title: "Error",
                                text: "Something went wrong, please try again later",
                                icon: "error",
                                button: "Ok",
                            });
                        });
                    }
                });

                var settings = {
                    "url": "https://api.web3.storage/upload",
                    "method": "POST",
                    "timeout": 0,
                    "headers": {
                        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJkaWQ6ZXRocjoweDU2NDhlNzIyRTYyQmQ2MDA1MDdmM0YyOTI0Q0ExNjExMUE2QWUyMTUiLCJpc3MiOiJ3ZWIzLXN0b3JhZ2UiLCJpYXQiOjE2NjM4NDM3MTEzNTUsIm5hbWUiOiJmaW5mbGl4LXdlYnNpdGUifQ.KI2sRUCt97cEUug7iMp_qIubBqa8FpHjJhMmRSEgMws"

                    },
                    "processData": false,
                    "mimeType": "multipart/form-data",
                    "contentType": false,
                    "data": form
                };
                $.ajax(settings).done(function(response) {
                    video_cid = JSON.parse(response).cid;
                    if (thumbnail_cid != "" && video_cid != "") {
                        $.ajax({
                            type: 'POST',
                            url: 'php/API/update_video.php',
                            dataType: "json",
                            data: {
                                "video_uuid": video_uuid,
                                "name": title,
                                "category": category,
                                "video_desc": description,
                                "thumbnail_ipfs": client + thumbnail_cid + web3storage,
                                "video_uid": client + video_cid + web3storage,
                                "user_address": user_address,
                                "user_type": user_type
                            },
                        }).done(function(response) {
                            if (response.status == 201) {
                                btn.classList.remove("button--loading");
                                swal("Video Updated Successfully!", {
                                    icon: "success",
                                }).then((value) => {
                                    window.location.href = `/userVideosList`;
                                });
                            } else {
                                btn.classList.remove("button--loading");
                                swal({
                                    title: "Error",
                                    text: "Something went wrong, please try again later",
                                    icon: "error",
                                    button: "Ok",
                                });
                            }
                        }).fail(function(response) {
                            btn.classList.remove("button--loading");
                            swal({
                                title: "Error",
                                text: "Something went wrong, please try again later",
                                icon: "error",
                                button: "Ok",
                            });
                        });
                    }
                });
            } else if (tt.files[0] !== undefined) {
                var form1 = new FormData();
                form1.append("file", tt.files[0], (tt.files[0]).name);
                var settings1 = {
                    "url": "https://api.web3.storage/upload",
                    "method": "POST",
                    "timeout": 0,
                    "headers": {
                        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJkaWQ6ZXRocjoweDU2NDhlNzIyRTYyQmQ2MDA1MDdmM0YyOTI0Q0ExNjExMUE2QWUyMTUiLCJpc3MiOiJ3ZWIzLXN0b3JhZ2UiLCJpYXQiOjE2NjM4NDM3MTEzNTUsIm5hbWUiOiJmaW5mbGl4LXdlYnNpdGUifQ.KI2sRUCt97cEUug7iMp_qIubBqa8FpHjJhMmRSEgMws"

                    },
                    "processData": false,
                    "mimeType": "multipart/form-data",
                    "contentType": false,
                    "data": form1
                };
                $.ajax(settings1).done(function(response) {
                    thumbnail_cid = JSON.parse(response).cid;
                    if (thumbnail_cid != "" && video != "") {
                        $.ajax({
                            type: 'POST',
                            url: 'php/API/update_video.php',
                            dataType: "json",
                            data: {
                                "video_uuid": video_uuid,
                                "name": title,
                                "category": category,
                                "video_desc": description,
                                "thumbnail_ipfs": client + thumbnail_cid + web3storage,
                                "video_uid": video,
                                "user_address": user_address,
                                "user_type": user_type
                            },
                        }).done(function(response) {
                            if (response.status == 201) {
                                btn.classList.remove("button--loading");
                                swal("Video Updated Successfully!", {
                                    icon: "success",
                                }).then((value) => {
                                    window.location.href = `/userVideosList`;
                                });
                            } else {
                                btn.classList.remove("button--loading");
                                swal({
                                    title: "Error",
                                    text: "Something went wrong, please try again later",
                                    icon: "error",
                                    button: "Ok",
                                });
                            }
                        }).fail(function(response) {
                            btn.classList.remove("button--loading");
                            swal({
                                title: "Error",
                                text: "Something went wrong, please try again later",
                                icon: "error",
                                button: "Ok",
                            });
                        });
                    }
                });
            } else if (vv.files[0] !== undefined) {
                var form = new FormData();
                form.append("file", vv.files[0], (vv.files[0]).name);
                var settings = {
                    "url": "https://api.web3.storage/upload",
                    "method": "POST",
                    "timeout": 0,
                    "headers": {
                        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJkaWQ6ZXRocjoweDU2NDhlNzIyRTYyQmQ2MDA1MDdmM0YyOTI0Q0ExNjExMUE2QWUyMTUiLCJpc3MiOiJ3ZWIzLXN0b3JhZ2UiLCJpYXQiOjE2NjM4NDM3MTEzNTUsIm5hbWUiOiJmaW5mbGl4LXdlYnNpdGUifQ.KI2sRUCt97cEUug7iMp_qIubBqa8FpHjJhMmRSEgMws"
                    },
                    "processData": false,
                    "mimeType": "multipart/form-data",
                    "contentType": false,
                    "data": form
                };
                $.ajax(settings).done(function(response) {
                    video_cid = JSON.parse(response).cid;
                    if (thumbnail != "" && video_cid != "") {
                        $.ajax({
                            type: 'POST',
                            url: 'php/API/update_video.php',
                            dataType: "json",
                            data: {
                                "video_uuid": video_uuid,
                                "name": title,
                                "category": category,
                                "video_desc": description,
                                "thumbnail_ipfs": thumbnail,
                                "video_uid": client + video_cid + web3storage,
                                "user_address": user_address,
                                "user_type": user_type
                            },
                        }).done(function(response) {
                            if (response.status == 201) {
                                btn.classList.remove("button--loading");
                                swal("Video Updated Successfully!", {
                                    icon: "success",
                                }).then((value) => {
                                    window.location.href = `/userVideosList`;
                                });
                            } else {
                                btn.classList.remove("button--loading");
                                swal({
                                    title: "Error",
                                    text: "Something went wrong, please try again later",
                                    icon: "error",
                                    button: "Ok",
                                });
                            }
                        }).fail(function(response) {
                            btn.classList.remove("button--loading");
                            swal({
                                title: "Error",
                                text: "Something went wrong, please try again later",
                                icon: "error",
                                button: "Ok",
                            });
                        });
                    }
                });
            } else {
                $.ajax({
                    type: 'POST',
                    url: 'php/API/update_video.php',
                    dataType: "json",
                    data: {
                        "video_uuid": video_uuid,
                        "name": title,
                        "category": category,
                        "video_desc": description,
                        "thumbnail_ipfs": thumbnail,
                        "video_uid": video,
                        "user_address": user_address,
                        "user_type": user_type
                    },
                }).done(function(response) {
                    if (response.status == 201) {
                        btn.classList.remove("button--loading");
                        swal("Video Updated Successfully!", {
                            icon: "success",
                        }).then((value) => {
                            window.location.href = `/userVideosList`;
                        });
                    } else {
                        btn.classList.remove("button--loading");
                        swal({
                            title: "Error",
                            text: "Something went wrong, please try again later",
                            icon: "error",
                            button: "Ok",
                        });
                    }
                }).fail(function(response) {
                    btn.classList.remove("button--loading");
                    swal({
                        title: "Error",
                        text: "Something went wrong, please try again later",
                        icon: "error",
                        button: "Ok",
                    });
                });
            }
        }
    }
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