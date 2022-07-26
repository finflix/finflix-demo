<?php
session_start();
include("php/link.php");
$client = 'https://ipfs.io/ipfs/';
$user_address = '';
if(isset($_SESSION['userAddress'])){
    $user_address = $_SESSION['userAddress'];
}else{
    $user_address = '';
}
{
   $showYoutube = 'none';
   $showPaid = 'none';
   $p_id = '';
   $subtitles = "";
   $src180 = "";
   $src270 = "";
   $src360 = "";
   $src540 = "";
   $src720 = "";
   $course = "";
   $event_name = '';
   $video_url = '';
   $module_name='';
if (isset($_GET['course']) && isset($_GET['module'])) {
      $course = $_GET['course'];
      $result2 = mysqli_query($con, "SELECT * FROM `video_info` WHERE `video_uid` = '$course'");
      if (mysqli_num_rows($result2) > 0) {
         while ($row = mysqli_fetch_assoc($result2)) {        
               $showYoutube = 'none';
               $showPaid = 'block';             
               $course_ID = $row['video_id'];
               $subtitles = '';
               $title = $row['name'];
               $date = $row['from_time'];
               $desc = $row['video_desc'];
               $module_name = $row['module'];
               $thumbnail2 =  $client.$row['thumbnail_ipfs'];

               $curl = curl_init();
               curl_setopt_array($curl, array(
                 CURLOPT_URL => 'https://livepeer.studio/api/asset/'.$course,
                 CURLOPT_RETURNTRANSFER => true,
                 CURLOPT_ENCODING => '',
                 CURLOPT_MAXREDIRS => 10,
                 CURLOPT_TIMEOUT => 0,
                 CURLOPT_FOLLOWLOCATION => true,
                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                 CURLOPT_CUSTOMREQUEST => 'GET',
                 CURLOPT_HTTPHEADER => array(
                   'Authorization: Bearer 254e4297-7bbd-4c5c-8734-a931bbd395fe'
                 ),
               ));   
               $response = curl_exec($curl);   
               curl_close($curl);
            $someArray = json_decode($response, true);
            foreach($someArray as $key => $value) {  
               if('playbackUrl' === $key)  
               $video_url = ($value);              
            }
         }
      }
   } else {
      header("Location: playlist");
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
    <link href="https://vjs.zencdn.net/7.7.5/video-js.css" rel="stylesheet" />
    <link href="libs/videojs-resolution-switcher.css" rel="stylesheet">
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
        height: 80vh !important;
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
</style>

<body>
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- Banner Start -->
    <?php
      if (isset($_GET['course'])) {
         ?>
    <div class="video-container setvideoSize" style="overflow: hidden !important;">
        <!-- ------------------------- dynamic load iframe here start-------------------------- -->
        <div class="videopart">
            <div class="container-fluid p-0 setvideoSize2" id="videoheight"
                style="width:100%;display:<?php echo $showPaid ?>">
                <a href="./courses" class="back_button" style="z-index: 888;position:absolute;padding:1.5rem;">
                    <i class="ri-arrow-left-line"></i>
                </a>
                <video id="myvideo" class="video-js vjs-default-skin vjs-big-play-centered" controls autoplay
                    data-setup='{"playbackRates": [1, 1.2, 1.5,1.7,2,4]}' style="height:100%;width:100%;">
                    <source id="myvideo540" src='<?php echo $video_url ?>' label='540p' res='540' />
                    <source id="myvideo360" src='<?php echo $video_url ?>' label='360p' res='360' />
                    <source id="myvideo180" src='<?php echo $video_url ?>' label='180p' res='180' />
                    <source id="myvideo270" src='<?php echo $video_url ?>' label='270p' res='270' />
                    <source id="myvideo720" src='<?php echo $video_url ?>' label='720p' res='720' />
                    <source id="myvideo2160" src='<?php echo $video_url ?>' label='4k' res='2160' />
                </video>
                <div class="next_button"
                    style="z-index: 888;position:absolute;padding:1.5rem;margin-top:-85px;right:1rem;display:none;">
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
                        <div class="d-flex align-items-center text-white text-detail">
                            <span class="badge badge-secondary p-3"><?= $module_name ?></span>
                            <span class="ml-3">3h 15m</span>
                            <span class="trending-year"><?php echo $date; ?></span>
                        </div>
                        <div class="d-flex align-items-center series mb-4">
                            <a href="javascript:void();"><img src='<?= $thumbnail2 ?>' class="img-fluid img-responsive" alt="" style="height:72px;object-fit:cover;"></a>
                            <span class="text-gold ml-3">#2 <?= $module_name?></span>
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
                                    <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>">
                                        <div class="block-images position-relative">
                                            <div class="img-box my-img-container">
                                                <img src="<?= $thumbnail ?>" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6><?= $chapter_name ?></h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2"><?= $module_name ?></div>
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
                                <?php  $i=$i+1;}
                              } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php
      } else {
         header("Location: index");
      }
      ?>
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
                    window.location.href =`./favourite?user=${user_id}`;
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
<?php
}
?>