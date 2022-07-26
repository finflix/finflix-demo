<?php
session_start();
require_once('php/link.php');
$client = 'https://ipfs.io/ipfs/';
$user_address = '';
if(isset($_SESSION['userAddress'])){
    $user_address = $_SESSION['userAddress'];
}else{
    $user_address = '';
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
    <meta property="og:image:secure_url" itemprop="image"
        content="https://finflix.finstreet.in/<?php echo $img_link2 ?>fin-logo.jpg" />
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
</head>

<body>
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <?php
         $user_img='#';
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
                                <a href="#" class="navbar-toggler c-toggler" data-toggle="collapse"
                                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <div class="navbar-toggler-icon" data-toggle="collapse">
                                        <span class="navbar-menu-icon navbar-menu-icon--top"></span>
                                        <span class="navbar-menu-icon navbar-menu-icon--middle"></span>
                                        <span class="navbar-menu-icon navbar-menu-icon--bottom"></span>
                                    </div>
                                </a>
                                <a class="navbar-brand" href="./index"> <img class="img-fluid logo"
                                        src="images/logo.png" alt="Finflix" /> </a>
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
                                    <a href="javascript:void(0);" class="more-toggle" id="dropdownMenuButton"
                                        data-toggle="more-toggle" aria-haspopup="true" aria-expanded="false">
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
                                                                <input type="text"
                                                                    class="text search-input font-size-12"
                                                                    placeholder="type here to search..." name="query">
                                                                <i class="search-link ri-search-line"></i>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </li>
                                                <?php 
                                                if($user_address !== null && $user_address !== ''){
                                                ?>
                                                <li>
                                                    <a href="#"
                                                        class="iq-user-dropdown search-toggle d-flex align-items-center">
                                                        <img src="./images/user.png"
                                                            class="img-fluid avatar-40 rounded-circle" alt="user">
                                                    </a>
                                                    <div class="iq-sub-dropdown iq-user-dropdown">
                                                        <div class="iq-card shadow-none m-0">
                                                            <div class="iq-card-body p-0 pl-3 pr-3">
                                                                <a href="https://rinkeby.etherscan.io/address/<?= $user_address ?>"
                                                                    target="_blank"
                                                                    class="iq-sub-card setting-dropdown">
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
                                                                <a href="./favourite?user=<?= $user_address ?>"
                                                                    class="iq-sub-card setting-dropdown">
                                                                    <div class="media align-items-center">
                                                                        <div class="right-icon">
                                                                            <i
                                                                                class="ri-settings-4-line text-primary"></i>
                                                                        </div>
                                                                        <div class="media-body ml-3">
                                                                            <h6 class="mb-0 ">My Favourite</h6>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <a href="logout" class="iq-sub-card setting-dropdown">
                                                                    <div class="media align-items-center">
                                                                        <div class="right-icon">
                                                                            <i
                                                                                class="ri-logout-circle-line text-primary"></i>
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
                                                <?php }else{ ?>
                                                <li>
                                                    <div class="hover-buttons">
                                                        <a href="javascript:void(0)" class="btn btn-hover buttonText"
                                                            style="font-size:1rem;" onclick="userLoginOut()">Sign In</a>
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
                                                        <input type="text" class="text search-input font-size-12"
                                                            placeholder="type here to search..." name="query">
                                                        <i class="search-link ri-search-line"></i>
                                                    </div>
                                                </form>
                                            </div>
                                        </li>
                                        <?php 
                                        if($user_address !== null && $user_address !== ''){
                                        ?>
                                        <li class="nav-item nav-icon">
                                            <a href="#"
                                                class="iq-user-dropdown search-toggle p-0 d-flex align-items-center"
                                                data-toggle="search-toggle">
                                                <img src="./images/user.png" class="img-fluid avatar-40 rounded-circle"
                                                    alt="user">
                                            </a>
                                            <div class="iq-sub-dropdown iq-user-dropdown">
                                                <div class="iq-card shadow-none m-0">
                                                    <div class="iq-card-body p-0 pl-3 pr-3">
                                                        <a href="https://rinkeby.etherscan.io/address/<?= $user_address ?>"
                                                            target="_blank" class="iq-sub-card setting-dropdown">
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
                                                        <a href="./favourite?user=<?= $user_address ?>"
                                                            class="iq-sub-card setting-dropdown">
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
                                        <?php }else{ ?>
                                        <li>
                                            <div class="hover-buttons">
                                                <a href="javascript:void(0)" class="btn btn-hover buttonText"
                                                    style="font-size:1rem;" onclick="userLoginOut()">Sign In</a>
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
                                <a class="navbar-brand" href="./index"> <img class="img-fluid logo"
                                        src="images/logo.png" alt="Finflix" / style="width:120px;"> </a>
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
                                                                <input type="text"
                                                                    class="text search-input font-size-12"
                                                                    placeholder="type here to search..." name="query">
                                                                <i class="search-link ri-search-line"></i>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </li>
                                                <?php 
                                                if($user_address !== null && $user_address !== ''){
                                                ?>
                                                <li>
                                                    <a href="#"
                                                        class="iq-user-dropdown search-toggle d-flex align-items-center">
                                                        <img src="./images/user.png"
                                                            class="img-fluid avatar-40 rounded-circle" alt="user">
                                                    </a>
                                                    <div class="iq-sub-dropdown iq-user-dropdown">
                                                        <div class="iq-card shadow-none m-0">
                                                            <div class="iq-card-body p-0 pl-3 pr-3">
                                                                <a href="https://rinkeby.etherscan.io/address/<?= $user_address ?>"
                                                                    target="_blank"
                                                                    class="iq-sub-card setting-dropdown">
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
                                                                <a href="./favourite?user=<?= $user_address ?>"
                                                                    class="iq-sub-card setting-dropdown">
                                                                    <div class="media align-items-center">
                                                                        <div class="right-icon">
                                                                            <i
                                                                                class="ri-settings-4-line text-primary"></i>
                                                                        </div>
                                                                        <div class="media-body ml-3">
                                                                            <h6 class="mb-0 ">My Favourite</h6>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <a href="logout" class="iq-sub-card setting-dropdown">
                                                                    <div class="media align-items-center">
                                                                        <div class="right-icon">
                                                                            <i
                                                                                class="ri-logout-circle-line text-primary"></i>
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
                                                <?php }else{ ?>
                                                <li>
                                                    <div class="hover-buttons">
                                                        <a href="javascript:void(0)" class="btn btn-hover buttonText"
                                                            style="font-size:1rem;" onclick="userLoginOut()">Sign In</a>
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
                                                        <input type="text" class="text search-input font-size-12"
                                                            placeholder="type here to search..." name="query">
                                                        <i class="search-link ri-search-line"></i>
                                                    </div>
                                                </form>
                                            </div>
                                        </li>
                                        <?php 
                                            if($user_address !== null && $user_address !== ''){
                                        ?>
                                        <li class="nav-item nav-icon">
                                            <a href="#"
                                                class="iq-user-dropdown search-toggle p-0 d-flex align-items-center"
                                                data-toggle="search-toggle">
                                                <img src="./images/user.png" class="img-fluid avatar-40 rounded-circle"
                                                    alt="user">
                                            </a>
                                            <div class="iq-sub-dropdown iq-user-dropdown">
                                                <div class="iq-card shadow-none m-0">
                                                    <div class="iq-card-body p-0 pl-3 pr-3">
                                                        <a href="https://rinkeby.etherscan.io/address/<?= $user_address ?>"
                                                            target="_blank" class="iq-sub-card setting-dropdown">
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
                                                        <a href="./favourite?user=<?= $user_address ?>"
                                                            class="iq-sub-card setting-dropdown">
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
                                        <?php }else{?>
                                        <li>
                                            <div class="hover-buttons">
                                                <a href="javascript:void(0)" class="btn btn-hover buttonText"
                                                    style="font-size:1rem;" onclick="userLoginOut()">Sign In</a>
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
    <!-- Slider Start -->
    <section id="home" class="iq-main-slider p-0">
        <div id="home-slider" class="slider m-0 p-0">
            <?php
            $query = "SELECT * FROM `video_info` WHERE 1 ORDER BY `video_id` DESC LIMIT 5";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) {
               $i = 1;
               while ($row = mysqli_fetch_assoc($result)) {
                  $thumbnail = $client.$row['thumbnail_ipfs'];
                  $video_id = $row['video_uid'];
                  $chapter_part = $row['video_id'];
                  $chapter_name = $row['name'];
                  $chapter_desc = $row['video_desc'];
                  $chapter_id = $row['video_id'];
                  $module_name = $row['module'];
                  if(strlen($chapter_name)>25){
                     $chapter_name = substr($chapter_name, 0, 25) . ' ...';
                  }
            ?>
            <div class="slide slick-bg s-bg-<?= $i ?>"
                style="width: 1903px;background: url(<?= $thumbnail ?>);background-repeat: no-repeat;background-position: center;background-size: cover;">
                <div class="container-fluid position-relative h-100">
                    <div class="slider-inner h-100">
                        <div class="row align-items-center  h-100">
                            <div class="col-xl-6 col-lg-12 col-md-12">
                                <a href="javascript:void(0);">
                                    <div class="channel-logo" data-animation-in="fadeInLeft" data-delay-in="0.5">
                                        <img src="./images/logo.png" class="c-logo" alt="Finflix">
                                    </div>
                                </a>
                                <h1 class="slider-text big-title title text-uppercase" data-animation-in="fadeInLeft"
                                    data-delay-in="0.6"><?= $chapter_name ?></h1>
                                <div class="d-flex align-items-center" data-animation-in="fadeInUp" data-delay-in="1">
                                    <span class="badge badge-secondary p-2"><?=  $module_name ?></span>
                                    <span class="ml-3">#<?= $chapter_part ?></span>
                                </div>
                                <p data-animation-in="fadeInUp" data-delay-in="1.2"><?= $chapter_desc ?></p>
                                <div class="d-flex align-items-center r-mb-23" data-animation-in="fadeInUp"
                                    data-delay-in="1.2">
                                    <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>"
                                        class="btn btn-hover"><i class="fa fa-play mr-2" aria-hidden="true"></i>Play
                                        Now</a>
                                    <a href="./courses" class="btn btn-link">More details</a>
                                </div>
                            </div>
                        </div>
                        <div class="trailor-video">
                            <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>"
                                class="video-open playbtn">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="80px"
                                    height="80px" viewBox="0 0 213.7 213.7" enable-background="new 0 0 213.7 213.7"
                                    xml:space="preserve">
                                    <polygon class='triangle' fill="none" stroke-width="7" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-miterlimit="10"
                                        points="73.5,62.5 148.5,105.8 73.5,149.1 " />
                                    <circle class='circle' fill="none" stroke-width="7" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-miterlimit="10" cx="106.8" cy="106.8"
                                        r="103.3" />
                                </svg>
                                <span class="w-trailor">Watch Now</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                  $i = $i + 1;
               }
            }
            ?>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" width="44px" height="44px" id="circle"
                fill="none" stroke="currentColor">
                <circle r="20" cy="22" cx="22" id="test"></circle>
            </symbol>
        </svg>
    </section>
    <!-- Slider End -->
    <!-- MainContent -->
    <div class="main-content">
        <?php if($user_address != null && $user_address != ''){ 
                $query = "SELECT * FROM `favourite_videos` INNER JOIN `video_info` ON `favourite_videos`.`video_info_id`=`video_info`.`video_uuid` WHERE `user_id`= '$user_address' ORDER BY `favourite_videos`.`favourite_video_id` DESC LIMIT 10;";
                $result = mysqli_query($con, $query);
                if (mysqli_num_rows($result) > 0) {
                    $i = 1;
        ?>
        <section id="iq-suggestede" class="s-margin">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title"><a href="#">Favourite Video</a></h4>
                        </div>
                        <div class="suggestede-contens">
                            <ul class="list-inline favorites-slider row p-0 mb-0 favorites-slider-new">                        
                            <?php
                              while ($row = mysqli_fetch_assoc($result)) {
                                 $thumbnail = $client.$row['thumbnail_ipfs'];
                                 $video_id = $row['video_uid'];
                                 $chapter_part = $row['video_id'];
                                 $chapter_name = $row['name'];
                                 $chapter_id = $row['video_id'];
                                 $module_name = $row['module'];
                                 $video_uuid = $row['video_uuid'];
                           ?>
                                <li class="slide-item d-flex justify-content-center align-items-center">
                                    <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>">
                                        <div class="block-images position-relative">
                                            <div class="img-box my-img-container">
                                                <img src="<?= $thumbnail ?>" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6><?php echo $chapter_name ?></h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">Episode</div>
                                                    <span class="text-white"><?= $i; ?></span>
                                                </div>
                                                <div class="hover-buttons">
                                                    <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>"
                                                        class="btn btn-hover"><i class="fa fa-play mr-1"
                                                            aria-hidden="true"></i>
                                                        Play Now</a>
                                                </div>
                                            </div>
                                            <div class="block-social-info">
                                                <ul class="list-inline p-0 m-0 music-play-lists">
                                                    <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                                    <li
                                                        onclick="removeVid('<?php echo $user_address ?>','<?php echo $video_uuid ?>')">
                                                        <span><i class="ri-heart-fill"></i></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <?php
                                 $i = $i + 1;
                              }
                           ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php }} ?>
        <section id="iq-suggestede" class="s-margin">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title"><a href="#">Recently Added</a></h4>
                        </div>
                        <div class="suggestede-contens">
                            <ul class="list-inline favorites-slider row p-0 mb-0 favorites-slider-new">
                                <?php
                           $query = "SELECT * FROM `video_info` WHERE 1 ORDER BY `video_id` DESC LIMIT 10";
                           $result = mysqli_query($con, $query);
                           if (mysqli_num_rows($result) > 0) {
                              $i = 1;
                              while ($row = mysqli_fetch_assoc($result)) {
                                 $thumbnail = $client.$row['thumbnail_ipfs'];
                                 $video_id = $row['video_uid'];
                                 $chapter_part = $row['video_id'];
                                 $chapter_name = $row['name'];
                                 $chapter_id = $row['video_id'];
                                 $module_name = $row['module'];
                                 $video_uuid = $row['video_uuid'];
                           ?>
                                <li class="slide-item d-flex justify-content-center align-items-center">
                                    <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>">
                                        <div class="block-images position-relative">
                                            <div class="img-box my-img-container">
                                                <img src="<?= $thumbnail ?>" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6><?php echo $chapter_name ?></h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">Episode</div>
                                                    <span class="text-white"><?= $i; ?></span>
                                                </div>
                                                <div class="hover-buttons">
                                                    <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>"
                                                        class="btn btn-hover"><i class="fa fa-play mr-1"
                                                            aria-hidden="true"></i>
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
                                <?php
                                 $i = $i + 1;
                              }
                           }
                           ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="iq-suggestede" class="s-margin">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title"><a href="#">Cryptonext Videos</a></h4>
                        </div>
                        <div class="suggestede-contens">
                            <ul class="list-inline favorites-slider row p-0 mb-0 favorites-slider-new">
                                <?php
                           $query = "SELECT * FROM `video_info` WHERE `module`= 'Cryptonext' LIMIT 10";
                           $result = mysqli_query($con, $query);
                           if (mysqli_num_rows($result) > 0) {
                              $i = 1;
                              while ($row = mysqli_fetch_assoc($result)) {
                                 $thumbnail = $client.$row['thumbnail_ipfs'];
                                 $video_id = $row['video_uid'];
                                 $chapter_part = $row['video_id'];
                                 $chapter_name = $row['name'];
                                 $chapter_id = $row['video_id'];
                                 $module_name = $row['module'];
                                 $video_uuid = $row['video_uuid'];
                           ?>
                                <li class="slide-item">
                                    <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>">
                                        <div class="block-images position-relative">
                                            <div class="img-box my-img-container">
                                                <img src="<?= $thumbnail ?>" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6><?php echo $chapter_name ?></h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">Episode</div>
                                                    <span class="text-white"><?= $i; ?></span>
                                                </div>
                                                <div class="hover-buttons">
                                                    <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>"
                                                        class="btn btn-hover"><i class="fa fa-play mr-1"
                                                            aria-hidden="true"></i>
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
                                <?php
                                 $i = $i + 1;
                              }
                           }
                           ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="iq-suggestede" class="s-margin">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title"><a href="#">Cryptonite Videos</a></h4>
                        </div>
                        <div class="suggestede-contens">
                            <ul class="list-inline favorites-slider row p-0 mb-0 favorites-slider-new">
                                <?php
                           $query = "SELECT * FROM `video_info` WHERE `module`= 'Cryptonite' LIMIT 10";
                           $result = mysqli_query($con, $query);
                           if (mysqli_num_rows($result) > 0) {
                              $i = 1;
                              while ($row = mysqli_fetch_assoc($result)) {
                                 $thumbnail = $client.$row['thumbnail_ipfs'];
                                 $video_id = $row['video_uid'];
                                 $chapter_part = $row['video_id'];
                                 $chapter_name = $row['name'];
                                 $chapter_id = $row['video_id'];
                                 $module_name = $row['module'];
                                 $video_uuid = $row['video_uuid'];
                           ?>
                                <li class="slide-item">
                                    <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>">
                                        <div class="block-images position-relative">
                                            <div class="img-box my-img-container">
                                                <img src="<?= $thumbnail ?>" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6><?php echo $chapter_name ?></h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">Episode</div>
                                                    <span class="text-white"><?= $i; ?></span>
                                                </div>
                                                <div class="hover-buttons">
                                                    <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>"
                                                        class="btn btn-hover"><i class="fa fa-play mr-1"
                                                            aria-hidden="true"></i>
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
                                <?php
                                 $i = $i + 1;
                              }
                           }
                           ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="iq-suggestede" class="s-margin">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title"><a href="#">Recommended For You</a></h4>
                        </div>
                        <div class="suggestede-contens">
                            <ul class="list-inline favorites-slider row p-0 mb-0 favorites-slider-new">
                                <?php
                           $query = "SELECT * FROM `video_info` WHERE 1 ORDER BY RAND() LIMIT 10";
                           $result = mysqli_query($con, $query);
                           if (mysqli_num_rows($result) > 0) {
                              $i = 1;
                              while ($row = mysqli_fetch_assoc($result)) {
                                 $thumbnail = $client.$row['thumbnail_ipfs'];
                                 $video_id = $row['video_uid'];
                                 $chapter_part = $row['video_id'];
                                 $chapter_name = $row['name'];
                                 $chapter_id = $row['video_id'];
                                 $module_name = $row['module'];
                                 $video_uuid = $row['video_uuid'];
                           ?>
                                <li class="slide-item">
                                    <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>">
                                        <div class="block-images position-relative">
                                            <div class="img-box my-img-container">
                                                <img src="<?= $thumbnail ?>" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6><?php echo $chapter_name ?></h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">Episode</div>
                                                    <span class="text-white"><?= $i; ?></span>
                                                </div>
                                                <div class="hover-buttons">
                                                    <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>"
                                                        class="btn btn-hover"><i class="fa fa-play mr-1"
                                                            aria-hidden="true"></i>
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
                                <?php
                                 $i = $i + 1;
                              }
                           }
                           ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
               $query = "SELECT * FROM `video_info` WHERE 1 ORDER BY `video_id` DESC LIMIT 1";
               $result = mysqli_query($con, $query);
               if (mysqli_num_rows($result) > 0) {
                  $i = 1;
                  while ($row = mysqli_fetch_assoc($result)) {
                     $thumbnail = $client.$row['thumbnail_ipfs'];
                     $video_id = $row['video_uid'];
                     $chapter_part = $row['video_id'];
                     $chapter_desc = $row['video_desc'];
                     $chapter_name = $row['name'];
                     $chapter_id = $row['video_id'];
                     $module_name = $row['module'];
                     $date = $row['from_time'];

               ?>
        <section id="parallex" class="parallax-window"
            style="background: url('<?= $thumbnail ?>');background-size: cover;background-attachment:fixed;">
            <div class="container-fluid h-100">
                <div class="row align-items-center justify-content-center h-100 parallaxt-details">
                    <div class="col-lg-4 r-mb-23">
                        <div class="text-left">
                            <a href="javascript:void(0);">
                                <img src='./images/logo.png' class="img-fluid" alt="bailey">
                            </a>
                            <div class="parallax-ratting d-flex align-items-center mt-3 mb-3">
                                <ul
                                    class="ratting-start p-0 m-0 list-inline text-primary d-flex align-items-center justify-content-left">
                                    <li><a href="javascript:void(0);" class="text-primary"><i class="fa fa-star"
                                                aria-hidden="true"></i></a></li>
                                    <li><a href="javascript:void(0);" class="pl-2 text-primary"><i class="fa fa-star"
                                                aria-hidden="true"></i></a></li>
                                    <li><a href="javascript:void(0);" class="pl-2 text-primary"><i class="fa fa-star"
                                                aria-hidden="true"></i></a></li>
                                    <li><a href="javascript:void(0);" class="pl-2 text-primary"><i class="fa fa-star"
                                                aria-hidden="true"></i></a></li>
                                    <li><a href="javascript:void(0);" class="pl-2 text-primary"><i
                                                class="fa fa-star-half-o" aria-hidden="true"></i></a></li>
                                </ul>
                                <span class="text-white ml-3">4.5 (Rating)</span>
                            </div>
                            <div class="movie-time d-flex align-items-center mb-3">
                                <div class="badge badge-secondary mr-3"><?= $module_name ?></div>
                                <h6 class="text-white"><?= $date ?></h6>
                            </div>
                            <p><?= $chapter_desc ?></p>
                            <div class="parallax-buttons">
                                <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>"
                                    class="btn btn-hover">Play Now</a>
                                <a href="./courses" class="btn btn-link">More details</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="parallax-img">
                            <a href="movie-details.html">
                                <img src='<?= $thumbnail ?>' class="img-fluid w-100" alt="bailey">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php }} ?>
        <section id="iq-trending" class="s-margin">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title"><a href="#">Trending</a></h4>
                        </div>
                        <div class="trending-contens"></div>
                        <ul id="trending-slider-nav" class="list-inline p-0 mb-0 row align-items-center">
                            <?php
                              $query = "SELECT `thumbnail_ipfs` FROM `video_info` WHERE 1 ORDER BY `video_id` DESC LIMIT 6";
                              $result = mysqli_query($con, $query);
                              if (mysqli_num_rows($result) > 0) {
                                 $i = 1;
                                 while ($row = mysqli_fetch_assoc($result)) {
                                    $thumbnail = $client.$row['thumbnail_ipfs'];

                              ?>
                            <li>
                                <a href="javascript:void(0);">
                                    <div class="movie-slick position-relative">
                                        <img src=<?= $thumbnail ?> class="img-fluid" alt="">
                                    </div>
                                </a>
                            </li>
                            <?php }} ?>
                        </ul>
                        <ul id="trending-slider" class="list-inline p-0 m-0  d-flex align-items-center">
                            <?php
                              $query = "SELECT * FROM `video_info` WHERE 1 ORDER BY `video_id` DESC LIMIT 0,1";
                              $result = mysqli_query($con, $query);
                              if (mysqli_num_rows($result) > 0) {
                                 $i = 1;
                                 while ($row = mysqli_fetch_assoc($result)) {
                                    $thumbnail = $client.$row['thumbnail_ipfs'];
                                    $video_id = $row['video_uid'];
                                    $chapter_part = $row['video_id'];
                                    $chapter_desc = $row['video_desc'];
                                    $chapter_name = $row['name'];
                                    $chapter_id = $row['video_id'];
                                    $module_name = $row['module'];
                                    $date = $row['from_time'];
                                    $date = substr($date, 0, 17);
                                    if(strlen($chapter_name)>35){
                                       $chapter_name = substr($chapter_name, 0, 35) . ' ...';
                                    }

                              ?>
                            <li>
                                <div class="tranding-block position-relative"
                                    style="background-image: url(<?= $thumbnail ?>);">
                                    <div class="trending-custom-tab">
                                        <div class="tab-title-info position-relative">
                                            <ul class="trending-pills d-flex nav nav-pills justify-content-center align-items-center text-center"
                                                role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active show" data-toggle="pill"
                                                        href="#trending-data1" role="tab"
                                                        aria-selected="true">Overview</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#trending-data2"
                                                        role="tab" aria-selected="false">Videos</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#trending-data3"
                                                        role="tab" aria-selected="false">Similar Like This</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="trending-content">
                                            <!-- /* ------------------------------ overview code start----------------------------- */ -->

                                            <div id="trending-data1" class="overview-tab tab-pane fade active show">
                                                <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                    <a href="javascript:void(0);" tabindex="0">
                                                        <div class="res-logo">
                                                            <div class="channel-logo">
                                                                <img src="images/logo.png" class="c-logo" alt="Finflix">
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <h1 class="trending-text big-title text-uppercase">
                                                        <?= $chapter_name ?></h1>
                                                    <div class="d-flex align-items-center text-white text-detail">
                                                        <span
                                                            class="badge badge-secondary p-3"><?= $module_name ?></span>
                                                        <span class="ml-3">#<?= $chapter_part ?></span>
                                                        <span class="trending-year">2022</span>
                                                    </div>
                                                    <div class="d-flex align-items-center series mb-4">
                                                        <a href="javascript:void(0);"><img src='<?= $thumbnail ?>'
                                                                class="img-fluid" alt=""
                                                                style="width:72px;height:72px;object-fit: contain;"></a>
                                                        <span class="text-gold ml-3">#<?= $chapter_part ?> in Video
                                                            Today</span>
                                                    </div>
                                                    <p class="trending-dec"><?= $chapter_desc ?></p>
                                                    <div class="p-btns">
                                                        <div class="d-flex align-items-center p-0">
                                                            <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>"
                                                                class="btn btn-hover mr-2" tabindex="0"><i
                                                                    class="fa fa-play mr-2" aria-hidden="true"></i>Play
                                                                Now</a>
                                                            <a href="javascript:void(0);" class="btn btn-link"
                                                                tabindex="0">
                                                                <i class="ri-information-fill"></i>My
                                                                List</a>
                                                        </div>
                                                    </div>
                                                    <div class="trending-list mt-4">
                                                        <div class="text-primary title text-color">This Is: <span
                                                                class="text-body">Cryto,Blockchain</span>
                                                        </div>
                                                        <div class="text-primary title text-color">Added On: <span
                                                                class="text-body"><?= $date ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- /* ---------------------------- overview code end --------------------------- */ -->
                                            <div id="trending-data2" class="overlay-tab tab-pane fade">
                                                <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                    <a href="show-details.html" tabindex="0">
                                                        <div class="channel-logo">
                                                            <img src="images/logo.png" class="c-logo" alt="stramit">
                                                        </div>
                                                    </a>
                                                    <h1 class="trending-text big-title text-uppercase">
                                                        <?= $chapter_name ?></h1>
                                                    <div class="episodes-contens mt-4">
                                                        <div
                                                            class="owl-carousel owl-theme episodes-slider1 list-inline p-0 mb-0">
                                                            <?php
                                                   $query2 = "SELECT * FROM `video_info` WHERE `module`='$module_name' LIMIT 10";
                                                   $result2 = mysqli_query($con, $query2);
                                                   if (mysqli_num_rows($result2) > 0) {
                                                      $i = 1;
                                                      while ($row2 = mysqli_fetch_assoc($result2)) {
                                                         $thumbnail2 = $client.$row2['thumbnail_ipfs'];
                                                         $video_id2 = $row2['video_uid'];
                                                         $chapter_part2 = $row2['video_id'];
                                                         $chapter_desc2 = $row2['video_desc'];
                                                         $chapter_name2 = $row2['name'];
                                                         $chapter_id2 = $row2['video_id'];
                                                         $module_name2 = $row2['module'];
                                                         $date2 = $row2['from_time'];
                                                         $date2 = substr($date2, 0, 17);
                                                         if(strlen($chapter_name2)>35){
                                                            $chapter_name2 = substr($chapter_name2, 0, 35) . ' ...';
                                                         }
                                                   ?>
                                                            <div class="e-item">
                                                                <div class="block-image position-relative">
                                                                    <a
                                                                        href="videoPlayer.php?course=<?= $video_id2 ?>&module=<?= $module_name2 ?>">
                                                                        <img src='<?= $thumbnail2 ?>' class="img-fluid"
                                                                            alt="">
                                                                    </a>
                                                                    <div class="episode-number"><?= $i ?></div>
                                                                    <div class="episode-play-info">
                                                                        <div class="episode-play">
                                                                            <a href="videoPlayer.php?course=<?= $video_id2 ?>&module=<?= $module_name2 ?>"
                                                                                tabindex="0"><i
                                                                                    class="ri-play-fill"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="episodes-description text-body mt-2">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <a
                                                                            href="videoPlayer.php?course=<?= $video_id2 ?>&module=<?= $module_name2 ?>">Episode
                                                                            <?= $i ?></a>
                                                                        <span class="text-primary">2.25 m</span>
                                                                    </div>
                                                                    <p class="mb-0"><?= $chapter_desc2 ?>
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <?php $i=$i+1; }} ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="trending-data3" class="overlay-tab tab-pane fade">
                                                <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                    <a href="javascript:void(0);" tabindex="0">
                                                        <div class="channel-logo">
                                                            <img src="images/logo.png" class="c-logo" alt="stramit">
                                                        </div>
                                                    </a>
                                                    <h1 class="trending-text big-title text-uppercase">
                                                        <?= $chapter_name ?></h1>
                                                    <div class="episodes-contens mt-4">
                                                        <div
                                                            class="owl-carousel owl-theme episodes-slider1 list-inline p-0 mb-0">
                                                            <?php
                                                   $query3 = "SELECT * FROM `video_info` WHERE `module`='$module_name' ORDER BY RAND() LIMIT 10";
                                                   $result3 = mysqli_query($con, $query3);
                                                   if (mysqli_num_rows($result3) > 0) {
                                                      $i = 1;
                                                      while ($row3 = mysqli_fetch_assoc($result3)) {
                                                         $thumbnail3 = $client.$row3['thumbnail_ipfs'];
                                                         $video_id3 = $row3['video_uid'];
                                                         $chapter_part3 = $row3['video_id'];
                                                         $chapter_desc3 = $row3['video_desc'];
                                                         $chapter_name3 = $row3['name'];
                                                         $chapter_id3 = $row3['video_id'];
                                                         $module_name3 = $row3['module'];
                                                         $date3 = $row3['from_time'];
                                                         $date3 = substr($date3, 0, 17);
                                                         if(strlen($chapter_name3)>35){
                                                            $chapter_name3 = substr($chapter_name3, 0, 35) . ' ...';
                                                         }
                                                   ?>
                                                            <div class="e-item">
                                                                <div class="block-image position-relative">
                                                                    <a
                                                                        href="videoPlayer.php?course=<?= $video_id3 ?>&module=<?= $module_name3 ?>">
                                                                        <img src="<?= $thumbnail3 ?>" class="img-fluid"
                                                                            alt="">
                                                                    </a>
                                                                    <div class="episode-number"><?= $i ?></div>
                                                                    <div class="episode-play-info">
                                                                        <div class="episode-play">
                                                                            <a href="videoPlayer.php?course=<?= $video_id3 ?>&module=<?= $module_name3 ?>"
                                                                                tabindex="<?= $i-1 ?>"><i
                                                                                    class="ri-play-fill"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="episodes-description text-body mt-2">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <a
                                                                            href="videoPlayer.php?course=<?= $video_id3 ?>&module=<?= $module_name3 ?>">Episode
                                                                            <?= $i ?></a>
                                                                        <span class="text-primary">2.25 m</span>
                                                                    </div>
                                                                    <p class="mb-0"><?= $chapter_desc3 ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <?php $i=$i+1; }} ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php }} ?>
                            <?php
                              $query = "SELECT * FROM `video_info` WHERE 1 ORDER BY `video_id` DESC LIMIT 1,1";
                              $result = mysqli_query($con, $query);
                              if (mysqli_num_rows($result) > 0) {
                                 $i = 1;
                                 while ($row = mysqli_fetch_assoc($result)) {
                                    $thumbnail = $client.$row['thumbnail_ipfs'];
                                    $video_id = $row['video_uid'];
                                    $chapter_part = $row['video_id'];
                                    $chapter_desc = $row['video_desc'];
                                    $chapter_name = $row['name'];
                                    $chapter_id = $row['video_id'];
                                    $module_name = $row['module'];
                                    $date = $row['from_time'];
                                    $date = substr($date, 0, 17);
                                    if(strlen($chapter_name)>35){
                                       $chapter_name = substr($chapter_name, 0, 35) . ' ...';
                                    }

                              ?>
                            <li>
                                <div class="tranding-block position-relative"
                                    style="background-image: url(<?= $thumbnail ?>);">
                                    <div class="trending-custom-tab">
                                        <div class="tab-title-info position-relative">
                                            <ul class="trending-pills d-flex nav nav-pills justify-content-center align-items-center text-center"
                                                role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active show" data-toggle="pill"
                                                        href="#trending-data4" role="tab"
                                                        aria-selected="true">Overview</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#trending-data5"
                                                        role="tab" aria-selected="false">Videos</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#trending-data6"
                                                        role="tab" aria-selected="false">Similar Like This</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="trending-content">
                                            <div id="trending-data4" class="overview-tab tab-pane fade active show">
                                                <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                    <a href="javascript:void(0);" tabindex="0">
                                                        <div class="res-logo">
                                                            <div class="channel-logo">
                                                                <img src="images/logo.png" class="c-logo" alt="Finflix">
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <h1 class="trending-text big-title text-uppercase">
                                                        <?= $chapter_name ?></h1>
                                                    <div class="d-flex align-items-center text-white text-detail">
                                                        <span
                                                            class="badge badge-secondary p-3"><?= $module_name ?></span>
                                                        <span class="ml-3">#<?= $chapter_part ?></span>
                                                        <span class="trending-year">2022</span>
                                                    </div>
                                                    <div class="d-flex align-items-center series mb-4">
                                                        <a href="javascript:void(0);"><img src='<?= $thumbnail ?>'
                                                                class="img-fluid" alt=""
                                                                style="width:72px;height:72px;object-fit: contain;"></a>
                                                        <span class="text-gold ml-3">#<?= $chapter_part ?> in Video
                                                            Today</span>
                                                    </div>
                                                    <p class="trending-dec"><?= $chapter_desc ?></p>
                                                    <div class="p-btns">
                                                        <div class="d-flex align-items-center p-0">
                                                            <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>"
                                                                class="btn btn-hover mr-2" tabindex="0"><i
                                                                    class="fa fa-play mr-2" aria-hidden="true"></i>Play
                                                                Now</a>
                                                            <a href="javascript:void(0);" class="btn btn-link"
                                                                tabindex="0">
                                                                <i class="ri-information-fill"></i>My
                                                                List</a>
                                                        </div>
                                                    </div>
                                                    <div class="trending-list mt-4">
                                                        <div class="text-primary title text-color">This Is: <span
                                                                class="text-body">Cryto,Blockchain</span>
                                                        </div>
                                                        <div class="text-primary title text-color">Added On: <span
                                                                class="text-body"><?= $date ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="trending-data5" class="overlay-tab tab-pane fade">
                                                <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                    <a href="show-details.html" tabindex="0">
                                                        <div class="channel-logo">
                                                            <img src="images/logo.png" class="c-logo" alt="stramit">
                                                        </div>
                                                    </a>
                                                    <h1 class="trending-text big-title text-uppercase">
                                                        <?= $chapter_name ?></h1>
                                                    <div class="episodes-contens mt-4">
                                                        <div
                                                            class="owl-carousel owl-theme episodes-slider1 list-inline p-0 mb-0">
                                                            <?php
                                                   $query2 = "SELECT * FROM `video_info` WHERE `module`='$module_name' LIMIT 10";
                                                   $result2 = mysqli_query($con, $query2);
                                                   if (mysqli_num_rows($result2) > 0) {
                                                      $i = 1;
                                                      while ($row2 = mysqli_fetch_assoc($result2)) {
                                                         $thumbnail2 = $client.$row2['thumbnail_ipfs'];
                                                         $video_id2 = $row2['video_uid'];
                                                         $chapter_part2 = $row2['video_id'];
                                                         $chapter_desc2 = $row2['video_desc'];
                                                         $chapter_name2 = $row2['name'];
                                                         $chapter_id2 = $row2['video_id'];
                                                         $module_name2 = $row2['module'];
                                                         $date2 = $row2['from_time'];
                                                         $date2 = substr($date2, 0, 17);
                                                         if(strlen($chapter_name2)>35){
                                                            $chapter_name2 = substr($chapter_name2, 0, 35) . ' ...';
                                                         }
                                                   ?>
                                                            <div class="e-item">
                                                                <div class="block-image position-relative">
                                                                    <a
                                                                        href="videoPlayer.php?course=<?= $video_id2 ?>&module=<?= $module_name2 ?>">
                                                                        <img src='<?= $thumbnail2 ?>' class="img-fluid"
                                                                            alt="">
                                                                    </a>
                                                                    <div class="episode-number"><?= $i ?></div>
                                                                    <div class="episode-play-info">
                                                                        <div class="episode-play">
                                                                            <a href="videoPlayer.php?course=<?= $video_id2 ?>&module=<?= $module_name2 ?>"
                                                                                tabindex="0"><i
                                                                                    class="ri-play-fill"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="episodes-description text-body mt-2">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <a
                                                                            href="videoPlayer.php?course=<?= $video_id2 ?>&module=<?= $module_name2 ?>">Episode
                                                                            <?= $i ?></a>
                                                                        <span class="text-primary">2.25 m</span>
                                                                    </div>
                                                                    <p class="mb-0"><?= $chapter_desc2 ?>
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <?php $i=$i+1; }} ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="trending-data6" class="overlay-tab tab-pane fade">
                                                <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                    <a href="javascript:void(0);" tabindex="0">
                                                        <div class="channel-logo">
                                                            <img src="images/logo.png" class="c-logo" alt="stramit">
                                                        </div>
                                                    </a>
                                                    <h1 class="trending-text big-title text-uppercase">
                                                        <?= $chapter_name ?></h1>
                                                    <div class="episodes-contens mt-4">
                                                        <div
                                                            class="owl-carousel owl-theme episodes-slider1 list-inline p-0 mb-0">
                                                            <?php
                                                   $query3 = "SELECT * FROM `video_info` WHERE `module`='$module_name' ORDER BY RAND() LIMIT 10";
                                                   $result3 = mysqli_query($con, $query3);
                                                   if (mysqli_num_rows($result3) > 0) {
                                                      $i = 1;
                                                      while ($row3 = mysqli_fetch_assoc($result3)) {
                                                         $thumbnail3 = $client.$row3['thumbnail_ipfs'];
                                                         $video_id3 = $row3['video_uid'];
                                                         $chapter_part3 = $row3['video_id'];
                                                         $chapter_desc3 = $row3['video_desc'];
                                                         $chapter_name3 = $row3['name'];
                                                         $chapter_id3 = $row3['video_id'];
                                                         $module_name3 = $row3['module'];
                                                         $date3 = $row3['from_time'];
                                                         $date3 = substr($date3, 0, 17);
                                                         if(strlen($chapter_name3)>35){
                                                            $chapter_name3 = substr($chapter_name3, 0, 35) . ' ...';
                                                         }
                                                   ?>
                                                            <div class="e-item">
                                                                <div class="block-image position-relative">
                                                                    <a
                                                                        href="videoPlayer.php?course=<?= $video_id3 ?>&module=<?= $module_name3 ?>">
                                                                        <img src="<?= $thumbnail3 ?>" class="img-fluid"
                                                                            alt="">
                                                                    </a>
                                                                    <div class="episode-number"><?= $i ?></div>
                                                                    <div class="episode-play-info">
                                                                        <div class="episode-play">
                                                                            <a href="videoPlayer.php?course=<?= $video_id3 ?>&module=<?= $module_name3 ?>"
                                                                                tabindex="<?= $i-1 ?>"><i
                                                                                    class="ri-play-fill"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="episodes-description text-body mt-2">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <a
                                                                            href="videoPlayer.php?course=<?= $video_id3 ?>&module=<?= $module_name3 ?>">Episode
                                                                            <?= $i ?></a>
                                                                        <span class="text-primary">2.25 m</span>
                                                                    </div>
                                                                    <p class="mb-0"><?= $chapter_desc3 ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <?php $i=$i+1; }} ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php }} ?>
                            <?php
                              $query = "SELECT * FROM `video_info` WHERE 1 ORDER BY `video_id` DESC LIMIT 2,1";
                              $result = mysqli_query($con, $query);
                              if (mysqli_num_rows($result) > 0) {
                                 $i = 1;
                                 while ($row = mysqli_fetch_assoc($result)) {
                                    $thumbnail = $client.$row['thumbnail_ipfs'];
                                    $video_id = $row['video_uid'];
                                    $chapter_part = $row['video_id'];
                                    $chapter_desc = $row['video_desc'];
                                    $chapter_name = $row['name'];
                                    $chapter_id = $row['video_id'];
                                    $module_name = $row['module'];
                                    $date = $row['from_time'];
                                    $date = substr($date, 0, 17);
                                    if(strlen($chapter_name)>35){
                                       $chapter_name = substr($chapter_name, 0, 35) . ' ...';
                                    }

                              ?>
                            <li>
                                <div class="tranding-block position-relative"
                                    style="background-image: url(<?= $thumbnail ?>);">
                                    <div class="trending-custom-tab">
                                        <div class="tab-title-info position-relative">
                                            <ul class="trending-pills d-flex nav nav-pills justify-content-center align-items-center text-center"
                                                role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active show" data-toggle="pill"
                                                        href="#trending-data7" role="tab"
                                                        aria-selected="true">Overview</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#trending-data8"
                                                        role="tab" aria-selected="false">Videos</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#trending-data9"
                                                        role="tab" aria-selected="false">Similar Like This</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="trending-content">
                                            <div id="trending-data7" class="overview-tab tab-pane fade active show">
                                                <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                    <a href="javascript:void(0);" tabindex="0">
                                                        <div class="res-logo">
                                                            <div class="channel-logo">
                                                                <img src="images/logo.png" class="c-logo" alt="Finflix">
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <h1 class="trending-text big-title text-uppercase">
                                                        <?= $chapter_name ?></h1>
                                                    <div class="d-flex align-items-center text-white text-detail">
                                                        <span
                                                            class="badge badge-secondary p-3"><?= $module_name ?></span>
                                                        <span class="ml-3">#<?= $chapter_part ?></span>
                                                        <span class="trending-year">2022</span>
                                                    </div>
                                                    <div class="d-flex align-items-center series mb-4">
                                                        <a href="javascript:void(0);"><img src='<?= $thumbnail ?>'
                                                                class="img-fluid" alt=""
                                                                style="width:72px;height:72px;object-fit: contain;"></a>
                                                        <span class="text-gold ml-3">#<?= $chapter_part ?> in Video
                                                            Today</span>
                                                    </div>
                                                    <p class="trending-dec"><?= $chapter_desc ?></p>
                                                    <div class="p-btns">
                                                        <div class="d-flex align-items-center p-0">
                                                            <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>"
                                                                class="btn btn-hover mr-2" tabindex="0"><i
                                                                    class="fa fa-play mr-2" aria-hidden="true"></i>Play
                                                                Now</a>
                                                            <a href="javascript:void(0);" class="btn btn-link"
                                                                tabindex="0">
                                                                <i class="ri-information-fill"></i>My
                                                                List</a>
                                                        </div>
                                                    </div>
                                                    <div class="trending-list mt-4">
                                                        <div class="text-primary title text-color">This Is: <span
                                                                class="text-body">Cryto,Blockchain</span>
                                                        </div>
                                                        <div class="text-primary title text-color">Added On: <span
                                                                class="text-body"><?= $date ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="trending-data8" class="overlay-tab tab-pane fade">
                                                <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                    <a href="show-details.html" tabindex="0">
                                                        <div class="channel-logo">
                                                            <img src="images/logo.png" class="c-logo" alt="stramit">
                                                        </div>
                                                    </a>
                                                    <h1 class="trending-text big-title text-uppercase">
                                                        <?= $chapter_name ?></h1>
                                                    <div class="episodes-contens mt-4">
                                                        <div
                                                            class="owl-carousel owl-theme episodes-slider1 list-inline p-0 mb-0">
                                                            <?php
                                                   $query2 = "SELECT * FROM `video_info` WHERE `module`='$module_name' LIMIT 10";
                                                   $result2 = mysqli_query($con, $query2);
                                                   if (mysqli_num_rows($result2) > 0) {
                                                      $i = 1;
                                                      while ($row2 = mysqli_fetch_assoc($result2)) {
                                                         $thumbnail2 = $client.$row2['thumbnail_ipfs'];
                                                         $video_id2 = $row2['video_uid'];
                                                         $chapter_part2 = $row2['video_id'];
                                                         $chapter_desc2 = $row2['video_desc'];
                                                         $chapter_name2 = $row2['name'];
                                                         $chapter_id2 = $row2['video_id'];
                                                         $module_name2 = $row2['module'];
                                                         $date2 = $row2['from_time'];
                                                         $date2 = substr($date2, 0, 17);
                                                         if(strlen($chapter_name2)>35){
                                                            $chapter_name2 = substr($chapter_name2, 0, 35) . ' ...';
                                                         }
                                                   ?>
                                                            <div class="e-item">
                                                                <div class="block-image position-relative">
                                                                    <a
                                                                        href="videoPlayer.php?course=<?= $video_id2 ?>&module=<?= $module_name2 ?>">
                                                                        <img src='<?= $thumbnail2 ?>' class="img-fluid"
                                                                            alt="">
                                                                    </a>
                                                                    <div class="episode-number"><?= $i ?></div>
                                                                    <div class="episode-play-info">
                                                                        <div class="episode-play">
                                                                            <a href="videoPlayer.php?course=<?= $video_id2 ?>&module=<?= $module_name2 ?>"
                                                                                tabindex="0"><i
                                                                                    class="ri-play-fill"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="episodes-description text-body mt-2">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <a
                                                                            href="videoPlayer.php?course=<?= $video_id2 ?>&module=<?= $module_name2 ?>">Episode
                                                                            <?= $i ?></a>
                                                                        <span class="text-primary">2.25 m</span>
                                                                    </div>
                                                                    <p class="mb-0"><?= $chapter_desc2 ?>
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <?php $i=$i+1; }} ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="trending-data9" class="overlay-tab tab-pane fade">
                                                <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                    <a href="javascript:void(0);" tabindex="0">
                                                        <div class="channel-logo">
                                                            <img src="images/logo.png" class="c-logo" alt="stramit">
                                                        </div>
                                                    </a>
                                                    <h1 class="trending-text big-title text-uppercase">
                                                        <?= $chapter_name ?></h1>
                                                    <div class="episodes-contens mt-4">
                                                        <div
                                                            class="owl-carousel owl-theme episodes-slider1 list-inline p-0 mb-0">
                                                            <?php
                                                   $query3 = "SELECT * FROM `video_info` WHERE `module`='$module_name' ORDER BY RAND() LIMIT 10";
                                                   $result3 = mysqli_query($con, $query3);
                                                   if (mysqli_num_rows($result3) > 0) {
                                                      $i = 1;
                                                      while ($row3 = mysqli_fetch_assoc($result3)) {
                                                         $thumbnail3 = $client.$row3['thumbnail_ipfs'];
                                                         $video_id3 = $row3['video_uid'];
                                                         $chapter_part3 = $row3['video_id'];
                                                         $chapter_desc3 = $row3['video_desc'];
                                                         $chapter_name3 = $row3['name'];
                                                         $chapter_id3 = $row3['video_id'];
                                                         $module_name3 = $row3['module'];
                                                         $date3 = $row3['from_time'];
                                                         $date3 = substr($date3, 0, 17);
                                                         if(strlen($chapter_name3)>35){
                                                            $chapter_name3 = substr($chapter_name3, 0, 35) . ' ...';
                                                         }
                                                   ?>
                                                            <div class="e-item">
                                                                <div class="block-image position-relative">
                                                                    <a
                                                                        href="videoPlayer.php?course=<?= $video_id3 ?>&module=<?= $module_name3 ?>">
                                                                        <img src="<?= $thumbnail3 ?>" class="img-fluid"
                                                                            alt="">
                                                                    </a>
                                                                    <div class="episode-number"><?= $i ?></div>
                                                                    <div class="episode-play-info">
                                                                        <div class="episode-play">
                                                                            <a href="videoPlayer.php?course=<?= $video_id3 ?>&module=<?= $module_name3 ?>"
                                                                                tabindex="<?= $i-1 ?>"><i
                                                                                    class="ri-play-fill"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="episodes-description text-body mt-2">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <a
                                                                            href="videoPlayer.php?course=<?= $video_id3 ?>&module=<?= $module_name3 ?>">Episode
                                                                            <?= $i ?></a>
                                                                        <span class="text-primary">2.25 m</span>
                                                                    </div>
                                                                    <p class="mb-0"><?= $chapter_desc3 ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <?php $i=$i+1; }} ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php }} ?>
                            <?php
                              $query = "SELECT * FROM `video_info` WHERE 1 ORDER BY `video_id` DESC LIMIT 3,1";
                              $result = mysqli_query($con, $query);
                              if (mysqli_num_rows($result) > 0) {
                                 $i = 1;
                                 while ($row = mysqli_fetch_assoc($result)) {
                                    $thumbnail = $client.$row['thumbnail_ipfs'];
                                    $video_id = $row['video_uid'];
                                    $chapter_part = $row['video_id'];
                                    $chapter_desc = $row['video_desc'];
                                    $chapter_name = $row['name'];
                                    $chapter_id = $row['video_id'];
                                    $module_name = $row['module'];
                                    $date = $row['from_time'];
                                    $date = substr($date, 0, 17);
                                    if(strlen($chapter_name)>35){
                                       $chapter_name = substr($chapter_name, 0, 35) . ' ...';
                                    }

                              ?>
                            <li>
                                <div class="tranding-block position-relative"
                                    style="background-image: url(<?= $thumbnail ?>);">
                                    <div class="trending-custom-tab">
                                        <div class="tab-title-info position-relative">
                                            <ul class="trending-pills d-flex nav nav-pills justify-content-center align-items-center text-center"
                                                role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active show" data-toggle="pill"
                                                        href="#trending-data10" role="tab"
                                                        aria-selected="true">Overview</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#trending-data11"
                                                        role="tab" aria-selected="false">Videos</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#trending-data12"
                                                        role="tab" aria-selected="false">Similar Like This</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="trending-content">
                                            <div id="trending-data10" class="overview-tab tab-pane fade active show">
                                                <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                    <a href="javascript:void(0);" tabindex="0">
                                                        <div class="res-logo">
                                                            <div class="channel-logo">
                                                                <img src="images/logo.png" class="c-logo" alt="Finflix">
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <h1 class="trending-text big-title text-uppercase">
                                                        <?= $chapter_name ?></h1>
                                                    <div class="d-flex align-items-center text-white text-detail">
                                                        <span
                                                            class="badge badge-secondary p-3"><?= $module_name ?></span>
                                                        <span class="ml-3">#<?= $chapter_part ?></span>
                                                        <span class="trending-year">2022</span>
                                                    </div>
                                                    <div class="d-flex align-items-center series mb-4">
                                                        <a href="javascript:void(0);"><img src='<?= $thumbnail ?>'
                                                                class="img-fluid" alt=""
                                                                style="width:72px;height:72px;object-fit: contain;"></a>
                                                        <span class="text-gold ml-3">#<?= $chapter_part ?> in Video
                                                            Today</span>
                                                    </div>
                                                    <p class="trending-dec"><?= $chapter_desc ?></p>
                                                    <div class="p-btns">
                                                        <div class="d-flex align-items-center p-0">
                                                            <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>"
                                                                class="btn btn-hover mr-2" tabindex="0"><i
                                                                    class="fa fa-play mr-2" aria-hidden="true"></i>Play
                                                                Now</a>
                                                            <a href="javascript:void(0);" class="btn btn-link"
                                                                tabindex="0">
                                                                <i class="ri-information-fill"></i>My
                                                                List</a>
                                                        </div>
                                                    </div>
                                                    <div class="trending-list mt-4">
                                                        <div class="text-primary title text-color">This Is: <span
                                                                class="text-body">Cryto,Blockchain</span>
                                                        </div>
                                                        <div class="text-primary title text-color">Added On: <span
                                                                class="text-body"><?= $date ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="trending-data11" class="overlay-tab tab-pane fade">
                                                <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                    <a href="show-details.html" tabindex="0">
                                                        <div class="channel-logo">
                                                            <img src="images/logo.png" class="c-logo" alt="stramit">
                                                        </div>
                                                    </a>
                                                    <h1 class="trending-text big-title text-uppercase">
                                                        <?= $chapter_name ?></h1>
                                                    <div class="episodes-contens mt-4">
                                                        <div
                                                            class="owl-carousel owl-theme episodes-slider1 list-inline p-0 mb-0">
                                                            <?php
                                                   $query2 = "SELECT * FROM `video_info` WHERE `module`='$module_name' LIMIT 10";
                                                   $result2 = mysqli_query($con, $query2);
                                                   if (mysqli_num_rows($result2) > 0) {
                                                      $i = 1;
                                                      while ($row2 = mysqli_fetch_assoc($result2)) {
                                                         $thumbnail2 = $client.$row2['thumbnail_ipfs'];
                                                         $video_id2 = $row2['video_uid'];
                                                         $chapter_part2 = $row2['video_id'];
                                                         $chapter_desc2 = $row2['video_desc'];
                                                         $chapter_name2 = $row2['name'];
                                                         $chapter_id2 = $row2['video_id'];
                                                         $module_name2 = $row2['module'];
                                                         $date2 = $row2['from_time'];
                                                         $date2 = substr($date2, 0, 17);
                                                         if(strlen($chapter_name2)>35){
                                                            $chapter_name2 = substr($chapter_name2, 0, 35) . ' ...';
                                                         }
                                                   ?>
                                                            <div class="e-item">
                                                                <div class="block-image position-relative">
                                                                    <a
                                                                        href="videoPlayer.php?course=<?= $video_id2 ?>&module=<?= $module_name2 ?>">
                                                                        <img src='<?= $thumbnail2 ?>' class="img-fluid"
                                                                            alt="">
                                                                    </a>
                                                                    <div class="episode-number"><?= $i ?></div>
                                                                    <div class="episode-play-info">
                                                                        <div class="episode-play">
                                                                            <a href="videoPlayer.php?course=<?= $video_id2 ?>&module=<?= $module_name2 ?>"
                                                                                tabindex="0"><i
                                                                                    class="ri-play-fill"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="episodes-description text-body mt-2">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <a
                                                                            href="videoPlayer.php?course=<?= $video_id2 ?>&module=<?= $module_name2 ?>">Episode
                                                                            <?= $i ?></a>
                                                                        <span class="text-primary">2.25 m</span>
                                                                    </div>
                                                                    <p class="mb-0"><?= $chapter_desc2 ?>
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <?php $i=$i+1; }} ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="trending-data12" class="overlay-tab tab-pane fade">
                                                <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                    <a href="javascript:void(0);" tabindex="0">
                                                        <div class="channel-logo">
                                                            <img src="images/logo.png" class="c-logo" alt="stramit">
                                                        </div>
                                                    </a>
                                                    <h1 class="trending-text big-title text-uppercase">
                                                        <?= $chapter_name ?></h1>
                                                    <div class="episodes-contens mt-4">
                                                        <div
                                                            class="owl-carousel owl-theme episodes-slider1 list-inline p-0 mb-0">
                                                            <?php
                                                   $query3 = "SELECT * FROM `video_info` WHERE `module`='$module_name' ORDER BY RAND() LIMIT 10";
                                                   $result3 = mysqli_query($con, $query3);
                                                   if (mysqli_num_rows($result3) > 0) {
                                                      $i = 1;
                                                      while ($row3 = mysqli_fetch_assoc($result3)) {
                                                         $thumbnail3 = $client.$row3['thumbnail_ipfs'];
                                                         $video_id3 = $row3['video_uid'];
                                                         $chapter_part3 = $row3['video_id'];
                                                         $chapter_desc3 = $row3['video_desc'];
                                                         $chapter_name3 = $row3['name'];
                                                         $chapter_id3 = $row3['video_id'];
                                                         $module_name3 = $row3['module'];
                                                         $date3 = $row3['from_time'];
                                                         $date3 = substr($date3, 0, 17);
                                                         if(strlen($chapter_name3)>35){
                                                            $chapter_name3 = substr($chapter_name3, 0, 35) . ' ...';
                                                         }
                                                   ?>
                                                            <div class="e-item">
                                                                <div class="block-image position-relative">
                                                                    <a
                                                                        href="videoPlayer.php?course=<?= $video_id3 ?>&module=<?= $module_name3 ?>">
                                                                        <img src="<?= $thumbnail3 ?>" class="img-fluid"
                                                                            alt="">
                                                                    </a>
                                                                    <div class="episode-number"><?= $i ?></div>
                                                                    <div class="episode-play-info">
                                                                        <div class="episode-play">
                                                                            <a href="videoPlayer.php?course=<?= $video_id3 ?>&module=<?= $module_name3 ?>"
                                                                                tabindex="<?= $i-1 ?>"><i
                                                                                    class="ri-play-fill"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="episodes-description text-body mt-2">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <a
                                                                            href="videoPlayer.php?course=<?= $video_id3 ?>&module=<?= $module_name3 ?>">Episode
                                                                            <?= $i ?></a>
                                                                        <span class="text-primary">2.25 m</span>
                                                                    </div>
                                                                    <p class="mb-0"><?= $chapter_desc3 ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <?php $i=$i+1; }} ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php }} ?>
                            <?php
                              $query = "SELECT * FROM `video_info` WHERE 1 ORDER BY `video_id` DESC LIMIT 4,1";
                              $result = mysqli_query($con, $query);
                              if (mysqli_num_rows($result) > 0) {
                                 $i = 1;
                                 while ($row = mysqli_fetch_assoc($result)) {
                                    $thumbnail = $client.$row['thumbnail_ipfs'];
                                    $video_id = $row['video_uid'];
                                    $chapter_part = $row['video_id'];
                                    $chapter_desc = $row['video_desc'];
                                    $chapter_name = $row['name'];
                                    $chapter_id = $row['video_id'];
                                    $module_name = $row['module'];
                                    $date = $row['from_time'];
                                    $date = substr($date, 0, 17);
                                    if(strlen($chapter_name)>35){
                                       $chapter_name = substr($chapter_name, 0, 35) . ' ...';
                                    }

                              ?>
                            <li>
                                <div class="tranding-block position-relative"
                                    style="background-image: url(<?= $thumbnail ?>);">
                                    <div class="trending-custom-tab">
                                        <div class="tab-title-info position-relative">
                                            <ul class="trending-pills d-flex nav nav-pills justify-content-center align-items-center text-center"
                                                role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active show" data-toggle="pill"
                                                        href="#trending-data13" role="tab"
                                                        aria-selected="true">Overview</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#trending-data14"
                                                        role="tab" aria-selected="false">Videos</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#trending-data15"
                                                        role="tab" aria-selected="false">Similar Like This</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="trending-content">
                                            <div id="trending-data13" class="overview-tab tab-pane fade active show">
                                                <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                    <a href="javascript:void(0);" tabindex="0">
                                                        <div class="res-logo">
                                                            <div class="channel-logo">
                                                                <img src="images/logo.png" class="c-logo" alt="Finflix">
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <h1 class="trending-text big-title text-uppercase">
                                                        <?= $chapter_name ?></h1>
                                                    <div class="d-flex align-items-center text-white text-detail">
                                                        <span
                                                            class="badge badge-secondary p-3"><?= $module_name ?></span>
                                                        <span class="ml-3">#<?= $chapter_part ?></span>
                                                        <span class="trending-year">2022</span>
                                                    </div>
                                                    <div class="d-flex align-items-center series mb-4">
                                                        <a href="javascript:void(0);"><img src='<?= $thumbnail ?>'
                                                                class="img-fluid" alt=""
                                                                style="width:72px;height:72px;object-fit: contain;"></a>
                                                        <span class="text-gold ml-3">#<?= $chapter_part ?> in Video
                                                            Today</span>
                                                    </div>
                                                    <p class="trending-dec"><?= $chapter_desc ?></p>
                                                    <div class="p-btns">
                                                        <div class="d-flex align-items-center p-0">
                                                            <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>"
                                                                class="btn btn-hover mr-2" tabindex="0"><i
                                                                    class="fa fa-play mr-2" aria-hidden="true"></i>Play
                                                                Now</a>
                                                            <a href="javascript:void(0);" class="btn btn-link"
                                                                tabindex="0">
                                                                <i class="ri-information-fill"></i>My
                                                                List</a>
                                                        </div>
                                                    </div>
                                                    <div class="trending-list mt-4">
                                                        <div class="text-primary title text-color">This Is: <span
                                                                class="text-body">Cryto,Blockchain</span>
                                                        </div>
                                                        <div class="text-primary title text-color">Added On: <span
                                                                class="text-body"><?= $date ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="trending-data14" class="overlay-tab tab-pane fade">
                                                <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                    <a href="show-details.html" tabindex="0">
                                                        <div class="channel-logo">
                                                            <img src="images/logo.png" class="c-logo" alt="stramit">
                                                        </div>
                                                    </a>
                                                    <h1 class="trending-text big-title text-uppercase">
                                                        <?= $chapter_name ?></h1>
                                                    <div class="episodes-contens mt-4">
                                                        <div
                                                            class="owl-carousel owl-theme episodes-slider1 list-inline p-0 mb-0">
                                                            <?php
                                                   $query2 = "SELECT * FROM `video_info` WHERE `module`='$module_name' LIMIT 10";
                                                   $result2 = mysqli_query($con, $query2);
                                                   if (mysqli_num_rows($result2) > 0) {
                                                      $i = 1;
                                                      while ($row2 = mysqli_fetch_assoc($result2)) {
                                                         $thumbnail2 = $client.$row2['thumbnail_ipfs'];
                                                         $video_id2 = $row2['video_uid'];
                                                         $chapter_part2 = $row2['video_id'];
                                                         $chapter_desc2 = $row2['video_desc'];
                                                         $chapter_name2 = $row2['name'];
                                                         $chapter_id2 = $row2['video_id'];
                                                         $module_name2 = $row2['module'];
                                                         $date2 = $row2['from_time'];
                                                         $date2 = substr($date2, 0, 17);
                                                         if(strlen($chapter_name2)>35){
                                                            $chapter_name2 = substr($chapter_name2, 0, 35) . ' ...';
                                                         }
                                                   ?>
                                                            <div class="e-item">
                                                                <div class="block-image position-relative">
                                                                    <a
                                                                        href="videoPlayer.php?course=<?= $video_id2 ?>&module=<?= $module_name2 ?>">
                                                                        <img src='<?= $thumbnail2 ?>' class="img-fluid"
                                                                            alt="">
                                                                    </a>
                                                                    <div class="episode-number"><?= $i ?></div>
                                                                    <div class="episode-play-info">
                                                                        <div class="episode-play">
                                                                            <a href="videoPlayer.php?course=<?= $video_id2 ?>&module=<?= $module_name2 ?>"
                                                                                tabindex="0"><i
                                                                                    class="ri-play-fill"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="episodes-description text-body mt-2">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <a
                                                                            href="videoPlayer.php?course=<?= $video_id2 ?>&module=<?= $module_name2 ?>">Episode
                                                                            <?= $i ?></a>
                                                                        <span class="text-primary">2.25 m</span>
                                                                    </div>
                                                                    <p class="mb-0"><?= $chapter_desc2 ?>
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <?php $i=$i+1; }} ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="trending-data15" class="overlay-tab tab-pane fade">
                                                <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                    <a href="javascript:void(0);" tabindex="0">
                                                        <div class="channel-logo">
                                                            <img src="images/logo.png" class="c-logo" alt="stramit">
                                                        </div>
                                                    </a>
                                                    <h1 class="trending-text big-title text-uppercase">
                                                        <?= $chapter_name ?></h1>
                                                    <div class="episodes-contens mt-4">
                                                        <div
                                                            class="owl-carousel owl-theme episodes-slider1 list-inline p-0 mb-0">
                                                            <?php
                                                   $query3 = "SELECT * FROM `video_info` WHERE `module`='$module_name' ORDER BY RAND() LIMIT 10";
                                                   $result3 = mysqli_query($con, $query3);
                                                   if (mysqli_num_rows($result3) > 0) {
                                                      $i = 1;
                                                      while ($row3 = mysqli_fetch_assoc($result3)) {
                                                         $thumbnail3 = $client.$row3['thumbnail_ipfs'];
                                                         $video_id3 = $row3['video_uid'];
                                                         $chapter_part3 = $row3['video_id'];
                                                         $chapter_desc3 = $row3['video_desc'];
                                                         $chapter_name3 = $row3['name'];
                                                         $chapter_id3 = $row3['video_id'];
                                                         $module_name3 = $row3['module'];
                                                         $date3 = $row3['from_time'];
                                                         $date3 = substr($date3, 0, 17);
                                                         if(strlen($chapter_name3)>35){
                                                            $chapter_name3 = substr($chapter_name3, 0, 35) . ' ...';
                                                         }
                                                   ?>
                                                            <div class="e-item">
                                                                <div class="block-image position-relative">
                                                                    <a
                                                                        href="videoPlayer.php?course=<?= $video_id3 ?>&module=<?= $module_name3 ?>">
                                                                        <img src="<?= $thumbnail3 ?>" class="img-fluid"
                                                                            alt="">
                                                                    </a>
                                                                    <div class="episode-number"><?= $i ?></div>
                                                                    <div class="episode-play-info">
                                                                        <div class="episode-play">
                                                                            <a href="videoPlayer.php?course=<?= $video_id3 ?>&module=<?= $module_name3 ?>"
                                                                                tabindex="<?= $i-1 ?>"><i
                                                                                    class="ri-play-fill"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="episodes-description text-body mt-2">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <a
                                                                            href="videoPlayer.php?course=<?= $video_id3 ?>&module=<?= $module_name3 ?>">Episode
                                                                            <?= $i ?></a>
                                                                        <span class="text-primary">2.25 m</span>
                                                                    </div>
                                                                    <p class="mb-0"><?= $chapter_desc3 ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <?php $i=$i+1; }} ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php }} ?>
                            <?php
                              $query = "SELECT * FROM `video_info` WHERE 1 ORDER BY `video_id` DESC LIMIT 5,1";
                              $result = mysqli_query($con, $query);
                              if (mysqli_num_rows($result) > 0) {
                                 $i = 1;
                                 while ($row = mysqli_fetch_assoc($result)) {
                                    $thumbnail = $client.$row['thumbnail_ipfs'];
                                    $video_id = $row['video_uid'];
                                    $chapter_part = $row['video_id'];
                                    $chapter_desc = $row['video_desc'];
                                    $chapter_name = $row['name'];
                                    $chapter_id = $row['video_id'];
                                    $module_name = $row['module'];
                                    $date = $row['from_time'];
                                    $date = substr($date, 0, 17);
                                    if(strlen($chapter_name)>35){
                                       $chapter_name = substr($chapter_name, 0, 35) . ' ...';
                                    }

                              ?>
                            <li>
                                <div class="tranding-block position-relative"
                                    style="background-image: url(<?= $thumbnail ?>);">
                                    <div class="trending-custom-tab">
                                        <div class="tab-title-info position-relative">
                                            <ul class="trending-pills d-flex nav nav-pills justify-content-center align-items-center text-center"
                                                role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active show" data-toggle="pill"
                                                        href="#trending-data16" role="tab"
                                                        aria-selected="true">Overview</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#trending-data17"
                                                        role="tab" aria-selected="false">Videos</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#trending-data18"
                                                        role="tab" aria-selected="false">Similar Like This</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="trending-content">
                                            <div id="trending-data16" class="overview-tab tab-pane fade active show">
                                                <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                    <a href="javascript:void(0);" tabindex="0">
                                                        <div class="res-logo">
                                                            <div class="channel-logo">
                                                                <img src="images/logo.png" class="c-logo" alt="Finflix">
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <h1 class="trending-text big-title text-uppercase">
                                                        <?= $chapter_name ?></h1>
                                                    <div class="d-flex align-items-center text-white text-detail">
                                                        <span
                                                            class="badge badge-secondary p-3"><?= $module_name ?></span>
                                                        <span class="ml-3">#<?= $chapter_part ?></span>
                                                        <span class="trending-year">2022</span>
                                                    </div>
                                                    <div class="d-flex align-items-center series mb-4">
                                                        <a href="javascript:void(0);"><img src='<?= $thumbnail ?>'
                                                                class="img-fluid" alt=""
                                                                style="width:72px;height:72px;object-fit: contain;"></a>
                                                        <span class="text-gold ml-3">#<?= $chapter_part ?> in Video
                                                            Today</span>
                                                    </div>
                                                    <p class="trending-dec"><?= $chapter_desc ?></p>
                                                    <div class="p-btns">
                                                        <div class="d-flex align-items-center p-0">
                                                            <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>"
                                                                class="btn btn-hover mr-2" tabindex="0"><i
                                                                    class="fa fa-play mr-2" aria-hidden="true"></i>Play
                                                                Now</a>
                                                            <a href="javascript:void(0);" class="btn btn-link"
                                                                tabindex="0">
                                                                <i class="ri-information-fill"></i>My
                                                                List</a>
                                                        </div>
                                                    </div>
                                                    <div class="trending-list mt-4">
                                                        <div class="text-primary title text-color">This Is: <span
                                                                class="text-body">Cryto,Blockchain</span>
                                                        </div>
                                                        <div class="text-primary title text-color">Added On: <span
                                                                class="text-body"><?= $date ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="trending-data17" class="overlay-tab tab-pane fade">
                                                <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                    <a href="show-details.html" tabindex="0">
                                                        <div class="channel-logo">
                                                            <img src="images/logo.png" class="c-logo" alt="stramit">
                                                        </div>
                                                    </a>
                                                    <h1 class="trending-text big-title text-uppercase">
                                                        <?= $chapter_name ?></h1>
                                                    <div class="episodes-contens mt-4">
                                                        <div
                                                            class="owl-carousel owl-theme episodes-slider1 list-inline p-0 mb-0">
                                                            <?php
                                                   $query2 = "SELECT * FROM `video_info` WHERE `module`='$module_name' LIMIT 10";
                                                   $result2 = mysqli_query($con, $query2);
                                                   if (mysqli_num_rows($result2) > 0) {
                                                      $i = 1;
                                                      while ($row2 = mysqli_fetch_assoc($result2)) {
                                                         $thumbnail2 = $client.$row2['thumbnail_ipfs'];
                                                         $video_id2 = $row2['video_uid'];
                                                         $chapter_part2 = $row2['video_id'];
                                                         $chapter_desc2 = $row2['video_desc'];
                                                         $chapter_name2 = $row2['name'];
                                                         $chapter_id2 = $row2['video_id'];
                                                         $module_name2 = $row2['module'];
                                                         $date2 = $row2['from_time'];
                                                         $date2 = substr($date2, 0, 17);
                                                         if(strlen($chapter_name2)>35){
                                                            $chapter_name2 = substr($chapter_name2, 0, 35) . ' ...';
                                                         }
                                                   ?>
                                                            <div class="e-item">
                                                                <div class="block-image position-relative">
                                                                    <a
                                                                        href="videoPlayer.php?course=<?= $video_id2 ?>&module=<?= $module_name2 ?>">
                                                                        <img src='<?= $thumbnail2 ?>' class="img-fluid"
                                                                            alt="">
                                                                    </a>
                                                                    <div class="episode-number"><?= $i ?></div>
                                                                    <div class="episode-play-info">
                                                                        <div class="episode-play">
                                                                            <a href="videoPlayer.php?course=<?= $video_id2 ?>&module=<?= $module_name2 ?>"
                                                                                tabindex="0"><i
                                                                                    class="ri-play-fill"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="episodes-description text-body mt-2">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <a
                                                                            href="videoPlayer.php?course=<?= $video_id2 ?>&module=<?= $module_name2 ?>">Episode
                                                                            <?= $i ?></a>
                                                                        <span class="text-primary">2.25 m</span>
                                                                    </div>
                                                                    <p class="mb-0"><?= $chapter_desc2 ?>
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <?php $i=$i+1; }} ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="trending-data18" class="overlay-tab tab-pane fade">
                                                <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                    <a href="javascript:void(0);" tabindex="0">
                                                        <div class="channel-logo">
                                                            <img src="images/logo.png" class="c-logo" alt="stramit">
                                                        </div>
                                                    </a>
                                                    <h1 class="trending-text big-title text-uppercase">
                                                        <?= $chapter_name ?></h1>
                                                    <div class="episodes-contens mt-4">
                                                        <div
                                                            class="owl-carousel owl-theme episodes-slider1 list-inline p-0 mb-0">
                                                            <?php
                                                   $query3 = "SELECT * FROM `video_info` WHERE `module`='$module_name' ORDER BY RAND() LIMIT 10";
                                                   $result3 = mysqli_query($con, $query3);
                                                   if (mysqli_num_rows($result3) > 0) {
                                                      $i = 1;
                                                      while ($row3 = mysqli_fetch_assoc($result3)) {
                                                         $thumbnail3 = $client.$row3['thumbnail_ipfs'];
                                                         $video_id3 = $row3['video_uid'];
                                                         $chapter_part3 = $row3['video_id'];
                                                         $chapter_desc3 = $row3['video_desc'];
                                                         $chapter_name3 = $row3['name'];
                                                         $chapter_id3 = $row3['video_id'];
                                                         $module_name3 = $row3['module'];
                                                         $date3 = $row3['from_time'];
                                                         $date3 = substr($date3, 0, 17);
                                                         if(strlen($chapter_name3)>35){
                                                            $chapter_name3 = substr($chapter_name3, 0, 35) . ' ...';
                                                         }
                                                   ?>
                                                            <div class="e-item">
                                                                <div class="block-image position-relative">
                                                                    <a
                                                                        href="videoPlayer.php?course=<?= $video_id3 ?>&module=<?= $module_name3 ?>">
                                                                        <img src="<?= $thumbnail3 ?>" class="img-fluid"
                                                                            alt="">
                                                                    </a>
                                                                    <div class="episode-number"><?= $i ?></div>
                                                                    <div class="episode-play-info">
                                                                        <div class="episode-play">
                                                                            <a href="videoPlayer.php?course=<?= $video_id3 ?>&module=<?= $module_name3 ?>"
                                                                                tabindex="<?= $i-1 ?>"><i
                                                                                    class="ri-play-fill"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="episodes-description text-body mt-2">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <a
                                                                            href="videoPlayer.php?course=<?= $video_id3 ?>&module=<?= $module_name3 ?>">Episode
                                                                            <?= $i ?></a>
                                                                        <span class="text-primary">2.25 m</span>
                                                                    </div>
                                                                    <p class="mb-0"><?= $chapter_desc3 ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <?php $i=$i+1; }} ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php }} ?>

                        </ul>
                    </div>
                </div>
            </div>
    </div>
    </section>
    <section id="iq-suggestede" class="s-margin">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 overflow-hidden">
                    <div class="iq-main-header d-flex align-items-center justify-content-between">
                        <h4 class="main-title"><a href="#">Crypto News</a></h4>
                    </div>
                    <div class="suggestede-contens">
                        <ul class="list-inline favorites-slider row p-0 mb-0 favorites-slider-new">
                            <?php
                           $query = "SELECT * FROM `video_info` WHERE `module`='Cryptonite' ORDER BY RAND() LIMIT 10";
                           $result = mysqli_query($con, $query);
                           if (mysqli_num_rows($result) > 0) {
                              $i = 1;
                              while ($row = mysqli_fetch_assoc($result)) {
                                 $thumbnail = $client.$row['thumbnail_ipfs'];
                                 $video_id = $row['video_uid'];
                                 $chapter_part = $row['video_id'];
                                 $chapter_name = $row['name'];
                                 $chapter_id = $row['video_id'];
                                 $module_name = $row['module'];
                                 $video_uuid = $row['video_uuid'];
                                 // $chapter_id = $row['chapter_id'];
                           ?>
                            <li class="slide-item">
                                <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>">
                                    <div class="block-images position-relative">
                                        <div class="img-box my-img-container">
                                            <img src="<?= $thumbnail ?>" class="img-fluid" alt="">
                                        </div>
                                        <div class="block-description">
                                            <h6><?php echo $chapter_name ?></h6>
                                            <div class="movie-time d-flex align-items-center my-2">
                                                <div class="badge badge-secondary p-1 mr-2">Episode</div>
                                                <span class="text-white"><?= $i; ?></span>
                                            </div>
                                            <div class="hover-buttons">
                                                <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>"
                                                    class="btn btn-hover"><i class="fa fa-play mr-1"
                                                        aria-hidden="true"></i>
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
                            <?php
                                 $i = $i + 1;
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
                <p class="mb-0 text-center font-size-14 text-body">Finflix - 2021 All Rights Reserved</p>
            </div>
        </div>
    </footer>
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
    <script>
    function sliderInit2() {
        jQuery('.ccc').slick({
            dots: false,
            arrows: true,
            infinite: true,
            speed: 300,
            autoplay: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            // appendArrows: $('#sm-slick-arrow'),

            nextArrow: '<a href="#" class="slick-arrow slick-next"><i class= "fa fa-chevron-right"></i></a>',
            prevArrow: '<a href="#" class="slick-arrow slick-prev"><i class= "fa fa-chevron-left"></i></a>',
            responsive: [{
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        // arrows: false,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    }

    function myVid(id, title, desc, date, thumb, p_id) {
        console.log(id);
        console.log(title);
        console.log(desc);
        console.log(date);
        console.log(thumb);
        $.ajax({
            type: 'POST',
            url: 'php/addFavourite',
            'async': false,
            dataType: "json",
            data: {
                "videoId": id,
                "videoTitle": title,
                "videoDescription": desc,
                "videoPublishDate": date,
                "videoThumbnail": thumb,
                "p_id": p_id,
            },
            success: function(data) {
                if (data.status == '201') {
                    // alert("added in Your Favourite List");
                    addVid();
                    // location.reload();
                } else if (data.status == '501') {
                    alert("already in Your Favourite List");
                } else {
                    alert('try again after some time');
                }
            }
        });
    }

    function myVid2(video_id, user_id) {
        if(user_id == ''){
            userLoginOut();
        }else{
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
    //remove video by click functionality start
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

    function removeVid2(user, course, module, chapter) {
        // console.log(user);
        // console.log(videoId);
        $.ajax({
            type: 'POST',
            url: 'php/removeFavouritePaid',
            'async': false,
            dataType: "json",
            data: {
                "user": user,
                "course": course,
                "module": module,
                "chapter": chapter
            },
            success: function(data) {
                if (data.status == '201') {
                    // alert("remove from Your Favourite List");
                    addVid();
                } else {
                    alert('try again after some time');
                }
            }
        });
    }
    //add favourite video functionality start        
    function addVid() {
        $.ajax({
            type: 'POST',
            url: 'php/addList.php',
            'async': false,
            data: {
                "fetch": 1,
            },
            success: function(data) {
                $('#cc').html(data);
                sliderInit2();
                // console.log(data);
            }
        });
    }
    // addVid();

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
    const abc = window.ethereum.selectedAddress;
    console.log(abc);
    </script>
</body>

</html>