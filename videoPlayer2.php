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
$is_user_exits = mysqli_query($con, "SELECT * FROM `video_like_dislike_info` WHERE `video_id` = '$video_uuid_new' AND `user_id` = '$user_address'");

if (mysqli_num_rows($is_user_exits) != 0) {
    $user_like_status = true;
    while ($row = mysqli_fetch_assoc($is_user_exits)) {
        $video_current_status = $row['video_status'];
    }
} else {
    $user_like_status = false;
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
        gap: 0.5rem !important;
    }

    .gap-2 button {
        border-radius: 20px !important;
        box-shadow: 0 10px 16px 1px rgb(16 16 16 / 79%);
        color: #fff !important;
        background: #484747 !important;
        border-color: #484747 !important;
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
</style>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-53J6JBV" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- Banner Start -->
    <?php if (isset($_GET['course'])) { ?>
        <input type="hidden" name="videoUId" id="videoUId" value="<?= $video_uuid_new ?>">
        <input type="hidden" name="chooseChain" id="chooseChain">
        <input type="hidden" name="userAddress" id="userAddress" value="<?= $user_address ?>">

        <div class="video-container setvideoSize" style="overflow: hidden !important;">
            <!-- ------------------------- dynamic load iframe here start-------------------------- -->
            <div class="videopart">
                <div class="container-fluid p-0 setvideoSize2" id="videoheight" style="width:100%;display:<?php echo $showPaid; ?>">
                    <a href="./courses" class="back_button" style="z-index: 888;position:absolute;padding:1.5rem;">
                        <i class="ri-arrow-left-line"></i>
                    </a>
                    <video id="myvideo" class="video-js vjs-default-skin vjs-big-play-centered" controls autoplay data-setup='{"playbackRates": [1, 1.2, 1.5,1.7,2,4]}' style="height:100%;width:100%;">
                        <source id="myvideo540" src='<?php echo $video_url; ?>' label='540p' res='540' type="video/mp4" />
                        <source id="myvideo360" src='<?php echo $video_url; ?>' label='360p' res='360' type="video/mp4" />
                        <source id="myvideo180" src='<?php echo $video_url; ?>' label='180p' res='180' type="video/mp4" />
                        <source id="myvideo270" src='<?php echo $video_url; ?>' label='270p' res='270' type="video/mp4" />
                        <source id="myvideo720" src='<?php echo $video_url; ?>' label='720p' res='720' type="video/mp4" />
                        <source id="myvideo2160" src='<?php echo $video_url; ?>' label='4k' res='2160' type="video/mp4" />
                    </video>
                    <div class="next_button" style="z-index: 888;position:absolute;padding:1.5rem;margin-top:-85px;right:1rem;display:none;">
                        <a style="padding: 0.5rem 1rem;" class="btn btn-hover" id="setNextEpisode">Next Video</a>
                    </div>
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
                            <div class="d-flex justify-content-start align-items-center gap-2 mb-2">
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
                                <div class="d-flex justify-content-center align-items-center gap-2 like-panel py-3">
                                    <span class="d-flex justify-content-center align-items-center gap-2">
                                        <i class="fa fa-share"></i><span class="likeclass">Share</span>
                                    </span>
                                </div>
                                <div class="d-flex justify-content-center align-items-center gap-2 like-panel py-3">
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
                            <p class="trending-dec w-100 mb-0"><?php echo $desc; ?></p>
                            <!-- <ul class="list-inline p-0 mt-4 share-icons music-play-lists">
                            <li><span><i class="ri-information-fill"></i></span></li>
                            <li><span><i class="ri-heart-fill"></i></span></li>
                            <li class="share">
                            <span><i class="ri-share-fill"></i></span>
                            <div class="share-box">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="share-ico"><i class="ri-facebook-fill"></i></a>
                                    <a href="#" class="share-ico"><i class="ri-twitter-fill"></i></a>
                                    <a href="#" class="share-ico"><i class="ri-links-fill"></i></a>
                                </div>
                            </div>
                            </li>
                        </ul> -->
                            <?php if (!isset($donate_eth_address)) {
                                echo '<button class="fw-bold mt-3 btn btn-hover px-5 py-2 w-auto" onClick="login()"><img src="images/metamask-fox.svg"><span class="ms-2">Donate<span class="d-lg-none"> with MetaMask</span></span></button>';
                            } else {
                                echo '<button class="fw-bold mt-3 btn btn-hover px-5 py-2 w-auto" data-bs-toggle="modal" data-bs-target="#metamaskDonateModal"><img src="images/metamask-fox.svg"><span class="mx-2">Donate<span class="d-lg-none">with MetaMask </span></span></button>'; ?>
                            <?php
                            } ?>
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
                                <button class="btn btn-light px-2 py-1" style="background:var(--text-color);color:#103375bd;border-radius:20px;" id="dollar1" class="dollar_click">$1</button>
                                <button class="btn btn-light px-2 py-1" style="background:var(--text-color);color:#103375bd;border-radius:20px;" id="dollar2" class="dollar_click">$2</button>
                                <button class="btn btn-light px-2 py-1" style="background:var(--text-color);color:#103375bd;border-radius:20px;" id="dollar5" class="dollar_click">$5</button>
                                <button class="btn btn-light px-2 py-1" style="background:var(--text-color);color:#103375bd;border-radius:20px;" id="dollar10" class="dollar_click">$10</button>
                                <button class="btn btn-light px-2 py-1" style="background:var(--text-color);color:#103375bd;border-radius:20px;" id="dollar20" class="dollar_click">$20</button>
                                <button class="btn btn-light px-2 py-1" style="background:var(--text-color);color:#103375bd;border-radius:20px;" id="dollar50" class="dollar_click">$50</button>
                                <button class="btn btn-light px-2 py-1" style="background:var(--text-color);color:#103375bd;border-radius:20px;" id="dollar100" class="dollar_click">$100</button>
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
    <script>
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
                // } else if (chainValue === "matic-network") {
                //     chainId = "137"; // MATIC Testnet
                //     HexchainId = "0x89"; // Hex MATIC Testnet
                //     coinSymble = 'MATIC';
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
    </script>
</body>

</html>
<?php
?>