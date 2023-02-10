<?php require_once "php/controllerUserData.php"; ?>
<?php
require_once('php/link.php');
if (!isset($_SESSION['userAddress'])) {
    header("Location: login-user-mm");
    exit;
} else {
    $metamask_address = $_SESSION['userAddress'];
    $username = '';
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    }

    // $publicName = $_SESSION['publicName'];
    $sql = "SELECT * FROM user_login  WHERE metamask_address = '$metamask_address'";
    $run_Sql = mysqli_query($con, $sql);
    if ($run_Sql) {
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        if (!empty($fetch_info)) {
            $first_time_login = $fetch_info['first_time_login'];
            if ($first_time_login === 'true') {
                $_SESSION['username'] = $fetch_info['username'];
                header("Location: index");
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register New Account | Finflix </title>
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

        a {
            color: #0063cf;
        }

        .btn {
            z-index: 0;
        }

        .sign-in{
            height: 100vh;
            position: relative;
            background: url(images/login.jpg) no-repeat scroll 0 0;
            background-size: cover;
        }
    </style>
    <!-- Css for view password icon ends -->
</head>

<body>

<div id="loading">
        <div id="loading-center">
        </div>
    </div>

    <?php
    // $result = mysqli_query($con, 'SELECT * FROM `logo`');
    // $rowLogo = mysqli_fetch_assoc($result);
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

                                            <div class="login-content-panel-text px-4 pt-3 pt-lg-0">
                                                <p>Please enter the following details, remember this will be your social Id linked to the Finflix
                                                    platform and your wallet and it cannot be changed later.</p>
                                                <div class="d-flex justify-content-center align-items-center my-3">
                                                    <span class="st-line-style" style="width:28%;"></span>&nbsp;it's quick and easy&nbsp;<span class="st-line-style" style="width:28%;"></span>
                                                </div>
                                                <div>
                                                    <form class="register" action="signup-user" method="GET" autocomplete="">
                                                        <?php
                                                        if (count($errors) == 1) {
                                                        ?>
                                                            <div class="alert alert-danger text-center my-3">
                                                                <?php
                                                                foreach ($errors as $showerror) {
                                                                    echo $showerror;
                                                                }
                                                                ?>
                                                            </div>
                                                        <?php
                                                        } elseif (count($errors) > 1) {
                                                        ?>
                                                            <div class="alert alert-danger my-3">
                                                                <?php
                                                                foreach ($errors as $showerror) {
                                                                ?>
                                                                    <li><?php echo $showerror; ?></li>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                        <div class="form-group mb-3">
                                                            <input class="form-control" type="text" name="name" placeholder="Full Name" required>
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <input class="form-control" type="text" name="username" placeholder="Username" required value="<?php echo $username ?>" id="user_username">
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <input class="form-control" type="hidden" name="metamask_address" value="<?php echo $metamask_address ?>" required>
                                                        </div>
                                                        <p style="margin-top:1px;font-size:14px;"><b>Please note:</b>&nbsp;Do not use any special
                                                            characters ( , ; - " etc.)</p>
                                                        <div class="d-grid mb-4 w-100">
                                                            <input class="btn button-primary w-100 gradient-custom-2 text-white" type="submit" name="signup" value="Confirm">
                                                        </div>
                                                    </form>
                                                </div>

                                                <p class="mt-1">By continuing, you are indicating that you accept our Terms of use and Privacy
                                                    Policy.</p>

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

    <!-- Javascript for view password starts-->
    <script type="text/javascript">
        $(".toggle-password").click(function() {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        $(function() {
            $('#user_username').keyup(function() {
                $(this).val($(this).val().replace(/ +?/g, ''));
            });
        });
    </script>
    <!-- Javascript for view password ends-->
</body>

</html>