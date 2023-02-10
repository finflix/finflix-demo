<?php
session_start();
require_once('php/link.php');
$user_address = '';
$user_type = "user";
$video_uuid_for_details = '';
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
    <link rel="stylesheet" href="assets/dashboard/css/bootstrap.min.css">
    <!--datatable CSS -->
    <link rel="stylesheet" href="assets/dashboard/css/dataTables.bootstrap4.min.css">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="assets/dashboard/css/typography.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="assets/dashboard/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/mobileDrawer.css" />
    <link rel="stylesheet" href="assets/dashboard/css/responsive.css">
    <link rel="stylesheet" href="assets/css/circle_progress_bar.css">
    <style>
        body {
            background: #141414;
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

        @media screen and (max-width: 768px) {
            footer {
                position: absolute;
                bottom: 0;
                width: 100%;
            }

            footer {
                display: none;
            }

            #my-container {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
        }

        .main-header {
            background: #191919 !important;
        }

        .menu-item>a {
            color: #fff;
        }

        #top-rated-item-slick-arrow {
            z-index: 2 !important;
        }

        .iq-user-dropdown {
            width: 100%;
        }

        @media (min-width: 992px) {
            .search-box {
                left: auto !important;
                right: 0 !important;
            }
        }

        .device-search {
            color: #fff;
            font-size: 1.1rem;
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

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-53J6JBV" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- loader Start -->
    <input type="hidden" name="total_time_to_reward_in_hr" value="<?= $total_time_to_reward_in_hr ?>" id="total_time_to_reward_in_hr">
    <input type="hidden" name="total_view_in_sec" value="<?= $total_view_in_sec ?>" id="total_view_in_sec">
    <!-- loader END -->
    <?php
    $user_img = '#';
    ?>
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
    <!-- MainContent -->
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
        <div class="main-content">
            <section id="iq-favorites-2">
                <div class="container-fluid">
                    <div class="row" style="width: 99%; margin-left: 12px;">
                        <div class="col-sm-12 overflow-hidden" style="margin: 0 10px;">
                            <div class="iq-main-header d-flex align-items-center justify-content-center my-5 text-center">
                                <h4 class="slider-text big-title title text-uppercase fadeInLeft animated text-center" style="font-size:30px;">My Videos</h4>
                            </div>
                        </div>
                        <div class="container-fluid" id="my-container" style="width: 95%;">
                            <div class="col-sm-12">
                                <div class="iq-card">
                                    <div class="iq-card-header d-flex justify-content-between">
                                        <div class="iq-header-title">
                                            <h4 class="card-title">Recently Added Items</h4>
                                        </div>
                                        <div class="iq-card-header-toolbar d-flex align-items-center seasons">
                                            <div class="iq-custom-select d-inline-block sea-epi s-margin">
                                                <select name="cars" class="form-control season-select">
                                                    <option value="season1">Most Likely</option>
                                                    <option value="season2">Unlikely</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="iq-card-body">
                                        <div class="table-responsive">
                                            <table class="data-tables table movie_table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th style="width:20%;">Video</th>
                                                        <th style="width:10%;">Likes</th>
                                                        <th style="width:20%;">Category</th>
                                                        <th style="width:10%;">Download/Views</th>
                                                        <th style="width:10%;">Crowdfunding</th>
                                                        <th style="width:20%;">Date</th>
                                                        <th style="width:10%;">Link</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = "SELECT * FROM `video_info` WHERE `user_address` = '$user_address' order by `video_id` desc";
                                                    $like_result = mysqli_query($con, $query);
                                                    if (mysqli_num_rows($like_result) != 0) {
                                                        while ($row = mysqli_fetch_array($like_result)) {
                                                            $thumbnail_ipfs = $row['thumbnail_ipfs'];
                                                            $name = $row['name'];
                                                            $module = $row['module'];
                                                            $video_likes = $row['video_like'];
                                                            $video_views = $row['video_views'];
                                                            $oldTime = $row['from_time'];
                                                            $date = date_create($oldTime);
                                                            $newTime = date_format($date, "d M,Y");
                                                            $is_crowdfunded = $row['is_croudfunded'];
                                                            $video_uuid = $row['video_uuid'];
                                                            $module_id = $row['module_uuid'];
                                                    ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="media align-items-center">
                                                                        <div class="iq-movie">
                                                                            <a href="javascript:void(0);"><img src="<?= $thumbnail_ipfs ?>" class="img-border-radius avatar-40 img-fluid" alt=""></a>
                                                                        </div>
                                                                        <div class="media-body text-white text-left ml-3">
                                                                            <p class="mb-0"><?= $name ?></p>
                                                                            <small>1h 40m</small>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><i class="lar la-thumbs-up mr-2"></i><?= $video_likes ?></td>
                                                                <td><?= $module ?></td>
                                                                <td>
                                                                    <i class="lar la-eye mr-2"></i><?= $video_views ?>
                                                                </td>
                                                                <td><?= $is_crowdfunded ?></td>
                                                                <td><?= $newTime ?></td>
                                                                <td><a style="color: #358eef; text-decoration: none;" href="videoDetails.php?course=<?= $video_uuid ?>&module=<?= $module_id ?>">More Details</a></span></td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <footer class="setFooter" style="margin-top: 100px;">
            <div class="container-fluid" style="background: rgb(0 0 0 / 50%);">
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
                    <p class="mb-0 text-center font-size-14 text-body" style="color: #ccc !important;">Finflix - 2022 All Rights Reserved</p>
                </div>
            </div>
        </footer>
    <?php } ?>
    <!-- MainContent End-->
    <!-- back-to-top -->
    <div id="back-to-top">
        <a class="top" href="#top" id="top"> <i class="fa fa-angle-up"></i> </a>
    </div>

    <!-- back-to-top End -->

    <!-- jQuery, Popper JS -->
    <script src="assets/dashboard/js/jquery.min.js"></script>
    <script src="assets/dashboard/js/popper.min.js"></script>
    <script src="assets/dashboard/js/bootstrap.min.js"></script>
    <script src="assets/dashboard/js/jquery.dataTables.min.js"></script>
    <script src="assets/dashboard/js/dataTables.bootstrap4.min.js"></script>
    <!-- Appear JavaScript -->
    <script src="assets/dashboard/js/jquery.appear.js"></script>
    <!-- Countdown JavaScript -->
    <script src="assets/dashboard/js/countdown.min.js"></script>
    <!-- Select2 JavaScript -->
    <script src="assets/dashboard/js/select2.min.js"></script>
    <!-- Counterup JavaScript -->
    <script src="assets/dashboard/js/waypoints.min.js"></script>
    <script src="assets/dashboard/js/jquery.counterup.min.js"></script>
    <!-- Wow JavaScript -->
    <script src="assets/dashboard/js/wow.min.js"></script>
    <!-- <script src="js/main.js"></script> -->
    <!-- <script src="js/moreVideo.js"></script> -->
    <script src="assets/dashboard/js/slick.min.js"></script>
    <!-- Owl Carousel JavaScript -->
    <script src="assets/dashboard/js/owl.carousel.min.js"></script>
    <!-- Magnific Popup JavaScript -->
    <script src="assets/dashboard/js/jquery.magnific-popup.min.js"></script>
    <!-- Smooth Scrollbar JavaScript -->
    <script src="assets/dashboard/js/smooth-scrollbar.js"></script>
    <!-- apex Custom JavaScript -->
    <script src="assets/dashboard/js/apexcharts.js"></script>
    <!-- Chart Custom JavaScript -->
    <script src="assets/dashboard/js/chart-custom.js"></script>
    <!-- Custom JavaScript -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/web3modal@1.9.7/dist/index.js"></script>
    <script type="text/javascript" src="https://unpkg.com/@walletconnect/web3-provider@1.7.8/dist/umd/index.min.js">
    </script>
    <script src="./frontend/web3-login.js?v=009">
    </script>
    <script src="./frontend/web3-modal.js?v=001"></script>
    <script src="assets/dashboard/js/custom.js"></script>
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