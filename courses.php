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
{
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
    <link rel="stylesheet" href="css/test.css" />
    <link rel="stylesheet" href="css/mobileDrawer.css" />
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
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
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
                                <a class="navbar-brand" href="./index"> <img class="img-fluid logo" src="images/logo.png"
                                        alt="Finflix" / style="width:120px;"> </a>
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
                                                                <input type="text" class="text search-input font-size-12"
                                                                    placeholder="type here to search..." name="query">
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
                                                        <input type="text" class="text search-input font-size-12"
                                                            placeholder="type here to search..." name="query">
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
    <!-- Slider Start -->
    <section class="iq-main-slider">
        <div id="tvshows-slider">
            <?php
            $query = "SELECT * FROM `video_info` WHERE 1";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) {
               while ($row = mysqli_fetch_assoc($result)) {
                  $thumbnail = $client.$row['thumbnail_ipfs'];
                  $video_id = $row['video_uid'];
                  $chapter_part = $row['video_id'];
                  $chapter_name = $row['name'];
                  $chapter_id = $row['video_id'];
                  $module_name = $row['module'];
                //   $chapter_img = $row['chapter_thumbnail'];
            ?>
            <div>
                <div
                    href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>">
                    <div class="shows-img">
                        <img src="<?= $thumbnail ?>" class="w-100" alt="">
                        <div class="shows-content" style="margin-bottom:30px;">
                            <h4 class="text-white mb-1"><?= $chapter_name ?></h4>
                            <div class="movie-time d-flex align-items-center">
                                <div class="badge badge-secondary p-1 mr-2">Episode</div>
                                <span class="text-white"><?= $chapter_part ?></span>
                            </div>
                            <!-- button start -->
                            <div class="billboard-links button-layer forward-leaning d-flex justify-content-left">
                                <a role="link" aria-label="Play – start with Audio Description turned on"
                                    class="visually-hidden ad-playlink" href="#">
                                    <span class="visually-hidden">&nbsp;</span>
                                </a>
                                <a role="link" aria-label="Play" class=" playLink isToolkit"
                                    href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>">
                                    <button class="color-primary hasLabel hasIcon ltr-v8pdkb" tabindex="-1"
                                        type="button">
                                        <div class="ltr-1ksxkn9">
                                            <div class="medium ltr-shvwfm" role="presentation">
                                                <svg viewBox="0 0 24 24">
                                                    <path d="M6 4l15 8-15 8z" fill="currentColor"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ltr-1i33xgl"></div>
                                        <span class="ltr-zd4xih">Play Now</span>
                                    </button>
                                </a>                                
                            </div>
                            <!-- button end -->
                        </div>
                    </div>
                </div>
            </div>
            <?php }
            } ?>            
        </div>
    </section>
    <!-- Slider End -->
    <!-- MainContent -->
    <div class="main-content">
        <section id="iq-favorites-2">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title">Cryptonite</h4>
                        </div>
                        <div class="favorites-contens">
                            <ul class="favorites-slider list-inline  row p-0 mb-0 favorites-slider-new">
                                <?php
                           $query = "SELECT * FROM `video_info` WHERE `module` = 'Cryptonite'";
                           $result = mysqli_query($con, $query);
                           if (mysqli_num_rows($result) > 0) {
                              $i=1;
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
                                    <a
                                        href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>">
                                        <div class="block-images position-relative">
                                            <div class="img-box my-img-container">
                                                <img src="<?= $thumbnail ?>" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6><?= $chapter_name ?></h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">Episode</div>
                                                    <span class="text-white"><?= $i ?></span>
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
                                                        <span><i class="ri-heart-fill"></i></span></li>                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <?php 
                           $i=$i+1;
                           }
                           } ?>
                               
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="iq-favorites-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title">Cryptonext</h4>
                        </div>
                        <div class="favorites-contens">
                            <ul class="favorites-slider list-inline  row p-0 mb-0 favorites-slider-new">
                                <?php
                           $query = "SELECT * FROM `video_info` WHERE `module` = 'Cryptonext'";
                           $result = mysqli_query($con, $query);
                           if (mysqli_num_rows($result) > 0) {
                              $i=1;
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
                                    <a
                                        href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>">
                                        <div class="block-images position-relative">
                                            <div class="img-box my-img-container">
                                                <img src="<?= $thumbnail ?>" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6><?= $chapter_name ?></h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">Episode</div>
                                                    <span class="text-white"><?= $i ?></span>
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
                                                        <span><i class="ri-heart-fill"></i></span></li>                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <?php 
                           $i=$i+1;
                           }
                           } ?>
                                
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
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/web3modal@1.9.7/dist/index.js"></script>
    <script type="text/javascript" src="https://unpkg.com/@walletconnect/web3-provider@1.7.8/dist/umd/index.min.js">
    </script>
    <script src="./frontend/web3-login.js?v=009">
    </script>
    <script src="./frontend/web3-modal.js?v=001"></script>
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
    </script>
</body>

</html>
<?php } ?>