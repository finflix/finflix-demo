<?php

require_once 'link.php';
if(isset($_POST['razorpay_idpay'])){

    $response1 = array();  
    $from_ip = $_SERVER['REMOTE_ADDR'];
    $from_browser = $_SERVER['HTTP_USER_AGENT'];
    date_default_timezone_set("Asia/Calcutta");
    $date_now = date("r");

    $payementid = mysqli_real_escape_string($con, $_POST['razorpay_idpay']) ;
    $amounts = 100;
    $amounts = $amounts*100 ;
    $currency_code = "INR";
    function get_curl_handle($payementid, $data) {
    $url = 'https://api.razorpay.com/v1/payments/' . $payementid . '/capture';
    $params = http_build_query($data);

    $key_id = "rzp_test_tUDUQr0j70BmaQ";
    $key_secret = "kyoJ0uxryFunZknKWvjvv3bB";

    //cURL Request
    $ch = curl_init();
    //set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERPWD, $key_id . ':' . $key_secret);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    return $ch;
}
$data = array(
    'amount' => $amounts,
    'currency' => $currency_code,
);
$success = false;
$error = '';
try {
    $ch = get_curl_handle($payementid, $data);
    //execute post
    $result = curl_exec($ch);
    $data = json_decode($result);
   
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
 
    if ($result === false) {
        $success = false;
        $error = 'Curl error: ' . curl_error($ch);
    } else {
        $response_array = json_decode($result, true);
        //Check success response
        if ($http_status === 200 and isset($response_array['error']) === false) {
            $success = true;
        } else {
            $success = false;
            if (!empty($response_array['error']['code'])) {
                $error = $response_array['error']['code'] . ':' . $response_array['error']['description'];
            } else {
                $error = 'Invalid Response <br/>' . $result;
            }
        }
    }
    //close connection
    curl_close($ch);
} catch (Exception $e) {
    $success = false;
    $error = 'Request to Razorpay Failed';
}
if ($success === true) {
    $capture_status = "Captured" ;
}else{
    $capture_status = $error ;
}
    $response1['status'] = 201;
    $response1['total'] = $success ;
    $response1['currency_code'] = $currency_code ;
    $response1['error'] = $error ;
    $response1['capture_status'] = $capture_status ;
    echo json_encode($response1);
}
// $payementid = mysqli_real_escape_string($conn,$_POST['razorpay_idpay']);
// $amount = $_POST['amounts'];
// $currency_code = "INR";
// function get_curl_handle($payementid, $data) {
//     $url = 'https://api.razorpay.com/v1/payments/' . $payementid . '/capture';
//     $key_id = "Parvinderkc123@gmail.com";
//     $key_secret = "chalotra12345";
//     $params = http_build_query($data);
//     //cURL Request
//     $ch = curl_init();
//     //set the url, number of POST vars, POST data
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_USERPWD, $key_id . ':' . $key_secret);
//     curl_setopt($ch, CURLOPT_TIMEOUT, 60);
//     curl_setopt($ch, CURLOPT_POST, 1);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
//     return $ch;
// }
// // $amount = $_POST['amount'];

// $data = array(
//     'amount' => $amount,
//     'currency' => $currency_code,
// );
// $ch = get_curl_handle($payementid, $data);
// $responses = curl_exec($ch);
// // $data = json_decode($result);
// // $responses = curl_exec($curl);
//     $err =  curl_error($ch);

//     curl_close($ch);

//     if ($err) {
//         echo "cURL Error #:" . $err;
//     } else {
//         echo $responses;
//     }
    


// }
  

?>