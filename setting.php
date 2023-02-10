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
   <title>Streamit - Responsive Bootstrap 4 Template</title>
   <!-- Favicon -->
   <link rel="shortcut icon" href="images/favicon.ico" />
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="css/bootstrap.min.css" />
   <!-- Typography CSS -->
   <link rel="stylesheet" href="css/typography.css">
   <!-- Style -->
   <link rel="stylesheet" href="css/style.css" />
   <!-- Responsive -->
   <link rel="stylesheet" href="css/responsive.css" />
   <link rel="stylesheet" href="assets/css/circle_progress_bar.css">
   <style type="text/css">
      .text-primary {
         color: #007bff !important;
      }
   </style>
</head>

<body>
   <input type="hidden" name="total_time_to_reward_in_hr" value="<?= $total_time_to_reward_in_hr ?>" id="total_time_to_reward_in_hr">
   <input type="hidden" name="total_view_in_sec" value="<?= $total_view_in_sec ?>" id="total_view_in_sec">
   <!-- Header -->
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
   <!-- Header End -->
   <!-- MainContent -->
   <section class="m-profile setting-wrapper">
      <div class="container">
         <h4 class="main-title mb-4">Account Setting</h4>
         <div class="row">
            <div class="col-lg-4 mb-3">
               <div class="sign-user_card text-center">
                  <img src="images/user/user.jpg" class="rounded-circle img-fluid d-block mx-auto mb-3" alt="user" loading="lazy">
                  <h4 class="mb-3">John Doe</h4>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                  <a href="#" class="edit-icon text-primary">Edit</a>
               </div>
            </div>
            <div class="col-lg-8">
               <div class="sign-user_card">
                  <h5 class="mb-3 pb-3 a-border">Personal Details</h5>
                  <div class="row align-items-center justify-content-between mb-3">
                     <div class="col-md-8">
                        <span class="text-light font-size-13">Name</span>
                        <p class="mb-0">DragonAarya</p>
                     </div>
                     <div class="col-md-4 text-md-right text-left">
                        <a href="#" class="text-primary">Change</a>
                     </div>
                  </div>
                  <div class="row align-items-center justify-content-between mb-3">
                     <div class="col-md-8">
                        <span class="text-light font-size-13">Bio</span>
                        <p class="mb-0">hello I am full stack developer</p>
                     </div>
                     <div class="col-md-4 text-md-right text-left">
                        <a href="#" class="text-primary">Change</a>
                     </div>
                  </div>
                  <div class="row align-items-center justify-content-between mb-3">
                     <div class="col-md-8">
                        <span class="text-light font-size-13">Metamask Address</span>
                        <p class="mb-0">123121313131313131313</p>
                     </div>
                     <div class="col-md-4 text-md-right text-left">
                        <a href="#" class="text-primary">Change</a>
                     </div>
                  </div>
                  <div class="row align-items-center justify-content-between mb-3">
                     <div class="col-md-8">
                        <span class="text-light font-size-13">Twitter</span>
                        <p class="mb-0">none</p>
                     </div>
                     <div class="col-md-4 text-md-right text-left">
                        <a href="#" class="text-primary">Change</a>
                     </div>
                  </div>
                  <div class="row align-items-center justify-content-between mb-3">
                     <div class="col-md-8">
                        <span class="text-light font-size-13">Facebook</span>
                        <p class="mb-0">none</p>
                     </div>
                     <div class="col-md-4 text-md-right text-left">
                        <a href="#" class="text-primary">Change</a>
                     </div>
                  </div>
                  <div class="row align-items-center justify-content-between mb-3">
                     <div class="col-md-8">
                        <span class="text-light font-size-13">Instagram</span>
                        <p class="mb-0">none</p>
                     </div>
                     <div class="col-md-4 text-md-right text-left">
                        <a href="#" class="text-primary">Change</a>
                     </div>
                  </div>
                  <div class="row align-items-center justify-content-between mb-3">
                     <div class="col-md-8">
                        <span class="text-light font-size-13">Linkedin</span>
                        <p class="mb-0">none</p>
                     </div>
                     <div class="col-md-4 text-md-right text-left">
                        <a href="#" class="text-primary">Change</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
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
            <p class="mb-0 text-center font-size-14 text-body">Finflix - 2022 All Rights Reserved</p>
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
   <!-- owl carousel Js -->
   <script src="js/owl.carousel.min.js"></script>
   <!-- select2 Js -->
   <script src="js/select2.min.js"></script>
   <!-- Magnific Popup-->
   <script src="js/jquery.magnific-popup.min.js"></script>
   <!-- Custom JS-->
   <script src="js/custom.js"></script>
   <!-- rtl -->
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