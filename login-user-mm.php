<?php
session_start();
require_once('php/link.php');
if (isset($_SERVER['HTTP_REFERER'])) {
    $referer = filter_var($_SERVER['HTTP_REFERER'], FILTER_VALIDATE_URL);
}

if (isset($_SESSION['userAddress'])) {
    header("Location: index");
    exit;
} else {
    session_unset();
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login | Finflix </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- favicon -->
    <link rel="icon" href="assets/images/logo/favicon.ico">

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- icons pack -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" />

    <!-- stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/typography.css">

    <!-- Css for view password icon starts -->
    <style type="text/css">
        .field-icon {
            float: right;
            margin-left: -25px;
            margin-top: -25px;
            position: relative;
            z-index: 2;
        }

        .st-line-style {
            width: 4rem;
            height: 0.1rem;
            background: #adb5bd;
        }

        a {
            color: #0063cf;
        }

        .btn {
            z-index: 0;
        }

        .gradient-custom-2 {
            background: #0063cf;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #0063cf, #11929b);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #0063cf, #11929b);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }

        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }            
        }

        @media (max-width: 769px) {
            .sign-in{
                padding: 0 10px !important;
            }

            .gradient-custom-2{
                margin: 0 1rem;
            }

            .st-line-style{
                width: 24% !important;
            }
        }

        .bottom-panel-login-page-list-wrapper {
            list-style: none;
            margin-left: -2rem;
        }

        .bottom-panel-login-page-list-wrapper>li>a {
            text-decoration: none;
        }

        #buttonText:hover {
            background: #117a8b !important;
        }

        .sign-in{
            height: 100vh;
            position: relative;
            background: url(images/login.jpg) no-repeat scroll 0 0;
            background-size: cover;
        }
    </style>
    <!-- Css for view password icon ends -->

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>

    <script type="text/javascript" src="https://unpkg.com/web3modal@1.9.0/dist/index.js"></script>
    <script type="text/javascript" src="https://unpkg.com/@walletconnect/web3-provider@1.2.1/dist/umd/index.min.js">
    </script>
</head>

<body>

    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->

    <?php
    //   $result = mysqli_query($con, 'SELECT * FROM `logo`');
    //   $rowLogo = mysqli_fetch_assoc($result);
    ?>

    <div class="container-fluid sign-in">
        <div class="row">
            <section class="h-100 w-100 gradient-form">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-xl-10">
                            <div class="card rounded-3 text-black">
                                <div class="row g-0">
                                    <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                        <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                            <h4 class="mb-4">We are more than just a company</h4>
                                            <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card-body p-md-5">
                                            <div class="text-center">
                                                <img src="images/fin-logo.jpg" style="width: 185px;cursor: pointer;" alt="logo" onclick="window.location.replace('index')">
                                                <h5 class="mb-5 pb-1">Learn With Entertainment</h5>
                                            </div>

                                            <div>
                                                <div class="login-content-panel-text pt-3 pt-lg-0">
                                                    <div class="d-flex justify-content-center align-items-center my-3">
                                                        <span class="st-line-style" style="width:34%;"></span>&nbsp;login/create with&nbsp;<span class="st-line-style" style="width:34%;"></span>
                                                    </div>
                                                    <!-- msg box start -->
                                                    <p id='userWallet' class='text-truncate'></p>
                                                    <div id="needMetamask" style="display:none;color: #1a8917;" class="user-login-msg">
                                                        To login, first install a Web3 wallet like the <a href="https://metamask.io/" style="color:#1a8917" target="_blank">MetaMask</a> browser extension or mobile
                                                        app
                                                    </div>
                                                    <div id="needLogInToMetaMask" style="display:none;color: #1a8917;" class="user-login-msg">
                                                        Log in to your wallet account first!
                                                    </div>
                                                    <div id="signTheMessage" style="display:none;color: #1a8917;" class="user-login-msg">
                                                        Sign the message with your wallet to authenticate
                                                    </div>
                                                    <div id="loggedIn" style="display:none;color: #1a8917;" class="user-login-msg">
                                                        Successful authentication for address:<br><span id="ethAddress" style="word-break: break-all;"></span>
                                                    </div>
                                                    <!-- msg box end -->
                                                    <p>If you want to access an earlier created account please use the wallet you had used to create it.
                                                    </p>
                                                    <div class="d-grid mb-2 my-3">
                                                        <button id="buttonText" onclick="userLoginOut()" class="btn button-primary button-text-metamask shadow gradient-custom-2">
                                                            <img src="images/metamask.png" alt="metamask" class="img-responsive button-image" style="width: 45%;">
                                                        </button>
                                                    </div>
                                                    <p>install&nbsp;<a href="https://metamask.io/" target="_blank" class="button-text-metamask-anchor">MetaMask</a></p>
                                                    <p class="mt-1">After clicking on the above options you will be redirected to your wallet's
                                                        respecting signature
                                                        pages, please sign the message to continue with the login process.</p>
                                                    <div class="bottom-panel-login-page">
                                                        <h5 class="bottom-panel-login-page-heading">if you need help contact here:</h5>
                                                        <ul class="bottom-panel-login-page-list-wrapper">
                                                            <li>
                                                                <a href="#" class="element-social-link">
                                                                    <span>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16">
                                                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z" />
                                                                        </svg>
                                                                    </span>
                                                                    <span class="mx-2">Finflix</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" class="element-social-link">
                                                                    <span>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                                                            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                                                                        </svg>
                                                                    </span>
                                                                    <span class="mx-2">@Finflix</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" class="element-social-link">
                                                                    <span>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                                                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                                                        </svg>
                                                                    </span>
                                                                    <span class="mx-2">team@finflix.com</span>
                                                                </a>
                                                            </li>
                                                        </ul>
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
            </section>
        </div>
    </div>

    <!-- script -->
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
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
    <script src="frontend/web3-login.js?v=009"></script>
    <script src="frontend/web3-modal.js?v=001"></script>
</body>

</html>