<?php
    require_once 'link.php';
if(isset($_POST['email'])){ 
    $sub_id = "";
    $email = mysqli_real_escape_string($con, $_POST['email']) ;

    $query = mysqli_query($con, "SELECT * FROM `users` WHERE `email` = '$email'");
    
    if (mysqli_num_rows($query) !=0 ) {
        while ($row = mysqli_fetch_array($query)) {
            $sub_id = $row['razorpay_subscription_id'];
        }
    }
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://rzp_test_tUDUQr0j70BmaQ:kyoJ0uxryFunZknKWvjvv3bB@api.razorpay.com/v1/subscriptions/$sub_id/cancel",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded",
            "postman-token: 67d92778-3ca8-ffb4-9680-c384d115f95a"
        ),
    )); 

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
}
?>