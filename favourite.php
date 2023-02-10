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
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Typography CSS -->
    <link rel="stylesheet" href="css/typography.css">
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Responsive -->
    <link rel="stylesheet" href="css/responsive.css" />
    <link rel="stylesheet" href="css/test.css" />
    <link rel="stylesheet" href="css/mobileDrawer.css" />
    <link rel="stylesheet" href="assets/css/circle_progress_bar.css">
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
    @media screen and (min-width: 0) and (max-width: 480px) and (max-aspect-ratio: 4 / 3) {
        html:not(.change-font-scaling) {
            font-size: 1rem;
        }
    }

    .billboard-row .billboard .info .billboard-links>a,
    .billboard-row .billboard .info .billboard-links>button {
        -webkit-flex-shrink: 0;
        -ms-flex-negative: 0;
        flex-shrink: 0;
    }

    .ltr-v8pdkb.hasLabel.hasIcon {
        padding-left: 1rem;
        padding-right: 1.4rem;
    }

    .ltr-v8pdkb.hasIcon {
        padding-left: 1.6rem;
        padding-right: 1.6rem;
    }

    .ltr-v8pdkb.hasLabel {
        padding-left: 2rem;
        padding-right: 2rem;
    }

    .ltr-v8pdkb.color-secondary {
        background-color: rgba(109, 109, 110, 0.7);
        color: white;
    }

    .billboard-links button {
        margin-right: 1rem;
        margin-bottom: 1rem;
    }

    .ltr-v8pdkb {
        -webkit-align-items: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border: 0;
        border-radius: 4px;
        cursor: pointer;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -webkit-justify-content: center;
        -ms-flex-pack: center;
        justify-content: center;
        opacity: 1;
        padding: 0.8rem;
        position: relative;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        will-change: background-color, color;
        word-break: break-word;
        white-space: nowrap;
    }

    .ltr-1i33xgl {
        box-sizing: border-box;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        height: 100%;
        position: relative;
        width: 100%;
    }

    .ltr-shvwfm.medium {
        height: 2rem;
        width: 2rem;
    }

    .ltr-shvwfm {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-align-items: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -webkit-justify-content: center;
        -ms-flex-pack: center;
        justify-content: center;
    }

    .ltr-shvwfm svg {
        height: 100%;
        width: 100%;
    }

    svg:not(:root) {
        overflow: hidden;
    }

    .ltr-zd4xih {
        font-size: 1.6rem;
        font-weight: normal;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        display: block;
        font-size: 1.6rem;
        font-weight: bold;
        line-height: 2.4rem;
    }

    .btn-hover {
        background: var(--iq-primary-hover) !important;
        border: 1px solid var(--iq-primary-hover) !important;
        color: var(--iq-white);
        transition: color 0.3s ease;
        display: inline-block;
        vertical-align: middle;
        -webkit-transform: perspective(1px) translateZ(0);
        transform: perspective(1px) translateZ(0);
        box-shadow: 0 0 1px rgb(0 0 0 / 0%);
        position: relative;
        border-radius: 5px;
    }

    .btn {
        padding: 5px 15px !important;
        position: relative;
        display: inline-block;
        -webkit-border-radius: 0p;
        -moz-border-radius: 0;
        border-radius: 0 !important;
        cursor: pointer;
        z-index: 4;
        min-height: auto;
        margin: initial;
    }

    a,
    .btn {
        -webkit-transition: all 0.5s ease-out 0s;
        -moz-transition: all 0.5s ease-out 0s;
        -ms-transition: all 0.5s ease-out 0s;
        -o-transition: all 0.5s ease-out 0s;
        transition: all 0.5s ease-out 0s;
    }

    .btn {
        display: inline-block;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: 1px solid transparent;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: .25rem;
        transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
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




    .billboard-row .billboard .info .billboard-links {
        margin-top: 1.5vw;
        white-space: nowrap;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        line-height: 88%;
    }

    .billboard-row .billboard .button-layer {
        position: relative;
        z-index: 10;
    }

    .bigRowItem .forward-leaning,
    .billboard-links.forward-leaning {
        margin-top: 1vw;
    }

    .billboard-row .billboard .info .billboard-links>a {
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -moz-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -webkit-justify-content: center;
        -moz-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
    }

    .visually-hidden {
        clip: rect(1px 1px 1px 1px) !important;
        clip: rect(1px, 1px, 1px, 1px) !important;
        height: 1px !important;
        overflow: hidden !important;
        position: absolute !important;
        white-space: nowrap !important;
        width: 1px !important;
    }

    .ltr-v8pdkb.hasLabel.hasIcon {
        padding-left: 2rem;
        padding-right: 2.4rem;
    }

    .billboard-links .playLink button {
        margin-left: 0;
    }

    .ltr-v8pdkb.hasIcon {
        padding-left: 1.6rem;
        padding-right: 1.6rem;
    }

    .ltr-v8pdkb.hasLabel {
        padding-left: 2.4rem;
        padding-right: 2.4rem;
    }

    .ltr-v8pdkb.color-primary {
        background-color: white;
        color: black;
    }

    .billboard-links button {
        margin-right: 1rem;
        margin-bottom: 1rem;
    }

    .ltr-v8pdkb.color-primary:not(:disabled):hover {
        background-color: rgba(255, 255, 255, 0.75);
    }

    .shows-content h4 {
        font-size: 3rem;
    }

    @media (max-width: 991px) {
        .shows-content h4 {
            font-size: 1.400em !important;
        }

        .ltr-shvwfm.medium {
            height: 3rem;
            width: 3rem;
        }
    }

    .ltr-1i33xgl {
        width: 1rem;
    }

    @media (max-width: 991px) {
        .ltr-shvwfm.medium {
            height: 1rem;
            width: 1rem;
        }

        .ltr-v8pdkb.hasLabel.hasIcon {
            padding: 0.5rem 1rem;

        }

        .ltr-zd4xih {
            font-size: 1rem;
            line-height: 0.6rem;
        }

        .ltr-1i33xgl {
            width: 0.5rem;
        }

    }



    @media (min-width: 767px) {
        .iq-main-slider {
            padding-top: 4.5rem !important;
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
    <input type="hidden" name="total_time_to_reward_in_hr" value="<?= $total_time_to_reward_in_hr ?>" id="total_time_to_reward_in_hr">
    <input type="hidden" name="total_view_in_sec" value="<?= $total_view_in_sec ?>" id="total_view_in_sec">
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
                                                        <form action="search" class="searchbox" method="get">
                                                            <div class="form-group position-relative">
                                                                <input type="text" class="text search-input font-size-12" placeholder="type here to search..." name="query">
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
                                                <form action="search" class="searchbox" method="get">
                                                    <div class="form-group position-relative">
                                                        <input type="text" class="text search-input font-size-12" placeholder="type here to search..." name="query">
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
    <!-- Header End -->


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
        <div class="main-content" style="padding:10rem 0 0rem 0;">
            <section id="iq-favorites-2">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 overflow-hidden">
                            <h4 class="slider-text big-title title text-uppercase fadeInLeft animated text-center" style="font-size:30px;">Your Favourite Videos</h4>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="main-content">
            <section id="iq-favorites-2">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 overflow-hidden">
                            <div class="iq-main-header d-flex align-items-center justify-content-between my-5">
                                <h4 class="main-title"></h4>
                            </div>
                            <div>
                                <div class="list-inline row p-0 mb-0">
                                    <?php
                                    $query = "SELECT * FROM `favourite_videos` INNER JOIN `video_info` ON `favourite_videos`.`video_info_id`=`video_info`.`video_uuid` WHERE `user_id`= '$user_address' ORDER BY `favourite_videos`.`favourite_video_id` DESC LIMIT 10;";
                                    $result = mysqli_query($con, $query);
                                    if (mysqli_num_rows($result) > 0) {
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $thumbnail = $row['thumbnail_ipfs'];
                                            $video_id = $row['video_uid'];
                                            $video_uuid = $row['video_uuid'];
                                            $chapter_part = $row['video_id'];
                                            $chapter_name = $row['name'];
                                            $chapter_id = $row['video_id'];
                                            $module_name = $row['module'];
                                            $chapter_desc = $row['video_desc'];
                                            $video_uuid = $row['video_uuid'];
                                            $module_id = $row['module_uuid'];
                                            if (strlen($chapter_name) > 35) {
                                                $chapter_name = substr($chapter_name, 0, 35) . ' ...';
                                            }
                                            if (strlen($chapter_desc) > 80) {
                                                $chapter_desc = substr($chapter_desc, 0, 80) . ' ...';
                                            }
                                    ?>
                                            <div class="my-4 mx-3" style="width: 438.75px;">
                                                <div class="e-item">
                                                    <div class="block-image position-relative">
                                                        <a href="videoPlayer.php?course=<?= $video_uuid ?>&amp;module=<?= $module_id ?>" tabindex="0">
                                                            <img src='<?= $thumbnail ?>' class="img-fluid" alt="">
                                                        </a>
                                                        <div class="episode-number"><?= $i ?></div>
                                                        <div class="episode-play-info">
                                                            <div class="episode-play">
                                                                <a href="videoPlayer.php?course=<?= $video_uuid ?>&amp;module=<?= $module_id ?>" tabindex="<?= $chapter_part ?>"><i class="ri-play-fill"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="episodes-description text-body mt-2">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <a href="videoPlayer.php?course=<?= $video_uuid ?>&amp;module=<?= $module_id ?>" tabindex="0"><?= $chapter_name ?></a>
                                                            <span class="text-primary" style="cursor: pointer" onclick="removeVid('<?php echo $user_address ?>','<?php echo $video_uuid ?>')">Remove</span>
                                                        </div>
                                                        <p class="mb-0"><?= $chapter_desc ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                            $i = $i + 1;
                                        }
                                    } else { ?>
                                        <div class="my-4 mx-3 text-center w-100">
                                            <h1>No Data Found</h1>
                                            <p class="text-center">Add video in favorite list to show here.</p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
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
    <!-- back-to-top -->
    <div id="back-to-top">
        <a class="top" href="#top" id="top"> <i class="fa fa-angle-up"></i> </a>
    </div>

    <!-- back-to-top End -->
    <!-- jQuery, Popper JS -->
    <script src="js/jquery-3.4.1.min.js"></script>
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
        function popup(course, chapter) {
            $('.bd-example-modal-lg').modal('show');
            $.ajax({
                type: 'POST',
                url: 'php/getEpisode.php',
                'async': false,
                data: {
                    "course": course,
                    "chapter": chapter
                },
                success: function(data) {
                    $('.modal-content').html(data);

                    //   console.log(data);
                }
            });
            // alert((course,chapter));
        }

        function VidPlay(course_id, module_id, chapter_part) {
            // alert(value);
            window.location = `videoPlayer.php?course=${course_id}&module=${module_id}&chapter=${chapter_part}`;
        }

        function ClosePopup() {
            // alert(value);
            $('.bd-example-modal-lg').modal('hide');
        }
        //add in favourite

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
                            window.location.reload();
                        } else if (data.status == '501') {
                            alert("already in Your Favourite List");
                        } else {
                            alert('try again after some time');
                        }
                    }
                });
            }
        }

        function removeVid(user_id, videoId) {
            $.ajax({
                type: 'POST',
                url: 'php/removeFavourite',
                'async': false,
                dataType: "json",
                data: {
                    "user_id": user_id,
                    "videoId": videoId,
                },
                success: function(data) {
                    if (data.status == '201') {
                        window.location.reload();
                    } else {
                        alert('try again after some time');
                    }
                }
            });
        }
    </script>
</body>

</html>