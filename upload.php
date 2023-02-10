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
    <link rel="stylesheet" href="css/mobileDrawer.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="css/extra-setting.css">
    <link href="assets/toastr/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/circle_progress_bar.css">
    <link rel="stylesheet" href="assets/css/newLoader.css">
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
<!-- loader END -->
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
<input type="hidden" name="total_time_to_reward_in_hr" value="<?= $total_time_to_reward_in_hr ?>" id="total_time_to_reward_in_hr">
<input type="hidden" name="total_view_in_sec" value="<?= $total_view_in_sec ?>" id="total_view_in_sec">
<?php
$user_img = '#';
?>
<!-- Header -->
<!-- desktop header -->
<input type="hidden" id="user_address" name="user_address" value="<?php echo $user_address; ?>">
<input type="hidden" id="user_amount_in" name="user_amount_in" value="ETH">
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

<!-- Video upload from start -->
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
                <h3 class="text-center">Video Uploader</h3>
            </div>
        </div>
        <div class="row d-flex justify-content-center align-items-center mt-5 py-4 px-3" style="box-shadow:10px 10px 60px 40px rgb(72 89 171 / 18%)">
            <div class="col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center align-items-center">
                <img src="images/upload-bro.svg" style="background: #464646;box-shadow: 0 0 10px 0 rgb(236 230 230 / 20%);border-radius:1rem;" class="img img-responsive">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center align-items-center" style="margin-bottom: 4rem;">
                <form action="" class="p-3 d-flex align-item-center border form-container">
                    <div class="container">
                        <div class="row" id="setColumnHeight">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="select">Select an option</label>
                                    <select class="form-control" id="select" required>
                                        <option>Choose video category</option>
                                        <option value="927f0965-6eed-462c-bfa0-79867c9f9448">Explainers</option>
                                        <option value="fd3d24bd-8764-494e-9ade-40911b8e11a1">Tutorials</option>
                                        <option value="5dae4ba7-933a-40a9-8866-49ee971ccf87">Review</option>
                                        <option value="5822014a-02af-41c4-8564-0ec4ceba8db6">News</option>
                                        <option value="0f01d804-648d-42a7-ab11-bdc373f4b7bd">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" required rows="2"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="thumbnail">Thumbnail</label>
                                    <div class="drop-zone">
                                        <span class="drop-zone__prompt"><i class="fa-solid fa-cloud-arrow-up icon"></i><br>Drop thumbnail here or click
                                            to upload</span>
                                        <input type="file" name="thumbnail" id="thumbnail" class="drop-zone__input" required accept="image/*">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="video">Video</label>
                                    <div class="drop-zone">
                                        <span class="drop-zone__prompt"><i class="fa-solid fa-cloud-arrow-up icon"></i><br>Drop video here or click to
                                            upload</span>
                                        <input type="file" name="video" id="video" class="drop-zone__input" required accept="video/*">
                                    </div>
                                    <span class="text-warning my-1" style="font-size:12px;"><i class="fa fa-info-circle" aria-hidden="true"></i> Video size
                                        should be less than 100 mb</span>
                                </div>
                            </div>
                            <div class="row p-0 m-0 auto-height-set d-block w-100">
                                <!-- funding code start -->
                                <div class="col-12" id="crowdfunding_section">
                                    <div class="shadow px-3 py-1 mb-3" style="color:var(--text-color);">
                                        <div>
                                            <div class="d-flex align-items-center justify-content-between my-3">
                                                <h5>Raise Crowdfund</h5>
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="crowd_funding_switch">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- funding body start -->
                                            <div id="crowd_funding_body">
                                                <!-- croudfunding button start -->
                                                <div class="d-flex justify-content-around align-items-center my-2 p-3" style="background:#20222c;">
                                                    <form id="croudfunding_form_area" class="w-100" name="croudfunding_form_area">
                                                        <div class="radio">
                                                            <input id="radio-4" name="radio_crowd" type="radio" value="ETH" checked>
                                                            <label for="radio-4" class="radio-label" style="color:var(--text-color);"><img style="width:1.2rem;height:1.2rem;" src="images/download.png" alt="matic" class="img-responsive mx-1">
                                                                ETH</label>
                                                        </div>

                                                        <div class="radio">
                                                            <input id="radio-5" name="radio_crowd" type="radio" value="MATIC">
                                                            <label for="radio-5" class="radio-label" style="color:var(--text-color);"><img style="width:1.2rem;height:1.2rem;" src="images/polygon-matic-logo.png" alt="matic" class="img-responsive mx-1">
                                                                MATIC</label>
                                                        </div>
                                                        <!-- <div class="radio">
                                                            <input id="radio-6" name="radio_crowd" type="radio" value="BNB">
                                                            <label for="radio-6" class="radio-label" style="color:var(--text-color);"><img style="width:1.2rem;height:1.2rem;" src="images/bnb.png" alt="matic" class="img-responsive mx-1">
                                                                BNB</label>
                                                        </div> -->
                                                    </form>
                                                </div>
                                                <!-- croudfunding button end -->


                                                <!-- <div class="d-flex justify-content-center align-items-center my-2 p-3"
                                                                    style="background:#f4fbff;">                                                                   
                                                                    <label class="mx-2 network_class_eth" style="color:var(--text-color);font-size:16px;font-weight:bold;"><img
                                                                            style="width:1.2rem;height:1.2rem;"
                                                                            src="assets/images/download.png" alt="matic"
                                                                            class="img-responsive mx-1">ETH</label>
                                                                    <div class="form-check form-switch">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            id="crowd_funding_network"
                                                                            style="width:2.4em;height:1.2em">
                                                                    </div>
                                                                    <label
                                                                        class="mx-1 network_class_matic d-flex justify-content-center align-items-center"
                                                                        style="color:var(--text-color);font-size:16px;"><img
                                                                            style="width:1.2rem;height:1.2rem;"
                                                                            src="assets/images/polygon-matic-logo.png"
                                                                            alt="matic"
                                                                            class="img-responsive mx-1">MATIC</label>                                                                    
                                                                </div> -->

                                                <!-- eth_crowd_funding_network start-->
                                                <div id="eth_crowdfunding_section">
                                                    <div class="d-flex justify-content-center align-items-center my-3">
                                                        <form class="form">
                                                            <p>Collect up to <span id="eth_show_value">0</span> ETH
                                                                ($<span id="dollar_amount">0.00</span>)
                                                                with these settings.</p>
                                                            <div class="d-flex form-row align-items-center row mb-2">
                                                                <div class="col-md-12">
                                                                    <label class="sr-only" for="min_donation">Min
                                                                        Donation</label>
                                                                    <div class="input-group mb-2">
                                                                        <input type="number" class="form-control" id="min_donation" placeholder="Min Donation" min="0">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                ETH</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="sr-only" for="target_amount">Target
                                                                        Value</label>
                                                                    <div class="input-group mb-2">
                                                                        <input type="number" class="form-control currencyField" id="target_amount" placeholder="Target Amount" min="0" name="convFrom">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                ETH</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-auto mt-2 w-100">
                                                                    <div class="form-check mb-2 py-2 w-100 d-flex justify-content-between" style="background:#20222c;color: #429dff;">
                                                                        <input class="form-check-input px-lg-2" style="width: 2rem;" type="checkbox" id="settingConfiramtion">
                                                                        <label class="form-check-label w-100 ml-2" for="settingConfiramtion">
                                                                            I confirm these settings are
                                                                            correct and
                                                                            would
                                                                            be not change in future.
                                                                        </label>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <small style="font-size:0.75rem;"><b>*Min
                                                                    Donation:&nbsp;</b>You
                                                                can
                                                                set minimum amount which user can
                                                                pay.</small><br>
                                                            <small style="font-size:0.75rem;"><b>**Target
                                                                    Amount:&nbsp;</b>You
                                                                can set total funding required.</small>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- eth_crowd_funding_network end-->

                                                <!-- matic_crowd_funding_network start-->
                                                <div id="matic_crowdfunding_section" style="display:none;">
                                                    <div class="d-flex justify-content-center align-items-center my-3">
                                                        <form class="form">
                                                            <p>Collect up to <span id="matic_show_value">0</span> MATIC
                                                                ($<span id="dollar_amount_matic">0.00</span>)
                                                                with these settings.</p>
                                                            <div class="d-flex form-row align-items-center row mb-2">
                                                                <div class="col-md-12">
                                                                    <label class="sr-only" for="min_donation_matic">Min
                                                                        Donation</label>
                                                                    <div class="input-group mb-2">
                                                                        <input type="number" class="form-control" id="min_donation_matic" placeholder="Min Donation" min="0">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                MATIC</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="sr-only" for="target_amount_matic">Target
                                                                        Value</label>
                                                                    <div class="input-group mb-2">
                                                                        <input type="number" class="form-control currencyFieldMatic" id="target_amount_matic" placeholder="Target Amount" min="0" name="convFromMatic">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                MATIC</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-auto mt-2 w-100">
                                                                    <div class="form-check mb-2 py-2 w-100 d-flex justify-content-between" style="background:#20222c;color: #429dff;">
                                                                        <input class="form-check-input px-lg-2" style="width: 2rem;" type="checkbox" id="settingConfiramtion_matic">
                                                                        <label class="form-check-label w-100 ml-2" for="settingConfiramtion_matic">
                                                                            I confirm these settings are
                                                                            correct and
                                                                            would
                                                                            be not change in future.
                                                                        </label>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <small style="font-size:0.75rem;"><b>*Min
                                                                    Donation:&nbsp;</b>You
                                                                can
                                                                set minimum amount which user can
                                                                pay.</small><br>
                                                            <small style="font-size:0.75rem;"><b>**Target
                                                                    Amount:&nbsp;</b>You
                                                                can set total funding required.</small>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- matic_crowd_funding_network end-->
                                                <!-- bnb_crowd_funding_network start-->
                                                <div id="bnb_crowdfunding_section" style="display:none;">
                                                    <div class="d-flex justify-content-center align-items-center my-3">
                                                        <form class="form">
                                                            <p>Collect up to <span id="bnb_show_value">0</span> BNB
                                                                ($<span id="dollar_amount_bnb">0.00</span>)
                                                                with these settings.</p>
                                                            <div class="d-flex form-row align-items-center row mb-2">
                                                                <div class="col-md-12">
                                                                    <label class="sr-only" for="min_donation_bnb">Min
                                                                        Donation</label>
                                                                    <div class="input-group mb-2">
                                                                        <input type="number" class="form-control" id="min_donation_bnb" placeholder="Min Donation" min="0">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                BNB</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="sr-only" for="target_amount_bnb">Target
                                                                        Value</label>
                                                                    <div class="input-group mb-2">
                                                                        <input type="number" class="form-control currencyFieldBnb" id="target_amount_bnb" placeholder="Target Amount" min="0" name="convFromBnb">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                BNB</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-auto mt-2 w-100">
                                                                    <div class="form-check mb-2 py-2 w-100 d-flex justify-content-between" style="background:#20222c;color: #429dff;">
                                                                        <input class="form-check-input px-lg-2" style="width: 2rem;" type="checkbox" id="settingConfiramtion_bnb">
                                                                        <label class="form-check-label w-100 ml-2" for="settingConfiramtion_bnb">
                                                                            I confirm these settings are
                                                                            correct and
                                                                            would
                                                                            be not change in future.
                                                                        </label>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <small style="font-size:0.75rem;"><b>*Min
                                                                    Donation:&nbsp;</b>You
                                                                can
                                                                set minimum amount which user can
                                                                pay.</small><br>
                                                            <small style="font-size:0.75rem;"><b>**Target
                                                                    Amount:&nbsp;</b>You
                                                                can set total funding required.</small>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- matic_crowd_funding_network end-->
                                            </div>
                                            <!-- funding body end -->
                                        </div>
                                    </div>
                                </div>
                                <!-- funding code end -->
                            </div>
                            <div class="btn-container">
                                <!-- <button type="button" id="uploadBtn" class="btn btn-primary" >Upload</button> -->
                                <button type="button" class="btn btn-primary w-100 d-flex justify-content-center align-items-center" id="uploadBtn" onclick="uploadVideo()">
                                    <span class="button__text">UPLOAD</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.7.1-rc.0/web3.min.js"></script>
<script src="https://aloycwl.github.io/js/cdn/ipfs-api.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/near-api-js@0.41.0/dist/near-api-js.min.js"></script>
<script src="js/moment.min.js"></script>
<script src="js/moment-duration-format.min.js"></script>
<script src="assets/toastr/toastr.min.js"></script>
<!-- eth -->
<script src="contract/EthAbi.js"></script>
<script src="contract/EthContract.js"></script>
<!-- matic -->
<script src="contract/matic/maticFactoryContract.js"></script>
<script src="contract/matic/maticContract.js"></script>
<!-- bnb -->
<script src="contract/bnb/bnbFactoryContract.js"></script>
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
    var crowd_on_off = false;
    var crowdfunding_price_confiramtion = false;
    var project_uri_ipfs_link = '';
    var crowd_funding_switch = false;
    var crowd_funding_network = false;
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
    async function fun_project_qri(crowd_project_uri) {
        console.log(JSON.stringify(crowd_project_uri));
        const projectId = '2DInI7VLAGEHD8O9MjGjm2HDlo5';
        const projectSecret = 'f69504cfab98937d3b6bd405d175420a';
        const auth = 'Basic ' + Buffer.from(projectId + ':' + projectSecret).toString('base64');

        ipfs = IpfsApi({
            host: 'ipfs.infura.io',
            port: 5001,
            protocol: 'https',
            headers: {
                authorization: auth,
            },
        });
        console.log(ipfs, 'ipfs');
        pro = await new Promise(async (d) => {
            reader = new FileReader();
            reader.onloadend = () => {
                ipfs.add(ipfs.Buffer.from(reader.result)).then((files) => {
                    d(files);
                });
            };
            await fetch(window.location.href).then(response => response.text()).then(
                formatedResponse => {
                    reader.readAsArrayBuffer(new File([JSON.stringify(crowd_project_uri)],
                        'application/json'));
                })

        });
        if (pro) {
            var ipfs_link = (`https://ipfs.io/ipfs/${pro[0].hash}`);
            return ipfs_link;
        } else {
            return;
        }

    }
    const client = 'https://';
    const web3storage = ".ipfs.w3s.link";
    var thumbnail_cid = "";
    var video_cid = "";

    function uploadVideo() {
        var user_address = $('#user_address').val();
        var title = $('#title').val();
        var description = $('#description').val();
        var thumbnail = $('#thumbnail').val();
        var category = $('#select').val();
        var video = $('#video').val();
        var user_type = "user";
        const crowd_min_amount = parseFloat($('#min_donation').val());
        const crowd_target_amount = parseFloat($('#target_amount').val());
        const crowd_min_amount_matic = parseFloat($('#min_donation_matic').val());
        const crowd_target_amount_matic = parseFloat($('#target_amount_matic').val());
        const crowd_min_amount_bnb = parseFloat($('#min_donation_bnb').val());
        const crowd_target_amount_bnb = parseFloat($('#target_amount_bnb').val());
        var crowd_amount_in = $('#user_amount_in').val();
        const crowd_current_datetime = moment().format('MMMM Do YYYY, h:mm:ss a');
        const current_timestamp = Date.now();
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
            var formData = new FormData();
            var form2 = new FormData();
            form2.append("file", vv.files[0], (vv.files[0]).name);
            var form1 = new FormData();
            form1.append("file", tt.files[0], (tt.files[0]).name);

            if ($("#crowd_funding_switch").is(':checked')) {
                crowd_on_off = true;
                console.log($('#user_amount_in').val());
                if ($('#user_amount_in').val() === 'ETH') {
                    confirmation_function();
                } else if ($('#user_amount_in').val() === 'MATIC') {
                    confirmation_function_matic();
                } else if ($('#user_amount_in').val() === 'BNB') {
                    confirmation_function_bnb();
                } else {
                    console.log('something went wrong');
                }
                const is_confirm_crowd = $("#settingConfiramtion").is(':checked');
                const is_confirm_crowd_matic = $("#settingConfiramtion_matic").is(':checked');
                const is_confirm_crowd_bnb = $("#settingConfiramtion_bnb").is(':checked');
                if (crowdfunding_price_confiramtion && crowd_on_off && (is_confirm_crowd ||
                        is_confirm_crowd_matic || is_confirm_crowd_bnb)) {
                    formData.append('is_crowdfunding', true);
                } else {
                    crowdfunding_price_confiramtion = false;
                }
            } else {
                crowd_on_off = false;
                formData.append('is_crowdfunding', false);
            }


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
                "data": form2
            };

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

            function test(settings, settings1) {
                var video_cid = '';
                var thumbnail_cid = '';
                $.ajax(settings1).done(async function(response) {
                    thumbnail_cid = await JSON.parse(response).cid;
                    hello(thumbnail_cid, settings);
                });

                function hello(thumbnail_cid, settings) {
                    $.ajax(settings).done(async function(response) {
                        video_cid = await JSON.parse(response).cid;
                        // console.log(thumbnail_cid, 'thumbnail_cid inner');
                        // console.log(video_cid, 'video_cid inner');
                        videoUploadContract(video_cid, thumbnail_cid);
                    });
                }
            }
            test(settings, settings1);

            function videoUploadContract(video_cid, thumbnail_cid) {
                if (video_cid != "" && thumbnail_cid != "") {
                    console.warn(thumbnail_cid, video_cid);
                    // crowdfunding test start
                    authoraddress = $('#user_address').val();
                    formData.append('name', title);
                    formData.append('category', category);
                    formData.append('video_desc', description);
                    formData.append('thumbnail_ipfs', client + thumbnail_cid + web3storage);
                    formData.append('video_ipfs', client + video_cid + web3storage);
                    formData.append('user_address', user_address);
                    formData.append('user_type', user_type);

                    console.log(crowd_on_off, 'crowd_on_off');

                    const crowd_project_uri = [{
                        content: {
                            title: title,
                            video_cid: video_cid,
                            thumbnail_cid: thumbnail_cid,
                            category: category,
                            user_type: user_type,
                            story: description,
                            thumbnail_url: client + thumbnail_cid + web3storage,
                            video_url: client + video_cid + web3storage,
                            timestamp: current_timestamp
                        },
                        author: {
                            address: authoraddress,
                            // uid: user_uid,
                            // username: username,
                        },
                        crowdfunding_details: {
                            min_pay_amount: crowd_min_amount,
                            target_amount: crowd_target_amount,
                            amount_in: crowd_amount_in
                        },
                        created_at: crowd_current_datetime,
                        updated_at: crowd_current_datetime
                    }];

                    const crowd_project_uri_matic = [{
                        content: {
                            title: title,
                            video_cid: video_cid,
                            thumbnail_cid: thumbnail_cid,
                            category: category,
                            user_type: user_type,
                            story: description,
                            thumbnail_url: client + thumbnail_cid + web3storage,
                            video_url: client + video_cid + web3storage,
                            timestamp: current_timestamp
                        },
                        author: {
                            address: authoraddress,
                            // uid: user_uid,
                            // username: username,
                        },
                        crowdfunding_details: {
                            min_pay_amount: crowd_min_amount,
                            target_amount: crowd_target_amount,
                            amount_in: crowd_amount_in
                        },
                        created_at: crowd_current_datetime,
                        updated_at: crowd_current_datetime
                    }];

                    const crowd_project_uri_bnb = [{
                        content: {
                            title: title,
                            video_cid: video_cid,
                            thumbnail_cid: thumbnail_cid,
                            category: category,
                            user_type: user_type,
                            story: description,
                            thumbnail_url: client + thumbnail_cid + web3storage,
                            video_url: client + video_cid + web3storage,
                            timestamp: current_timestamp
                        },
                        author: {
                            address: authoraddress,
                            // uid: user_uid,
                            // username: username,
                        },
                        crowdfunding_details: {
                            min_pay_amount: crowd_min_amount,
                            target_amount: crowd_target_amount,
                            amount_in: crowd_amount_in
                        },
                        created_at: crowd_current_datetime,
                        updated_at: crowd_current_datetime
                    }];


                    // ETH Contract
                    async function createProjectFunding(crowd_min_amount, crowd_target_amount, project_uri_link,
                        crowd_amount_in) {
                        if (window.ethereum) {
                            console.log("This is DAppp Environment");
                            var accounts = await ethereum.request({
                                method: 'eth_requestAccounts'
                            });
                            var currentaddress = accounts[0];
                            console.log("Current address: " + currentaddress);
                            web3 = new Web3(window.ethereum);
                            myFactoryContract = new web3.eth.Contract(factoryContract, contractAddress);
                            var min_donation_wei = web3.utils.toWei(crowd_min_amount.toString(), 'ether');
                            var target_amount_wei = web3.utils.toWei(crowd_target_amount.toString(),
                                'ether');

                            // create a project 
                            myFactoryContract.methods.createCrowdfundProject(min_donation_wei, target_amount_wei,
                                project_uri_link).send({
                                from: currentaddress
                            }).then((res) => {
                                const returnTxData = (res.events.ProjectCreated.returnValues);
                                const returnTxProjectId = returnTxData._project;
                                const returnTxCreator = returnTxData._creator;
                                console.log(returnTxProjectId, returnTxCreator);
                                formData.append('project_uri_link', project_uri_link);
                                formData.append('project_address', returnTxProjectId);
                                formData.append('project_creator', returnTxCreator);
                                formData.append('minimum_pay', crowd_min_amount);
                                formData.append('target_amount', crowd_target_amount);
                                formData.append('amount_in', crowd_amount_in);
                                $(".new-loader-wrapper").addClass("d-none");
                                $.ajax({
                                    type: 'POST',
                                    url: 'php/uploadVideoImage.php',
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    data: formData,
                                    success: function(data) {
                                        data = JSON.parse(data);
                                        if (data.status == 201) {
                                            $(".new-loader-wrapper").css("display", "none");
                                            $(".new-loader-wrapper").addClass("d-lg-none");
                                            $(".new-loader-wrapper").addClass("d-md-none");
                                            $(".new-loader-wrapper").addClass("d-sm-none");
                                            btn.classList.remove("button--loading");
                                            swal("Video Uploaded Successfully!", {
                                                icon: "success",
                                            }).then((value) => {
                                                window.location.href = `userVideosList`;
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
                                    }
                                });
                            }).catch((err) => {
                                $(".new-loader-wrapper").addClass("d-none");
                                console.log(err);
                            });
                        } else {
                            console.log("Please connect with metamask");
                        }
                    }

                    // MATIC Contract
                    async function createProjectFundingMatic(crowd_min_amount, crowd_target_amount,
                        project_uri_link, crowd_amount_in) {
                        console.log(crowd_min_amount, crowd_target_amount, project_uri_link,
                            crowd_amount_in)
                        if (window.ethereum) {
                            console.log("This is DAppp Environment");
                            var accounts = await ethereum.request({
                                method: 'eth_requestAccounts'
                            });
                            var currentaddress = accounts[0];
                            console.log("Current address: " + currentaddress);
                            web3 = new Web3(window.ethereum);
                            myFactoryContract = new web3.eth.Contract(maticFactoryContract, maticContract);
                            var min_donation_wei = web3.utils.toWei(crowd_min_amount.toString(), 'ether');
                            var target_amount_wei = web3.utils.toWei(crowd_target_amount.toString(),
                                'ether');

                            // create a project 
                            myFactoryContract.methods.createCrowdfundProject(min_donation_wei, target_amount_wei,
                                project_uri_link).send({
                                from: currentaddress
                            }).then((res) => {
                                const returnTxData = (res.events.ProjectCreated.returnValues);
                                const returnTxProjectId = returnTxData._project;
                                const returnTxCreator = returnTxData._creator;
                                console.log(returnTxProjectId, returnTxCreator);
                                formData.append('project_uri_link', project_uri_link);
                                formData.append('project_address', returnTxProjectId);
                                formData.append('project_creator', returnTxCreator);
                                formData.append('minimum_pay', crowd_min_amount);
                                formData.append('target_amount', crowd_target_amount);
                                formData.append('amount_in', crowd_amount_in);

                                formData.append('name', title);
                                formData.append('category', category);
                                formData.append('video_desc', description);
                                formData.append('thumbnail_ipfs', client + thumbnail_cid + web3storage);
                                formData.append('user_address', user_address);
                                formData.append('user_type', user_type);
                                $(".new-loader-wrapper").addClass("d-none");
                                // for (const value of formData.values()) {
                                // console.log(value);
                                // }
                                $.ajax({
                                    type: 'POST',
                                    url: 'php/uploadVideoImage.php',
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    data: formData,
                                    success: function(data) {
                                        data = JSON.parse(data);
                                        if (data.status == 201) {
                                            $(".new-loader-wrapper").css("display", "none");
                                            $(".new-loader-wrapper").addClass("d-lg-none");
                                            $(".new-loader-wrapper").addClass("d-md-none");
                                            $(".new-loader-wrapper").addClass("d-sm-none");
                                            btn.classList.remove("button--loading");
                                            swal("Video Uploaded Successfully!", {
                                                icon: "success",
                                            }).then((value) => {
                                                window.location.href = `userVideosList`;
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
                                    }
                                });
                            }).catch((err) => {
                                $(".new-loader-wrapper").addClass("d-none");
                                console.log(err);
                            });
                        } else {
                            console.log("Please connect with metamask");
                        }
                    }

                    // BNB Contract
                    async function createProjectFundingBnb(crowd_min_amount, crowd_target_amount,
                        project_uri_link, crowd_amount_in) {
                        console.log(crowd_min_amount, crowd_target_amount, project_uri_link,
                            crowd_amount_in)
                        if (window.ethereum) {
                            console.log("This is DAppp Environment");
                            var accounts = await ethereum.request({
                                method: 'eth_requestAccounts'
                            });
                            var currentaddress = accounts[0];
                            console.log("Current address: " + currentaddress);
                            web3 = new Web3(window.ethereum);
                            myFactoryContract = new web3.eth.Contract(bnbFactoryContract, bnbContract);
                            var min_donation_wei = web3.utils.toWei(crowd_min_amount.toString(), 'ether');
                            var target_amount_wei = web3.utils.toWei(crowd_target_amount.toString(),
                                'ether');

                            // create a project 
                            myFactoryContract.methods.createCrowdfundProject(min_donation_wei, target_amount_wei,
                                project_uri_link).send({
                                from: currentaddress
                            }).then((res) => {
                                const returnTxData = (res.events.ProjectCreated.returnValues);
                                const returnTxProjectId = returnTxData._project;
                                const returnTxCreator = returnTxData._creator;
                                console.log(returnTxProjectId, returnTxCreator);
                                formData.append('project_uri_link', project_uri_link);
                                formData.append('project_address', returnTxProjectId);
                                formData.append('project_creator', returnTxCreator);
                                formData.append('minimum_pay', crowd_min_amount);
                                formData.append('target_amount', crowd_target_amount);
                                formData.append('amount_in', crowd_amount_in);

                                formData.append('name', title);
                                formData.append('category', category);
                                formData.append('video_desc', description);
                                formData.append('thumbnail_ipfs', client + thumbnail_cid + web3storage);
                                formData.append('user_address', user_address);
                                formData.append('user_type', user_type);
                                $(".new-loader-wrapper").addClass("d-none");
                                // for (const value of formData.values()) {
                                // console.log(value);
                                // }
                                $.ajax({
                                    type: 'POST',
                                    url: 'php/uploadVideoImage.php',
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    data: formData,
                                    success: function(data) {
                                        data = JSON.parse(data);
                                        if (data.status == 201) {
                                            $(".new-loader-wrapper").css("display", "none");
                                            $(".new-loader-wrapper").addClass("d-lg-none");
                                            $(".new-loader-wrapper").addClass("d-md-none");
                                            $(".new-loader-wrapper").addClass("d-sm-none");
                                            btn.classList.remove("button--loading");
                                            swal("Video Uploaded Successfully!", {
                                                icon: "success",
                                            }).then((value) => {
                                                window.location.href = `userVideosList`;
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
                                    }
                                });
                            }).catch((err) => {
                                $(".new-loader-wrapper").addClass("d-none");
                                console.log(err);
                            });
                        } else {
                            console.log("Please connect with metamask");
                        }
                    }

                    if (crowd_on_off) {
                        const is_confirm_crowd = $("#settingConfiramtion").is(':checked');
                        const is_confirm_crowd_matic = $("#settingConfiramtion_matic").is(':checked');
                        const is_confirm_crowd_bnb = $("#settingConfiramtion_bnb").is(':checked');
                        if (is_confirm_crowd || is_confirm_crowd_matic || is_confirm_crowd_bnb) {
                            if ($('#user_amount_in').val() === 'ETH') {
                                if ((window.ethereum.networkVersion) !== '1') {
                                    changeNetwork('1');
                                } else {
                                    console.log(crowd_min_amount, crowd_target_amount, crowd_amount_in);
                                    const promise1 = Promise.resolve(fun_project_qri(crowd_project_uri));
                                    promise1.then((value) => {
                                        $(".new-loader-wrapper").removeClass("d-none");
                                        $(".new-loader-wrapper").addClass("d-flex");
                                        createProjectFunding(crowd_min_amount, crowd_target_amount,
                                            value, crowd_amount_in);
                                    });
                                }
                            } else if ($('#user_amount_in').val() === 'MATIC') {
                                if ((window.ethereum.networkVersion) !== '137') {
                                    changeNetwork('89');
                                } else {
                                    console.log(crowd_min_amount_matic, crowd_target_amount_matic,
                                        crowd_amount_in);
                                    const promise2 = Promise.resolve(fun_project_qri(
                                        crowd_project_uri_matic));
                                    promise2.then((value) => {
                                        $(".new-loader-wrapper").removeClass("d-none");
                                        $(".new-loader-wrapper").addClass("d-flex");
                                        createProjectFundingMatic(crowd_min_amount_matic,
                                            crowd_target_amount_matic,
                                            value, crowd_amount_in);
                                    });
                                }
                            } else if ($('#user_amount_in').val() === 'BNB') {
                                if ((window.ethereum.networkVersion) !== '97') {
                                    changeNetwork('61');
                                } else {
                                    console.log(crowd_min_amount_bnb, crowd_target_amount_bnb,
                                        crowd_amount_in);
                                    const promise2 = Promise.resolve(fun_project_qri(
                                        crowd_project_uri_bnb));
                                    promise2.then((value) => {
                                        $(".new-loader-wrapper").removeClass("d-none");
                                        $(".new-loader-wrapper").addClass("d-flex");
                                        createProjectFundingBnb(crowd_min_amount_bnb,
                                            crowd_target_amount_bnb, value, crowd_amount_in);
                                    });
                                }

                            } else {
                                console.log('Something went wrong.')
                            }
                        } else {
                            toastr["error"]("confirm crowdfunding settings first.");
                        }
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: 'php/uploadVideoImage.php',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: formData,
                            success: function(data) {
                                data = JSON.parse(data);
                                if (data.status == 201) {
                                    $(".new-loader-wrapper").css("display", "none");
                                    $(".new-loader-wrapper").addClass("d-lg-none");
                                    $(".new-loader-wrapper").addClass("d-md-none");
                                    $(".new-loader-wrapper").addClass("d-sm-none");
                                    btn.classList.remove("button--loading");
                                    swal("Video Uploaded Successfully!", {
                                        icon: "success",
                                    }).then((value) => {
                                        window.location.href = `userVideosList`;
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
                            }
                        });
                    }
                    // crowdfundung test end
                }
            }




        }
    }
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
        let current_radio_value = $('input[name=radio_crowd]:checked').val();

        $('input[name=radio_crowd]').on('change', function(e) {
            current_radio_value = ($(this).val());
            $('#user_amount_in').val(current_radio_value);

            if (current_radio_value === 'MATIC') {
                crowd_funding_network = current_radio_value;
                $('.network_class_matic').css('font-weight', 'bold');
                $('.network_class_eth').css('font-weight', 'inherit');
                $('#matic_crowdfunding_section').css('display', 'flex');
                $('#eth_crowdfunding_section').css('display', 'none');
                $('#bnb_crowdfunding_section').css('display', 'none');
                $('#user_amount_in').val('MATIC');
                changeNetwork('89');
            } else if (current_radio_value === 'BNB') {
                crowd_funding_network = current_radio_value;
                $('.network_class_eth').css('font-weight', 'bold');
                $('.network_class_matic').css('font-weight', 'inherit');
                $('#matic_crowdfunding_section').css('display', 'none');
                $('#eth_crowdfunding_section').css('display', 'none');
                $('#bnb_crowdfunding_section').css('display', 'flex');
                $('#user_amount_in').val('BNB');
                changeNetwork('61');
            } else {
                crowd_funding_network = current_radio_value;
                $('.network_class_eth').css('font-weight', 'bold');
                $('.network_class_matic').css('font-weight', 'inherit');
                $('#matic_crowdfunding_section').css('display', 'none');
                $('#bnb_crowdfunding_section').css('display', 'none');
                $('#eth_crowdfunding_section').css('display', 'flex');
                $('#user_amount_in').val('ETH');
                changeNetwork('1');
            }


        });
        $('#crowd_funding_body').slideUp();
        $("#crowd_funding_switch").on('change', function() {
            if ($(this).is(':checked')) {
                crowd_funding_switch = $(this).is(':checked');
                $('.themeSliderShow').css('display', 'none');
                $('#crowd_funding_body').slideDown();
            } else {
                crowd_funding_switch = $(this).is(':checked');
                $('#crowd_funding_body').slideUp();
                $('.themeSliderShow').css('display', 'block');
            }
        });

        $('#crowd_funding_body').slideUp();
        $("#crowd_funding_switch").on('change', function() {
            if ($(this).is(':checked')) {
                crowd_funding_switch = $(this).is(':checked');
                $('.themeSliderShow').css('display', 'none');
                $('#crowd_funding_body').slideDown();
            } else {
                crowd_funding_switch = $(this).is(':checked');
                $('#crowd_funding_body').slideUp();
                $('.themeSliderShow').css('display', 'block');
            }
        });
        // eth
        $(".currencyField").keypress(function() {
            Eth_to_usd();
            $("#settingConfiramtion").prop('checked', false);
        });
        $(".currencyField").change(function() {
            Eth_to_usd();
            $("#settingConfiramtion").prop('checked', false);
        });

        $('#min_donation').keypress(function() {
            $("#settingConfiramtion").prop('checked', false);
        });
        $('#min_donation').change(function() {
            $("#settingConfiramtion").prop('checked', false);
        });

        $("#settingConfiramtion").on('change', function() {
            confirmation_function();
            changeNetwork('1');
        });
        // matic
        $(".currencyFieldMatic").keypress(function() {
            Matic_to_usd();
            $("#settingConfiramtion_matic").prop('checked', false);
        });
        $(".currencyFieldMatic").change(function() {
            Matic_to_usd();
            $("#settingConfiramtion_matic").prop('checked', false);
        });

        $('#min_donation_matic').keypress(function() {
            $("#settingConfiramtion_matic").prop('checked', false);
        });
        $('#min_donation_matic').change(function() {
            $("#settingConfiramtion_matic").prop('checked', false);
        });

        $("#settingConfiramtion_matic").on('change', function() {
            confirmation_function_matic();
            changeNetwork('89');
        });

        // bnb
        $(".currencyFieldBnb").keypress(function() {
            Bnb_to_usd();
            $("#settingConfiramtion_bnb").prop('checked', false);
            $('#uploadBtn').attr('disabled', false);
            $('#uploadBtn').css("cursor", "pointer");
        });
        $(".currencyFieldBnb").change(function() {
            Bnb_to_usd();
            $("#settingConfiramtion_bnb").prop('checked', false);
            $('#uploadBtn').attr('disabled', false);
            $('#uploadBtn').css("cursor", "pointer");
        });

        $('#min_donation_bnb').keypress(function() {
            $("#settingConfiramtion_bnb").prop('checked', false);
            $('#uploadBtn').attr('disabled', false);
            $('#uploadBtn').css("cursor", "pointer");
        });
        $('#min_donation_bnb').change(function() {
            $("#settingConfiramtion_bnb").prop('checked', false);
            $('#uploadBtn').attr('disabled', false);
            $('#uploadBtn').css("cursor", "pointer");
        });

        $("#settingConfiramtion_bnb").on('change', function() {
            confirmation_function_bnb();
            changeNetwork('61');
        });
    });

    function Eth_to_usd() {
        var ethereum_amount = $("#target_amount").val();
        let convFrom;
        let convTo;
        var chain = "ethereum";
        if ($(this).prop("name") == "usd") {
            convFrom = "usd";
            convTo = "eth";
        } else {
            convFrom = "eth";
            convTo = "usd";
        }
        $.getJSON(`https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=${chain}`,
            function(data) {
                var origAmount = parseFloat($("#target_amount").val());
                var exchangeRate = parseFloat(data[0].current_price);
                let amount = null;
                if (convFrom == "eth")
                    amount = parseFloat(origAmount * exchangeRate);
                else
                    amount = parseFloat(origAmount / exchangeRate);
                $("input[name='" + convTo + "']").val(amount.toFixed(5));
                if (convFrom === "eth") {
                    if (isNaN(amount)) {
                        $("#dollar_amount").text('0.00');
                    } else {
                        $("#dollar_amount").text(amount);
                    }
                    if (isNaN(origAmount)) {
                        $("#eth_show_value").text('0');
                    } else {
                        $("#eth_show_value").text(origAmount);
                    }
                }
            });
    }

    function Bnb_to_usd() {
        var ethereum_amount = $("#target_amount_bnb").val();
        let convFromMatic;
        let convTo;
        var chain = "binancecoin";
        if ($(this).prop("name") == "usd") {
            convFromMatic = "usd";
            convTo = "bnb";
        } else {
            convFromMatic = "bnb";
            convTo = "usd";
        }
        $.getJSON(`https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=${chain}`,
            function(data) {
                var origAmount = parseFloat($("#target_amount_bnb").val());
                var exchangeRate = parseFloat(data[0].current_price);
                let amount = null;
                if (convFromMatic == "bnb")
                    amount = parseFloat(origAmount * exchangeRate);
                else
                    amount = parseFloat(origAmount / exchangeRate);
                $("input[name='" + convTo + "']").val(amount.toFixed(5));
                if (convFromMatic === "bnb") {
                    if (isNaN(amount)) {
                        $("#dollar_amount_bnb").text('0.00');
                    } else {
                        $("#dollar_amount_bnb").text(amount);
                    }
                    if (isNaN(origAmount)) {
                        $("#bnb_show_value").text('0');
                    } else {
                        $("#bnb_show_value").text(origAmount);
                    }
                }
            });
    }

    function Matic_to_usd() {
        var ethereum_amount = $("#target_amount_matic").val();
        let convFromMatic;
        let convTo;
        var chain = "matic-network";
        if ($(this).prop("name") == "usd") {
            convFromMatic = "usd";
            convTo = "matic";
        } else {
            convFromMatic = "matic";
            convTo = "usd";
        }
        $.getJSON(`https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=${chain}`,
            function(data) {
                var origAmount = parseFloat($("#target_amount_matic").val());
                var exchangeRate = parseFloat(data[0].current_price);
                let amount = null;
                if (convFromMatic == "matic")
                    amount = parseFloat(origAmount * exchangeRate);
                else
                    amount = parseFloat(origAmount / exchangeRate);
                $("input[name='" + convTo + "']").val(amount.toFixed(5));
                if (convFromMatic === "matic") {
                    if (isNaN(amount)) {
                        $("#dollar_amount_matic").text('0.00');
                    } else {
                        $("#dollar_amount_matic").text(amount);
                    }
                    if (isNaN(origAmount)) {
                        $("#matic_show_value").text('0');
                    } else {
                        $("#matic_show_value").text(origAmount);
                    }
                }
            });
    }

    function confirmation_function() {
        if ($("#settingConfiramtion").is(':checked')) {
            Eth_to_usd();
            const min_donatation = parseFloat($('#min_donation').val());
            const target_amount = parseFloat($('#target_amount').val());
            if (min_donatation <= 0 || isNaN(min_donatation)) {
                toastr["error"]("Error in Min Donation");
                $("#settingConfiramtion").prop('checked', false);
            }
            if (target_amount <= 0 || isNaN(target_amount)) {
                toastr["error"]("Error in Target Amount");
                $("#settingConfiramtion").prop('checked', false);
            }
            if (min_donatation > target_amount) {
                toastr["error"]("Min Donation must be less than Target Amount");
                $("#settingConfiramtion").prop('checked', false);
            }

            if ((min_donatation > 0) && (target_amount > 0) && (min_donatation < target_amount)) {
                crowdfunding_price_confiramtion = true;
            } else {
                crowdfunding_price_confiramtion = false;
            }
        } else {
            toastr["error"]("confirm eth crowdfunding settings first.");
        }
    }

    function confirmation_function_matic() {
        if ($("#settingConfiramtion_matic").is(':checked')) {
            Matic_to_usd();
            const min_donatation = parseFloat($('#min_donation_matic').val());
            const target_amount = parseFloat($('#target_amount_matic').val());
            if (min_donatation <= 0 || isNaN(min_donatation)) {
                toastr["error"]("Error in Min Donation");
                $("#settingConfiramtion_matic").prop('checked', false);
            }
            if (target_amount <= 0 || isNaN(target_amount)) {
                toastr["error"]("Error in Target Amount");
                $("#settingConfiramtion_matic").prop('checked', false);
            }
            if (min_donatation > target_amount) {
                toastr["error"]("Min Donation must be less than Target Amount");
                $("#settingConfiramtion_matic").prop('checked', false);
            }

            if ((min_donatation > 0) && (target_amount > 0) && (min_donatation < target_amount)) {
                crowdfunding_price_confiramtion = true;
            } else {
                crowdfunding_price_confiramtion = false;
            }
        } else {
            toastr["error"]("confirm matic crowdfunding settings first.");
        }
    }

    function confirmation_function_bnb() {
        if ($("#settingConfiramtion_bnb").is(':checked')) {
            Bnb_to_usd();
            const min_donatation = parseFloat($('#min_donation_bnb').val());
            const target_amount = parseFloat($('#target_amount_bnb').val());
            if (min_donatation <= 0 || isNaN(min_donatation)) {
                toastr["error"]("Error in Min Donation");
                $("#settingConfiramtion_bnb").prop('checked', false);
                $('#uploadBtn').attr('disabled', false);
                $('#uploadBtn').css("cursor", "pointer");
            }
            if (target_amount <= 0 || isNaN(target_amount)) {
                toastr["error"]("Error in Target Amount");
                $("#settingConfiramtion_bnb").prop('checked', false);
                $('#uploadBtn').attr('disabled', false);
                $('#uploadBtn').css("cursor", "pointer");
            }
            if (min_donatation > target_amount) {
                toastr["error"]("Min Donation must be less than Target Amount");
                $("#settingConfiramtion_bnb").prop('checked', false);
                $('#uploadBtn').attr('disabled', false);
                $('#uploadBtn').css("cursor", "pointer");
            }

            if ((min_donatation > 0) && (target_amount > 0) && (min_donatation < target_amount)) {
                crowdfunding_price_confiramtion = true;
            } else {
                crowdfunding_price_confiramtion = false;
            }
        } else {
            toastr["error"]("confirm bnb crowdfunding settings first.");
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
</script>
</body>

</html>