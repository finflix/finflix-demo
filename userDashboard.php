<?php
session_start();
require_once('php/link.php');
$user_address = '';
if (isset($_SESSION['userAddress'])) {
    $user_address = $_SESSION['userAddress'];
} else {
    header('Location:index');
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
<html lang="en">

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
    <!-- Favicon -->
    <link rel="shortcut icon" href="https://templates.iqonic.design/lite/streamit/html/assets/images/favicon.ico" />
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
</head>

<body>
    <!-- loader Start -->
    <!-- <div id="loading">
        <div id="loading-center">
        </div>
    </div> -->
    <!-- loader END -->
    <!-- Wrapper Start -->
    <input type="hidden" name="userAddress" id="userAddress" value="<?= $user_address ?>">
    <input type="hidden" name="total_time_to_reward_in_hr" value="<?= $total_time_to_reward_in_hr ?>" id="total_time_to_reward_in_hr">
    <input type="hidden" name="total_view_in_sec" value="<?= $total_view_in_sec ?>" id="total_view_in_sec">
    <div class="wrapper">
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
                                                            <form action="search" class="searchbox ml-4" method="get" style="background: rgb(55 55 55 / 50%);">
                                                                <div class="form-group position-relative">
                                                                    <input type="text" class="text search-input font-size-12" placeholder="type here to search..." name="query" style="background: rgb(55 55 55 / 50%);">
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
                                                                <a href="javascript:void(0)" class="btn btn-hover buttonText" style="font-size:1rem;background: #007bff;color: #fff;" onclick="userLoginOut()">Sign In</a>
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
                                                    <form action="search" class="searchbox" method="get" style="background: #1e1e1f;">
                                                        <div class="form-group position-relative">
                                                            <input type="text" class="text search-input font-size-12" placeholder="type here to search..." name="query" style="background: #1e1e1f;border:none">
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
                                                        <a href="javascript:void(0)" class="btn btn-hover buttonText" style="font-size:1rem;background: #007bff;color: #fff;" onclick="userLoginOut()">Sign In</a>
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
            <header id="main-header">
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
                                                            <form action="search" class="searchbox ml-4" method="get" style="background: rgb(55 55 55 / 50%);">
                                                                <div class="form-group position-relative">
                                                                    <input type="text" class="text search-input font-size-12" placeholder="type here to search..." name="query" style="background: rgb(55 55 55 / 50%);">
                                                                    <i class="search-link ri-search-line"></i>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </li>
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
                                                    <form action="search" class="searchbox ml-4" method="get" style="background: rgb(55 55 55 / 50%);">
                                                        <div class="form-group position-relative">
                                                            <input type="text" class="text search-input font-size-12" placeholder="type here to search..." name="query" style="background: rgb(55 55 55 / 50%);">
                                                            <i class="search-link ri-search-line"></i>
                                                        </div>
                                                    </form>
                                                </div>
                                            </li>
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
        <!-- Page Content  -->
        <div id="content-page" class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-sm-6 col-lg-6 col-xl-3">
                                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                                    <div class="iq-card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="iq-cart-text text-capitalize">
                                                <p class="mb-0">
                                                    view
                                                </p>
                                            </div>
                                            <div class="icon iq-icon-box-top rounded-circle bg-primary">
                                                <i class="las la-eye"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-3">
                                            <h4 class=" mb-0">+<span id="total_views">0</span></h4>
                                            <p class="mb-0 text-primary"><span><i class="fa fa-caret-down mr-2"></i></span>35%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6 col-xl-3">
                                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                                    <div class="iq-card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="iq-cart-text text-capitalize">
                                                <p class="mb-0 font-size-14">
                                                    Likes
                                                </p>
                                            </div>
                                            <div class="icon iq-icon-box-top rounded-circle bg-success">
                                                <i class="lar la-thumbs-up"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-3">
                                            <h4 class=" mb-0">+<span id="total_likes">0</span></h4>
                                            <p class="mb-0 text-success"><span><i class="fa fa-caret-up mr-2"></i></span>50%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6 col-xl-3">
                                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                                    <div class="iq-card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="iq-cart-text text-capitalize">
                                                <p class="mb-0 font-size-14">
                                                    Dislikes
                                                </p>
                                            </div>
                                            <div class="icon iq-icon-box-top rounded-circle bg-info">
                                                <i class="las la-thumbs-down"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-3">
                                            <h4 class=" mb-0">+<span id="total_dislikes">0</span></h4>
                                            <p class="mb-0 text-info"><span><i class="fa fa-caret-down mr-2"></i></span>30%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6 col-xl-3">
                                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                                    <div class="iq-card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="iq-cart-text text-uppercase">
                                                <p class="mb-0 font-size-14">
                                                    Videos
                                                </p>
                                            </div>
                                            <div class="icon iq-icon-box-top rounded-circle bg-warning">
                                                <i class="las la-film"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-3">
                                            <h4 class=" mb-0">+<span id="total_videos">0</span></h4>
                                            <p class="mb-0 text-warning"><span><i class="fa fa-caret-up mr-2"></i></span>80%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between align-items-center">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Top Viewed Videos </h4>
                                </div>
                                <div id="top-rated-item-slick-arrow" class="slick-aerrow-block "></div>
                            </div>
                            <div class="iq-card-body">
                                <ul class="list-unstyled row top-rated-item mb-0" id="sliderDataAppend">
                                    <!-- slider data insert here -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="iq-card iq-card iq-card-block iq-card-stretch iq-card-height">
                            <div class="iq-card-header">
                                <div class="iq-header-title">
                                    <h4 class="card-title text-center">Account Information</h4>
                                </div>
                            </div>
                            <div class="iq-card-body pb-0">
                                <div id="view-chart-01">
                                </div>
                                <div class="row mt-1">
                                    <div class="col-sm-6 col-md-3 col-lg-6 iq-user-list">
                                        <div class="iq-card">
                                            <div class="iq-card-body">
                                                <div class="media align-items-center">
                                                    <div class="iq-user-box" style="background:#dc3545;"></div>
                                                    <div class="media-body text-white">
                                                        <p class="mb-0 font-size-14 line-height">Total <br>
                                                            Views
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3 col-lg-6 iq-user-list">
                                        <div class="iq-card">
                                            <div class="iq-card-body">
                                                <div class="media align-items-center">
                                                    <div class="iq-user-box bg-warning"></div>
                                                    <div class="media-body text-white">
                                                        <p class="mb-0 font-size-14 line-height">Total <br>
                                                            Likes
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3 col-lg-6 iq-user-list">
                                        <div class="iq-card">
                                            <div class="iq-card-body">
                                                <div class="media align-items-center">
                                                    <div class="iq-user-box bg-info"></div>
                                                    <div class="media-body text-white">
                                                        <p class="mb-0 font-size-14 line-height">Total<br>
                                                            Dislikes
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3 col-lg-6 iq-user-list">
                                        <div class="iq-card">
                                            <div class="iq-card-body">
                                                <div class="media align-items-center">
                                                    <div class="iq-user-box bg-danger"></div>
                                                    <div class="media-body text-white">
                                                        <p class="mb-0 font-size-14 line-height">Total <br>
                                                            Videos
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12  col-lg-4">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                            <div class="iq-card-header d-flex align-items-center justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Last 7 Video Performance</h4>
                                </div>
                            </div>
                            <div class="iq-card-body p-0">
                                <div id="view-chart-03"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                            <div class="iq-card-header d-flex align-items-center justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Raised Money</h4>
                                </div>
                                <div class="iq-card-header-toolbar d-flex align-items-center seasons">
                                    <div class="iq-custom-select d-inline-block sea-epi s-margin">
                                        <select name="cars" class="form-control season-select">
                                            <option value="season1">Today</option>
                                            <option value="season2">This Week</option>
                                            <option value="season2">This Month</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="iq-card-body row align-items-center">
                                <div class="col-lg-7">
                                    <div class="row list-unstyled mb-0 pb-0">
                                        <div class="col-sm-6 col-md-4 col-lg-6 mb-3">
                                            <div class="iq-progress-bar progress-bar-vertical iq-bg-primary">
                                                <span class="bg-primary" data-percent="100" style="transition: height 2s ease 0s; width: 100%; height: 40%;"></span>
                                            </div>
                                            <div class="media align-items-center">
                                                <div class="iq-icon-box-view rounded mr-3 iq-bg-primary"><i class="las la-money-bill font-size-32"></i></div>
                                                <div class="media-body text-white">
                                                    <h6 class="mb-0 font-size-14 line-height"><span id="eth_tipping">0.000</span> ETH</h6>
                                                    <small class="text-primary mb-0">By Tipping</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-6 mb-3">
                                            <div class="iq-progress-bar progress-bar-vertical iq-bg-info">
                                                <span class="bg-info" data-percent="100" style="transition: height 2s ease 0s; width: 100%; height: 40%;"></span>
                                            </div>
                                            <div class="media align-items-center">
                                                <div class="iq-icon-box-view rounded mr-3 iq-bg-info"><i class="las la-money-bill-wave font-size-32"></i></div>
                                                <div class="media-body text-white">
                                                    <p class="mb-0 font-size-14 line-height"><span id="matic_tipping">0.000</span> MATIC</p>
                                                    <small class="text-info mb-0">By Tipping</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-6 mb-3">
                                            <div class="iq-progress-bar progress-bar-vertical iq-bg-warning">
                                                <span class="bg-warning" data-percent="100" style="transition: height 2s ease 0s; width: 40%; height: 40%;"></span>
                                            </div>
                                            <div class="media align-items-center">
                                                <div class="iq-icon-box-view rounded mr-3 iq-bg-warning"><i class="las la-hand-holding-usd font-size-32"></i></div>
                                                <div class="media-body text-white">
                                                    <p class="mb-0 font-size-14 line-height"><span id="eth_crowdfunding">0.000</span> ETH</p>
                                                    <small class="text-warning mb-0">By Crowdfunding</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-6 mb-lg-0 mb-3">
                                            <div class="iq-progress-bar progress-bar-vertical iq-bg-success">
                                                <span class="bg-success" data-percent="100" style="transition: height 2s ease 0s; width: 60%; height: 60%;"></span>
                                            </div>
                                            <div class="media align-items-center mb-lg-0 mb-3">
                                                <div class="iq-icon-box-view rounded mr-3 iq-bg-success"><i class="las la-donate font-size-32"></i></div>
                                                <div class="media-body text-white">
                                                    <p class="mb-0 font-size-14 line-height"><span id="matic_crowdfunding">0.000</span> MATIC</p>
                                                    <small class="text-success mb-0">By Crowdfunding</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div id="view-chart-02" class="view-cahrt-02"></div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                                <th style="width:10%;"><i class="lar la-heart"></i></th>
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
                                                        <td><i class="las la-heart text-primary"></i></td>
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
    </div>
    <!-- Wrapper END -->

    <!-- Footer -->
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
    <!-- Footer END -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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
    <!-- Slick JavaScript -->
    <script>
        const user_address = $('#userAddress').val();

        function setLikeData(user_address) {
            $.ajax({
                url: "php/dashboardData/fetchDashboardVideo.php",
                method: "POST",
                data: {
                    user_address: user_address,
                },
                success: function(data) {
                    $('#sliderDataAppend').append(data);
                    // data.map((v) => {
                    //     console.log(v);
                    // });
                }
            });
        }
        setLikeData(user_address);

        function setViewVideosData(user_address) {
            $.ajax({
                url: "php/dashboardData/fetchLastVideosViews.php",
                method: "POST",
                data: {
                    user_address: user_address,
                },
                success: function(data) {
                    data = JSON.parse(data);
                    // console.log(data);
                    data.map((v) => {
                        // top chart 2
                        function draw_2_chart(array1, array2) {
                            if (jQuery("#view-chart-03").length) {
                                var options = {
                                    series: [{
                                        name: 'views',
                                        data: array1
                                    }],
                                    chart: {
                                        height: 350,
                                        type: 'area'
                                    },
                                    dataLabels: {
                                        enabled: false
                                    },
                                    stroke: {
                                        curve: 'smooth'
                                    },
                                    xaxis: {
                                        type: 'category',
                                        categories: array2
                                    },
                                    tooltip: {
                                        x: {
                                            format: 'dd/MM/yy HH:mm'
                                        },
                                    },
                                    animations: {
                                        enabled: true,
                                        easing: 'easeinout',
                                        speed: 800,
                                        animateGradually: {
                                            enabled: true,
                                            delay: 150
                                        },
                                        dynamicAnimation: {
                                            enabled: true,
                                            speed: 350
                                        }
                                    }
                                };

                                var chart = new ApexCharts(document.querySelector("#view-chart-03"), options);
                                chart.render();
                            }
                        }
                        draw_2_chart(v[1], v[0])
                    });
                }
            });
        }
        setViewVideosData(user_address);

        function setFundData(user_address) {
            $.ajax({
                url: "php/dashboardData/getCrowdfundTippingData.php",
                method: "POST",
                data: {
                    user_address: user_address,
                },
                success: function(data) {
                    const rawdata = JSON.parse(data);
                    $('#eth_tipping').html(rawdata[0]);
                    $('#matic_tipping').html(rawdata[1]);
                    $('#eth_crowdfunding').html(rawdata[2]);
                    $('#matic_crowdfunding').html(rawdata[3]);

                    const array = data.match(/\d+(?:\.\d+)?/g).map(Number)
                    // top chart 2
                    if (jQuery("#view-chart-02").length) {
                        var options = {
                            series: array,
                            chart: {
                                width: 250,
                                type: "donut",
                            },
                            colors: ["#e20e02", "#007aff", "#f68a04", "#14e788"],
                            labels: ["ETH Tipping", "MATIC Tipping", "ETH Crowdfunding", "MATIC Crowdfunding"],
                            dataLabels: {
                                enabled: false,
                            },
                            stroke: {
                                show: false,
                                width: 0,
                            },
                            legend: {
                                show: false,
                                formatter: function(val, opts) {
                                    return val + " - " + opts.w.globals.series[opts.seriesIndex];
                                },
                            },
                            responsive: [{
                                breakpoint: 480,
                                options: {
                                    chart: {
                                        width: 200,
                                    },
                                    legend: {
                                        position: "bottom",
                                    },
                                },
                            }, ],
                        };

                        var chart = new ApexCharts(document.querySelector("#view-chart-02"), options);
                        chart.render();
                    }
                    // $('#sliderDataAppend').append(data);
                    // data.map((v) => {
                    //     console.log(v);
                    // });
                }
            });
        }
        setFundData(user_address);
    </script>
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
    <script>
        function setViewData(user_address) {
            $.ajax({
                url: "php/dashboardData/fetchTotalViewData.php",
                method: "POST",
                data: {
                    user_address: user_address,
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.status === 201) {
                        $('#total_views').html(data.total_views);
                        $('#total_likes').html(data.total_likes);
                        $('#total_videos').html(data.total_videos);
                        $('#total_dislikes').html(data.total_dislikes);
                        draw_1_chart(parseInt(data.pie_views), parseInt(data.pie_likes), parseInt(data.pie_dislikes), parseInt(data.pie_videos))
                    } else {

                    }
                }
            });
        }
        setViewData(user_address);
    </script>
    <script>
        // top chart 1
        function draw_1_chart(value1, value2, value3, value4) {
            if (jQuery('#view-chart-01').length) {
                var options = {
                    series: [value1, value2, value3, value4],
                    chart: {
                        width: 250,
                        type: 'donut',
                    },
                    colors: ['#e20e02', '#f68a04', '#007aff', '#545e75'],
                    labels: ["Total Views", "Total Likes", "Total Dislikes", "Total Videos"],
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: false,
                        width: 0
                    },
                    legend: {
                        show: false,
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };
                var chart = new ApexCharts(document.querySelector("#view-chart-01"), options);
                chart.render();
            }
        }
    </script>
</body>

</html>